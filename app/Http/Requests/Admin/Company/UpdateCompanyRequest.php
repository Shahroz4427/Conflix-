<?php

namespace App\Http\Requests\Admin\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
        $company = Company::find($this->route('company')->id);

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[\w\.-]+@[\w\.-]+\.(com)$/i',
                Rule::unique('users', 'email')
                    ->ignore($company->user->id),
            ],
            'password' => 'nullable|string|min:6',
            'status' => 'required|in:active,inactive',
            'company_subscription_plans_id' => 'required|exists:company_subscription_plans,id',
        ];
    }
}
