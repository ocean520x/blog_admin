<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\CheckCodeRule;
use App\Rules\IsFreezeRule;
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
            'phone' => ['required', new PhoneRule(), Rule::exists('users'), new IsFreezeRule()],
            'captcha_code' => 'sometimes|required|captcha_api:' . request('captcha_key') . ',math'
        ], [
            'captcha_code.captcha_api' => '验证码输入错误'
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
            'email' => ['email', Rule::unique('users')],
            'password' => ['required', 'confirmed', 'min:6'],
            'code' => ['required', new CheckCodeRule()]
        ])->validate();
        $user->fill($request->input());
        $user->name = 'Blog_' . Str::lower(Str::random(4));
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->success('注册成功', ['user' => new UserResource($user->refresh()), 'token' => $user->createToken('auth')->plainTextToken]);
    }

    public function rePassword(Request $request)
    {
        Validator::make($request->input(), [
            'phone' => ['required', new PhoneRule(), Rule::exists('users')],
            'password' => ['required', 'max:255', 'confirmed'],
            'code' => ['required', new CheckCodeRule()]
        ])->validate();
        $user = User::wherePhone($request->phone)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->success('重置密码成功', [
            'user' => new UserResource($user->refresh())
        ]);
    }
}
