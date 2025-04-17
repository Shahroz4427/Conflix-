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

        $caseHearing1 = CaseHearing::find($conflictLog->case_hearing_id_1);
        
        $caseHearing2 = CaseHearing::find($conflictLog->case_hearing_id_2);
    
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
    
        $conflictLog = ConflictLog::where(function ($q) use ($caseHearing) {
            $q->where('case_hearing_id_1', $caseHearing->id)
              ->orWhere('case_hearing_id_2', $caseHearing->id);
        })->first();
    
        if ($conflictLog) {
            $hearing1 = CaseHearing::find($conflictLog->case_hearing_id_1);
            $hearing2 = CaseHearing::find($conflictLog->case_hearing_id_2);
    
            if ($hearing1 && $hearing2) {
                $datetime1 = Carbon::parse($hearing1->hearing_date . ' ' . $hearing1->hearing_time);
                $datetime2 = Carbon::parse($hearing2->hearing_date . ' ' . $hearing2->hearing_time);
    
                $diffInMinutes = $datetime1->diffInMinutes($datetime2);
    
                if ($diffInMinutes > 60) {
                    $conflictLog->delete();
                }
            }
        }
    
        return redirect()->route('company.home')->with('success', 'Hearing updated successfully.');
    }


}