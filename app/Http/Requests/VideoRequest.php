<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VideoRequest extends FormRequest
{
    // protected $redirect = '/';

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
        $this->redirect = url()->previous();

        return [
            'titulo' => 'required|min:10|max:100',
            'descricao' => 'required|min:10|max:255',
            'url' => 'required',
            'categoria_id' => ''
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
            'descricao.required' => 'A descrição é requerida!',
            'url.required' => 'A url da imagem é requerida!',

            'titulo.min' => 'O titulo deve conter no mínimo 10 caracteres!',
            'descricao.min' => 'A descrição deve conter no mínimo 10 caracteres!',

            'titulo.max' => 'O titulo deve conter no máximo 100 caracteres!',
            'descricao.max' => 'A descrição deve conter no máximo 255 caracteres!',
        ];
    }
}
