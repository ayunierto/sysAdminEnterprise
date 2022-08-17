<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'providers_id' => 'required',
            'companies_id' => 'required',
            'payment_methods_id' => 'required',
            'proof_payments_id' => 'required',
            'voucher_number' => 'required',
            'exchange_rate' => 'required',
            'date' => 'required',
            'coins_id' => 'required',
            'state' => 'required',
            'products' => 'required',
        ];
    }
}
