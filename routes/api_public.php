<?php

Route::post('/request-company-register', "CompanyRegister@request")->name('company_request');
Route::get('/logged-redirect', "User@loggedRedirect")->name('logged_redirect');
