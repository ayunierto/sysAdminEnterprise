<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
            'companies_id' => 'required',
            'name' => 'required|string|max:100',
            'document' => 'required|string|max:50',
            'description' => 'required|string|max:250',
            'phone' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50'
        ];
    }
}
