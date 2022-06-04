<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[0-9a-zA-Z\s\-]+$/'],
            'price' => ['required', 'integer', 'gt:0'],
            'duration' => ['required', 'integer', 'gt:0'],
            'type' => ['required', 'exists:App\Models\ComputerType,id']
        ];
    }
}
