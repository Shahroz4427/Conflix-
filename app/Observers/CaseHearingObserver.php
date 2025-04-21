<?php

namespace App\Observers;

use App\Models\CaseHearing;
use App\Models\ConflictLog;
use Carbon\Carbon;

class CaseHearingObserver
{
    public function created(CaseHearing $hearing)
    {
        $this->checkForConflicts($hearing);
    }

    public function updated(CaseHearing $hearing)
    {
        $this->deleteRelatedConflictLogs($hearing);
        $this->checkForConflicts($hearing);
    }

    public function deleted(CaseHearing $hearing)
    {
        $this->deleteRelatedConflictLogs($hearing);
    }

    protected function checkForConflicts(CaseHearing $hearing): void
    {
        if (!$hearing->case || !$hearing->case->client) {
            return;
        }

        $companyId = $hearing->case->company_id;
        $hearingDateTime = $this->getDateTime($hearing);

        $otherHearings = CaseHearing::whereHas('case', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->where('id', '!=', $hearing->id)
            ->whereDate('hearing_date', $hearing->hearing_date)
            ->get();

        foreach ($otherHearings as $other) {
            if (
                !$other->case || !$other->case->client ||
                $other->case->id === $hearing->case->id
            ) {
                continue;
            }

            $otherDateTime = $this->getDateTime($other);


            if ($hearingDateTime->diffInMinutes($otherDateTime) >= 60) {
                continue;
            }

         
            [$id1, $id2] = $hearing->id < $other->id
                ? [$hearing->id, $other->id]
                : [$other->id, $hearing->id];

            [$conflictCase1, $conflictCase2] = $hearing->case->case_number < $other->case->case_number
                ? [$hearing->case->case_number, $other->case->case_number]
                : [$other->case->case_number, $hearing->case->case_number];


            $alreadyLogged = ConflictLog::where('case_hearing_id_1', $id1)
                ->where('case_hearing_id_2', $id2)
                ->where('conflict_date_time', $hearingDateTime)
                ->exists();

            if (!$alreadyLogged) {
                ConflictLog::create([
                    'company_id' => $companyId,
                    'recipient_name' => $hearing->case->client->name,
                    'recipient_case_number' => $hearing->case->case_number,
                    'conflict_case_number_1' => $conflictCase1,
                    'conflict_case_number_2' => $conflictCase2,
                    'case_hearing_id_1' => $id1,
                    'case_hearing_id_2' => $id2,
                    'conflict_date_time' => $hearingDateTime,
                    'status' => $hearingDateTime->isPast() ? 'history' : 'upcoming',
                    'record_generated_at' => now(),
                ]);
            }
        }
    }

    protected function deleteRelatedConflictLogs(CaseHearing $hearing): void
    {
        ConflictLog::where(function ($q) use ($hearing) {
            $q->where('case_hearing_id_1', $hearing->id)
              ->orWhere('case_hearing_id_2', $hearing->id);
        })->delete();
    }

    protected function getDateTime(CaseHearing $hearing): Carbon
    {
        return Carbon::parse("{$hearing->hearing_date} {$hearing->hearing_time}")->startOfMinute();
    }
}
