<?php

namespace App\Http\Controllers\ApiPublic;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyRegister extends Controller
{
    public function request(Request $request)
    {
        return JsonResource::make($request->all());
    }
}
