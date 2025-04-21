<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        $company=auth()->user()->company;

        return view('company.home', [
            'clients' => $company->clients->count(),
            'lawyers' => $company->lawyers->count(),
            'cases' => $company->caseManagements->count(),
            'conflicts' =>  $company->conflictLogs->count() ,
        ]);
    }
}
