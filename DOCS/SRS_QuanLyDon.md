# UC-07: Quản lý đơn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-07 |
| Tên chức năng     | Quản lý đơn |
| Người dùng liên quan | Admin |


### 1. Mô tả tổng quan (Description)
Chức năng Quản lý đơn đặt bàn cho phép Admin theo dõi, kiểm tra và cập nhật trạng thái của các đơn đặt bàn trong hệ thống.

Hệ thống hỗ trợ quản lý toàn bộ vòng đời của một đơn đặt bàn từ khi được tạo đến khi hoàn tất hoặc bị hủy. Điều này giúp nhà hàng kiểm soát tình trạng bàn, tối ưu vận hành và nâng cao chất lượng phục vụ khách hàng.

### 2. Luồng nghiệp vụ (User Workflow)
* Xem chi tiết đơn
| Bước | Hành động Admin                                      | Phản hồi hệ thống           |
| :--- | :--------------------------------------------------- | :-------------------------- |
| 1    | Nhấn vào đơn                                         | Hiển thị thông tin chi tiết |
| 2    | Xem thông tin (khách hàng, thời gian, số người, bàn) | Hiển thị đầy đủ dữ liệu     |

* Cập nhật trạng thái đơn
| Bước | Hành động Admin                                       | Phản hồi hệ thống                        |
| :--- | :---------------------------------------------------- | :--------------------------------------- |
| 1    | Chọn trạng thái mới (Confirm / Completed / Cancelled) | Validate trạng thái hợp lệ               |
| 2    | Nhấn "Update"                                         | Gửi request cập nhật                     |
| 3    | Thành công                                            | Lưu trạng thái mới và hiển thị thông báo |


### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
* **Reservation ID**: int, bắt buộc
* **Status**: enum
* Pending Chờ xác nhận
* Confirmed Đã xác nhận
* Completed Đã hoàn thành
* Cancelled Đã hủy

#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* id: primary key
* table_id: liên kết bàn
* reservation_time: datetime
* number_of_guests: int
* status: enum
* note: string (tùy chọn)
* created_at: timestamp
* updated_at: timestamp

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Phân quyền:** Chỉ Admin mới được truy cập chức năng này
* **Xác thực:** Bắt buộc đăng nhập trước khi truy cập.
* **Data Integrity:** Không cho phép cập nhật trạng thái không hợp lệ (ví dụ: Completed → Pending).
* **Logging:** Lưu log thay đổi trạng thái (Admin ID, thời gian, trạng thái cũ → mới).

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Đơn không tồn tại.  
  * **Xử lý:** Hiển thị: "Đơn đặt bàn không tồn tại".
* **Trường hợp:** Trạng thái không hợp lệ.  
  * **Xử lý:** Hiển thị: "Không thể cập nhật trạng thái này".
* **Trường hợp:** Mất kết nối server  
  * **Xử lý:** Hiển thị: "Không thể kết nối đến hệ thống".

### 6. Giao diện (UI/UX)
* Popup xác nhận khi thay đổi trạng thái
* Hiển thị thông báo (toast) khi cập nhật thành công/thất bại