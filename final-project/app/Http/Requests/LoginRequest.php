<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::exists('users', 'email')->whereNull('deleted_at')],
            'password' => 'required',
            'captcha' => 'required|captcha',
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
            'required' => ':attributes is required',
            'email' => 'This :attribute is not valid',
            'email.exists' => 'This Email does not exist',
            "captcha.captcha" => 'Wrong Captcha'
        ];
    }

    /**
     * Get the attributes for the defined validation rules.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'captcha' => 'Captcha',
        ];
    }
}
