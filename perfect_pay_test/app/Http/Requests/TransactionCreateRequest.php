<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'amount'            => 'bail|required|numeric|min:1',
            'customer_id'       => 'required|numeric|exists:customers,id',
            'payment_method_id' => 'required|numeric|exists:payment_methods,id',
        ];

        if ($this->input('payment_method_id') == 3) {
            $rules['ccv']         = 'required|numeric';
            $rules['expiryYear']  = 'required|numeric|digits:4';
            $rules['expiryMonth'] = 'required|numeric|digits_between:1,2';
            $rules['number']      = 'required|numeric';
            $rules['holderName']  = 'required';
        }

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'amount.required'            => 'O valor é obrigatório',
            'amount.numeric'             => 'Valor no formato inválido',
            'amount.min'                 => 'Valor abaixo do permitido',
            'customer_id.required'       => 'Pagador é obrigatório',
            'customer_id.numeric'        => 'Pagador formato inválido',
            'customer_id.exists'         => 'Esse Pagador não existe ou com ID inválido',
            'payment_method_id.required' => 'Método de pagamento inexistente',
            'payment_method_id.numeric'  => 'Método de pagamento formato inválido',
            'payment_method_id.exists'   => 'Esse Método de pagamento não existe ou com ID inválido',
            'ccv.required'               => 'CCV é obrigatório',
            'ccv.numeric'                => 'CCV deve ser um número',
            'expiryYear.required'        => 'Ano de Expiração é obrigatório',
            'expiryYear.numeric'         => 'Ano de Expiração deve ser um número',
            'expiryYear.digits'          => 'Ano de Expiração inválido',
            'expiryMonth.required'       => 'Mês de Expiração é obrigatório',
            'expiryMonth.numeric'        => 'Mês de Expiração deve ser um número',
            'expiryMonth.digits_between' => 'Mês de Expiração inválido',
            'number.required'            => 'Número do Cartão é obrigatório',
            'number.numeric'             => 'Número do Cartão deve ser um número',
            'holderName.required'        => 'Nome do dono do Cartão é obrigatório',
        ];
    }
}
