# UC-02: Tìm kiếm bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-02 |
| Tên chức năng     | Tìm kiếm bàn |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🔴 Cao |

---

## Mô tả

Cho phép khách hàng tìm kiếm bàn phù hợp dựa trên các tiêu chí như loại bàn, số lượng chỗ ngồi và thời gian đặt.

---

## Luồng chính

1. Người dùng truy cập trang tìm kiếm.
2. Nhập tiêu chí (loại bàn, số lượng, thời gian).
3. Hệ thống truy vấn database.
4. Hiển thị danh sách bàn phù hợp.

---

## Luồng thay thế

- Không có bàn phù hợp → hiển thị thông báo “Không tìm thấy bàn phù hợp”.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-02.1 | Cho phép tìm kiếm theo loại bàn |
| FR-02.2 | Cho phép lọc theo sức chứa |
| FR-02.3 | Kiểm tra khả dụng theo thời gian |
| FR-02.4 | Hiển thị danh sách kết quả |

---

> **Điều kiện tiên quyết:** Người dùng đã đăng nhập  
> **Điều kiện hậu:** Danh sách bàn phù hợp được hiển thị
