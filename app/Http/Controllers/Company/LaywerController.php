<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Lawyer\StoreLawyerRequest;
use App\Http\Requests\Company\Lawyer\UpdateLawyerRequest;
use App\Models\Jurisdiction;
use App\Models\Lawyer;
use Illuminate\Http\Request;

class LaywerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lawyers = Lawyer::with('jurisdiction')->where('company_id', auth()->user()->company->id)->latest()->paginate(10);

        return view('company.lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurisdictions=Jurisdiction::all();

        return view('company.lawyers.create',compact('jurisdictions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLawyerRequest $request)
    {
        $validated = $request->validated(); 
    
        $company = auth()->user()->company;

        $validated['company_id'] = $company->id;
    
        Lawyer::create($validated);

        $company->increment('total_lawyers');
    
        return redirect()->route('company.lawyers.index')->with('success', 'Lawyer created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Lawyer $lawyer)
    {    
        $lawyer->load('jurisdiction');

        return view('company.lawyers.show',compact('lawyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lawyer $lawyer)
    {
        $jurisdictions=Jurisdiction::all();

        $lawyer->load('jurisdiction');
        
        return view('company.lawyers.edit',compact('lawyer','jurisdictions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLawyerRequest $request, Lawyer $lawyer)
    {
        $validated = $request->validated();

        $validated['company_id'] = auth()->user()->company->id;
    
        $lawyer->update($validated);
    
        return redirect()->route('company.lawyers.index')->with('success', 'Lawyer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();

        auth()->user()->company->decrement('total_lawyers');

        return redirect()->route('company.lawyers.index')->with('success', 'Lawyer Deleted successfully.');
    }
}
