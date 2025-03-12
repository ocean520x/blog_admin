<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeControl;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('send/code', [CodeControl::class, 'send']);
Route::post('send/repassword_code', [CodeControl::class, 'rePasswordSend']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::put('auth/repassword', [AuthController::class, 'rePassword']);
Route::post('upload/image', [AttachmentController::class, 'image']);
Route::get('get_one_user_favorite_topics', [FavoriteController::class, 'getOneUserFavoriteTopics']);
Route::get('is_favorite/{user}/{topic}', [FavoriteController::class, 'is_favorite']);
Route::get('favorite/toggle/{topic}', [FavoriteController::class, 'toggle']);
Route::apiResource('category', CategoryController::class);
Route::post('category/change_sort', [CategoryController::class, 'changeSort']);
Route::get('per_category/{c_id}', [TopicController::class, 'perCategory']);
Route::get('get_one_user_topics', [TopicController::class, 'get_one_user_topics']);
Route::apiResource('topic', TopicController::class);
Route::get('list/comment/{topic}', [CommentController::class, 'index']);
Route::post('comment/{topic}', [CommentController::class, 'store']);
Route::post('reply/comment/{topic}/{comment}', [CommentController::class, 'replyComment']);
Route::delete('comment/{comment}', [CommentController::class, 'destroy']);
Route::get('get_one_user_comments', [CommentController::class, 'get_one_user_comments']);
Route::get('all_comments', [CommentController::class, 'allComments']);
Route::post('logout', [UserController::class, 'logout']);
Route::get('get_current_user', [UserController::class, 'get_current_user']);
Route::get('user/{user}', [UserController::class, 'show']);
Route::put('update_current_user', [UserController::class, 'updateCurrentUser']);
Route::get('get_users', [UserController::class, 'getUsers']);
Route::put('user_freeze/{user}', [UserController::class, 'freeze']);
Route::delete('user_del/{user}', [UserController::class, 'destroy']);
Route::put('config/{fieldName}', [ConfigController::class, 'update']);
Route::get('get_config/{fieldName}', [ConfigController::class, 'getConfig']);
