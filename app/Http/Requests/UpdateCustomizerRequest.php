<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomizerRequest extends FormRequest
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
            'companies_id'=> 'required|integer',
            'primary_color'=> 'nullable|string|max:50',
            'secondary_color'=> 'nullable|string|max:50',
            'tertiary_color'=> 'nullable|integer',
            'logo'=> 'nullable|string|max:250',
        ];
    }
}
