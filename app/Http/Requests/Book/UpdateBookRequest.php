<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'subject_id' => ['required', 'string'],
            'level_id' => ['required', 'string'],
            'unit_price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'minimum_stock_level' => ['required', 'numeric'],
            'author' => ['required', 'string'],
            'title' => ['required', 'string']
        ];
    }
}
