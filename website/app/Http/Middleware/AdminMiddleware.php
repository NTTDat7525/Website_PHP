<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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

        if (!$user->isAdmin()) {
            return response()->json(['message' => 'Forbidden - Chỉ admin mới có quyền truy cập'], 403);
        }

        return $next($request);
    }
}
