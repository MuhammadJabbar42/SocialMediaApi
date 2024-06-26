<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:16',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:26',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,26}$/',
            ],
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please Fill Up Your Name.',
            'name.min'=>'Name should be at least 4 Charecter',
            'name.max'=>'Name Cannot be longer than 16 Charecter',
            'email.required' => 'Please Fill Up Your Email.',
            'email.email'=>'Must be email format example@example.com',
            'password.required' => 'Please Fill Up Your Password.',
            'password.min'=>'Password must be at least 8 charecters',
            'password.max'=>"password should be at most 26 charecters",
            'password.regex' => 'The password must be include at least one uppercase letter, one lowercase letter, one number, and one special character.',

        ];
    }
}
