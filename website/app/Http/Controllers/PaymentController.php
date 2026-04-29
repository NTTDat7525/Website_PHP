<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Jobs\SendPaymentSuccessEmailJob;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function generateVietQr($booking)
    {
        $bankCode = "MB";
        $accountNo = "0394782424";
        $accountName = "Nguyễn Trịnh Tiến Đạt";

        $amount = $booking->total_price;
        $content = "BOOKING-" . str_pad($booking->id, 6, '0', STR_PAD_LEFT);

        // VietQR API
        return "https://img.vietqr.io/image/{$bankCode}-{$accountNo}-compact.png"
            . "?amount={$amount}"
            . "&addInfo={$content}"
            . "&accountName=" . urlencode($accountName);
    }

    public function success($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // update trạng thái thanh toán
        $booking->payment_status = 'paid';
        $booking->status = 'confirmed';
        $booking->save();

        // GỬI MAIL SAU KHI THANH TOÁN THÀNH CÔNG
        SendPaymentSuccessEmailJob::dispatch($booking);

        return response()->json([
            'message' => 'Thanh toán thành công'
        ]);
    }

    public function webhook(Request $request)
    {
        Log::info('SePay webhook:', $request->all());

        // 🔒 Verify API KEY
        if ($request->header('Authorization') !== env('SEPAY_API_KEY')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $content = $request->content;
        $amount = $request->amount;

        // 🔍 Lấy ORDER_ID
        preg_match('/ORDER_(\d+)/', $content, $matches);

        if (!isset($matches[1])) {
            return response()->json(['message' => 'No order id']);
        }

        $bookingId = $matches[1];
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Not found']);
        }

        // tránh xử lý lại
        if ($booking->payment_status === 'paid') {
            return response()->json(['message' => 'Already paid']);
        }

        // 💰 check tiền
        if ($amount >= $booking->total_price) {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed'
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}