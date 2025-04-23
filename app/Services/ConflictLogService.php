<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class ConflictLogService
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ){}

    /**
     * Get and format the company's conflict logs.
     */
    public function getFormattedConflictLogs(): array
    {
        $now = now();

        $logs = $this->companyRepository->getCompanyByAuthUser()->conflictLogs;

        $upcomingLogs = $this->filterAndFormatLogs($logs, fn($log) => $log->conflict_date_time >= $now);
        $historyLogs = $this->filterAndFormatLogs($logs, fn($log) => $log->conflict_date_time < $now);

        return [
            'upcomingLogs' => $upcomingLogs,
            'historyLogs' => $historyLogs,
        ];
    }

    /**
     * Filter and format the logs based on a condition.
     */
    protected function filterAndFormatLogs(Collection $logs, callable $condition): Collection
    {
        return $logs->filter($condition)->map(function ($log) {
            $log->formatted_conflict_date_time = Carbon::parse($log->conflict_date_time)->format('M d, Y - g:i A');
            $log->formatted_created_at = Carbon::parse($log->created_at)->format('M d, Y - g:i A');
            return $log;
        });
    }
}
