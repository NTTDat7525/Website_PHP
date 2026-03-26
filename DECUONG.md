# WEBSITE ĐẶT BÀN NHÀ HÀNG ONLINE
## Thành viên nhóm 7
- Nguyễn Trịnh Tiến Đạt - 23810310148
- Bùi Minh Đức - 23810310110
- Đồng Việt Tiến - 23810310142

---

## 1. Công nghệ và bảo mật
- **Ngôn ngữ/Framework**: PHP
- **CSDL**: MySQL
- **Mã hóa mật khẩu**: sử dụng **bcrypt** để lưu trữ mật khẩu an toàn
- **Phân quyền**: Customer và Admin

---

## 2. Phân quyền người dùng

### Customer
- **Tìm kiếm bàn**: theo loại bàn, số lượng chỗ ngồi, thời gian.
- **Đặt bàn**: chọn bàn, nhập thông tin, xác nhận đặt.
- **Quản lý tài khoản**: cập nhật thông tin cá nhân, đổi mật khẩu.
- **Xem lịch sử đặt bàn**: danh sách các lần đặt trước đó.
- **Xem order hiện tại**: theo dõi trạng thái các đơn đặt bàn đang hoạt động.

### Admin
- **Kiểm tra doanh thu**: thống kê theo
- **Quản lý order**: xem chi tiết, cập nhật trạng thái (chờ xác nhận, đang phục vụ, hoàn tất).
- **Quản lý loại bàn**: thêm mới, chỉnh sửa, xóa các loại bàn (ví dụ: bàn 2 người, bàn 4 người, bàn VIP).

---

## 3. Luồng hoạt động chính

1. **Đăng ký/Đăng nhập**
   - Customer đăng ký tài khoản → mật khẩu được mã hóa bằng bcrypt.
   - Admin có tài khoản riêng, được cấp sẵn.

2. **Đặt bàn (Customer)**
   - Customer tìm kiếm bàn theo nhu cầu.
   - Chọn bàn và thời gian → hệ thống kiểm tra khả dụng.
   - Xác nhận đặt bàn → lưu vào CSDL.

3. **Quản lý order (Admin)**
   - Admin xem danh sách order.
   - Cập nhật trạng thái order (pending → confirmed → completed).

4. **Doanh thu (Admin)**
   - Hệ thống tổng hợp dữ liệu order đã hoàn tất.
   - Xuất báo cáo doanh thu.

---

## 4. Cấu trúc cơ sở dữ liệu (gợi ý)

- **Users**
  - id, name, email, password (bcrypt hash), role (customer/admin), phone.
- **Tables**
  - id, type, capacity, status
- **Orders**
  - id, user_id, table_id, time, status, total_price
- **Revenue**
  - tổng hợp từ Orders

---

## 5. Yêu cầu bổ sung
- Giao diện thân thiện, dễ sử dụng.
- Hệ thống phân quyền rõ ràng, tránh truy cập trái phép.
- Mật khẩu **không lưu dạng plain text**, chỉ lưu hash bcrypt.
