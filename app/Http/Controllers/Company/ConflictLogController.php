<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ConflictLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConflictLogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $company = auth()->user()->company;

        $now = now();

        $conflictLogs = $company->conflictLogs;

        $upcomingLogs = $conflictLogs->filter(fn($log) => $log->conflict_date_time >= $now);
        $historyLogs = $conflictLogs->filter(fn($log) => $log->conflict_date_time < $now);

        return view('company.conflict_logs.index', [
            'upcomingLogs' => $upcomingLogs,
            'historyLogs' => $historyLogs,
        ]);
    }

    
}