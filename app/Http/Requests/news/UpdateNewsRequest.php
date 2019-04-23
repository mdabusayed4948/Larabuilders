<?php

namespace App\Http\Requests\news;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
        $news = $this->route('news');
        return [
            'title'       => 'required|unique:news,title,'.$news->id,
            'description' => 'required',
            'news_date'   => 'required',
            'image'       => 'mimes:jpeg,bmp,png,jpg'
        ];
    }
}
