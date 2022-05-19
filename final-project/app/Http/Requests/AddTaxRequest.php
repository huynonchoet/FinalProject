<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTaxRequest extends FormRequest
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
            'day_start' => 'required|after:yesterday',
            'end_day' => 'required|after:day_start',
            'tax' => 'required|integer|between:1,50'
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
            'day_start.required' =>  __('validation.required', ['attribute' => 'From Day']),
            'day_start.after' =>  __('validation.after', ['attribute' => 'From Day']),
            'end_day.after' =>  __('validation.after', ['attribute' => 'To Day']),
            'end_day.required' =>  __('validation.required', ['attribute' => 'To Day']),
            'tax.required' =>  __('validation.required', ['attribute' => 'Tax']),
            'tax.integer' =>  __('validation.integer', ['attribute' => 'Tax']),
            'tax.between' =>  __('validation.between', ['attribute' => 'Tax']),
        ];
    }
}
