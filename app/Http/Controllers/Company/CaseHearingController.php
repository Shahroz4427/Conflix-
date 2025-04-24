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
    /**
     * Constructor to inject the CaseHearingRepository dependency.
     * 
     * @param CaseHearingRepositoryInterface $caseHearingRepository
     */
    public function __construct(
        protected CaseHearingRepositoryInterface $caseHearingRepository
    ) {}

    /**
     * Display a listing of the case hearings for a specific case.
     * 
     * @param CaseManagement $case
     * @return View
     */
    public function index(CaseManagement $case): View
    {
        // Fetch the client associated with the case
        $client = $this->caseHearingRepository->getClientFromCase($case);

        // Fetch all courts
        $courts = $this->caseHearingRepository->getAllCourt();

        // Fetch all hearings related to the case with pagination
        $hearings = $this->caseHearingRepository->getAllCaseRelatedHearingWithPagination($case);

        // Return the index view with the hearings, client, courts, and case data
        return view('company.hearings.index', compact('hearings', 'client', 'courts', 'case'));
    }

    /**
     * Show the form for editing the specified hearing.
     * 
     * @param CaseHearing $caseHearing
     * @return View
     */
    public function edit(CaseHearing $caseHearing): View
    {
        // Fetch all courts
        $courts = $this->caseHearingRepository->getAllCourt();

        // Fetch the case related to the hearing
        $case = $this->caseHearingRepository->getRelatedCase($caseHearing);

        // Fetch the client associated with the case
        $client = $this->caseHearingRepository->getClientFromCase($case);

        // Return the edit view with the hearing, courts, case, and client data
        return view('company.hearings.edit', compact('caseHearing', 'courts', 'case', 'client'));
    }

    /**
     * Store a newly created hearing in storage.
     * 
     * @param StoreCaseHearingRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCaseHearingRequest $request): RedirectResponse
    {
        // Validate and store the new hearing
        $this->caseHearingRepository->store($request->validated());

        // Redirect back with a success message
        return back()->with('success', 'Court date added successfully.');
    }

    /**
     * Update the specified hearing in storage.
     * 
     * @param UpdateCaseHearingRequest $request
     * @param CaseHearing $caseHearing
     * @return RedirectResponse
     */
    public function update(UpdateCaseHearingRequest $request, CaseHearing $caseHearing): RedirectResponse
    {
        // Validate and update the specified hearing
        $this->caseHearingRepository->update($request->validated(), $caseHearing);

        // Redirect back with a success message
        return back()->with('success', 'Hearing updated successfully.');
    }

    /**
     * Remove the specified hearing from storage.
     * 
     * @param CaseHearing $caseHearing
     * @return RedirectResponse
     */
    public function destroy(CaseHearing $caseHearing): RedirectResponse
    {
        // Delete the specified hearing
        $this->caseHearingRepository->delete($caseHearing);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Hearing deleted successfully.');
    }
}
