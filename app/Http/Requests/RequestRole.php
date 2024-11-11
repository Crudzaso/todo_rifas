<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestRole extends FormRequest
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
            'role_id' => 'exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'role_id.exists' => 'El rol que intentas eliminar no existe.',
        ];
    }
}
