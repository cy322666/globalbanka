<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'account_id',
        'name',
        'code',
        'subdomain',
        'client_id',
        'access_token',
        'refresh_token',
        'work',
        'timezone',
        'client_secret',
        'expires_in',
        'created_at',
        'redirect_uri',
        'endpoint',
        'expires_tariff',
    ];

    protected $guarded = [];
}
