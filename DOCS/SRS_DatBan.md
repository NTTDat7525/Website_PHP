# Chức năng: Đặt bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-03 |
| Tên chức năng     | Đặt bàn |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🔴 Cao |

---

## 1. Mô tả tổng quan (Description)  
- Cung cấp chức năng cho khách hàng đặt bàn tại nhà hàng sau khi lựa chọn bàn phù hợp.  
- Cho phép kiểm tra trạng thái bàn (còn trống/đã đặt) trước khi xác nhận.  
- Lưu thông tin đơn đặt bàn vào hệ thống (Orders) với trạng thái mặc định là **pending**.  

---

## 2. Luồng nghiệp vụ (User Workflow)  

| Bước | Hành động người dùng | Phản hồi hệ thống |  
|------|----------------------|-------------------|  
| 1 | Người dùng chọn bàn từ danh sách | Hiển thị thông tin bàn (số bàn, vị trí, trạng thái). |  
| 2 | Nhập thời gian đặt | Validate dữ liệu thời gian (không cho phép quá khứ). |  
| 3 | Hệ thống kiểm tra khả dụng | Nếu bàn trống → tiếp tục, nếu đã đặt → báo lỗi. |  
| 4 | Người dùng xác nhận | Gửi yêu cầu đặt bàn. |  
| 5 | Hệ thống xử lý | Lưu đơn đặt bàn vào bảng Orders với trạng thái pending. |  
| 6 | Thành công | Hiển thị thông báo xác nhận đặt bàn. |  
| 7 | Thất bại | Hiển thị lỗi cụ thể (bàn đã đặt, dữ liệu không hợp lệ…). |  

---

## 3. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)  
- **Database:** Lưu thông tin đặt bàn trong bảng Orders.  
- **Unique Constraint:** `(table_id + time_slot)` phải unique để tránh trùng đặt.  
- **Phân quyền:** Chỉ khách hàng đã đăng nhập mới được phép đặt bàn.  
- **Hiệu năng:** Kiểm tra trạng thái bàn nhanh, tránh tình trạng race condition khi nhiều người đặt cùng lúc.  

---

## 4. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)  
- **Bàn đã được đặt:** Hiển thị lỗi "Bàn đã được đặt, vui lòng chọn bàn khác".  
- **Thời gian không hợp lệ:** Không cho phép đặt bàn trong quá khứ.  
- **Người dùng chưa đăng nhập:** Chuyển hướng sang trang đăng nhập.  

---

## 5. Giao diện (UI/UX)  
- Hiển thị danh sách bàn dạng bảng: **Số bàn | Vị trí | Trạng thái | Hành động**.  
- Cho phép chọn bàn bằng nút "Đặt bàn".  
- Form nhập thời gian đặt với kiểm tra realtime (không cho phép nhập sai định dạng).  
- Hiển thị trạng thái bàn:  
  - Còn trống  
  - Đã đặt  
- UX:  
  - Nút xác nhận rõ ràng.  
  - Loading spinner khi kiểm tra khả dụng.  
  - Thông báo lỗi/ thành công hiển thị ngay lập tức.  

---

## Phần 1: Mô hình hóa quy trình (Business Flow)  
- Sơ đồ Use Case Customer: [Click here](/PICTURES/Active_Datban.png)  
- Sơ đồ Activity: [Click here](/PICTURES/UC_Datban.png)  

---

## Phần 2: Đặc tả chức năng (Functional Requirements)  
- Là một khách hàng, tôi muốn chọn bàn từ danh sách để đặt chỗ.  
- Là một khách hàng, tôi muốn nhập thời gian đặt bàn để đảm bảo có chỗ khi đến.  
- Là một khách hàng, tôi muốn hệ thống kiểm tra trạng thái bàn để tránh trùng đặt.  
- Là một khách hàng, tôi muốn nhận thông báo xác nhận ngay sau khi đặt thành công.  

---

**Constraint:** `(table_id + time_slot)` phải unique.  
```

