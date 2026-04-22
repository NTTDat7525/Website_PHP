<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function vnpay_payment(){
    //     error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    //     date_default_timezone_set('Asia/Ho_Chi_Minh');
        
    //     $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //     $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
    //     $vnp_TmnCode = "RH70239L";//Mã website tại VNPAY 
    //     $vnp_HashSecret = "JEPSN3V5U9Z8QMHO5WRKWLKB1DJEHHFM"; //Chuỗi bí mật
        
    //     $vnp_TxnRef = '1000000000';
    //     $vnp_OrderInfo = 'Thanh toán hóa đơn';
    //     $vnp_OrderType = 'golden spoon';
    //     $vnp_Amount = 10000 * 100;
    //     $vnp_Locale = 'VN';
    //     $vnp_BankCode = 'NCB';
    //     $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    //     $inputData = array(
    //         "vnp_Version" => "2.1.0",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_Command" => "pay",
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_OrderType" => $vnp_OrderType,
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $vnp_TxnRef
    //     );
        
    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }
    //     if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    //     }
        
    //     //var_dump($inputData);
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }
        
    //     $vnp_Url = $vnp_Url . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //         $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    //         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    //     }
    //     $returnData = array('code' => '00'
    //         , 'message' => 'success'
    //         , 'data' => $vnp_Url);
    //         if (isset($_POST['redirect'])) {
    //             header('Location: ' . $vnp_Url);
    //             die();
    //         } else {
    //             echo json_encode($returnData);
    //         }
    //         // vui lòng tham khảo thêm tại code demo
    
    // }


    public function generateVietQr($booking)
    {
        $bankCode = "MB"; // Vietcombank
        $accountNo = "0394782424"; // STK của bạn
        $accountName = "Nguyễn Trịnh Tiến Đạt";

        $amount = $booking->total_price;
        $content = "BOOKING-" . str_pad($booking->id, 6, '0', STR_PAD_LEFT);

        // VietQR API
        return "https://img.vietqr.io/image/{$bankCode}-{$accountNo}-compact.png"
            . "?amount={$amount}"
            . "&addInfo={$content}"
            . "&accountName=" . urlencode($accountName);
    }
}