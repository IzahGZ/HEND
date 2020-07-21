<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    function index(){
        return view('Forecast.indexGenerateMrp');
    }
}
