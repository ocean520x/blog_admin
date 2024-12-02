<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\CheckCodeRule;
use App\Rules\PhoneRule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
                'user' => new UserResource($user),
                'token' => $user->createToken('api_token')->plainTextToken
            ]);
        }
        throw ValidationException::withMessages([
            'password' => '密码错误'
        ]);
    }

    public function register(Request $request, User $user)
    {
        Validator::make($request->input(), [
            'phone' => ['required', new PhoneRule(), Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', 'min:6'],
            'code' => ['required', new CheckCodeRule()]
        ])->validate();

        $user->fill($request->input());
        $user->name = 'Blog_' . Str::lower(Str::random(4));
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return $this->success('注册成功', ['user' => new UserResource($user->refresh()),'token' => $user->createToken('auth')->plainTextToken]);
    }
}
