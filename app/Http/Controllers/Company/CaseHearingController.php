<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseHearing;
use App\Models\CaseManagement;
use App\Models\Court;
use Illuminate\Http\Request;

class CaseHearingController extends Controller
{
    /**
     * Display a listing of the Case Hearings.
     */
    public function index(CaseManagement $case)
    {
        $client=$case->client;

        $courts=Court::all();

        $hearings = $case->hearings()->latest()->paginate(10);
    
        return view('company.hearings.index', compact('hearings', 'client','courts','case'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CaseManagement $case)
    {
       
        $validated = $request->validate([
            'hearing_date' => 'required|date',
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
        ]);
    
        CaseHearing::create([
            'hearing_date' => $validated['hearing_date'],
            'hearing_time' => $validated['hearing_time'],
            'nature_of_court_date' => $validated['nature_of_court_date'],
            'court_id' => $validated['court_id'],
            'case_management_id'=>$case->id
        ]);
    

        return redirect()->back()->with('success', 'Court date added successfully.');
    }


     /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, CaseHearing $caseHearing)
    {

        $validated = $request->validate([
            'hearing_date' => 'required|date',
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
        ]);

        $caseHearing->update($validated);

     
        return redirect()->back()->with('success', 'Hearing updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseHearing $caseHearing)
    {
        $caseHearing->delete();

        return redirect()->back()->with('success', 'Hearing updated successfully.');
    }


}