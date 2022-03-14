<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users|email:rfc,dns',
            'name' => 'required|min:6',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required|min:8|max:20',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email' => 'This email is not valid ',
            'required' => ':attributes is required',
            'min' => ':attributes is required at least :min characters',
            'max' => ':attributes is required less than :max characters',
            'confirmed' => 'Password Confirmation should match the Password'
        ];
    }
}
