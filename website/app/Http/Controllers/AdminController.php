<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Table;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Quản lý người dùng - Danh sách người dùng
    public function listUsers()
    {
        $users = User::where('role', 'customer')->get();

        return response()->json([
            'message' => 'Lấy danh sách người dùng thành công',
            'data' => $users
        ], 200);
    }

    // Xem chi tiết người dùng
    public function showUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        return response()->json([
            'message' => 'Lấy thông tin người dùng thành công',
            'data' => $user
        ], 200);
    }

    // Quản lý bàn - Thêm bàn
    public function addTable(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'status' => 'nullable|in:available,reserved'
        ]);

        $table = Table::create([
            'type' => $validated['type'],
            'capacity' => $validated['capacity'],
            'status' => $validated['status'] ?? 'available'
        ]);

        return response()->json([
            'message' => 'Thêm bàn thành công',
            'data' => $table
        ], 201);
    }

    // Cập nhật thông tin bàn
    public function updateTable(Request $request, $id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Bàn không tồn tại'], 404);
        }

        $validated = $request->validate([
            'type' => 'nullable|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'nullable|in:available,reserved'
        ]);

        $table->update($validated);

        return response()->json([
            'message' => 'Cập nhật bàn thành công',
            'data' => $table
        ], 200);
    }

    // Xóa bàn
    public function deleteTable($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Bàn không tồn tại'], 404);
        }

        $table->delete();

        return response()->json(['message' => 'Xóa bàn thành công'], 200);
    }

    // Quản lý đơn - Danh sách đơn
    public function listOrders(Request $request)
    {
        $status = $request->input('status');

        $query = Order::with(['user', 'table']);

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->get();

        return response()->json([
            'message' => 'Lấy danh sách đơn thành công',
            'data' => $orders
        ], 200);
    }

    // Xem chi tiết đơn
    public function showOrder($id)
    {
        $order = Order::with(['user', 'table'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn không tồn tại'], 404);
        }

        return response()->json([
            'message' => 'Lấy thông tin đơn thành công',
            'data' => $order
        ], 200);
    }

    // Cập nhật trạng thái đơn
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn không tồn tại'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed'
        ]);

        $order->update($validated);

        return response()->json([
            'message' => 'Cập nhật trạng thái đơn thành công',
            'data' => $order
        ], 200);
    }

    // Thống kê doanh thu (Xem doanh thu)
    public function viewRevenue(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Order::where('status', 'completed');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $totalRevenue = $query->sum('total_price');
        $orders = $query->with(['user', 'table'])->get();
        $totalOrders = count($orders);

        return response()->json([
            'message' => 'Lấy thông tin doanh thu thành công',
            'data' => [
                'total_revenue' => $totalRevenue,
                'total_orders' => $totalOrders,
                'orders' => $orders
            ]
        ], 200);
    }
}
