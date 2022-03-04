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
            'name.required' => __('validation.required', ['attribute' => 'name']),
            'name.max' =>  __('validation.max', ['attribute' => 'name']),
            'name.min' =>  __('validation.min', ['attribute' => 'name']),
            'image.required' =>  __('validation.required', ['attribute' => 'image']),
            'image.array'  =>  __('validation.array', ['attribute' => 'image']),
            'image.max' =>  __('validation.max', ['attribute' => 'image']),
            'image.min' =>  __('validation.min', ['attribute' => 'image']),
            'image.*.image' =>  __('validation.image', ['attribute' => 'image']),
            'image.*.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'image.*.max' => __('validation.max', ['attribute' => 'image']),
            'price.required' =>  __('validation.required', ['attribute' => 'price']),
            'price.numeric' =>  __('validation.numeric', ['attribute' => 'price']),
            'discount.integer' =>  __('validation.integer', ['attribute' => 'discount']),
            'description.required' => __('validation.required', ['attribute' => 'description']),
            'description.max' => __('validation.max', ['attribute' => 'description']),
            'quantity_room.required' => __('validation.required', ['attribute' => 'quantity']),
            'quantity_room.integer' => __('validation.integer', ['attribute' => 'quantity']),
            'type_room_id.required' =>  __('validation.required', ['attribute' => 'type_room_id']),
            'type_room_id.numeric' =>  __('validation.numeric', ['attribute' => 'type_room_id']),
        ];
    }
}
