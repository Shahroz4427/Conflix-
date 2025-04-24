<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CompanyHomeService;
use Illuminate\View\View;

class CompanyHomeController extends Controller
{
    /**
     * Constructor to inject the CompanyHomeService dependency.
     * 
     * @param CompanyHomeService $companyHomeService
     */
    public function __construct(
        protected CompanyHomeService $companyHomeService
    ) {}

    /**
     * Handle the incoming request to display the company home page.
     * 
     * @return View
     */
    public function __invoke(): View
    {
        // Render the company home view with data provided by the CompanyHomeService
        return view('company.home', $this->companyHomeService->data());
    }
}
