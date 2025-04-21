<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseHearing;
use App\Models\ConflictLog;
use App\Models\Court;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResolveConflictLogController extends Controller
{
    public function edit(ConflictLog $conflictLog)
    {

        $courts=Court::all();

        $caseHearing1 = CaseHearing::with('case.client')->find($conflictLog->case_hearing_id_1);

        $caseHearing2 = CaseHearing::with('case.client')->find($conflictLog->case_hearing_id_2);
        
        
        return view('company.resolve_conflict.edit', compact('caseHearing1', 'caseHearing2','courts'));
    }
    
    public function update(Request $request, CaseHearing $caseHearing)
    {
        $request->validate([
            'hearing_date' => 'required|date',
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string',
            'court_id' => 'required|exists:courts,id',
        ]);
    
        $caseHearing->update([
            'hearing_date' => $request->hearing_date,
            'hearing_time' => $request->hearing_time,
            'nature_of_court_date' => $request->nature_of_court_date,
            'court_id' => $request->court_id,
        ]);
    
        return redirect()->route('company.home')->with('success', 'Hearing updated successfully.');
    }
    

}