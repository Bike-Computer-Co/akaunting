<?php

// DISABLE REGISTER FOR PUBLIC
//Route::post('/request-company-register', "CompanyRegister@request")->name('company_request');
use App\Http\Controllers\ApiPublic\FirmRegistrationApiController;
use App\Http\Controllers\ApiPublic\FirmRegistrationAttemptApiController;
use App\Http\Controllers\ApiPublic\GiftCodeApplicantApiController;

Route::get('/auth/check', 'Auth@check')->name('check');
Route::get('/packages', 'PackageController@packages')->name('packages.index');
Route::apiResource('firm-registrations', FirmRegistrationApiController::class)->only('index', 'store');
Route::apiResource('firm-registration-attempts', FirmRegistrationAttemptApiController::class)->only('store');
Route::post('gift-code', [GiftCodeApplicantApiController::class, 'store'])->middleware('throttle:10,1');
