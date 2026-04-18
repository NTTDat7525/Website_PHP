<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Danh sách booking
    public function index()
    {

        $tables = Table::all(); // sau này filter

        return view('customer.listTable', compact('tables'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with('table', 'user')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function revenue()
    {
        $revenue = Booking::where('status', 'confirmed')->sum('total_price');
        return view('admin.revenue', compact('revenue'));
    }

    public function reports()
    {
        $bookings = Booking::with('table', 'user')->get();
        return view('admin.reports', compact('bookings'));
    }

    //hiển thị form đặt bàn
    public function create($id)//user
    {
        $table = Table::findOrFail($id);
        if ($table->status !== 'available') {
            return response()->json(['error' => 'Bàn đã được đặt trước'], 400);
        }
        return view('customer.booking', compact('table'));
    }

    public function store(Request $request, $id)//user
    {
        $table = Table::findOrFail($id);

        if ($table->status !== 'available') {
            return redirect()->back()->with('error', 'Bàn đã được đặt');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'table_id' => $table->id,
            'time' => $request->time,
            'guest_count' => $request->guest_count,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'special_requests' => $request->special_requests,
            'total_price' => $request->total_price ?? 0,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'cash',
        ]);

        // cập nhật trạng thái bàn
        $table->update([
            'status' => 'reserved'
        ]);

        return redirect()->route('customer.booking.confirm', $booking->id);
    }

    // Hiển thị trang xác nhận booking
    public function confirm($id)
    {
        $booking = Booking::with('table')->findOrFail($id);

        // Kiểm tra xem booking này có thuộc về user hiện tại không
        if ($booking->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized');
        }

        return view('customer.confirmBooking', compact('booking'));
    }

    // Cập nhật trạng thái thanh toán
    public function confirmPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Kiểm tra xem booking này có thuộc về user hiện tại không
        if ($booking->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Cập nhật trạng thái booking
        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);

        // Update table status to in_use
        $booking->table->update([
            'status' => 'occupied'
        ]);

        return response()->json(['success' => true, 'message' => 'Thanh toán thành công', 'booking_id' => $booking->id]);
    }

    public function history()//user
    {
        $bookings = Booking::where('user_id', Auth::id())->with('table')->get();
        return view('customer.history', compact('bookings'));
    }

    // Hiển thị chi tiết booking
    public function show($id)//user
    {
        $booking = Booking::with('table')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.detailBooking', compact('booking'));
    }
}
