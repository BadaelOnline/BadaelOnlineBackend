<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8"
        ];
    }
    public function messages()
    {
        return [

            'required'=>'this field is required',
            'password.min' => 'Your users\'s password  Is Too Short',
            'email.email' => 'this field is required email'
        ];
    }
}
