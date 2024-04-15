<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'category_name' => ['required'],
            'image' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Category Name is required',
            'image.required' => 'Image is required',
        ];
    }
}
