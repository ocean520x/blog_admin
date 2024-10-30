<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeControl;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('send/code', [CodeControl::class, 'send']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('upload/image', [AttachmentController::class, 'image']);
Route::get('favorite/toggle/{topic}', [FavoriteController::class, 'toggle']);
Route::apiResource('category', CategoryController::class);
Route::apiResource('topic', TopicController::class);
