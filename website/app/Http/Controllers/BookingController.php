<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Danh sách booking
    public function index() {
        return response()->json(Booking::with(['user','table'])->get(), 200);
    }

    // Chi tiết booking
    public function show($id) {
        $booking = Booking::with(['user','table'])->findOrFail($id);
        return response()->json($booking, 200);
    }

    // Tạo booking mới
    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'required|exists:tables,id',
            'booking_time' => 'required|date',
            'guest_count' => 'required|integer|min:1',
        ]);

        // Kiểm tra bàn có trống không
        $table = Table::find($validated['table_id']);
        if ($table->status !== 'available') {
            return response()->json(['error' => 'Bàn đã được đặt trước'], 400);
        }

        $booking = Booking::create($validated);
        $table->update(['status' => 'reserved']);

        return response()->json($booking, 201);
    }

    // Cập nhật booking
    public function update(Request $request, $id) {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return response()->json($booking, 200);
    }

    // Hủy booking
    public function destroy($id) {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        // Trả bàn về trạng thái available
        $booking->table->update(['status' => 'available']);

        return response()->json(['message' => 'Hủy đặt bàn thành công'], 200);
    }
}