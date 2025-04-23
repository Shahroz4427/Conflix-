<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CaseHearing\StoreCaseHearingRequest;
use App\Http\Requests\Company\CaseHearing\UpdateCaseHearingRequest;
use App\Models\CaseHearing;
use App\Models\CaseManagement;
use App\Repositories\Interfaces\CaseHearingRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CaseHearingController extends Controller
{
    public function __construct(
        protected CaseHearingRepositoryInterface $caseHearingRepository
    ){}

    /**
     * Display a listing of the cases.
     */
    public function index(CaseManagement $case): View
    {
        $client = $this->caseHearingRepository->getClientFromCase($case);

        $courts = $this->caseHearingRepository->getAllCourt();

        $hearings = $this->caseHearingRepository->getAllCaseRelatedHearingWithPagination($case);

        return view('company.hearings.index',
            compact('hearings', 'client', 'courts', 'case'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseHearing $caseHearing): View
    {
        $courts = $this->caseHearingRepository->getAllCourt();

        $case = $this->caseHearingRepository->getRelatedCase($caseHearing);

        $client = $this->caseHearingRepository->getClientFromCase($case);

        return view('company.hearings.edit',
            compact('caseHearing', 'courts', 'case', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseHearingRequest $request): RedirectResponse
    {
        $this->caseHearingRepository->store($request->validated());

        return back()->with('success', 'Court date added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseHearingRequest $request, CaseHearing $caseHearing): RedirectResponse
    {
        $this->caseHearingRepository->update($request->validated(), $caseHearing);

        return back()->with('success', 'Hearing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseHearing $caseHearing): RedirectResponse
    {
        $this->caseHearingRepository->delete($caseHearing);

        return redirect()->back()->with('success', 'Hearing deleted successfully.');
    }


}
