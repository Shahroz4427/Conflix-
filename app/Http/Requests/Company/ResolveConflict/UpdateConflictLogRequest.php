<?php

namespace App\Http\Requests\Company\ResolveConflict;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConflictLogRequest extends FormRequest
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
            'hearing_date' => 'required|date',
            'hearing_time' => 'required',
            'nature_of_court_date' => 'required|string',
            'court_id' => 'required|exists:courts,id',
        ];
    }
}
