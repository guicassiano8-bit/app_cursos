<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:3',
            'password_confirmation' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'O campo email tem que ser um email valido!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.min' => 'O campo senha tem que ter no minimo :min caracteres!',
            'password_confirmation.same' => 'O campo confirmar senha tem que ser igual ao campo senha!',
        ];     
    }
}
