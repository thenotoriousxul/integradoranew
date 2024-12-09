<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class productoRequest extends FormRequest
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
            'tipo' => ['required', 'string', 'max:50'],
            'talla' => ['required', Rule::in(['CH', 'M', 'XL', 'XXL'])],
            'color' => ['required', 'string', 'max:50'],
            'lote' => ['required', 'integer', 'min:1'],
            'costo' => ['required', 'numeric', 'min:0'],
            'imagen_producto' => ['nullable', 'image', 'max:2048'],
            'proveedores_id' => ['required', 'integer'], 
        ];
    }
}
