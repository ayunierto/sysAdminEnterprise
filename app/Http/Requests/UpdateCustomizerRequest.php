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
            'color_menu'=> 'string|max:50',
            'color_sub_menu'=> 'string|max:50',
            'color_header'=> 'string|max:50',
            'color_footer'=> 'string|max:50',
            'color_text'=> 'string|max:50',
        ];
    }
}
