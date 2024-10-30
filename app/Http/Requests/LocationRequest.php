<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'city' => 'nullable|required_without:state|string|min:2',
            'state' => 'nullable|required_without:city|string|min:2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'city.required_without' => 'The city field is required when state is empty.',
            'city.min' => 'The city field must have at least 2 characters.',
            'state.required_without' => 'The state field is required when city is empty.',
            'state.min' => 'The state field must have at least 2 characters.',
        ];
    }
}
