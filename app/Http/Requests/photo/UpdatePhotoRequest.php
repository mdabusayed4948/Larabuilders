<?php

namespace App\Http\Requests\photo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
        $photo = $this->route('photo');
        return [
            'title' => 'required|unique:photos,title,'.$photo->id,
            'image'       => 'mimes:jpeg,bmp,png,jpg'
        ];
    }
}
