# UC-08: Thống kê doanh thu

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-08 |
| Tên chức năng     | Thống kê doanh thu |
| Người dùng liên quan | Admin |
| Ưu tiên           | 🟡 Trung bình |

---

## Mô tả

Cho phép Admin xem báo cáo doanh thu.

---

## Luồng chính

1. Hệ thống lọc Orders completed.
2. Tính tổng doanh thu.
3. Hiển thị kết quả.

---

## Luồng thay thế

- Không có dữ liệu → hiển thị 0.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-08.1 | Lọc theo thời gian |
| FR-08.2 | Tính tổng doanh thu |
| FR-08.3 | Hiển thị báo cáo |

---

> **Điều kiện tiên quyết:** Admin đăng nhập  
> **Điều kiện hậu:** Báo cáo doanh thu được hiển thị
