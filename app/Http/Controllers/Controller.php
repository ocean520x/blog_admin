<?php

namespace App\Http\Controllers;

abstract class Controller
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
