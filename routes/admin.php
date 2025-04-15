<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\CompanyConflictLetterTemplateController;
use App\Http\Controllers\Admin\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/home', AdminHomeController::class)->name('home');

    Route::resource('companies', CompanyController::class);

    Route::patch('/companies/deactivate/{company}',[CompanyController::class,'deactivate'])->name('companies.deactivate');
    
    Route::resource('company_conflict_letter_templates', CompanyConflictLetterTemplateController::class);
});