# UC-07: Quản lý đơn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-07 |
| Tên chức năng     | Quản lý đơn |
| Người dùng liên quan | Admin |
| Ưu tiên           | 🔴 Cao |

---

## Mô tả

Cho phép Admin theo dõi và cập nhật trạng thái đơn đặt.

---

## Luồng chính

1. Admin xem danh sách đơn.
2. Chọn đơn cần xử lý.
3. Cập nhật trạng thái.

---

## Luồng thay thế

- Trạng thái không hợp lệ → báo lỗi.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-07.1 | Xem danh sách đơn |
| FR-07.2 | Cập nhật trạng thái |
| FR-07.3 | Hiển thị chi tiết |

---

> **Điều kiện tiên quyết:** Admin đăng nhập  
> **Điều kiện hậu:** Trạng thái đơn được cập nhật
