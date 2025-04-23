<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurisdiction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function lawyers(): HasMany
    {
        return $this->hasMany(Lawyer::class);
    }
}
