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
            'color_menu'=> 'nullable|string|max:50',
            'color_sub_menu'=> 'nullable|string|max:50',
            'color_header'=> 'nullable|string|max:50',
            'color_footer'=> 'nullable|string|max:50',
            'color_text'=> 'nullable|string|max:50',
            // 'logo'=> 'nullable|image',
        ];
    }
}
