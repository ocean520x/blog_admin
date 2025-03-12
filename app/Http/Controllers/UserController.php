<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['logout', 'get_current_user', 'updateCurrentUser', 'getUsers']);
    }

    public function logout()
    {
        if ($user = Auth::user()) {
            $user->tokens()->delete();
        }
    }

    public function get_current_user()
    {
        return $this->success(data: new UserResource(Auth::user()));
    }

    public function show(User $user)
    {
        return $this->success(data: new UserResource($user));
    }

    public function updateCurrentUser(Request $request)
    {
        $user = Auth::user();
        $user->fill($request->input())->save();
        return $this->success('更新成功', new UserResource($user->refresh()));
    }

    public function getUsers()
    {
        return UserResource::collection(User::latest()->paginate(8));
    }
}
