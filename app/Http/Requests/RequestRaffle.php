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
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:ticket,bet',
            'lottery' => 'required|string',
            'raffle_date' => 'required|date',

            'tickets_count' => 'required_if:type,ticket|integer|min:1',
            'ticket_price' => 'required_if:type,ticket|numeric|min:1',

            'min_bet' => 'required_if:type,bet|numeric|min:1',
            'max_bet' => 'required_if:type,bet|numeric|min:1|gt:min_bet',


        ];
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
            'tickets_count.required_if' => 'El número de boletos es obligatorio si seleccionaste el tipo "ticket".',
            'ticket_price.required_if' => 'El precio del boleto es obligatorio si seleccionaste el tipo "ticket".',
            'min_bet.required_if' => 'La apuesta mínima es obligatoria si seleccionaste el tipo "bets".',
            'max_bet.required_if' => 'La apuesta máxima es obligatoria si seleccionaste el tipo "bets".',
            'max_bet.gt' => 'La apuesta máxima debe ser mayor que la mínima.',
        ];
    }
}
