<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string',
            'code' => 'required|numeric',
            'bar_code' => 'required|numeric',
            'stock' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'price_by_unit' => 'numeric',
            'wholesale_price' => 'numeric',
            'special_price' => 'numeric',
            'description' => 'required|string|max:250',
            'state' => 'required|boolean',
            'expiration_date' => 'required|date',

            'companies_id' => 'required',
            'categories_id' => 'required',
            'marks_id' => 'required',
            'measures_id' => 'required',
            'providers_id' => 'required',
            'presentations_id' => 'required',
        ];
    }
}
