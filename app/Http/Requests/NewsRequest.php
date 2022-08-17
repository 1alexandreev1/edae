<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:news,name,' . optional($this->news)->id,
            'sub_url' => 'nullable|min:1',
            'text' => 'required|min:10',
            'last_code' => 'required|numeric',
            'file.*' => 'nullable|file',
            'codeFile.*' => 'required_if:file,|string',
            'views' => 'nullable|numeric',
            'publish' => 'required|date',
            'tags' => 'nullable|array'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return __('news');
    }
}
