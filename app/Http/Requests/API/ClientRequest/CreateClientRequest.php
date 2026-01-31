<?php

namespace App\Http\Requests\API\ClientRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'client_id' => ['required', 'string', 'exists:registrations,reg_id'],
            'subject_id' => ['nullable', 'string', 'exists:subjects,id'],
            'level_id' => ['nullable', 'string', 'exists:levels,id'],
            'book_id' => ['nullable', 'string', 'exists:books,book_id'],
            'unit_price' => ['nullable', 'numeric'],
            'quantity' => ['nullable', 'numeric']
        ];
    }
}
