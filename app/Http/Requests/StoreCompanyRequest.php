<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'ruc' => 'required|numeric',
            'description' => 'required|string|max:250',
            'phone' => 'required|max:15',
            'address' => 'required|string|max:250',
            'department' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'country_code' => 'required|string|max:10',
            'state' => 'required|string|max:50',
        ];
    }
}
