<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'jurisdiction_id',
        'company_id',
        'address',
        'additional_information',
    ];

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }

    public function caseManagements(): HasMany
    {
        return $this->hasMany(CaseManagement::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}