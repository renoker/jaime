<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => 'required|string|max:255',
            'edad' => 'required|integer|min:0|max:120',
            'acopio_id' => 'required|exists:acopios,id',
        ];
    }

    /**
     * Mensajes personalizados de error.
     */
    public function messages(): array
    {
        return [
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpg, jpeg, png o webp.',
            'image.max' => 'La imagen no debe exceder los 2 MB.',
            'name.required' => 'El nombre es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'acopio_id.required' => 'El acopio es obligatorio.',
            'acopio_id.exists' => 'El acopio seleccionado no existe.',
        ];
    }
}
