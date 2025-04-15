<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    use HasFactory;

    protected $fillable=[
      'name'
    ];

    public function hearingInformation(): HasMany
    {
        return $this->hasMany(HearingInformation::class);
    }
}
