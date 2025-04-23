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

    public function __construct(
        protected ResolveConflictLogService $conflictLogService
    ){}

    public function edit(ConflictLog $conflictLog): View
    {
        $courts = $this->conflictLogService->getAllCourts();

        $caseHearing1 = $this->conflictLogService->findConflictCaseHearing($conflictLog->case_hearing_id_1);

        $caseHearing2 = $this->conflictLogService->findConflictCaseHearing($conflictLog->case_hearing_id_2);

        return view('company.resolve_conflict.edit', compact('caseHearing1', 'caseHearing2', 'courts'));
    }

    public function update(UpdateConflictLogRequest $request, CaseHearing $caseHearing): RedirectResponse
    {
        $this->conflictLogService->update($request->validated(), $caseHearing);

        return redirect()->route('company.conflict_logs.index')
            ->with('success', 'Hearing updated successfully.');
    }
}
