<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Lawyer;
use App\Services\AdminHomeService;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    public function __construct(
        protected AdminHomeService $adminHomeService
    ){}

    public function __invoke(): View
    {
        return view('admin.home',$this->adminHomeService->data());
    }
}
