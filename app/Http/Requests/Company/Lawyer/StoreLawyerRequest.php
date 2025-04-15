<?php

namespace App\Http\Requests\Company\Lawyer;

use Illuminate\Foundation\Http\FormRequest;

class StoreLawyerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:lawyers,email',
            'phone_number' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:18|max:100',
            'address' => 'nullable|string|max:255',
            'additional_information' => 'nullable|string',
            'jurisdiction_id' => 'required|exists:jurisdictions,id',
        ];
    }
}
