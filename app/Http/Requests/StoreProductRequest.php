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
            'companies_id' => 'required|integer',
            'categories_id' => 'required|integer',
            'marks_id' => 'required|integer',
            'measures_id' => 'required|integer',
            'providers_id' => 'required|integer',
            
            'type' => 'nullable|string|max:25',
            'name' => 'required|string',
            'code' => 'nullable|string|max:25',
            'bar_code' => 'nullable|string|max:25',
            'stock' => 'nullable|numeric',
            'purchase_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'price_by_unit' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'special_price' => 'nullable|numeric',
            'description' => 'nullable|string|max:250',
            'state' => 'nullable|boolean',
            'expiration_date' => 'nullable|date',
        ];
    }
}
