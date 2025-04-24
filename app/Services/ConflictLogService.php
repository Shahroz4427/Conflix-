<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ConflictLogService
{
    /**
     * Constructor to inject the CompanyRepository dependency.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {}

    /**
     * Get and format the company's conflict logs.
     * 
     * @return array An array containing formatted upcoming and history logs
     */
    public function getFormattedConflictLogs(): array
    {
        // Get the current timestamp
        $now = now();

        // Fetch all conflict logs for the authenticated company
        $logs = $this->companyRepository->getCompanyByAuthUser()->conflictLogs;

        // Filter and format logs for upcoming conflicts
        $upcomingLogs = $this->filterAndFormatLogs($logs, fn($log) => $log->conflict_date_time >= $now);

        // Filter and format logs for historical conflicts
        $historyLogs = $this->filterAndFormatLogs($logs, fn($log) => $log->conflict_date_time < $now);

        // Return the formatted logs as an array
        return [
            'upcomingLogs' => $upcomingLogs,
            'historyLogs' => $historyLogs,
        ];
    }

    /**
     * Filter and format the logs based on a condition.
     * 
     * @param Collection $logs The collection of logs to filter and format
     * @param callable $condition A callback function to filter the logs
     * @return Collection The filtered and formatted logs
     */
    protected function filterAndFormatLogs(Collection $logs, callable $condition): Collection
    {
        // Filter logs based on the provided condition and format them
        return $logs->filter($condition)->map(function ($log) {
            // Format the conflict date and time
            $log->formatted_conflict_date_time = Carbon::parse($log->conflict_date_time)->format('M d, Y - g:i A');

            // Format the creation date and time
            $log->formatted_created_at = Carbon::parse($log->created_at)->format('M d, Y - g:i A');

            return $log;
        });
    }
}
