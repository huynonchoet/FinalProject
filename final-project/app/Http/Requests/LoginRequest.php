<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => 'required|email',
            'password' => 'required',
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
            'required' => 'Hãy nhập :attribute',
            'email' => 'Email không đúng định dạng',
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
            'password' => 'password',
        ];
    }
}