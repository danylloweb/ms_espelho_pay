<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'name'    => 'required',
            'cpfCnpj' => 'required|unique:customers|min:11|max:14',
        ];
    }

    /**
     * @return string[]
     */
    public function messages():array
    {
        return [
            'name.required'    => 'Campo Nome é obrigatório',
            'cpfCnpj.required' => 'CPF ou CNPJ é obrigatório',
            'cpfCnpj.unique'   => 'CPF ou CNPJ é já cadatrado',
            'cpfCnpj.min'      => 'CPF ou CNPJ Formato invalido',
            'cpfCnpj.max'      => 'CPF ou CNPJ Formato invalido',
        ];
    }
}
