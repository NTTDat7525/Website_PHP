<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Danh sách booking
    public function index(Request $request)
    {
        $date = $request->booking_date;
        $time = $request->booking_time;

        $tables = \App\Models\Table::all(); // sau này filter

        return view('customer.booking-list', compact('tables', 'date', 'time'));
    }

    //hiển thị form đặt bàn
    public function create($id) {
        $table = Table::findOrFail($id);
        if($table->status !== 'available') {
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
            'booking_time' => $request->booking_time,
            'status' => 'reserved',
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
}