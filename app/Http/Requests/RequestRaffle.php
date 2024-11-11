<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRaffle extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:ticket,bet',
            'lottery' => 'required|string',
            'raffle_date' => 'required|date',

            'tickets_count' => 'required|integer|min:1|max:100',

        ];

        if ($this->input('type') === 'ticket') {
            $rules['ticket_price'] = 'required|numeric|min:1';
        }
        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre de la rifa es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'lottery.required' => 'Debes seleccionar una lotería.',
            'type.required' => 'Debes seleccionar un tipo de rifa.',
            'raffle_date.required' => 'La fecha de la rifa es obligatoria.',
            'raffle_date.after' => 'La fecha de la rifa debe ser una fecha futura.',
            'tickets_count.required' => 'El número de boletos es obligatorio".',
            'ticket_price.required' => 'El precio del boleto es obligatorio si seleccionaste el tipo "ticket".',
            'ticket_price.numeric' => 'El precio del boleto debe ser un número.',
            'ticket_price.min' => 'El precio del boleto debe ser al menos 1.',
        ];
    }
}
