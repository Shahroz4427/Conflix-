<?php

namespace App\Http\Requests\Admin\CompanyConflictLetterTemplate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyConflictLetterTemplateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'upload_template' => 'nullable|file|mimes:pdf,doc,docx',
            'uploaded_date' => 'required|date',
            'uploaded_by' => 'nullable|string|max:255',

        ];
    }
}
