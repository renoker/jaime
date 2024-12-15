<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicinesRequest extends FormRequest
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
            'clave' => 'required|string|max:255|unique:medicines,clave',
            'descripcion' => 'required|string|max:1000',
            'principal_activo' => 'required|string|max:255',
            'laboratorio' => 'required|string|max:255',
            'iva' => 'required|numeric|min:0',
            'pecio_maximo' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'pecio' => 'required|numeric|min:0',
            'pecio_anterior' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'comentarios' => 'nullable|string|max:1000',
            'caducidad' => 'required|date|after:today',
            'contenido' => 'required|string|max:255',
            'codigo_barras' => 'required|string|max:255|unique:medicines,codigo_barras',
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
            'clave.required' => 'La clave es obligatoria.',
            'clave.unique' => 'La clave ya existe en el sistema.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'principal_activo.required' => 'El principio activo es obligatorio.',
            'laboratorio.required' => 'El laboratorio es obligatorio.',
            'iva.required' => 'El IVA es obligatorio.',
            'pecio_maximo.required' => 'El precio máximo es obligatorio.',
            'pecio.required' => 'El precio es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
            'caducidad.required' => 'La fecha de caducidad es obligatoria.',
            'caducidad.after' => 'La fecha de caducidad debe ser una fecha futura.',
            'codigo_barras.required' => 'El código de barras es obligatorio.',
            'codigo_barras.unique' => 'El código de barras ya existe en el sistema.',
        ];
    }
}
