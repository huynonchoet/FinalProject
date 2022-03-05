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
            'avatar' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
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
            'name.required' =>  __('validation.required', ['attribute' => 'name']),
            'name.min' => __('validation.min', ['attribute' => 'name']),
            'avatar.required' =>  __('validation.required', ['attribute' => 'image']),
            'avatar.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'avatar.max' => __('validation.max', ['attribute' => 'image']),
            'phone.required' =>  __('validation.required', ['attribute' => 'phone']),
            'birthday.required' =>  __('validation.required', ['attribute' => 'birthday']),
            'password.required' =>  __('validation.required', ['attribute' => 'password']),
        ];
    }
}
