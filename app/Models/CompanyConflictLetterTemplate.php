<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $array)
 * @property mixed $upload_template
 */
class CompanyConflictLetterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'upload_template',
        'uploaded_date',
        'uploaded_by',
    ];


    protected $casts = [
        'uploaded_date' => 'date',
    ];
}
