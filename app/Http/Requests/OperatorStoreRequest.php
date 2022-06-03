<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorStoreRequest extends FormRequest
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
            'fullname' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'username' => ['required', 'unique:operators', 'regex:/^[a-zA-Z0-9\_]+$/'],
            'password' => ['required', 'confirmed', 'min:4'],
        ];
    }
}
