<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Xác Nhận Đặt Bàn - Luminous Epicure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
</head>

<body class="bg-gray-50">

    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-800 to-black relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=1000&fit=crop"
                alt="Restaurant" class="w-full h-full object-cover opacity-80">

            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col justify-end p-8">
                <h2 class="text-4xl font-bold text-white mb-4">Nghệ thuật ẩm thực trong từng chi tiết.</h2>
                <p class="text-lg text-gray-200">Chào mừng bạn đến với trải nghiệm số đẳng cấp dành cho giới mộ điệu.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <button onclick="window.history.back()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-900">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="mb-8">
                    <p class="text-sm font-bold text-gray-500 tracking-widest mb-2">BƯỚC CUỐI CÙNG</p>
                    <h1 class="text-4xl font-bold text-gray-900">Xác nhận thông tin đặt bàn</h1>
                    <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                        Vui lòng kiểm tra kỹ các thông tin bên dưới trước khi hoàn tất yêu cầu của bạn.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 mb-8 border border-gray-100 shadow-sm">
                    <div class="mb-6">
                        <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">TÊN KHÁCH HÀNG</p>
                        <p class="text-lg font-bold text-gray-900">{{ Auth::user()->name ?? $booking->phone ?? 'Khách Hàng' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">NGÀY & GIỜ</p>
                            <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->time)->format('d \T\h\á\n\g m, Y') }}</p>
                            <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">SỐ LƯỢNG KHÁCH</p>
                            <p class="text-sm font-bold text-gray-900">{{ $booking->guest_count }} Người <i class="fas fa-users text-gray-400 ml-2"></i></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">VỊ TRÍ BÀN</p>
                        <p class="text-sm font-bold text-gray-900">{{ $booking->table->name ?? 'Bàn T04' }} - {{ $booking->table->location ?? 'View cửa sổ' }}</p>
                    </div>

                    @if($booking->special_requests)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">YÊU CẦU ĐẶC BIỆT</p>
                        <p class="text-sm text-gray-600 italic">{{ $booking->special_requests }}</p>
                    </div>
                    @endif
                </div>

                <div class="space-y-3">
                    <button onclick="openPaymentModal()" class="w-full bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-bold py-4 rounded-xl transition duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        Xác nhận đặt bàn
                    </button>

                    <button onclick="window.history.back()" class="w-full text-center text-violet-600 hover:text-violet-700 font-semibold py-2 text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>
                        Chỉnh sửa thông tin
                    </button>
                </div>

                <p class="text-xs text-gray-500 text-center mt-6">
                    Bằng việc nhấn xác nhận, bạn đồng ý với <a href="#" class="text-violet-600 hover:underline">điều khoản dịch vụ</a> và <br>
                    chính sách hủy bỏ bàn của Lumina.
                </p>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" data-booking-id="{{ $booking->id }}" data-total-price="{{ $booking->total_price ?? 0 }}" data-transfer-content="LUMINOUS-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-gradient-to-r from-violet-600 to-purple-600 text-white p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold opacity-90">THANH TOÁN QUA CHUYỂN KHOẢN</p>
                    <h2 class="text-2xl font-bold mt-1">Quét mã QR để thanh toán</h2>
                </div>
                <button onclick="closePaymentModal()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col items-center">
                        <div class="bg-white border-4 border-gray-200 p-6 rounded-xl mb-4">
                            <div id="qrCode"></div>
                        </div>
                        <p class="text-sm text-gray-600 text-center">
                            Quét mã QR bằng ứng dụng ngân hàng của bạn
                        </p>
                    </div>

                    <div>
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-university text-violet-600"></i>
                                Thông Tin Ngân Hàng
                            </h3>

                            <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-1">NGÂN HÀNG</p>
                                    <p class="text-lg font-bold text-gray-900">Vietcombank (VCB)</p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-1">CHỦ TÀI KHOẢN</p>
                                    <p class="text-lg font-bold text-gray-900">LUMINOUS EPICURE JSC</p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-1">SỐ TÀI KHOẢN</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-bold text-gray-900 font-mono">1012345678</p>
                                        <button onclick="copyToClipboard('1012345678')" class="text-violet-600 hover:text-violet-700">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-1">CHI NHÁNH</p>
                                    <p class="text-lg font-bold text-gray-900">Hồ Chí Minh</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-pen-fancy text-violet-600"></i>
                                Nội Dung Chuyển Khoản
                            </h3>

                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 mb-4">
                                <p class="text-xs text-blue-600 font-semibold mb-2">COPY NỘI DUNG</p>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <p id="transferContent" class="font-mono text-sm text-gray-900 break-all">
                                            LUMINOUS-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                    <button onclick="copyTransferContent()" class="flex-shrink-0 bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500">
                                ⚠️ Hãy chắc chắn rằng bạn sao chép đúng nội dung chuyển khoản. Nó sẽ giúp chúng tôi xác nhận thanh toán của bạn một cách nhanh chóng.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <div class="bg-gradient-to-r from-violet-50 to-purple-50 rounded-xl p-6 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-1">TỔNG TIỀN CẦN THANH TOÁN</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($booking->total_price ?? 0, 0, ',', '.') }}đ</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600 font-semibold mb-1">CỌCĐÃ THANH TOÁN</p>
                            <p class="text-2xl font-bold text-green-600">{{ number_format(($booking->total_price ?? 0) * 0.2, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 space-y-3">
                    <button onclick="confirmPayment()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition duration-200">
                        <i class="fas fa-check-circle mr-2"></i>
                        Tôi Đã Chuyển Khoản
                    </button>

                    <button onclick="closePaymentModal()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-3 rounded-xl transition duration-200">
                        Hủy
                    </button>
                </div>

                <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <p class="text-xs text-yellow-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Lưu ý:</strong> Thanh toán có thể mất từ 1-5 phút để được xử lý. Hệ thống sẽ tự động chuyển bạn đến trang chi tiết đặt bàn khi thanh toán được xác nhận.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const paymentModal = document.getElementById('paymentModal');
        const bookingId = parseInt(paymentModal.getAttribute('data-booking-id'));
        const transferContent = paymentModal.getAttribute('data-transfer-content');
        const totalPrice = parseInt(paymentModal.getAttribute('data-total-price'));

        document.addEventListener('DOMContentLoaded', function() {
            generateQRCode();
        });

        function generateQRCode() {
            const qrContainer = document.getElementById('qrCode');
            qrContainer.innerHTML = '';

            const qrData = `00020126360014com.vietqr.pay0710414060618520208LUMIMOUS${transferContent}5802VN62110819Luminous Epicure63041D6F`;

            QRCode.toCanvas(document.getElementById('qrCode'), transferContent, {
                errorCorrectionLevel: 'H',
                type: 'image/png',
                width: 250,
                margin: 2,
                color: {
                    dark: '#000000',
                    light: '#FFFFFF'
                }
            }, function(error) {
                if (error) {
                    console.error('QR Code generation failed:', error);
                    document.getElementById('qrCode').innerHTML = '<div class="text-center text-gray-500">QR Code không thể tạo</div>';
                }
            });
        }

        function openPaymentModal() {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Đã sao chép số tài khoản!');
            }).catch(err => {
                console.error('Lỗi sao chép:', err);
            });
        }

        function copyTransferContent() {
            navigator.clipboard.writeText(transferContent).then(() => {
                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(err => {
                console.error('Lỗi sao chép:', err);
            });
        }

        function confirmPayment() {
            const btn = event.target;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xác nhận...';

            setTimeout(() => {
                fetch(`/customer/booking/confirm-payment/${bookingId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            payment_status: 'paid'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = `/customer/booking/detail/${bookingId}`;
                        } else {
                            alert('Có lỗi xảy ra: ' + data.message);
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Tôi Đã Chuyển Khoản';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xác nhận thanh toán');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Tôi Đã Chuyển Khoản';
                    });
            }, 1000);
        }
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePaymentModal();
            }
        });
    </script>
</body>

</html>