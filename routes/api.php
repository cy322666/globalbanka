<?php

use App\Http\Controllers\CommandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('incoming', [CommandController::class, 'incoming']);

Route::get('outgoing', [CommandController::class, 'outgoing']);

Route::get('created', [CommandController::class, 'created']);

Route::get('accept', [CommandController::class, 'accept']);
