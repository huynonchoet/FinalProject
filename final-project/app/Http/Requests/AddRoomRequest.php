<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoomRequest extends FormRequest
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
            'price' => 'required|numeric',
            'description' => 'required|max:2000',
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
            'image.required' =>  __('validation.required', ['attribute' => 'Image']),
            'image.array'  =>  __('validation.array', ['attribute' => 'Image']),
            'image.max' =>  __('validation.max', ['attribute' => 'Image']),
            'image.min' =>  __('validation.min', ['attribute' => 'Image']),
            'image.*.image' =>  __('validation.image', ['attribute' => 'Image']),
            'image.*.mimes' =>  __('validation.mimes', ['attribute' => 'Image']),
            'image.*.max' => __('validation.max', ['attribute' => 'Image']),
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
