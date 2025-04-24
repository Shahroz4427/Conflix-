<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CaseManagement\StoreCaseRequest;
use App\Http\Requests\Company\CaseManagement\UpdateCaseRequest;
use App\Models\CaseManagement;
use App\Repositories\Interfaces\CaseManagementRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CaseManagementController extends Controller
{
    /**
     * Constructor to inject the CaseManagementRepository dependency.
     * 
     * @param CaseManagementRepositoryInterface $caseManagementRepository
     */
    public function __construct(
        protected CaseManagementRepositoryInterface $caseManagementRepository
    ) {}

    /**
     * Display a listing of the cases.
     * 
     * @return View
     */
    public function index(): View
    {
        // Define the relations to load with each case
        $relations = ['client', 'lawyer', 'court'];

        // Fetch all cases with the specified relations and pagination
        $cases = $this->caseManagementRepository->getAllCasesWithRelationsAndPagination($relations);

        // Return the index view with the fetched cases
        return view('company.case_management.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        // Fetch all clients for the form
        $clients = $this->caseManagementRepository->getAllCompanyClients();

        // Fetch all lawyers for the form
        $lawyers = $this->caseManagementRepository->getAllCompanyLawyers();

        // Fetch all courts for the form
        $courts = $this->caseManagementRepository->getAllCourts();

        // Return the create view with the fetched data
        return view('company.case_management.create', compact('clients', 'lawyers', 'courts'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreCaseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCaseRequest $request): RedirectResponse
    {
        // Validate and store the new case
        $this->caseManagementRepository->store($request->validated());

        // Redirect to the index page with a success message
        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param CaseManagement $caseManagement
     * @return View
     */
    public function edit(CaseManagement $caseManagement): View
    {
        // Define the relations to load with the case
        $relations = ['client', 'lawyer', 'court'];

        // Load the specified case with the defined relations
        $this->caseManagementRepository->loadWithRelations($caseManagement, $relations);

        // Fetch all clients for the form
        $clients = $this->caseManagementRepository->getAllCompanyClients();

        // Fetch all lawyers for the form
        $lawyers = $this->caseManagementRepository->getAllCompanyLawyers();

        // Fetch all courts for the form
        $courts = $this->caseManagementRepository->getAllCourts();

        // Return the edit view with the fetched data and the case
        return view('company.case_management.edit', compact('clients', 'lawyers', 'courts', 'caseManagement'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateCaseRequest $request
     * @param CaseManagement $caseManagement
     * @return RedirectResponse
     */
    public function update(UpdateCaseRequest $request, CaseManagement $caseManagement): RedirectResponse
    {
        // Validate and update the specified case
        $this->caseManagementRepository->update($caseManagement, $request->validated());

        // Redirect to the index page with a success message
        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param CaseManagement $caseManagement
     * @return RedirectResponse
     */
    public function destroy(CaseManagement $caseManagement): RedirectResponse
    {
        // Delete the specified case
        $this->caseManagementRepository->delete($caseManagement);

        // Redirect to the index page with a success message
        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case deleted successfully.');
    }
}
