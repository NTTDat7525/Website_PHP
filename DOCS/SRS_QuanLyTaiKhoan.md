# UC-04: Quản lý tài khoản

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-04 |
| Tên chức năng     | Quản lý tài khoản |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🟡 Trung bình |

---

## Mô tả

Cho phép người dùng cập nhật thông tin cá nhân và thay đổi mật khẩu.

---

## Luồng chính

1. Người dùng vào trang Profile.
2. Chỉnh sửa thông tin.
3. Nhấn lưu.
4. Hệ thống cập nhật database.

---

## Luồng thay thế

- Dữ liệu không hợp lệ → hiển thị lỗi.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-04.1 | Cập nhật tên và số điện thoại |
| FR-04.2 | Đổi mật khẩu |
| FR-04.3 | Validate dữ liệu |

---

> **Điều kiện tiên quyết:** Đăng nhập  
> **Điều kiện hậu:** Thông tin được cập nhật
