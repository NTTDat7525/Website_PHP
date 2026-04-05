# UC-08: Thống kê doanh thu

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-08 |
| Tên chức năng     | Thống kê doanh thu |
| Người dùng liên quan | Admin |

### 1. Mô tả tổng quan (Description)
Chức năng Thống kê doanh thu cho phép Admin theo dõi và phân tích doanh thu của nhà hàng dựa trên các đơn đặt bàn đã hoàn thành.

Hệ thống cung cấp các báo cáo theo thời gian (ngày, tháng, năm), giúp nhà quản lý đánh giá hiệu quả kinh doanh, đưa ra quyết định phù hợp và tối ưu hoạt động vận hành.

### 2. Luồng nghiệp vụ (User Workflow)
**Xem báo cáo doanh thu**

| Bước | Hành động Admin                            | Phản hồi hệ thống          |
| :--- | :----------------------------------------- | :------------------------- |
| 1    | Truy cập `/admin/revenue`                  | Hiển thị giao diện báo cáo |
| 2    | Chọn khoảng thời gian (từ ngày → đến ngày) | Validate dữ liệu           |
| 3    | Nhấn "Thống kê"                            | Hệ thống xử lý dữ liệu     |
| 4    | Hiển thị kết quả                           | Tổng doanh thu + biểu đồ   |

**Lọc và phân tích dữ liệu**

| Bước | Hành động Admin                 | Phản hồi hệ thống  |
| :--- | :------------------------------ | :----------------- |
| 1    | Chọn bộ lọc (ngày/tháng/năm)    | Cập nhật dữ liệu   |
| 2    | Chọn trạng thái đơn (Completed) | Lọc dữ liệu        |
| 3    | Xem biểu đồ                     | Hiển thị trực quan |


### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
* **Start Date**: date, bắt buộc
* **End Date**: date, bắt buộc
* **Filter Type**: enum
* Day
* Month
* Year
#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* Bảng `reservations`
* `id`
* `status`
* `reservation_time`
* `total_amount`
* Bảng `users`
* `id`
* `full_name`
### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Phân quyền:** Chỉ Admin được truy cập
* **Xác thực**: Bắt buộc đăng nhập
* **Xử lý dữ liệu lớn**: Phân trang khi hiển thị chi tiết

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Khoảng thời gian không hợp lệ (End < Start).  
  * **Xử lý:** Hiển thị: "Khoảng thời gian không hợp lệ".
* **Trường hợp:** Không có dữ liệu:
  * **Xử lý:** Hiển thị: "Không có dữ liệu trong khoảng thời gian này".
* **Trường hợp:** Dữ liệu lớn gây chậm.  
  * **Xử lý:** Hiển thị loading + thông báo đang xử lý

### 6. Giao diện (UI/UX)
* **Hiển thị**:
* Tổng doanh thu
* Số lượng đơn hoàn thành
* Có loading khi xử lý dữ liệu

