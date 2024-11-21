<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;


Route::get('/clima', [WeatherController::class, 'getWeather']);
