<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WeatherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cidade' => 'required|string|max:255', // O parâmetro "cidade" é obrigatório, deve ser uma string e ter no máximo 255 caracteres
        ];
    }

    public function messages()
    {
        return [
            'cidade.required' => 'O parâmetro "cidade" é obrigatório.',
            'cidade.string' => 'O parâmetro "cidade" deve ser uma string.',
            'cidade.max' => 'O parâmetro "cidade" não pode ter mais que 255 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Dados inválidos.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
