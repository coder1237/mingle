<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserSignup extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'annual_income' => ['required', 'numeric', 'between:1,100000000.00'],
            'gender' => ['required', Rule::in(['male', 'female'])],
        ];
    }
}
