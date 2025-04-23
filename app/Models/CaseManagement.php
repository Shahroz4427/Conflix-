<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 * @property mixed $client
 */
class CaseManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'lawyer_id',
        'incarcerated',
        'case_number',
        'date_of_arrest',
        'date_of_indictment',
        'judge',
        'country',
        'filling_date',
        'calendar_clerk_name',
        'calendar_clerk_email',
        'opposing_counsel_name',
        'opposing_counsel_email',
        'clerk_of_court_name',
        'clerk_of_court_email',
        'court_date_expected_time_to_resolve',
        'company_id',
        'court_id'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function hearings()
    {
        return $this->hasMany(CaseHearing::class);
    }
}
