<?php

namespace App\Http\Requests\API\Territory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerritoryRequest extends FormRequest
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
            'region_id' => ['nullable', 'string', 'exists:regions,id'],
            'zone_id' => ['nullable', 'string', 'exists:zones,id'],
            'latitude' => ['nullable', 'numeric', 'between:-180,180'],
            'longitude' => ['nullable', 'numeric', 'required_with:longitude', 'between:-90,90'],
            'status' => ['nullable', 'string']
        ];
    }
}
