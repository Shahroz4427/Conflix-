<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ResolveConflict\UpdateConflictLogRequest;
use App\Models\CaseHearing;
use App\Models\ConflictLog;
use App\Services\ResolveConflictLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ResolveConflictLogController extends Controller
{
    /**
     * Constructor to inject the ResolveConflictLogService dependency.
     * 
     * @param ResolveConflictLogService $conflictLogService
     */
    public function __construct(
        protected ResolveConflictLogService $conflictLogService
    ) {}

    /**
     * Show the form for resolving a conflict log.
     * 
     * @param ConflictLog $conflictLog
     * @return View
     */
    public function edit(ConflictLog $conflictLog): View
    {
        // Fetch all courts for the form
        $courts = $this->conflictLogService->getAllCourts();

        // Fetch the first conflicting case hearing
        $caseHearing1 = $this->conflictLogService->findConflictCaseHearing($conflictLog->case_hearing_id_1);

        // Fetch the second conflicting case hearing
        $caseHearing2 = $this->conflictLogService->findConflictCaseHearing($conflictLog->case_hearing_id_2);

        // Return the edit view with the fetched data
        return view('company.resolve_conflict.edit', compact('caseHearing1', 'caseHearing2', 'courts'));
    }

    /**
     * Update the specified conflict log and resolve the conflict.
     * 
     * @param UpdateConflictLogRequest $request
     * @param CaseHearing $caseHearing
     * @return RedirectResponse
     */
    public function update(UpdateConflictLogRequest $request, CaseHearing $caseHearing): RedirectResponse
    {
        // Validate and update the conflict log to resolve the conflict
        $this->conflictLogService->update($request->validated(), $caseHearing);

        // Redirect to the conflict logs index page with a success message
        return redirect()->route('company.conflict_logs.index')
            ->with('success', 'Hearing updated successfully.');
    }
}
