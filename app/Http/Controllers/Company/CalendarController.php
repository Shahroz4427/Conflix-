<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CalendarService;
use Illuminate\View\View;

class CalendarController extends Controller
{

    public function __construct(
        protected CalendarService $calendarService
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $hearings = $this->calendarService->getFormattedHearings();

        return view('company.calendar.index', [
            'hearings' => $hearings
        ]);
    }
}
