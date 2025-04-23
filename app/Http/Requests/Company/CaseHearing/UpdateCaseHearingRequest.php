<?php

namespace App\Http\Requests\Company\CaseHearing;

use App\Models\CaseHearing;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateCaseHearingRequest extends FormRequest
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
            'nature_of_court_date' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $validated = $this->validated();

            $caseHearing = $this->route('caseHearing');
            $caseId = $caseHearing->case_management_id;

            $start = Carbon::parse($validated['hearing_date'] . ' ' . $validated['hearing_time']);
            $end = $start->copy()->addHour();

            $conflictingHearing = CaseHearing::where('case_management_id', $caseId)
                ->where('hearing_date', $validated['hearing_date'])
                ->where('id', '!=', $caseHearing->id)
                ->get()
                ->filter(function ($hearing) use ($start, $end) {
                    $hearingStart = Carbon::parse($hearing->hearing_date . ' ' . $hearing->hearing_time);
                    $hearingEnd = $hearingStart->copy()->addHour();

                    return $start < $hearingEnd && $end > $hearingStart;
                })
                ->first();

            if ($conflictingHearing) {
                $validator->errors()->add('hearing_time', 'There is already a hearing scheduled within 1 hour of the selected time for this case.');
            }
        });
    }

}
