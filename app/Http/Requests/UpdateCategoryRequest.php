<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'description' => 'string|nullable|max:250'

        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'El campo nombre es requerido',
            'name.string'=> 'El campo nombre solo debe contener letras.',
            'name.max'=> 'El campo nombre solo permite máximo 50 caracteres',
            'description.required'=> 'El campo descripción es requerido',
            'description.max'=> 'El campo descripción solo permite máximo 250 caracteres',
        ];
    }
}
