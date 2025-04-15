<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseManagement;
use Illuminate\Http\Request;

class CaseHearingController extends Controller
{
    /**
     * Display a listing of the Case Hearings.
     */
    public function index(CaseManagement $case)
    {
        $client=$case->client;

        $hearings = $case->hearings()->latest()->paginate(10);
    
        return view('company.hearings.index', compact('hearings', 'client'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
       
    }


}
