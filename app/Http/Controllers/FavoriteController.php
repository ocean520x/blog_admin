<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['anth:sanctum']);
    }
    public function toggle(Topic $topic)
    {
        $user = Auth::user();
        // $user->
    }
}
