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
        $companyId = auth()->user()->company->id;

        $now = Carbon::now();

        $conflictLogs = ConflictLog::where('company_id', $companyId)->get();

        $upcomingLogs = $conflictLogs->filter(function ($log) use ($now) {
            return $log->conflict_date_time >= $now && $log->status === 'upcoming';
        });

        $historyLogs = $conflictLogs->filter(function ($log) use ($now) {
            return $log->conflict_date_time < $now && $log->status === 'history';
        });

        return view('company.conflict_logs.index', [
            'upcomingLogs' => $upcomingLogs,
            'historyLogs' => $historyLogs
        ]);
    }
}