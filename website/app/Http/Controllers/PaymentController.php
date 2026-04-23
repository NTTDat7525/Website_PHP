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
}