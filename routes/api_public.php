<?php

Route::post('/request-company-register', "CompanyRegister@request")->name('company_request');
Route::get('/auth/check', "Auth@check")->name('check');
Route::get('/packages', "PackageController@packages")->name('packages.index');
