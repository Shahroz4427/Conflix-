<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
                    'start' => Carbon::parse($hearing->hearing_date)->toDateString(),
                    'time'  => Carbon::parse($hearing->hearing_time)->format('g:i A'), // e.g. 2:30 PM
                    'extendedProps' => [
                        'case_number' => $hearing->case->case_number ?? '-',
                        'client_name' => $hearing->case->client->name ?? 'Unknown Client',
                        'hearing_time' => Carbon::parse($hearing->hearing_time)->format('g:i A'),
                        'hearing_date' => Carbon::parse($hearing->hearing_date)->format('M d, Y'), // e.g. Apr 22, 2025
                    ],
                    'url' => route('company.case_hearing.edit', $hearing->id),
                ];
            });
    
        return view('company.calendar.index', [
            'hearings' => $hearings
        ]);
    }
    
}