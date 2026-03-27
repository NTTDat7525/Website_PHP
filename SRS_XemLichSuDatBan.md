# UC-05: Xem lịch sử đặt bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-05 |
| Tên chức năng     | Xem lịch sử |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🟡 Trung bình |

---

## Mô tả

Hiển thị danh sách các đơn đặt bàn của người dùng.

---

## Luồng chính

1. Người dùng vào trang lịch sử.
2. Hệ thống truy vấn Orders theo user_id.
3. Hiển thị danh sách đơn.

---

## Luồng thay thế

- Không có dữ liệu → hiển thị thông báo.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-05.1 | Hiển thị danh sách đơn |
| FR-05.2 | Sắp xếp theo thời gian |
| FR-05.3 | Hiển thị trạng thái |

---

> **Điều kiện tiên quyết:** Đăng nhập  
> **Điều kiện hậu:** Danh sách đơn được hiển thị
