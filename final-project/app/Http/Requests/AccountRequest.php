<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required|min:6',
            'avatar' => 'mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'password' => 'required|min:8',
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
            'name.required' =>  __('validation.required', ['attribute' => 'Name']),
            'name.min' => __('validation.min', ['attribute' => 'Name']),
            'avatar.mimes' =>  __('validation.mimes', ['attribute' => 'Avatar']),
            'avatar.max' => __('validation.max', ['attribute' => 'Avatar']),
            'phone.required' =>  __('validation.required', ['attribute' => 'Phone']),
            'address.required' =>  __('validation.required', ['attribute' => 'Address']),
            'birthday.required' =>  __('validation.required', ['attribute' => 'Birthday']),
            'password.required' =>  __('validation.required', ['attribute' => 'Password']),
        ];
    }
}
