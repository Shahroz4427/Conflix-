<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CalendarService
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
     * Get the authenticated company.
     * 
     * @return Company
     */
    private function getAuthCompany(): Company
    {
        // Fetch and return the company associated with the authenticated user
        return $this->companyRepository->getCompanyByAuthUser();
    }

    /**
     * Get formatted hearings for the authenticated company.
     * 
     * @return Collection A collection of formatted hearings
     */
    public function getFormattedHearings(): Collection
    {
        // Fetch all case managements with related hearings and clients
        return $this->getAuthCompany()->caseManagements()
            ->with(['hearings', 'hearings.case.client'])
            ->get()
            ->pluck('hearings') // Extract hearings from each case
            ->flatten() // Flatten the collection of hearings
            ->map(fn($hearing) => $this->formatHearing($hearing)); // Format each hearing
    }

    /**
     * Format a single hearing for the calendar.
     * 
     * @param mixed $hearing The hearing to format
     * @return array The formatted hearing data
     */
    protected function formatHearing($hearing): array
    {
        // Extract case number or use a default value
        $caseNumber = $hearing->case->case_number ?? '-';

        // Extract client name or use a default value
        $clientName = $hearing->case->client->name ?? 'Unknown Client';

        // Parse hearing date and time
        $hearingDate = Carbon::parse($hearing->hearing_date);
        $hearingTime = Carbon::parse($hearing->hearing_time);

        // Return the formatted hearing data
        return [
            'title' => "Case #$caseNumber - $clientName", // Title for the calendar event
            'start' => $hearingDate->toDateString(), // Start date for the event
            'time' => $hearingTime->format('g:i A'), // Time for the event
            'extendedProps' => [ // Additional properties for the event
                'case_number' => $caseNumber,
                'client_name' => $clientName,
                'hearing_time' => $hearingTime->format('g:i A'),
                'hearing_date' => $hearingDate->format('M d, Y'),
            ],
            'url' => route('company.case_hearing.edit', $hearing->id), // URL for editing the hearing
        ];
    }
}
