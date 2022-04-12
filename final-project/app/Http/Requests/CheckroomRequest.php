<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckroomRequest extends FormRequest
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
            'fromDate' => 'required',
            'toDate' => 'required',
            'qty' => 'required',

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
            'fromDate.required' =>  __('validation.required', ['attribute' => 'From Date']),
            'toDate.required' =>  __('validation.required', ['attribute' => 'To Date']),
            'qty.required' =>  __('validation.required', ['attribute' => 'Quantity Room']),
        ];
    }
}
