<?php

namespace App\Http\Requests\Admin\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email|regex:/^[\w\.-]+@[\w\.-]+\.(com)$/i',
            'password' => 'required|string|min:6',
            'status' => 'required|in:active,inactive',
            'company_subscription_plans_id' => 'required|exists:company_subscription_plans,id',
        ];
    }
}
