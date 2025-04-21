<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseHearing;
use App\Models\CaseManagement;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaseHearingController extends Controller
{
  
    public function index(CaseManagement $case)
    {
        $client=$case->client;

        $courts=Court::all();

        $hearings = $case->hearings()->latest()->paginate(10);
    
        return view('company.hearings.index', compact('hearings', 'client','courts','case'));
    }
    

    public function edit(CaseHearing $caseHearing)
    {
        $courts = Court::all(); 

        $case=$caseHearing->case;

        $client= $case->client;
    
        return view('company.hearings.edit', compact('caseHearing', 'courts','case','client'));
    }
    
    public function store(Request $request, CaseManagement $case)
    {
        $validated = $this->validateRequest($request, $case->id);

    
        CaseHearing::create([
            ...$validated,
            'case_management_id' => $case->id
        ]);
    
        return back()->with('success', 'Court date added successfully.');
    }
    
    public function update(Request $request, CaseHearing $caseHearing)
    {
        
        $validated = $this->validateRequest($request, $caseHearing->case_management_id, $caseHearing);

    
        $caseHearing->update($validated);
    
        return back()->with('success', 'Hearing updated successfully.');
    }
    

    public function destroy(CaseHearing $caseHearing)
    {
        $caseHearing->delete();

        return redirect()->back()->with('success', 'Hearing deleted successfully.');
    }

    private function validateRequest(Request $request, int $caseId, ?CaseHearing $current = null): array
    {
        return $request->validate([
            'hearing_date' => [
                'required',
                'date',
                Rule::unique('case_hearings')
                    ->where(fn ($query) => $query
                        ->where('case_management_id', $caseId)
                        ->where('hearing_time', $request->hearing_time)
                    )
                    ->ignore($current?->id),
            ],
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
        ]);
    }
    
    

}