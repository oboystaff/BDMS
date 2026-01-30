<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesRequest extends FormRequest
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
            'request_id' => ['required', 'string', 'exists:client_requests,request_id'],
            'client_id' => ['required', 'string', 'exists:registrations,reg_id'],
            'book_id' => ['required', 'string', 'exists:books,book_id'],
            'zonal_sales_officer_id' => ['required', 'string', 'exists:zonal_sales_officers,id'],
            'amount' => ['required', 'numeric']
        ];
    }
}
