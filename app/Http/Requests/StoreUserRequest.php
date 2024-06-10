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
            'name'=>'required|string|min:4|max:16',
            'email'=>'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:26',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,26}$/',
            ],
        ];

    }

    public function messages():array
    {
        return [
            'password.regex'=> 'The password must be 8-26 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            
        ];
    }
}
