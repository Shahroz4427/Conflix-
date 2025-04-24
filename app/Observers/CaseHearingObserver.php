<?php

namespace App\Observers;

use App\Models\CaseHearing;
use App\Services\ConflictDetectorService;

class CaseHearingObserver
{
    protected ConflictDetectorService $conflictService;

    public function __construct(ConflictDetectorService $conflictService)
    {
        $this->conflictService = $conflictService;
    }

    /**
     * Handle the CaseHearing "created" event.
     *
     * @param CaseHearing $hearing
     * @return void
     */
    public function created(CaseHearing $hearing): void
    {
        // Detect conflicts and log them
        $this->conflictService->detectAndLogConflicts($hearing);
    }

    /**
     * Handle the CaseHearing "updated" event.
     *
     * @param CaseHearing $hearing
     * @return void
     */
    public function updated(CaseHearing $hearing): void
    {
        // Delete existing conflicts related to this hearing
        $this->conflictService->deleteConflictsFor($hearing);

        // Re-check for conflicts and log them
        $this->conflictService->detectAndLogConflicts($hearing);
    }

    /**
     * Handle the CaseHearing "deleted" event.
     *
     * @param CaseHearing $hearing
     * @return void
     */
    public function deleted(CaseHearing $hearing): void
    {
        // Delete conflicts related to this hearing
        $this->conflictService->deleteConflictsFor($hearing);
    }
}
