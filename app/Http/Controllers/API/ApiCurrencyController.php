<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiCurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class ApiCurrencyController extends Controller
{
    public function index(Request $request)
    {
        /* Make the currency's resource */
        return ApiCurrencyResource::collection(Currency::orderBy('name','DESC')->get());
    }
}
