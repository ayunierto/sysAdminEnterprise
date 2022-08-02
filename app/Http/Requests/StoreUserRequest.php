<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
        ];
    }
}
