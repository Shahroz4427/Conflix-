<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyConflictLetterTemplate\StoreCompanyConflictLetterTemplateRequest;
use App\Http\Requests\Admin\CompanyConflictLetterTemplate\UpdateCompanyConflictLetterTemplateRequest;
use App\Models\CompanyConflictLetterTemplate;
use App\Repositories\Interfaces\CompanyConflictLetterTemplateRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyConflictLetterTemplateController extends Controller
{

    public function __construct(
        protected CompanyConflictLetterTemplateRepositoryInterface $companyConflictLetterTemplateRepository
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $letterTemplates = $this->companyConflictLetterTemplateRepository->getAllWithPagination();

        return view('admin.company_conflict_letter_templates.index',
            compact('letterTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.company_conflict_letter_templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyConflictLetterTemplateRequest $request): RedirectResponse
    {
        $this->companyConflictLetterTemplateRepository->store($request->validated());

        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        return view('admin.company_conflict_letter_templates.show',
            compact('companyConflictLetterTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        return view('admin.company_conflict_letter_templates.edit',
            compact('companyConflictLetterTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyConflictLetterTemplateRequest $request, CompanyConflictLetterTemplate $companyConflictLetterTemplate): RedirectResponse
    {
        $this->companyConflictLetterTemplateRepository->update($companyConflictLetterTemplate,$request->validated());

        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyConflictLetterTemplate $companyConflictLetterTemplate): RedirectResponse
    {
       $this->companyConflictLetterTemplateRepository->delete($companyConflictLetterTemplate);

        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template deleted successfully.');
    }
}
