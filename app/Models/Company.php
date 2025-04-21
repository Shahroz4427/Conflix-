<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_clients',
        'total_lawyers',
        'total_conflict_sent',
        'status',
        'company_subscription_plans_id',
        'user_id'
    ];

    public function subscriptionPlan() :BelongsTo
    {
     return $this->belongsTo(CompanySubscriptionPlan::class, 'company_subscription_plans_id');
    }

    public function user() :BelongsTo
    {
     return $this->belongsTo(User::class, 'user_id');
    }

    public function clients()
    {
     return $this->hasMany(Client::class);
    }

    public function lawyers()
    {
     return $this->hasMany(Lawyer::class);
    }

    public function caseManagements()
    {
        return $this->hasMany(CaseManagement::class);
    }

    public function conflictLogs()
    {
      return $this->hasMany(ConflictLog::class);
    }



}