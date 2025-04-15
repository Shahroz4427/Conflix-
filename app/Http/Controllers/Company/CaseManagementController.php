<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CaseManagement\StoreCaseRequest;
use App\Http\Requests\Company\CaseManagement\UpdateCaseRequest;
use App\Models\CaseManagement;
use App\Models\Court;
use Illuminate\Http\Request;

class CaseManagementController extends Controller
{
    /**
     * Display a listing of the cases.
     */
    public function index()
    {
        $cases = CaseManagement::with(['client', 'lawyer','court']) ->where('company_id', auth()->user()->company->id)->latest()->paginate(10);  
    
        return view('company.case_management.index', compact('cases'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients=auth()->user()->company->clients;

        $lawyers=auth()->user()->company->lawyers;

        $courts =Court::all();

        return view('company.case_management.create', compact('clients','lawyers','courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseRequest $request)
    {
        $validated=$request->validated();

        $validated['company_id']=auth()->user()->company->id;

        CaseManagement::create($validated);

        return redirect() ->route('company.case_management.index')->with('success', 'Case created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseManagement $caseManagement)
    {
        $caseManagement->load(['client', 'lawyer','court']);

        $clients=auth()->user()->company->clients;

        $lawyers=auth()->user()->company->lawyers;

        $courts =Court::all();

        return view('company.case_management.edit', compact('clients','lawyers','courts','caseManagement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseRequest $request, CaseManagement $caseManagement)
    {
        $validated = $request->validated();

        $validated['company_id'] = auth()->user()->company->id;

        $caseManagement->update($validated);

        return redirect() ->route('company.case_management.index')->with('success', 'Case updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseManagement $caseManagement)
    {
        $caseManagement->delete();

        return redirect() ->route('company.case_management.index')->with('success', 'Case Deleted successfully.');
    }
}
