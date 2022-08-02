<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            // 'code' => 'string|max:25',
            // 'bar_code' => 'string|max:25',
            // 'stock' => 'numeric',
            // 'purchase_price' => 'numeric',
            // 'sale_price' => 'numeric',
            // 'price_by_unit' => 'numeric',
            // 'wholesale_price' => 'numeric',
            // 'special_price' => 'numeric',
            // 'description' => 'string|max:250',
            'state' => 'required|boolean',
            // 'expiration_date' => 'date',

            'companies_id' => 'required',
            'categories_id' => 'required',
            'marks_id' => 'required',
            'measures_id' => 'required',
            'providers_id' => 'required',
            'presentations_id' => 'required',
        ];
    }
}
