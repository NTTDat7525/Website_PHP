# Chức năng: Quản lý bàn (Table Management)

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-06 |
| Tên chức năng     | Quản lý bàn |
| Người dùng liên quan | Admin |
| Ưu tiên           | 🔴 Cao |

---

## 1. Mô tả tổng quan (Description)  
- Cung cấp chức năng cho Admin quản lý danh sách bàn trong nhà hàng.  
- Cho phép thêm mới, chỉnh sửa và xóa bàn.  
- Đảm bảo dữ liệu bàn được cập nhật chính xác trong hệ thống.  

---

## 2. Luồng nghiệp vụ (User Workflow)  

| Bước | Hành động người dùng | Phản hồi hệ thống |  
|------|----------------------|-------------------|  
| 1 | Admin truy cập trang quản lý bàn | Hiển thị danh sách bàn hiện có. |  
| 2 | Admin chọn thêm/sửa/xóa bàn | Hiển thị form nhập hoặc xác nhận hành động. |  
| 3 | Admin nhập dữ liệu và lưu | Validate dữ liệu (bắt buộc, định dạng, trùng lặp). |  
| 4 | Hệ thống xử lý | Cập nhật database. |  
| 5 | Thành công | Hiển thị thông báo cập nhật thành công. |  
| 6 | Thất bại | Hiển thị lỗi cụ thể (dữ liệu không hợp lệ…). |  

---

## 3. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)  
- **Database:** Lưu thông tin bàn trong bảng Tables.  
- **Unique Constraint:** `table_number` phải unique để tránh trùng số bàn.  
- **Phân quyền:** Chỉ Admin có quyền thêm, sửa, xóa bàn.  
- **Hiệu năng:** Cập nhật dữ liệu nhanh, đảm bảo đồng bộ với hệ thống đặt bàn.  

---

## 4. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)  
- **Dữ liệu không hợp lệ:** Hiển thị lỗi "Thông tin bàn không hợp lệ".  
- **Trùng số bàn:** Không cho phép lưu, hiển thị lỗi "Số bàn đã tồn tại".  
- **Admin chưa đăng nhập:** Chuyển hướng sang trang đăng nhập.  

---

## 5. Giao diện (UI/UX)  
- Hiển thị danh sách bàn dạng bảng: **Số bàn | Vị trí | Trạng thái | Hành động**.  
- Cho phép thêm bàn bằng nút "Thêm bàn".  
- Cho phép chỉnh sửa inline hoặc qua form popup.  
- Hiển thị trạng thái bàn:  
  - Còn trống  
  - Đã đặt  
- UX:  
  - Nút hành động rõ ràng (Thêm, Sửa, Xóa).  
  - Loading spinner khi cập nhật.  
  - Thông báo lỗi/thành công hiển thị ngay lập tức.  

---

## Phần 1: Mô hình hóa quy trình (Business Flow)  
- Sơ đồ Use Case Admin: [Click here](/PICTURES/UC_QLdatban.png)
- Sơ đồ Activity:
    - Chức năng thêm bàn[Click here](/PICTURES/Active_Themban.png)
    - Chức năng xóa bàn [Click here](/PICTURES/Active_Xoaban.png)
    - Chức năng thay đổi thông tin bàn [Click here](/PICTURES/Active_Thaydoithongtinban.png)

---

## Phần 2: Đặc tả chức năng (Functional Requirements)
- Là một Admin, tôi muốn thêm bàn mới để mở rộng số lượng bàn trong nhà hàng.  
- Là một Admin, tôi muốn chỉnh sửa thông tin bàn để đảm bảo dữ liệu chính xác.  
- Là một Admin, tôi muốn xóa bàn không còn sử dụng để giữ hệ thống gọn gàng.  

---

**Constraint:** `table_number` phải unique.
