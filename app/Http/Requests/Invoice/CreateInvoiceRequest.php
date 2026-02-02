<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'apply_discount' => ['nullable', 'boolean'],
            'discount' => ['nullable', 'numeric'],
            'discount_amount' => ['nullable', 'numeric', 'min:0', $this->apply_discount ? 'required' : '']
        ];
    }
}
