<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseHearing;
use App\Models\CaseManagement;
use App\Models\ConflictLog;
use App\Models\Court;
use Carbon\Carbon;
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
     * Show the form for editing the specified resource.
     */
    public function edit(CaseHearing $caseHearing)
    {
        $courts = Court::all(); 

        $case=$caseHearing->case;

        $client= $case->client;
    
        return view('company.hearings.edit', compact('caseHearing', 'courts','case','client'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CaseManagement $case)
    {
        $validated = $request->validate([
            'hearing_date' => 'required|date',
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
        ]);
    
        $hearingDateTime = Carbon::parse($validated['hearing_date'] . ' ' . $validated['hearing_time'])->startOfMinute();
    
        $newHearing = CaseHearing::create([
            'hearing_date' => $validated['hearing_date'],
            'hearing_time' => $validated['hearing_time'],
            'nature_of_court_date' => $validated['nature_of_court_date'],
            'court_id' => $validated['court_id'],
            'case_management_id' => $case->id
        ]);
    
        $companyId = auth()->user()->company->id;
    
        $conflictingHearings = CaseHearing::whereHas('case', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })
        ->whereDate('hearing_date', $validated['hearing_date'])
        ->get();
    
        foreach ($conflictingHearings as $conflictingHearing) {
            if ($conflictingHearing->id === $newHearing->id) continue;
    
            $conflictingHearingDateTime = Carbon::parse($conflictingHearing->hearing_date . ' ' . $conflictingHearing->hearing_time)->startOfMinute();
    
            if ($hearingDateTime->diffInMinutes($conflictingHearingDateTime) < 60) {
                $status = $hearingDateTime->isPast() ? 'history' : 'upcoming';
    
                [$hearingId1, $hearingId2] = $newHearing->id < $conflictingHearing->id
                    ? [$newHearing->id, $conflictingHearing->id]
                    : [$conflictingHearing->id, $newHearing->id];
    
                $existingConflict = ConflictLog::where('case_hearing_id_1', $hearingId1)
                    ->where('case_hearing_id_2', $hearingId2)
                    ->exists();
    
                if (!$existingConflict) {
                    ConflictLog::create([
                        'company_id' => $companyId,
                        'recipient_name' => $case->client->name,
                        'recipient_case_number' => $case->case_number,
                        'conflict_case_number_1' => $case->case_number,
                        'conflict_case_number_2' => $conflictingHearing->case->case_number,
                        'case_hearing_id_1' => $hearingId1,
                        'case_hearing_id_2' => $hearingId2,
                        'conflict_date_time' => $hearingDateTime,
                        'status' => $status,
                        'record_generated_at' => now()
                    ]);
                }
            }
        }
    
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
    
        $hearingDateTime = Carbon::parse($validated['hearing_date'] . ' ' . $validated['hearing_time'])->startOfMinute();
    
        $conflictingHearings = CaseHearing::whereHas('case', function ($query) {
            $query->where('company_id', auth()->user()->company->id);
        })
        ->whereDate('hearing_date', $validated['hearing_date'])
        ->get();
    
        $stillHasConflict = false;
    
        foreach ($conflictingHearings as $conflictingHearing) {
            if ($conflictingHearing->id === $caseHearing->id) continue;
    
            $conflictingHearingDateTime = Carbon::parse($conflictingHearing->hearing_date . ' ' . $conflictingHearing->hearing_time)->startOfMinute();
    
            if ($hearingDateTime->diffInMinutes($conflictingHearingDateTime) < 60) {
                $stillHasConflict = true;
    
                $status = $hearingDateTime->isPast() ? 'history' : 'upcoming';
    
                [$hearingId1, $hearingId2] = $caseHearing->id < $conflictingHearing->id
                    ? [$caseHearing->id, $conflictingHearing->id]
                    : [$conflictingHearing->id, $caseHearing->id];
    
                $existingConflict = ConflictLog::where('case_hearing_id_1', $hearingId1)
                    ->where('case_hearing_id_2', $hearingId2)
                    ->exists();
    
                if (!$existingConflict) {
                    ConflictLog::create([
                        'company_id' => auth()->user()->company->id,
                        'recipient_name' => $caseHearing->case->client->name,
                        'recipient_case_number' => $caseHearing->case->case_number,
                        'conflict_case_number_1' => $caseHearing->case->case_number,
                        'conflict_case_number_2' => $conflictingHearing->case->case_number,
                        'case_hearing_id_1' => $hearingId1,
                        'case_hearing_id_2' => $hearingId2,
                        'conflict_date_time' => $hearingDateTime,
                        'status' => $status,
                        'record_generated_at' => now()
                    ]);
                }
            }
        }
    
        $caseHearing->update($validated);
    
        if (!$stillHasConflict) {
            ConflictLog::where(function ($q) use ($caseHearing) {
                $q->where('case_hearing_id_1', $caseHearing->id)
                  ->orWhere('case_hearing_id_2', $caseHearing->id);
            })->delete();
        }
    
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