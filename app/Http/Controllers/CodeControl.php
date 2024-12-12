<?php

namespace App\Http\Controllers;

use App\Rules\PhoneRule;
use App\Services\CodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CodeControl extends Controller
{
    function send(Request $request)
    {
        Validator::make($request->input(), [
            'phone' => ['required', new PhoneRule(), Rule::unique('users')]
        ])->validate();
        $code =  app(CodeService::class)->send($request->input('phone'), 'SMS_468225424');
        return $this->success('验证码发送成功', ['code' => $code]);
    }
}
