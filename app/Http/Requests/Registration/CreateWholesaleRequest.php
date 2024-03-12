<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWholesaleRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('registrations', 'name')],
            'email' => ['required', 'string', Rule::unique('registrations', 'email')],
            'phone' => ['required', 'string', Rule::unique('registrations', 'phone')],
            'region_id' => ['required', 'string', 'exists:regions,id'],
            'zone_id' => ['required', 'string', 'exists:zones,id'],
            'territory_id' => ['required', 'string', 'exists:territories,id'],
            'latitude' => ['required', 'numeric', 'between:-180,180'],
            'longitude' => ['required', 'numeric', 'required_with:longitude', 'between:-90,90']
        ];
    }
}
