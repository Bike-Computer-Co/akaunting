<?php

use App\Http\Controllers\Inertia\FirmRegistrationController;
use App\Http\Controllers\Inertia\CompanyController;
use App\Http\Controllers\Inertia\EmployeeController;
use App\Http\Controllers\Inertia\StripePlanController;
use App\Http\Controllers\Inertia\UserController;
use App\Http\Controllers\Inertia\PdfController;

Route::redirect('/', '/users');
Route::resource('users', UserController::class)->only('index', 'create', 'store', 'show');
Route::resource('companies', CompanyController::class)->only('update', 'index');
Route::resource('stripe-plans', StripePlanController::class)->only('index', 'store', 'destroy');
Route::resource('employees', EmployeeController::class)->only('index', 'show');
Route::resource('firm-registrations', FirmRegistrationController::class);
Route::get('/firm-registrations/{firmRegistration}/certified-signature-pdf', [PdfController::class, 'certifiedSignaturePdf'])->name('firm-registrations.certified-signature-pdf');
Route::get('/firm-registrations/{firmRegistration}/statement-1', [PdfController::class, 'statment1'])->name('firm-registrations.statment-1');
Route::get('/firm-registrations/{firmRegistration}/statement-2', [PdfController::class, 'statment2'])->name('firm-registrations.statment-2');
Route::get('/firm-registrations/{firmRegistration}/statement-3', [PdfController::class, 'statment3'])->name('firm-registrations.statment-3');
Route::get('/firm-registrations/{firmRegistration}/statement-4', [PdfController::class, 'statment4'])->name('firm-registrations.statment-4');
Route::get('/firm-registrations/{firmRegistration}/power-of-attorney', [PdfController::class, 'powerOfAttorney'])->name('firm-registrations.power-of-attorney');
Route::get('/firm-registrations/{firmRegistration}/decision', [PdfController::class, 'decision'])->name('firm-registrations.decision');
Route::put('/firm-registrations/{firmRegistration}/enrollment-decision', [FirmRegistrationController::class, 'uploadFirmEnrollmentDecision'])->name('firm-registrations.upload-enrollment-decision');
