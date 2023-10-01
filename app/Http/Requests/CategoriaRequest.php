<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoriaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|max:30|min:5',
            'cor' => 'required|max:20|min:2'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O titulo é requerido!',
            'cor.required' => 'A cor é requerida!',

            'titulo.min' => 'O titulo deve conter no mínimo 10 caracteres!',
            'cor.min' => 'A descrição deve conter no mínimo 2 caracteres!',

            'titulo.max' => 'O titulo deve conter no máximo 200 caracteres!',
            'cor.max' => 'A descrição deve conter no máximo 20 caracteres!',
        ];
    }
}
