<?php

namespace App\Http\Requests;

use App\Enums\TicketCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:2000',
            'category' => ['required', 'string', Rule::in(array_column(TicketCategory::cases(), 'value'))],
            'attachment' => 'sometimes|file|mimes:pdf,jpg,jpeg,bmp,png',
        ];
    }
}
