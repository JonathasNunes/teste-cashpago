<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\WeatherFormatter;

class WeatherService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.openweathermap.org/data/2.5/']);
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    public function getWeather($city)
    {
        try {
            $response = $this->client->get("weather", [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric', // Para temperatura em Celsius
                    'lang' => 'pt'      // Idioma das descrições
                ]
            ]);
            $data = json_decode($response->getBody(), true);

            return WeatherFormatter::format($data);
        } catch (\Exception $e) {
            return ['error' => 'Não foi possível obter os dados do clima.'];
        }
    }
}
