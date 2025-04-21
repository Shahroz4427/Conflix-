<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyConflictLetterTemplate\StoreCompanyConflictLetterTemplateRequest;
use App\Http\Requests\Admin\CompanyConflictLetterTemplate\UpdateCompanyConflictLetterTemplateRequest;
use App\Models\CompanyConflictLetterTemplate;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyConflictLetterTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $letterTemplates = CompanyConflictLetterTemplate::latest()->paginate(10);

        return view('admin.company_conflict_letter_templates.index', compact('letterTemplates'));
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
        $fileName = uploadFile($request->file('upload_template'), 'uploads/company_conflict_letter_templates');

        CompanyConflictLetterTemplate::create([
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => auth()->user()->name,
        ]);

        return redirect()->route('admin.company_conflict_letter_templates.index')->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        return view('admin.company_conflict_letter_templates.show', compact('companyConflictLetterTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyConflictLetterTemplate $companyConflictLetterTemplate): View
    {
        return view('admin.company_conflict_letter_templates.edit', compact('companyConflictLetterTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyConflictLetterTemplateRequest $request, CompanyConflictLetterTemplate $companyConflictLetterTemplate): RedirectResponse
    {
        $fileName = $companyConflictLetterTemplate->upload_template;

        if ($request->hasFile('upload_template')) {
            $fileName = uploadFile($request->file('upload_template'), 'uploads/company_conflict_letter_templates');
            if ($companyConflictLetterTemplate->upload_template && file_exists(public_path($companyConflictLetterTemplate->upload_template))) {
                unlink(public_path($companyConflictLetterTemplate->upload_template));
            }
        }

        $companyConflictLetterTemplate->update([
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => auth()->user()->name,
        ]);

        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyConflictLetterTemplate $companyConflictLetterTemplate): RedirectResponse
    {
        if ($companyConflictLetterTemplate->upload_template && file_exists(public_path($companyConflictLetterTemplate->upload_template))) {
            unlink(public_path($companyConflictLetterTemplate->upload_template));
        }

        $companyConflictLetterTemplate->delete();

        return redirect()->route('admin.company_conflict_letter_templates.index')
            ->with('success', 'Template deleted successfully.');
    }
}