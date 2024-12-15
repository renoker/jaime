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
            'genre' => 'required|string',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:120',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'level_id' => 'required|exists:levels,id',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'genre.required' => 'El género es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'age.required' => 'La edad es obligatoria.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'level_id.required' => 'El nivel es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso. Por favor, elige otro.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
