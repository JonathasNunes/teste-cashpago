<?php

namespace App\Services;

class WeatherFormatter
{
    /**
     * Formata os dados do clima recebidos da API para o formato esperado.
     *
     * @param array $data
     * @return array
     */
    public static function format(array $data): array
    {
        return [
            'temperatura_atual' => $data['main']['temp'] ?? null,
            'descricao_clima' => $data['weather'][0]['description'] ?? null,
            'humidade_relativa' => $data['main']['humidity'] ?? null,
            'velocidade_vento' => $data['wind']['speed'] ?? null,
            'cidade_pais' => $data['name']? $data['name'].", ".$data["sys"]["country"] : null,
        ];
    }
}