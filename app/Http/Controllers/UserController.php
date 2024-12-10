<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['logout']);
    }

    public function logout(){
        if($user = Auth::user()) {
            $user->tokens()->delete();
        }
    }
}
