<?php

use App\Http\Controllers\Company\CalendarController;
use App\Http\Controllers\Company\CaseHearingController;
use App\Http\Controllers\Company\ClientController;
use App\Http\Controllers\Company\CaseManagementController;
use App\Http\Controllers\Company\CompanyHomeController;
use App\Http\Controllers\Company\ConflictLogController;
use App\Http\Controllers\Company\LaywerController;
use App\Http\Controllers\Company\ResolveConflictLogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified','restrictUserType:company'])->prefix('company')->name('company.')->group(function () {

    Route::get('/home',CompanyHomeController::class)->name('home');

    Route::get('/calendar',CalendarController::class)->name('calendar.index');

    Route::resource('case_management', CaseManagementController::class);

    Route::get('case_hearing/{case}',[CaseHearingController::class,'index'])->name('case_hearing.index');

    Route::post('case_hearing/{case}',[CaseHearingController::class,'store'])->name('case_hearing.store');

    Route::get('case_hearing/edit/{caseHearing}',[CaseHearingController::class,'edit'])->name('case_hearing.edit');

    Route::put('case_hearing/{caseHearing}',[CaseHearingController::class,'update'])->name('case_hearing.update');

    Route::delete('case_hearing/{caseHearing}',[CaseHearingController::class,'destroy'])->name('case_hearing.destroy');

    Route::resource('clients', ClientController::class);

    Route::resource('lawyers', LaywerController::class);

    Route::get('/conflict_logs',ConflictLogController::class)->name('conflict_logs.index');

    Route::get('/resolve_logs/{conflictLog}',[ResolveConflictLogController::class,'edit'])->name('resolve_logs.edit');

    Route::put('/resolve_logs/{caseHearing}', [ResolveConflictLogController::class, 'update'])->name('resolve_logs.update');

    Route::get('/conflict_letter/send',function(){

         auth()->user()->comapany->increment('total_conflict_sent');

         return view('company.send-success-message');

    })->name('conflict_letter.send');


});