<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check() || auth()->user()->role !== 'customer') {
            return response()->json([
                'message' => 'Trang này chỉ dành cho khách hàng'
            ], 403);
        }

        return $next($request);
    }
}
