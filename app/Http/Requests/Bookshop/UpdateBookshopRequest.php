<?php

namespace App\Http\Requests\Bookshop;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookshopRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'contact_person_name' => ['nullable', 'string'],
            'contact_person_phone' => ['nullable', 'string'],
            'region_id' => ['required', 'string', 'exists:regions,id'],
            'zone_id' => ['required', 'string', 'exists:zones,id'],
            'territory_id' => ['required', 'string', 'exists:territories,id'],
            'zonal_sales_officer_id' => ['required', 'string', 'exists:zonal_sales_officers,id'],
            'latitude' => ['required', 'numeric', 'between:-180,180'],
            'longitude' => ['required', 'numeric', 'required_with:longitude', 'between:-90,90']
        ];
    }
}
