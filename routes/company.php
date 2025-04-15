<?php

use App\Http\Controllers\Company\CaseHearingController;
use App\Http\Controllers\Company\ClientController;
use App\Http\Controllers\Company\CaseManagementController;
use App\Http\Controllers\Company\CompanyHomeController;
use App\Http\Controllers\Company\LaywerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('company')->name('company.')->group(function () {

    Route::get('/home',CompanyHomeController::class)->name('home');

    Route::resource('case_management', CaseManagementController::class);

    Route::get('case_hearing/{case}',[CaseHearingController::class,'index'])->name('case_hearing.index');

    Route::post('case_hearing',[CaseHearingController::class,'store'])->name('case_hearing.store');

    Route::delete('case_hearing',[CaseHearingController::class,'destroy'])->name('case_hearing.delete');

    Route::resource('clients', ClientController::class);

    Route::resource('lawyers', LaywerController::class);

});