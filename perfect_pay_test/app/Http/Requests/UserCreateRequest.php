<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'     => 'required',
            'email'    => 'email|required|unique:users|email',
            'cpf_cnpj' => 'required|unique:users|min:11|max:14',
            'password' => 'required|min:6',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'email.email'       => 'Formato invalido',
            'email.required'    => 'O campo e-mail é obrigatório',
            'email.unique'      => 'Email já cadastrado',
            'cpf_cnpj.required' => 'O campo CPF ou CNPJ é obrigatório',
            'cpf_cnpj.unique'   => 'O campo CPF ou CNPJ já cadastrado',
            'cpf_cnpj.min'      => 'CPF ou CNPJ Formato invalido',
            'cpf_cnpj.max'      => 'CPF ou CNPJ Formato invalido',
            'password.required' => 'O campo senha é obrigatório',
            'password.min'      => 'O campo senha esta menor que o permitido',
        ];
    }
}
