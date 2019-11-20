<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePicture extends FormRequest
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
            'propic' => 'required|mimes:jpeg,jpg,png,bmp,svg|dimensions:max_width=500,max_height=500'
        ];
    }

    public function messages()
    {
        return array(
          'propic.dimensions' => 'Maximum dimension is 500 x 500',

        );
    }
}
