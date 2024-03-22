<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWholesaleRequest extends FormRequest
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
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'region_id' => ['nullable', 'string', 'exists:regions,id'],
            'zone_id' => ['nullable', 'string', 'exists:zones,id'],
            'territory_id' => ['nullable', 'string', 'exists:territories,id'],
            'designation' => ['nullable', 'string'],
            'community' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-180,180'],
            'longitude' => ['nullable', 'numeric', 'required_with:longitude', 'between:-90,90']
        ];
    }
}
