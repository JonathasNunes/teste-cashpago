<?php

namespace Tests\Feature;

use App\Services\WeatherFormatter;
use Tests\TestCase;
use App\Services\WeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;

class WeatherServiceTest extends TestCase
{
    protected $weatherService;
    protected $mockClient;

    protected function setUp(): void
    {
        parent::setUp();

        // Mockando o cliente HTTP
        $this->mockClient = Mockery::mock(Client::class);
        $this->app->instance(Client::class, $this->mockClient);

        // Instanciando o serviço com o cliente mockado
        $this->weatherService = new WeatherService();
        $this->weatherService->client = $this->mockClient;
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Testa o retorno da API em caso de sucesso.
     */
    public function test_get_weather_success()
    {
        $apiResponse = [
            "coord" => ["lon" => -48.9528, "lat" => -16.3267],
            "weather" => [["id" => 802, "main" => "Clouds", "description" => "nuvens dispersas", "icon" => "03n"]],
            "main" => ["temp" => 23.78, "feels_like" => 24.51, "temp_min" => 23.78, "temp_max" => 23.78, "humidity" => 88],
            "wind" => ["speed" => 1.03, "deg" => 320],
        ];

        // Simula a resposta da API
        $this->mockClient->shouldReceive('get')
            ->once()
            ->with("weather", [
                'query' => [
                    'q' => 'Anápolis',
                    'appid' => env('OPENWEATHER_API_KEY'),
                    'units' => 'metric',
                    'lang' => 'pt',
                ],
            ])
            ->andReturn(new Response(200, [], json_encode($apiResponse)));

        $result = $this->weatherService->getWeather('Anápolis');

        $this->assertEquals([
            'temperatura_atual' => 23.78,
            'descricao_clima' => 'nuvens dispersas',
            'humidade_relativa' => 88,
            'velocidade_vento' => 1.03,
        ], $result);
    }

    /**
     * Testa o comportamento do serviço em caso de erro na API.
     */
    public function test_get_weather_api_error()
    {
        // Simula uma exceção lançada pelo cliente HTTP
        $this->mockClient->shouldReceive('get')
            ->once()
            ->withAnyArgs()
            ->andThrow(new \Exception('Erro na API'));

        $result = $this->weatherService->getWeather('Anápolis');

        $this->assertEquals(['error' => 'Não foi possível obter os dados do clima.'], $result);
    }

    /**
     * Testa se os parâmetros são enviados corretamente para a API.
     */
    public function test_get_weather_query_parameters()
    {
        $city = 'Test City';
        $expectedQuery = [
            'q' => $city,
            'appid' => env('OPENWEATHER_API_KEY'),
            'units' => 'metric',
            'lang' => 'pt',
        ];

        // Configuração do mock do cliente Guzzle
        $this->mockClient
            ->shouldReceive('get')
            ->with('weather', ['query' => $expectedQuery])
            ->once()
            ->andReturn(new \GuzzleHttp\Psr7\Response(200, [], json_encode(['weather' => []])));

        // Usando Reflection para substituir o cliente da instância do WeatherService
        $reflection = new \ReflectionClass($this->weatherService);
        $clientProperty = $reflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $clientProperty->setValue($this->weatherService, $this->mockClient);

        // Chamando o método que será testado
        $this->weatherService->getWeather($city);

        // Validação para garantir que o teste passou
        $this->assertTrue(true, 'Query parameters passed as expected.');
    }
}
