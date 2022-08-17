<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'login' => 'required|max:20|unique:users,login,' . optional($this->user)->id,
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . optional($this->user)->id,
            'password' => is_null($this->user) ? 'required|min:5|confirmed' : 'nullable|min:5|confirmed',
        ];
    }
}
