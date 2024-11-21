<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\WeatherController;
use App\Services\WeatherService;
use App\Http\Requests\WeatherRequest;
use Mockery;

class WeatherControllerTest extends TestCase
{
    protected $weatherService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        // Criando o mock para o serviço WeatherService
        $this->weatherService = Mockery::mock(WeatherService::class);

        // Registrar o mock no contêiner de dependências do Laravel
        $this->app->instance(WeatherService::class, $this->weatherService);

        // Agora podemos instanciar o controlador normalmente
        $this->controller = $this->app->make(WeatherController::class);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Testa o sucesso da obtenção do clima.
     */
    public function test_get_weather_success()
    {
        // Dados de sucesso simulados
        $mockWeatherResponse = [
            'temperatura_atual' => 23.78,
            'descricao_clima' => 'nuvens dispersas',
            'humidade_relativa' => 88,
            'velocidade_vento' => 1.03,
        ];

        // Mock para o serviço WeatherService
        $this->weatherService->shouldReceive('getWeather')
            ->once()
            ->with('Anápolis')
            ->andReturn($mockWeatherResponse);

        // Criando o objeto WeatherRequest simulado
        $weatherRequest = Mockery::mock(WeatherRequest::class);
        $weatherRequest->shouldReceive('validated')
            ->once()
            ->andReturn(['cidade' => 'Anápolis']);

        // Substituindo o WeatherRequest original com o mock
        $this->app->instance(WeatherRequest::class, $weatherRequest);

        // Chamando o controlador com o objeto WeatherRequest
        $response = $this->controller->getWeather($weatherRequest);

        // Verifica se o status é 200 e se os dados retornados são corretos
        $this->assertEquals(200, $response->status());
        $this->assertJsonStringEqualsJsonString(json_encode($mockWeatherResponse), $response->getContent());
    }

    /**
     * Testa o comportamento quando o serviço retorna um erro.
     */
    public function test_get_weather_error()
    {
        // Dados de erro simulados
        $mockErrorResponse = ['error' => 'Não foi possível obter os dados do clima.'];

        // Mock para o serviço WeatherService retornando erro
        $this->weatherService->shouldReceive('getWeather')
            ->once()
            ->with('Anápolis')
            ->andReturn($mockErrorResponse);

        // Criando o objeto WeatherRequest simulado
        $weatherRequest = Mockery::mock(WeatherRequest::class);
        $weatherRequest->shouldReceive('validated')
            ->once()
            ->andReturn(['cidade' => 'Anápolis']);

        // Substituindo o WeatherRequest original com o mock
        $this->app->instance(WeatherRequest::class, $weatherRequest);

        // Chamando o controlador com o objeto WeatherRequest
        $response = $this->controller->getWeather($weatherRequest);

        // Verifica se o status é 500 e se a mensagem de erro está correta
        $this->assertEquals(500, $response->status());
        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'Não foi possível obter os dados do clima.']), $response->getContent());
    }

    /**
     * Testa a validação da requisição quando a cidade não é fornecida.
     */
    public function test_get_weather_validation_error()
    {
        // Envia a requisição sem o campo 'cidade'
        $response = $this->json('GET', '/api/clima', []); // Ou qualquer endpoint de sua aplicação

        // Verifica que a resposta tem status 422, indicando erro de validação
        $response->assertStatus(422);

        // Verifica que o campo 'cidade' foi validado e retornado como erro
        $response->assertJsonValidationErrors(['cidade']);
    }


    /**
     * Testa se a cidade vazia retorna erro.
     */
    public function test_get_weather_city_not_provided()
    {
        // Mock para o serviço WeatherService retornando um erro para cidade vazia
        $this->weatherService->shouldReceive('getWeather')
            ->once()
            ->with('')
            ->andReturn(['error' => 'Cidade não informada.']);

        // Criando o objeto WeatherRequest simulado para cidade vazia
        $weatherRequest = Mockery::mock(WeatherRequest::class);
        $weatherRequest->shouldReceive('validated')
            ->once()
            ->andReturn(['cidade' => '']);

        // Substituindo o WeatherRequest original com o mock
        $this->app->instance(WeatherRequest::class, $weatherRequest);

        // Chamando o controlador com o objeto WeatherRequest
        $response = $this->controller->getWeather($weatherRequest);

        // Verifica se o status é 500 e a mensagem de erro correta
        $this->assertEquals(500, $response->status());
        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'Cidade não informada.']), $response->getContent());
    }
}