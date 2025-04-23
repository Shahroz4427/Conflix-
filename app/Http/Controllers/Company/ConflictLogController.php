<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\ConflictLogService;

use Illuminate\View\View;

class ConflictLogController extends Controller
{
    public function __construct(
        protected ConflictLogService $conflictLogService
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $logs = $this->conflictLogService->getFormattedConflictLogs();

        return view('company.conflict_logs.index', [
            'upcomingLogs' => $logs['upcomingLogs'],
            'historyLogs' => $logs['historyLogs'],
        ]);
    }

}
