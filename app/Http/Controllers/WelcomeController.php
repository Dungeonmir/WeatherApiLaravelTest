<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function index(Request $request) {
        $lat = $request->input('lat');
        $lon = $request->input('lon');
        $id = env('OPENWEATHERID');;
        return Http::get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$id}&lang=ru&units=metric");
    }
}
