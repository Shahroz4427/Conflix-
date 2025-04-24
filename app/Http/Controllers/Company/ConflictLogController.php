<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\ConflictLogService;
use Illuminate\View\View;

class ConflictLogController extends Controller
{
    /**
     * Constructor to inject the ConflictLogService dependency.
     * 
     * @param ConflictLogService $conflictLogService
     */
    public function __construct(
        protected ConflictLogService $conflictLogService
    ) {}

    /**
     * Handle the incoming request to display the conflict logs.
     * 
     * @return View
     */
    public function __invoke(): View
    {
        // Fetch formatted conflict logs using the ConflictLogService
        $logs = $this->conflictLogService->getFormattedConflictLogs();

        // Return the conflict logs view with upcoming and history logs
        return view('company.conflict_logs.index', [
            'upcomingLogs' => $logs['upcomingLogs'], // Logs for upcoming conflicts
            'historyLogs' => $logs['historyLogs'],   // Logs for past conflicts
        ]);
    }
}
