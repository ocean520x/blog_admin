<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Validator::make($request->input(), [
            'phone' => ['required', new PhoneRule(), Rule::exists('users')]
        ])->validate();

        $user = User::where('phone', $request->input('phone'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            return $this->success('登录成功', [
                'token' => $user->createToken('api_token')->plainTextToken
            ]);
        }
        throw ValidationException::withMessages([
            'password' => '密码错误'
        ]);
    }
}
