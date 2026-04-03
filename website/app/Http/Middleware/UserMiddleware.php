<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->input('user_id');

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized - Vui lòng cung cấp user_id'], 401);
        }

        $user = \App\Models\User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        return $next($request);
    }
}
