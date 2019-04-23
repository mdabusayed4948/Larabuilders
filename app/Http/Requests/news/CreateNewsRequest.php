<?php

namespace App\Http\Requests\news;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
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
            'title'       => 'required|unique:news',
            'description' => 'required',
            'news_date'   => 'required',
            'image'       => 'required|mimes:jpeg,bmp,png,jpg'
        ];
    }
}
