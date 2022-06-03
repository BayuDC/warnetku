<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
            'customer' => ['required', 'regex:/^[a-zA-Z\s0-9]+$/'],
            'computer' => ['required', 'exists:App\Models\Computer,id'],
            'duration' => ['required', 'integer', 'min:1', 'max:24']
        ];
    }
}
