<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanySubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'plan',
        'charges',
        'purchase_date',
        'recurring_date',
        'is_active',
    ];

  

}
