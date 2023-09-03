<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    //раз в 10
    public function incoming()
    {
        Artisan::call('messages:incoming');
    }

    //раз в 10
    public function outgoing()
    {
        Artisan::call('messages:outgoing');
    }

    //раз в 15
    public function created()
    {
        Artisan::call('leads:created_at');
    }

    //раз в 20
    public function accept()
    {
        Artisan::call('accept:run');
    }

    //раз в 10
    public function calls()
    {
        Artisan::call('messages:call-del');
    }
}
