<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt bàn thành công</title>
</head>
<body>
    <h2>Đặt bàn thành công</h2>
    <p>Xin chào {{ $booking->customer_name }},</p>
    <p>Cảm ơn bạn đã đặt bàn tại Golden Spoons. Chúng tôi rất vui được thông báo rằng đặt bàn của bạn đã được xác nhận.</p>
    <h3>Chi tiết đặt bàn:</h3>
    <table>
        <tr>
            <td><strong>Tên khách hàng:</strong></td>
            <td>{{ $booking->customer_name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $booking->customer_email }}</td>
        </tr>
        <tr>
            <td><strong>Số điện thoại:</strong></td>
            <td>{{ $booking->customer_phone }}</td>
        </tr>
        <tr>
            <td><strong>Ngày đặt:</strong></td>
            <td>{{ $booking->booking_date }}</td>
        </tr>
        <tr>
            <td><strong>Giờ đặt:</strong></td>
            <td>{{ $booking->booking_time }}</td>
        </tr>
        <tr>
            <td><strong>Số lượng người:</strong></td>
            <td>{{ $booking->number_of_people }}</td>
        </tr>
    </table>
    <p>Chúng tôi mong được phục vụ bạn tại Golden Spoons. Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ Golden Spoons</p>
</body>
</html>