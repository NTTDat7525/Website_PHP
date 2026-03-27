# UC-03: Đặt bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-03 |
| Tên chức năng     | Đặt bàn |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🔴 Cao |

---

## Mô tả

Cho phép khách hàng đặt bàn sau khi lựa chọn bàn phù hợp.

---

## Luồng chính

1. Người dùng chọn bàn từ danh sách.
2. Nhập thời gian đặt.
3. Hệ thống kiểm tra khả dụng.
4. Người dùng xác nhận.
5. Hệ thống lưu vào database (Orders).

---

## Luồng thay thế

- Bàn đã được đặt → hiển thị lỗi và yêu cầu chọn lại.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-03.1 | Cho phép chọn bàn |
| FR-03.2 | Kiểm tra trạng thái bàn |
| FR-03.3 | Lưu đơn vào bảng Orders |
| FR-03.4 | Trạng thái mặc định là pending |

---

> **Điều kiện tiên quyết:** Đã đăng nhập  
> **Điều kiện hậu:** Đơn đặt được tạo thành công
