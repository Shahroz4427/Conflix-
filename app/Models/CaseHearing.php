<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function court():BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function case()
    {
      return $this->belongsTo(CaseManagement::class, 'case_management_id');
    }
}
