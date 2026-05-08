<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use  App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Log;

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

        $validated = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'guest_count' => 'required|integer|min:1',
        ]);

        $exists = Booking::where('table_id', $table->id)
            ->where('date', $request->booking_date)
            ->where('time', $request->booking_time)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Khung giờ đã được đặt');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'table_id' => $table->id,
            
            'date' => $request->booking_date,
            'time' => $request->booking_time,

            'guest_count' => $request->guest_count,
            'email' => $request->email ?? Auth::user()->email,
            'phone' => $request->phone ?? Auth::user()->phone,
            'special_requests' => $request->special_requests,
            'total_price' => $table->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'bank_transfer',
        ]);

        return redirect()->route('customer.booking.confirm', $booking->id);
    }

    // Hiển thị trang xác nhận booking
    public function confirm($id)//done
    {
        $booking = Booking::with('table')->findOrFail($id);

        // Kiểm tra xem booking này có thuộc về user hiện tại không
        if ($booking->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized');
        }

        $paymentController = new PaymentController();
        $vietQrUrl = $paymentController->generateVietQr($booking);

        return view('customer.confirmBooking', compact('booking', 'vietQrUrl'));
    }


    // Cập nhật trạng thái thanh toán
    public function confirmPayment($id)//done
    {
        $booking = Booking::with(['user', 'table'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($booking->payment_status === 'paid') {
            return response()->json(['success' => true]);
        }

        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);

        $booking->load('user');

        try {
            Mail::to($booking->user->email)
                ->queue(new PaymentSuccessMail($booking));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(['success' => true]);
    }



    
    public function checkStatus($id)
    {
        $booking = Booking::findOrFail($id);

        return response()->json([
            'paid' => $booking->payment_status === 'paid'
        ]);
    }

    public function history()//done
    {
        $user = Auth::user();
        $bookings = Booking::with('table')
            ->where('user_id', $user->id)
            ->orderByDesc('date')->orderBy('date', 'desc')->get();

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
                'error' => 'Không được chọn ngày trong quá khứ',
                'bookingTimes' => []
            ]);
        }

        $query = Table::query();

        $query->where('status', 'available');

        $query->where('capacity', '>=', $request->guest_count);

        if ($request->location) {
            $query->where('location', $request->location);
        }
        $bookedTimes = [];

        if ($request->date) {
            $bookedTimes = Booking::where('date', $request->date)
                ->pluck('time')
                ->map(function ($time) {
                    return \Carbon\Carbon::parse($time)->format('H:i');
                })
                ->toArray();
        }
        $tables = $query->get();

        return view('customer.listTable',[
            'tables' => $tables,
            'noResult' => $tables->isEmpty(),
            'error' => $tables->isEmpty() ? 'Không tìm thấy bàn phù hợp với yêu cầu của bạn' : null,
            'bookingTimes' => $bookedTimes
        ]);
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking đã bị hủy rồi');
        }

        $bookingDateTime = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            \Carbon\Carbon::parse($booking->date)
                ->format('Y-m-d')
            . ' ' .
            \Carbon\Carbon::parse($booking->time)
                ->format('H:i:s')
        );

        if ($bookingDateTime->isPast()) {
            return back()->with('error', 'Không thể hủy booking đã diễn ra');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        $booking->table->update([
            'status' => 'available'
        ]);

        return back()->with('success', 'Hủy booking thành công');
    }

    public function getBookedTimes(Request $request)
    {
        if (
            !$request->table_id ||
            !$request->date
        ) {
            return response()->json([]);
        }

        $times = Booking::where(
                'table_id',
                $request->table_id
            )
            ->where(
                'date',
                $request->date
            )

            ->where('status', '!=', 'cancelled')

            ->pluck('time')
            ->map(fn($t) =>
                Carbon::parse($t)
                    ->format('H:i')
            )
            ->toArray();

        return response()->json($times);
    }

        public function paymentStatus($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'payment_status' => $booking->payment_status,
            'status' => $booking->status
        ]);
    }
}
