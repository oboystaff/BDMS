<?php

namespace App\Http\Requests\Requisition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequisitionRequest extends FormRequest
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
            'zonal_sales_officer_id' => ['required', 'string', 'exists:zonal_sales_officers,id'],
            'book_id' => ['required', 'string', 'exists:books,book_id'],
            'subject_id' => ['required', 'string', 'exists:subjects,id'],
            'level_id' => ['required', 'string', 'exists:levels,id'],
            'quantity' => ['required', 'numeric'],
            'available_stock' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric']
        ];
    }
}
