<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('send/code', [CodeControl::class, 'send']);

Route::post('auth/login', [AuthController::class, 'login']);
