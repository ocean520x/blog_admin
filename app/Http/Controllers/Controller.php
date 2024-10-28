<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller extends BaseController
{
    protected function success($message = '', $data = [], $code = 0)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'success' => true
        ]);
    }
}
