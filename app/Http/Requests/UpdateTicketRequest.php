<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (auth()->user()->role == 'admin') {
            return [
                'status' => ['sometimes', 'string', Rule::in(array_column(TicketStatus::cases(), 'value'))],
            ];
        }

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'attachment' => 'sometimes|file|mimes:pdf,jpg,jpeg,bmp,png',
            'status' => ['sometimes', 'string', Rule::in(array_column(TicketStatus::cases(), 'value'))],
        ];
    }
}
