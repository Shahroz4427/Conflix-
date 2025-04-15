<?php

namespace App\Http\Requests\Company\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'email' => 'nullable|email|max:255|unique:clients,email',
            'phone_number' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:0',
            'address' => 'nullable|string|max:500',
            'additional_information' => 'nullable|string|max:1000',
        ];
    }
}
