<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Đặt bàn (Create order)
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'table_id' => 'required|integer|exists:tables,id',
            'time' => 'required|date_format:Y-m-d H:i:s',
            'total_price' => 'nullable|numeric|min:0'
        ]);

        // Check if table is available
        $table = Table::find($validated['table_id']);
        if ($table->status !== 'available') {
            return response()->json(['message' => 'Bàn không khả dụng'], 400);
        }

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'table_id' => $validated['table_id'],
            'time' => $validated['time'],
            'total_price' => $validated['total_price'] ?? 0,
            'status' => 'pending'
        ]);

        // Update table status
        $table->update(['status' => 'reserved']);

        return response()->json([
            'message' => 'Đặt bàn thành công',
            'data' => $order
        ], 201);
    }

    // Xem lịch sử đặt (Get user orders)
    public function getUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)
            ->with(['table', 'user'])
            ->get();

        return response()->json([
            'message' => 'Lấy danh sách đơn thành công',
            'data' => $orders
        ], 200);
    }

    // Hủy đơn đặt (Cancel order)
    public function cancel($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn không tồn tại'], 404);
        }

        if ($order->status === 'completed') {
            return response()->json(['message' => 'Không thể hủy đơn đã hoàn tất'], 400);
        }

        // Release the table
        $table = Table::find($order->table_id);
        if ($table && $table->status === 'reserved') {
            $table->update(['status' => 'available']);
        }

        $order->update(['status' => 'pending']);

        return response()->json([
            'message' => 'Hủy đơn thành công',
            'data' => $order
        ], 200);
    }
}
