<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use App\Http\Requests\WeatherRequest;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(WeatherRequest $request)
    {
        $req = $request->validated();
        $city = $req['cidade'];

        $weather = $this->weatherService->getWeather($city);

        if (isset($weather['error'])) {
            return response()->json(['message' => $weather['error']], 500);
        }

        return response()->json($weather);
    }
}