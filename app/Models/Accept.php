<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accept extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'lead_created_at',
        'first_out',
        'talk_id',
        'time',
        'responsible_user_id',
    ];
}
