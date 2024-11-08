<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class direccionRequest extends FormRequest
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
            'calle' => ['required', 'string', 'max:50'],
            'colonia' => ['required', 'string', 'max:50'],
            'numero_ext' => ['required', 'string', 'max:50'],
            'numero_int' => ['required', 'string', 'max:50'],
            'estado' => ['required', 'string', 'max:50'],
            'codigo_postal' => ['required', 'string', 'max:50'],
            'pais' => ['required', 'string', 'max:50'],
        ];
    }
}
