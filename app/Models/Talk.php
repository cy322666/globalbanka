<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    protected $fillable = [
        'out_id',
        'in_id',
        'out_at',
        'in_at',
        'time',
        'status',
        'talk_id',
        'responsible_user_id',
    ];
}
