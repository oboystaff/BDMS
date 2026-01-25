<?php

namespace App\Http\Requests\API\Territory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTerritoryRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('territories', 'name')],
            'region_id' => ['required', 'string', 'exists:regions,id'],
            'zone_id' => ['required', 'string', 'exists:zones,id'],
            'latitude' => ['required', 'numeric', 'between:-180,180'],
            'longitude' => ['required', 'numeric', 'required_with:longitude', 'between:-90,90']
        ];
    }
}
