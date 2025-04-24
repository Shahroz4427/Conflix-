<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CalendarService;
use Illuminate\View\View;

class CalendarController extends Controller
{
    /**
     * Constructor to inject the CalendarService dependency.
     * 
     * @param CalendarService $calendarService
     */
    public function __construct(
        protected CalendarService $calendarService
    ){}

    /**
     * Handle the incoming request to display the calendar view.
     * 
     * @return View
     */
    public function __invoke(): View
    {
        // Fetch formatted hearings data using the CalendarService
        $hearings = $this->calendarService->getFormattedHearings();

        // Return the calendar view with the hearings data
        return view('company.calendar.index', [
            'hearings' => $hearings
        ]);
    }
}
