<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Carbon\Carbon;

class BookingController extends Controller
{
    // Danh sách booking
    public function index()//done
    {

        $tables = Table::paginate(9);

        return view('customer.listTable', compact('tables'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with('user', 'table')
        ->latest()
        ->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function revenue()
    {
        $revenue = Booking::where('status', 'confirmed')->sum('total_price');
        return view('admin.revenue', compact('revenue'));
    }

    public function reports()
    {
        $bookings = Booking::with('user', 'table')
        ->latest()
        ->get();
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

        $exists = Booking::where('table_id', $table->id)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Khung giờ đã được đặt');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'table_id' => $table->id,
            'time' => $request->time,
            'guest_count' => $request->guest_count,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'special_requests' => $request->special_requests,
            'total_price' => $table->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'cash',
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

        public function history()
        {
            $user = Auth::user();

            $bookings = Booking::with('table')
                ->where('user_id', $user->id)
                ->orderByDesc('time')
                ->get();

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

    public function search(Request $request)//done
    {
        $request->validate([
            'date' => 'nullable|date',
            'time' => 'nullable',
            'guest_count' => 'nullable|integer',
        ]);

        if ($request->date && Carbon::parse($request->date)->lt(Carbon::today())) {
            return view('customer.listTable', [
                'tables' => collect(),
                'noResult' => true,
                'error' => 'Không được chọn ngày trong quá khứ'
            ]);
        }

        $query = Table::query();

        $query->where('status', 'available');

        $query->where('capacity', '>=', $request->guest_count);

        if ($request->location) {
            $query->where('location', $request->location);
        }

        $tables = $query->get();

        return view('customer.listTable',[
            'tables' => $tables,
            'noResult' => $tables->isEmpty(),
            'error' => $tables->isEmpty() ? 'Không tìm thấy bàn phù hợp với yêu cầu của bạn' : null
        ]);
    }
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // chỉ cho hủy booking chưa diễn ra
        if ($booking->status == 'cancelled') {
            return back()->with('error', 'Booking đã bị hủy rồi');
        }

        if ($booking->time < now()) {
            return back()->with('error', 'Không thể hủy booking đã diễn ra');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Hủy booking thành công');
    }
}
