<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'age',
        'address',
        'additional_information',
        'company_id'
    ];

    public function caseManagements(): HasMany
    {
        return $this->hasMany(CaseManagement::class);
    }

    public function company()
   {
    return $this->belongsTo(Company::class);
    }


}