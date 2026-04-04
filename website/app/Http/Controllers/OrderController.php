<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index() {
        return response()->json(Order::with('items.food')->get(), 200);
    }

    // Chi tiết đơn hàng
    public function show($id) {
        $order = Order::with('items.food')->findOrFail($id);
        return response()->json($order, 200);
    }

    // Tạo đơn hàng mới
    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'nullable|exists:tables,id',
            'booking_id' => 'nullable|exists:bookings,id',
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }

    // Xóa đơn hàng
    public function destroy($id) {
        Order::destroy($id);
        return response()->json(['message' => 'Xóa đơn hàng thành công'], 200);
    }

    // Thêm món ăn vào đơn hàng
    public function addItem(Request $request, $orderId) {
        $validated = $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $validated['order_id'] = $orderId;
        $item = OrderItem::create($validated);

        return response()->json(['message' => 'Thêm món ăn vào đơn hàng thành công', 'data' => $item], 201);
    }

    public function revenue(Request $request) {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Order::query()->where('status', 'paid');
        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate));
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate));
        }

        $totalRevenue = 0;
        $orders = $query->with('items')->get();
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $totalRevenue += $item->quantity * $item->price;
            }
        }

        return response()->json([
            'total_revenue' => $totalRevenue,
            'orders_count' => $orders->count(),
            'from' => $startDate,
            'to' => $endDate
        ], 200);
    }
}