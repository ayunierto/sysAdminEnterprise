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
            'description' => 'required|string|max:250',
            'state' => 'required|boolean',
            'expiration_date' => 'required|date',

            'company' => 'required',
            'category' => 'required',
            'mark' => 'required',
            'measure' => 'required',
            'provider' => 'required',
            'presentation' => 'required',
            'batch' => 'required',
        ];
    }
}
