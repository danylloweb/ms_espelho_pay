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
            'name'          => 'required',
            'cpfCnpj'       => 'required|unique:customers|min:11|max:14',
            'postalCode'    => 'required',
            'mobilePhone'   => 'required|numeric',
            'address'       => 'required',
            'addressNumber' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages():array
    {
        return [
            'name.required'        => 'Campo Nome é obrigatório',
            'cpfCnpj.required'     => 'CPF ou CNPJ é obrigatório',
            'cpfCnpj.unique'       => 'CPF ou CNPJ é já cadatrado',
            'cpfCnpj.min'          => 'CPF ou CNPJ Formato invalido',
            'cpfCnpj.max'          => 'CPF ou CNPJ Formato invalido',
            'postalCode.required'  => 'Campo CEP é obrigatório',
            'mobilePhone.required' => 'Campo Telefone é obrigatório',
            'mobilePhone.numeric'  => 'Campo telefone inválido',
            'address.required'     => 'Campo Endereço é obrigatório',
            'addressNumber.required' => 'Campo Numero do endereço é obrigatório',
            'addressNumber.numeric'  => 'Campo Numero do endereço é obrigatório',
        ];
    }
}
