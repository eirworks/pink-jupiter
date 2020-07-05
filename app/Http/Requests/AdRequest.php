<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'city_id' => 'required|integer|min:1',
            'category_id' => 'required|integer|min:1',
            'price' => 'required|integer|min:100',
        ];
    }

    public function messages()
    {
        return [
            'city_id.min' => __('validation.city_required'),
            'category_id.min' => __('validation.category_required'),
        ];
    }



}
