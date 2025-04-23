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
    public function __construct(
        protected CaseManagementRepositoryInterface $caseManagementRepository
    ){}

    /**
     * Display a listing of the cases.
     */
    public function index(): View
    {
        $relations=['client', 'lawyer', 'court'];

        $cases = $this->caseManagementRepository->getAllCasesWithRelationsAndPagination($relations);

        return view('company.case_management.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $clients = $this->caseManagementRepository->getAllCompanyClients();

        $lawyers = $this->caseManagementRepository->getAllCompanyLawyers();

        $courts = $this->caseManagementRepository->getAllCourts();

        return view('company.case_management.create', compact('clients', 'lawyers', 'courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseRequest $request): RedirectResponse
    {
        $this->caseManagementRepository->store($request->validated());

        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseManagement $caseManagement): View
    {
        $relations=['client', 'lawyer', 'court'];

        $this->caseManagementRepository->loadWithRelations($caseManagement,$relations);

        $clients = $this->caseManagementRepository->getAllCompanyClients();

        $lawyers = $this->caseManagementRepository->getAllCompanyLawyers();

        $courts = $this->caseManagementRepository->getAllCourts();

        return view('company.case_management.edit', compact('clients', 'lawyers', 'courts', 'caseManagement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseRequest $request, CaseManagement $caseManagement): RedirectResponse
    {
        $this->caseManagementRepository->update($caseManagement, $request->validated());

        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseManagement $caseManagement): RedirectResponse
    {
        $this->caseManagementRepository->delete($caseManagement);

        return redirect()
            ->route('company.case_management.index')
            ->with('success', 'Case deleted successfully.');
    }
}
