<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminHomeService;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    /**
     * Constructor to inject the AdminHomeService dependency.
     * 
     * @param AdminHomeService $adminHomeService
     */
    public function __construct(
        protected AdminHomeService $adminHomeService
    ){}

    /**
     * Handle the incoming request to display the admin home page.
     * 
     * @return View
     */
    public function __invoke(): View
    {
        // Render the admin home view with data provided by the AdminHomeService
        return view('admin.home', $this->adminHomeService->data());
    }
}
