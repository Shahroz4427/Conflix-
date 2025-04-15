<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;

use App\Models\Lawyer;

class AdminHomeController extends Controller
{
    public function __invoke()
    {
        return view('admin.home', [
            'companies'             => Company::count(),
            'clients'               => Client::count(),
            'lawyers'               => Lawyer::count(),
            'active_subscription'   => Company::where('status', 'active')->count(),
            'inactive_subscription' => Company::where('status', 'inactive')->count(),
            'conflict_sent'         => Company::sum('total_conflict_sent'),
        ]);
    }
}
