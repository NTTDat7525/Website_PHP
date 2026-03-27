# UC-01: Đăng ký / Đăng nhập

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-01 |
| Tên chức năng     | Đăng ký / Đăng nhập |
| Người dùng liên quan | Customer, Admin |
| Ưu tiên           | 🔴 Cao |

---

## Mô tả

- **Customer**: tạo tài khoản mới (mật khẩu được mã hóa bằng bcrypt), sau đó đăng nhập để sử dụng các tính năng cá nhân hóa (tìm kiếm bàn, đặt bàn, quản lý tài khoản, xem lịch sử).
- **Admin**: đăng nhập và chuyển qua giao diện riêng, sử dụng tài khoản được cấp sẵn, có phân quyền đặc biệt để quản lý hệ thống.

---

## Luồng chính

1. Người dùng mở ứng dụng → chọn "Đăng ký" hoặc "Đăng nhập".
2. Nhập thông tin:
   - Đăng ký: tên đăng nhập, email, mật khẩu, xác nhận mật khẩu (≥ 8 ký tự, gồm chữ và số).
   - Đăng nhập: tên đăng nhập, mật khẩu.
3. Hệ thống:
   - Với đăng ký: mã hóa mật khẩu bằng **bcrypt**, lưu vào CSDL.
   - Với đăng nhập: xác thực thông tin, tạo **JWT session** hợp lệ.
4. Đăng nhập thành công → chuyển về màn hình chính (Customer) hoặc dashboard quản trị (Admin).

---

## Luồng thay thế

- Sai mật khẩu → hiển thị thông báo lỗi, cho phép thử lại tối đa 5 lần.
- Quên mật khẩu → sử dụng email để tạo mật khẩu mới.

---

## Yêu cầu chức năng

| Mã     | Mô tả |
|--------|-------|
| FR-01.1 | Hệ thống cho phép đăng ký bằng tên đăng nhập và mật khẩu (bcrypt hash). |
| FR-01.2 | Mật khẩu phải có ít nhất 8 ký tự, gồm chữ và số. |
| FR-01.3 | Hệ thống hiển thị thông báo sau khi đăng ký thành công. |
| FR-01.4 | Hỗ trợ chức năng quên mật khẩu bằng email. |
| FR-01.5 | Admin đăng nhập qua giao diện riêng với phân quyền đặc biệt. |
| FR-01.6 | Tạo session bằng JWT để xác thực người dùng trong suốt quá trình sử dụng. |

---

> **Điều kiện tiên quyết:**kết nối internet ổn định, CSDL MySQL trong XAMPP đã khởi tạo.  
> **Điều kiện hậu:** Người dùng được xác thực, có session JWT hợp lệ, mật khẩu lưu trong CSDL dưới dạng **bcrypt hash**.
