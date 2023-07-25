<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsible_user_id',
        'message_id',
        'talk_id',
        'contact_id',
        'text',
        'element_type',
        'element_id',
        'entity_id',
        'type',
        'origin',
        'msg_at',
        'msg_time_at',
        'msg_date_at',
    ];
}
