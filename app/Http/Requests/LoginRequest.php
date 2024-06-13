<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|string|min:8|max:26',
        ];
    }

    public function messages():array
    {
        return [
            'email.required'=>'Email Missing',
            'email.email'=>'Must be email format example@example.com',
            'password.required'=>'Password Missing',
            'password.min'=>'Password must be at least 8 charecters',
            'password.max'=>"password should be at most 26 charecters",
        ];
    }
}
