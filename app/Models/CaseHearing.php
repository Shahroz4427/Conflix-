<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $case
 * @property mixed $hearing_date
 * @property mixed $hearing_time
 * @property mixed $id
 * @method static where(string $string, \Illuminate\Routing\Route|object|string|null $caseId)
 * @method static create(array $data)
 * @method static whereHas(string $string, \Closure $param)
 */
class CaseHearing extends Model
{
    use HasFactory;

    protected $fillable = [
        'court_id',
        'hearing_date',
        'hearing_time',
        'nature_of_court_date',
        'case_management_id'
    ];

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseManagement::class, 'case_management_id');
    }
}
