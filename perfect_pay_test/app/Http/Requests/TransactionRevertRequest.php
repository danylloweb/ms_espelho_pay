<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRevertRequest extends FormRequest
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
            'id' => 'required|numeric|exists:transactions,id',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => 'O ID é obrigatório',
            'id.numeric'  => 'ID no formato inválido',
            'id.exists'   => 'Essa Transação não existe ou com ID inválido'
        ];
    }
}
