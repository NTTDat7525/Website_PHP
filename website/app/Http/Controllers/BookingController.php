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

    //hiển thị form đặt bàn
    public function create($id)
    {
        $table = Table::findOrFail($id);
        if ($table->status !== 'available') {
            return response()->json(['error' => 'Bàn đã được đặt trước'], 400);
        }
        return view('customer.booking', compact('table'));
    }

    public function store(Request $request, $id)
    {
        $table = Table::findOrFail($id);

        if ($table->status !== 'available') {
            return redirect()->back()->with('error', 'Bàn đã được đặt');
        }

        // tạo booking
        Booking::create([
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

        return redirect()->route('customer.dashboard')
            ->with('success', 'Đặt bàn thành công');
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('table')->get();
        return view('customer.history', compact('bookings'));
    }

    // Hiển thị chi tiết booking
    public function show($id)
    {
        $booking = Booking::with('table')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.detailBooking', compact('booking'));
    }
}
