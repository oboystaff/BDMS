<?php

namespace App\Http\Requests\Payment;

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
            'invoice_id' => ['required', 'string', 'exists:invoices,invoice_id'],
            'client_id' => ['required', 'string', 'exists:registrations,reg_id'],
            'book_id' => ['required', 'string', 'exists:books,book_id'],
            'amount' => ['required', 'numeric'],
            'payment_mode' => ['required', 'string', 'in:cash,cheque,bank transfer'],
            'cheque_no' => ['required_if:payment_mode,cheque', 'nullable', 'string',],
            'bank_name' => ['required_if:payment_mode,cheque,bank transfer', 'nullable', 'string',],
        ];
    }
}
