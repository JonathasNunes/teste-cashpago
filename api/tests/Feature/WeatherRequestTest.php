<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherRequestTest extends TestCase
{
    /**
     * Testa se a validação falha quando o parâmetro "cidade" está ausente.
     */
    public function test_cidade_required()
    {
        $response = $this->json('GET', '/api/clima'); // Sem "cidade"

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'Dados inválidos.',
                     'errors' => [
                         'cidade' => ['O parâmetro "cidade" é obrigatório.']
                     ]
                 ]);
    }

    /**
     * Testa se a validação falha quando o parâmetro "cidade" não é uma string.
     */
    public function test_cidade_must_be_string()
    {
        $response = $this->json('GET', '/api/clima', ['cidade' => 12345]); // Número ao invés de string

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'Dados inválidos.',
                     'errors' => [
                         'cidade' => ['O parâmetro "cidade" deve ser uma string.']
                     ]
                 ]);
    }

    /**
     * Testa se a validação falha quando o parâmetro "cidade" tem mais de 255 caracteres.
     */
    public function test_cidade_max_length()
    {
        $longString = str_repeat('a', 256); // String com 256 caracteres
        $response = $this->json('GET', '/api/clima', ['cidade' => $longString]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'Dados inválidos.',
                     'errors' => [
                         'cidade' => ['O parâmetro "cidade" não pode ter mais que 255 caracteres.']
                     ]
                 ]);
    }

    /**
     * Testa se a validação passa quando o parâmetro "cidade" é válido.
     */
    public function test_cidade_valid()
    {
        $response = $this->json('GET', '/api/clima', ['cidade' => 'Anápolis']);

        $response->assertStatus(200);
    }
}
