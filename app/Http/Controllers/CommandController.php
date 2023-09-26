<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    //раз в 10
    //работает ок
    public function incoming()
    {
        Artisan::call('messages:incoming');
    }

    //раз в 10
    //работает ок
    public function outgoing()
    {
        Artisan::call('messages:outgoing');
    }

    //раз в 15
    //не работало, чекать
    public function created()
    {
        Artisan::call('leads:created_at');
    }

    //раз в 20
    //работает ок
    public function accept()
    {
        Artisan::call('accept:run');
    }

    //раз в 10
    //фиксил
    public function calls()
    {
        Artisan::call('messages:call-del');
    }

    //раз в 15
    //фиксил
    public function msg()
    {
        Artisan::call('messages:msg-del');
    }
}
