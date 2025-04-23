<?php

namespace App\Services;

use App\Models\CaseHearing;
use App\Models\ConflictLog;
use Carbon\Carbon;

class ConflictDetectorService
{

    public function detectAndLogConflicts(CaseHearing $hearing): void
    {
        $case = $hearing->case;
        if (!$case || !$case->client) {
            return;
        }

        $companyId = $case->company_id;
        $hearingStart = $this->combineDateAndTime($hearing->hearing_date, $hearing->hearing_time);
        $hearingEnd = $hearingStart->copy()->addMinutes(60);

        $otherHearings = CaseHearing::whereHas('case', function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })
        ->where('id', '!=', $hearing->id)
        ->whereDate('hearing_date', $hearing->hearing_date)
        ->get();

        foreach ($otherHearings as $other) {
            $otherCase = $other->case;

            if (!$otherCase || !$otherCase->client || $otherCase->id === $case->id) {
                continue;
            }

            $otherStart = $this->combineDateAndTime($other->hearing_date, $other->hearing_time);
            $otherEnd = $otherStart->copy()->addMinutes(60);

            if ($hearingStart < $otherEnd && $hearingEnd > $otherStart) {
                $this->logConflict($hearing, $other, $companyId, $hearingStart);
            }
        }
    }


    public function deleteConflictsFor(CaseHearing $hearing): void
    {
        ConflictLog::where(function ($q) use ($hearing) {
            $q->where('case_hearing_id_1', $hearing->id)
              ->orWhere('case_hearing_id_2', $hearing->id);
        })->delete();
    }


    protected function combineDateAndTime($date, $time): Carbon
    {
        return Carbon::parse("{$date} {$time}")->startOfMinute();
    }


    protected function logConflict(CaseHearing $hearing, CaseHearing $other, $companyId, Carbon $conflictDateTime): void
    {
        [$id1, $id2] = $hearing->id < $other->id ? [$hearing->id, $other->id] : [$other->id, $hearing->id];
        [$caseNum1, $caseNum2] = strcmp($hearing->case->case_number, $other->case->case_number) < 0
            ? [$hearing->case->case_number, $other->case->case_number]
            : [$other->case->case_number, $hearing->case->case_number];

        $exists = ConflictLog::where('case_hearing_id_1', $id1)
            ->where('case_hearing_id_2', $id2)
            ->where('conflict_date_time', $conflictDateTime->toDateTimeString())
            ->exists();

        if (!$exists) {
            ConflictLog::create([
                'company_id' => $companyId,
                'recipient_name' => $hearing->case->client->name,
                'recipient_case_number' => $hearing->case->case_number,
                'conflict_case_number_1' => $caseNum1,
                'conflict_case_number_2' => $caseNum2,
                'case_hearing_id_1' => $id1,
                'case_hearing_id_2' => $id2,
                'conflict_date_time' => $conflictDateTime,
                'record_generated_at' => now(),
                'status' => $conflictDateTime->isPast() ? 'history' : 'upcoming',
            ]);
        }
    }
}
