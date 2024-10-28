<?php

namespace App\Http\Controllers;

use App\Rules\PhoneRule;
use App\Services\CodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeControl extends Controller
{
    function send(Request $request)
    {
        Validator::make($request->input(), [
            'phone' => ['required', new PhoneRule()]
        ])->validate();
        $code =  app(CodeService::class)->send($request->input('phone'), 'SMS_468225424');
        return $this->success('发送成功', ['code' => $code]);
    }
}
