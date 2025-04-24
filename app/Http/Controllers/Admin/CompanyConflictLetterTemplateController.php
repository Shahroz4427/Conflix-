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
    /**
     * Constructor to inject the repository dependency.
     */
    public function __construct(
        protected CompanyConflictLetterTemplateRepositoryInterface $companyConflictLetterTemplateRepository
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(): View
    {
        // Fetch all letter templates with pagination
        $letterTemplates = $this->companyConflictLetterTemplateRepository->getAllWithPagination();

        // Return the index view with the fetched templates
        return view('admin.company_conflict_letter_templates.index', compact('letterTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        // Return the create view for letter templates
        return view('admin.company_conflict_letter_templates.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreCompanyConflictLetterTemplateRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyConflictLetterTemplateRequest $request): RedirectResponse
    {
        // Validate and store the new letter template
        $this->companyConflictLetterTemplateRepository->store($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param CompanyConflictLetterTemplate $companyConflictLetterTemplate
     * @return View
     */
    public function show(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        // Return the show view with the specified letter template
        return view('admin.company_conflict_letter_templates.show', compact('companyConflictLetterTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param CompanyConflictLetterTemplate $companyConflictLetterTemplate
     * @return View
     */
    public function edit(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        // Return the edit view with the specified letter template
        return view('admin.company_conflict_letter_templates.edit', compact('companyConflictLetterTemplate'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateCompanyConflictLetterTemplateRequest $request
     * @param CompanyConflictLetterTemplate $companyConflictLetterTemplate
     * @return RedirectResponse
     */
    public function update(
        UpdateCompanyConflictLetterTemplateRequest $request,
        CompanyConflictLetterTemplate $companyConflictLetterTemplate
    ): RedirectResponse {
        // Validate and update the specified letter template
        $this->companyConflictLetterTemplateRepository->update($companyConflictLetterTemplate, $request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param CompanyConflictLetterTemplate $companyConflictLetterTemplate
     * @return RedirectResponse
     */
    public function destroy(CompanyConflictLetterTemplate $companyConflictLetterTemplate): RedirectResponse
    {
        // Delete the specified letter template
        $this->companyConflictLetterTemplateRepository->delete($companyConflictLetterTemplate);

        // Redirect to the index page with a success message
        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template deleted successfully.');
    }
}
