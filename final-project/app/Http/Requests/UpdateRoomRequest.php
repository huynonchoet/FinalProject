<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'imageNew' => 'array|min:2|max:6',
            'imageNew.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|max:500',
            'discount' => 'integer|between:0,50',
            'quantity_room' => 'required|integer',
            'typeroom' => 'required|integer',
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
            'imageNew.array'  =>  __('validation.array', ['attribute' => 'Image']),
            'imageNew.max' =>  __('validation.max', ['attribute' => 'Image']),
            'imageNew.min' =>  __('validation.min', ['attribute' => 'Image']),
            'imageNew.*.image' =>  __('validation.image', ['attribute' => 'Image']),
            'imageNew.*.mimes' =>  __('validation.mimes', ['attribute' => 'Image']),
            'imageNew.*.max' => __('validation.max', ['attribute' => 'Image']),
            'price.required' =>  __('validation.required', ['attribute' => 'Price']),
            'price.numeric' =>  __('validation.numeric', ['attribute' => 'Price']),
            'discount.integer' =>  __('validation.integer', ['attribute' => 'Discount']),
            'description.required' => __('validation.required', ['attribute' => 'Description']),
            'description.max' => __('validation.max', ['attribute' => 'Description']),
            'quantity_room.required' => __('validation.required', ['attribute' => 'Quantity']),
            'quantity_room.integer' => __('validation.integer', ['attribute' => 'Quantity']),
            'type_room_id.required' =>  __('validation.required', ['attribute' => 'Type Room']),
            'type_room_id.numeric' =>  __('validation.numeric', ['attribute' => 'Type Room']),
        ];
    }
}
