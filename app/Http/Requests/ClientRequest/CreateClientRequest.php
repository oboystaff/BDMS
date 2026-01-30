<?php

namespace App\Http\Requests\ClientRequest;

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
            'book_id' => ['required', 'string', 'exists:books,book_id'],
            'subject_id' => ['required', 'string', 'exists:subjects,id'],
            'level_id' => ['required', 'string', 'exists:levels,id'],
            'unit_price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ];
    }
}
