<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/getWeather', [Controllers\WelcomeController::class, 'index']);

