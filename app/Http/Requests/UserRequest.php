<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public mixed $date_birth;

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
            'name' => 'required',
            'email' => 'required|email',
            'marital_status' => 'required',
            'zipcode' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'date_birth' => 'required',
            'address' => 'required',
            'number' => 'required|integer',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'uf' => 'required',
            'phone_number' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo de nome é obrigatório',
            'email.required' => 'O campo de email é obrigatório',
            'marital_status.required' => 'O campo de estado civil é obrigatório',
            'zipcode.required' => 'O campo de cep é obrigatório',
            'cpf.required' => 'O campo de cpf é obrigatório',
            'rg.required' => 'O campo de rg é obrigatório',
            'date_birth.required' => 'O campo de data de nascimento é obrigatório',
            'address.required' => 'O campo de endereço é obrigatório',
            'number.required' => 'O campo de número é obrigatório',
            'neighborhood.required' => 'O campo de bairro é obrigatório',
            'city.required' => 'O campo de cidade é obrigatório',
            'state.required' => 'O campo de estado é obrigatório',
            'uf.required' => 'O campo de unidade federativa é obrigatório',
            'phone_number.required' => 'O campo de telefone é obrigatório',
        ];
    }
}
