<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConflictLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'recipient_name',
        'recipient_case_number',
        'conflict_case_number_1',
        'conflict_case_number_2',
        'conflict_date_time',
        'record_generated_at',
        'scheduled_send_date',
        'status',
        'case_hearing_id_1',
        'case_hearing_id_2'
    ];


   
}
