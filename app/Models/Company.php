<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static latest()
 * @method static create(mixed $validated)
 * @method static count()
 * @method static where(string $string, string $string1)
 * @method static sum(string $string)
 * @method static find($id)
 * @property mixed $id
 * @property mixed $user
 * @property mixed|string $status
 * @property mixed $subscriptionPlan
 * @property mixed $clients
 * @property mixed $lawyers
 * @property mixed $caseManagements
 * @property mixed $conflictLogs
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

    public function subscriptionPlan(): BelongsTo
    {
        return $this->belongsTo(CompanySubscriptionPlan::class, 'company_subscription_plans_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function lawyers(): HasMany
    {
        return $this->hasMany(Lawyer::class);
    }

    public function caseManagements(): HasMany
    {
        return $this->hasMany(CaseManagement::class);
    }

    public function conflictLogs(): HasMany
    {
        return $this->hasMany(ConflictLog::class);
    }
}
