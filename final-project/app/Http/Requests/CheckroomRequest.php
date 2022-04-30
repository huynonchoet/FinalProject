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
            'fromDate' => 'required|after:yesterday',
            'toDate' => 'required|after:fromDate',
            'qty' => 'required|gt:0',

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
            'fromDate.required' =>  __('validation.required', ['attribute' => 'From Day']),
            'fromDate.after' =>  __('validation.after', ['attribute' => 'From Day']),
            'toDate.required' =>  __('validation.required', ['attribute' => 'To Day']),
            'toDate.after' =>  __('validation.after', ['attribute' => 'To Day']),
            'qty.required' =>  __('validation.required', ['attribute' => 'Quantity Room']),
            'qty.gt' =>  __('validation.gt', ['attribute' => 'Quantity Room']),
        ];
    }
}
