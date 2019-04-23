<?php

namespace App\Http\Requests\career;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
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
        $career = $this->route('career');
        return [
            'title' => 'required|unique:careers,title,'.$career->id,
            'description' => 'required',
        ];
    }
}
