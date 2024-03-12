<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
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
            'name' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'contact_person_name' => ['nullable', 'string'],
            'contact_person_phone' => ['nullable', 'string'],
            'contact_person_email' => ['nullable', 'string'],
            'region_id' => ['nullable', 'string', 'exists:regions,id'],
            'zone_id' => ['nullable', 'string', 'exists:zones,id'],
            'territory_id' => ['nullable', 'string', 'exists:territories,id'],
            'latitude' => ['nullable', 'numeric', 'between:-180,180'],
            'longitude' => ['nullable', 'numeric', 'required_with:longitude', 'between:-90,90']
        ];
    }
}
