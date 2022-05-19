<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddHomestayRequest extends FormRequest
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
            'name' => 'required|max:255|min:5',
            'image' => 'required|array|min:2|max:6',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'phone' => 'required|digits:10',
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
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'name.max' =>  __('validation.max', ['attribute' => 'Name']),
            'name.min' =>  __('validation.min', ['attribute' => 'Name']),
            'image.required' =>  __('validation.required', ['attribute' => 'Image']),
            'image.array'  =>  __('validation.array', ['attribute' => 'Image']),
            'image.max' =>  __('validation.max', ['attribute' => 'Image']),
            'image.min' =>  __('validation.min', ['attribute' => 'Image']),
            'image.*.image' =>  __('validation.image', ['attribute' => 'Image']),
            'image.*.mimes' =>  __('validation.mimes', ['attribute' => 'Image']),
            'image.*.max' => __('validation.max', ['attribute' => 'Image']),
            'address.required' =>  __('validation.required', ['attribute' => 'Address']),
            'phone.required' => __('validation.required', ['attribute' => 'Phone']),
            'phone.digits' => __('validation.digits', ['attribute' => 'Phone']),
        ];
    }
}
