<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CodeService
{
    public function send($phone, $templateCode)
    {
        $code = $this->code($phone);
        if (app()->environment('local')) return 'local-' . $code;
        app(AliYunService::class)->sms($phone, $templateCode, ['code' => $code]);
        return $code;
    }

    protected function code($phone)
    {
        if (Cache::get($phone)) abort(403, '请稍后再试');
        Cache::put($phone, $code = mt_rand(100000, 999999), 30);
        return $code;
    }
}
