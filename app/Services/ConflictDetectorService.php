<?php

namespace App\Services;

use App\Models\CaseHearing;
use App\Models\ConflictLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ConflictDetectorService
{
    /**
     * Detect and log conflicts for a given hearing.
     *
     * @param CaseHearing $hearing The hearing to check for conflicts
     * @return void
     */
    public function detectAndLogConflicts(CaseHearing $hearing): void
    {
        // Ensure the hearing has an associated case and client
        $case = $hearing->case;
        if (!$case || !$case->client) {
            return;
        }

        // Get the company ID and calculate the hearing start and end times
        $companyId = $case->company_id;
        $hearingStart = $this->combineDateAndTime($hearing->hearing_date, $hearing->hearing_time);
        $hearingEnd = $hearingStart->copy()->addMinutes(60);

        // Fetch other hearings for the same company on the same date
        $otherHearings = $this->getOtherHearings($hearing, $companyId);

        // Check for conflicts with other hearings
        foreach ($otherHearings as $other) {
            $this->checkAndLogConflict($hearing, $other, $companyId, $hearingStart, $hearingEnd);
        }
    }

    /**
     * Delete all conflicts associated with a given hearing.
     *
     * @param CaseHearing $hearing The hearing to delete conflicts for
     * @return void
     */
    public function deleteConflictsFor(CaseHearing $hearing): void
    {
        // Delete conflicts where the hearing is involved
        ConflictLog::where(function ($q) use ($hearing) {
            $q->where('case_hearing_id_1', $hearing->id)
              ->orWhere('case_hearing_id_2', $hearing->id);
        })->delete();
    }

    /**
     * Combine a date and time into a Carbon instance.
     *
     * @param string $date The date
     * @param string $time The time
     * @return Carbon The combined date and time
     */
    protected function combineDateAndTime(string $date, string $time): Carbon
    {
        return Carbon::parse("$date $time")->startOfMinute();
    }

    /**
     * Log a conflict between two hearings.
     *
     * @param CaseHearing $hearing The first hearing
     * @param CaseHearing $other The conflicting hearing
     * @param int $companyId The company ID
     * @param Carbon $conflictDateTime The conflict date and time
     * @return void
     */
    protected function logConflict(CaseHearing $hearing, CaseHearing $other, int $companyId, Carbon $conflictDateTime): void
    {
        // Determine the order of the hearings for logging
        [$id1, $id2] = $hearing->id < $other->id ? [$hearing->id, $other->id] : [$other->id, $hearing->id];
        [$caseNum1, $caseNum2] = strcmp($hearing->case->case_number, $other->case->case_number) < 0
            ? [$hearing->case->case_number, $other->case->case_number]
            : [$other->case->case_number, $hearing->case->case_number];

        // Check if the conflict already exists
        $exists = ConflictLog::where('case_hearing_id_1', $id1)
            ->where('case_hearing_id_2', $id2)
            ->where('conflict_date_time', $conflictDateTime->toDateTimeString())
            ->exists();

        // If the conflict does not exist, log it
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

    /**
     * Fetch other hearings for the same company on the same date.
     *
     * @param CaseHearing $hearing The hearing to exclude
     * @param int $companyId The company ID
     * @return Collection The other hearings
     */
    protected function getOtherHearings(CaseHearing $hearing, int $companyId): Collection
    {
        return CaseHearing::whereHas('case', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->whereNotIn('id', [$hearing->id])
            ->whereDate('hearing_date', $hearing->hearing_date)
            ->get();
    }


    /**
     * Check and log a conflict between two hearings if they overlap.
     *
     * @param CaseHearing $hearing The first hearing
     * @param CaseHearing $other The second hearing
     * @param int $companyId The company ID
     * @param Carbon $hearingStart The start time of the first hearing
     * @param Carbon $hearingEnd The end time of the first hearing
     * @return void
     */
    protected function checkAndLogConflict(CaseHearing $hearing, CaseHearing $other, int $companyId, Carbon $hearingStart, Carbon $hearingEnd): void
    {
        $otherCase = $other->case;

        // Ensure the other hearing has an associated case and client
        if (!$otherCase || !$otherCase->client || $otherCase->id === $hearing->case->id) {
            return;
        }

        // Calculate the start and end times of the other hearing
        $otherStart = $this->combineDateAndTime($other->hearing_date, $other->hearing_time);
        $otherEnd = $otherStart->copy()->addMinutes(60);

        // Check if the hearings overlap and log the conflict if they do
        if ($hearingStart < $otherEnd && $hearingEnd > $otherStart) {
            $this->logConflict($hearing, $other, $companyId, $hearingStart);
        }
    }
}
