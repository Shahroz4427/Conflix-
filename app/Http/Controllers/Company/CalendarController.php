<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $company = auth()->user()->company;
    
        $hearings = $company->caseManagements()
            ->with(['hearings', 'hearings.case.client'])
            ->get()
            ->pluck('hearings')
            ->flatten()
            ->map(function ($hearing) {
               
                return [
                    'title' => 'Case #' . ($hearing->case->case_number ?? '-') .
                    ' - ' . ($hearing->case->client->name ?? 'Unknown Client'),
                    'start' => $hearing->hearing_date,
                    'time'  => $hearing->hearing_time,
                    'extendedProps' => [
                        'case_number' => $hearing->case->case_number ?? '-',
                        'client_name' => $hearing->case->client->name ?? 'Unknown Client',
                        'hearing_time'  => $hearing->hearing_time,
                    ],
                    'url' => route('company.case_hearing.edit',1)
                ];
            });
    
        return view('company.calendar.index', [
            'hearings' => $hearings
        ]);
    }
    
}