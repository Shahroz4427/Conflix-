<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class CalendarService
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ){}

    private function getAuthCompany(): Company
    {
        return $this->companyRepository->getCompanyByAuthUser();
    }

    public function getFormattedHearings(): Collection
    {
        return $this->getAuthCompany()->caseManagements()
            ->with(['hearings', 'hearings.case.client'])
            ->get()
            ->pluck('hearings')
            ->flatten()
            ->map(fn($hearing) => $this->formatHearing($hearing));
    }

    #[ArrayShape(['title' => "string", 'start' => "string", 'time' => "string", 'extendedProps' => "array", 'url' => "string"])] protected function formatHearing($hearing): array
    {
        $caseNumber = $hearing->case->case_number ?? '-';
        $clientName = $hearing->case->client->name ?? 'Unknown Client';
        $hearingDate = Carbon::parse($hearing->hearing_date);
        $hearingTime = Carbon::parse($hearing->hearing_time);

        return [
            'title' => "Case #$caseNumber - $clientName",
            'start' => $hearingDate->toDateString(),
            'time' => $hearingTime->format('g:i A'),
            'extendedProps' => [
                'case_number' => $caseNumber,
                'client_name' => $clientName,
                'hearing_time' => $hearingTime->format('g:i A'),
                'hearing_date' => $hearingDate->format('M d, Y'),
            ],
            'url' => route('company.case_hearing.edit', $hearing->id),
        ];
    }
}
