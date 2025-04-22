<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

        $upcomingLogs = $conflictLogs->filter(fn($log) => $log->conflict_date_time >= $now)->map(function ($log) {
            $log->formatted_conflict_date_time = Carbon::parse($log->conflict_date_time)->format('M d, Y - g:i A');
            $log->formatted_created_at = Carbon::parse($log->created_at)->format('M d, Y - g:i A');
            return $log;
        });

        $historyLogs = $conflictLogs->filter(fn($log) => $log->conflict_date_time < $now)->map(function ($log) {
            $log->formatted_conflict_date_time = Carbon::parse($log->conflict_date_time)->format('M d, Y - g:i A');
            $log->formatted_created_at = Carbon::parse($log->created_at)->format('M d, Y - g:i A');
            return $log;
        });

        return view('company.conflict_logs.index', [
            'upcomingLogs' => $upcomingLogs,
            'historyLogs' => $historyLogs,
        ]);
    }
}
