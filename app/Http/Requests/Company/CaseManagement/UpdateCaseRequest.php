<?php

namespace App\Http\Requests\Company\CaseManagement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'client_email' => 'required|email',
            'client_address' => 'required|string',
            'lawyer_id' => 'required|exists:lawyers,id',
            'court_id' => 'required|exists:courts,id',
            'lawyer_email' => 'required|email',
            'incarcerated' => 'required|boolean',
            'case_number' => 'required|string|max:255',
            'date_of_arrest' => 'required|date',
            'date_of_indictment' => 'required|date',
            'judge' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'filling_date' => 'required|date',
            'calendar_clerk_name' => 'required|string|max:255',
            'calendar_clerk_email' => 'required|email|max:255',
            'opposing_counsel_name' => 'required|string|max:255',
            'opposing_counsel_email' => 'required|email|max:255',
            'clerk_of_court_name' => 'required|string|max:255',
            'clerk_of_court_email' => 'required|email|max:255',
            'court_date_expected_time_to_resolve' => 'required|date',
        ];
    }
}
