<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionFeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'valor_emprestimo' => 'required|numeric|min:1',
            'instituicoes' => 'array',
            'convenios' => 'array',
            'parcela' => 'numeric|min:1'
        ];
    }

    /**
     * Get the error messages that apply to the request parameters.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'valor_emprestimo.required' => 'The valor_emprestimo field is required',
            'valor_emprestimo.numeric' => 'The valor_emprestimo field must be a valid positive number',
            'valor_emprestimo.min' => 'The valor_emprestimo field must be a valid positive number',
            'instituicoes.array' => 'The instituicoes field must contain array values',
            'convenios.array' => 'The convenios field must contain array values',
            'parcela.numeric' => 'The parcela field must be a valid positive number',
            'parcela.min' => 'The parcela field must be a valid positive number'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
