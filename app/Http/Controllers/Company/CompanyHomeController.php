<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CompanyHomeService;
use Illuminate\View\View;

class CompanyHomeController extends Controller
{
    public function __construct(
        protected CompanyHomeService $companyHomeService
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke():View
    {
        return view('company.home', $this->companyHomeService->data());
    }
}
