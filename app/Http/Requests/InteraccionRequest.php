<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class InteraccionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'perro_interesado_id' => [
                'required',
                Rule::exists('perros', 'id')->whereNull('deleted_at'),
                Rule::notIn($this->perro_candidato_id),
            ],
            'perro_candidato_id' => [
                'required',
                Rule::exists('perros', 'id')->whereNull('deleted_at'),
                Rule::notIn($this->perro_interesado_id),
            ],
            'preferencia' => 'required|in:A,R',
        ];
    }
    public function messages()
    {
        return [
            'perro_interesado_id.required' => 'El campo perro_interesado_id es obligatorio.',
            'perro_interesado_id.exists' => 'El perro interesado no existe.',
            'perro_interesado_id.not_in' => 'El perro interesado y el perro candidato no pueden ser el mismo.',
            'perro_candidato_id.required' => 'El campo perro_candidato_id es obligatorio.',
            'perro_candidato_id.exists' => 'El perro candidato no existe.',
            'perro_candidato_id.not_in' => 'El perro candidato y el perro interesado no pueden ser el mismo.',
            'preferencia.required' => 'El campo preferencia es obligatorio.',
            'preferencia.in' => 'La preferencia debe ser A o R.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
