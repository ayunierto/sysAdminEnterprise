<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'document' => 'required|string|max:50',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100'
        ];
    }
}
