<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1000',
            'name' => 'required|string',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return[
            'amount.required' => 'El precio es obligatorio.',
            'amount.numeric' => 'El monto debe ser un número.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'Debes proporcionar el email.',
            ];

    }
}
