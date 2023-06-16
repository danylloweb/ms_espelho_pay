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
        return [
            'amount'            => 'bail|required|numeric|min:1',
            'customer_id'       => 'required|numeric|exists:customers,id',
            'payment_method_id' => 'required|numeric|exists:payment_methods,id',
        ];
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
            'payment_method_id.required' => 'Metodo de pagamento inexistente',
            'payment_method_id.numeric'  => 'Metodo de pagamento formato inválido',
            'payment_method_id.exists'   => 'Esse Metodo de pagamento não existe ou com ID inválido',
        ];
    }
}
