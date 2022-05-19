<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTypeRoomRequest extends FormRequest
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
            'name' => 'required|max:255|regex:"/^[#?!@$%^&*-]+$"|integer',
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
            'name.integer' =>  __('validation.integer', ['attribute' => 'Name']),
            'name.regex' =>  __('validation.regex', ['attribute' => 'Name']),
        ];
    }
}
