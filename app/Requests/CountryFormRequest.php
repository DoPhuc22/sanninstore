<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryFormRequest extends FormRequest
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
            'country_name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'country_name.required' => 'Country Name is required',
            'country_name.regex' => 'Country Name is not correct format',
        ];
    }
}
