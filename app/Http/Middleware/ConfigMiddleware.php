<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // $config = Config::firstOrNew();
        // if ($data = $config->toArray()) {
        //     config(['site' => $data['data']]);
        // } else {
        //     config(['site' => null]);
        // }
        // return $next($request);
    }
}
