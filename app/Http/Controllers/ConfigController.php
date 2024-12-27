<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;

class ConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('update');
    }

    public function update(UpdateConfigRequest $request, $fieldName)
    {
        $config = Config::firstOrNew();
        $config[$fieldName] = $request->input() + $config[$fieldName] ?: [];
        $config->save();
        return $this->success('系统配置修改成功', $config[$fieldName]);
    }

    public function getConfig($fieldName) {
        $config = Config::firstOrNew();
        return $this->success(data:$config[$fieldName]);
    }
}
