# UC-05: Xem lịch sử đặt bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-05 |
| Tên chức năng     | Xem lịch sử |
| Người dùng liên quan | Customer |

### 1. Mô tả tổng quan (Description)
Chức năng Xem lịch sử đặt bàn cho phép khách hàng (Customer) xem lại toàn bộ các đơn đặt bàn đã thực hiện trước đó.

Người dùng có thể theo dõi trạng thái đơn, xem chi tiết từng lần đặt bàn và quản lý lịch sử sử dụng dịch vụ. Chức năng này giúp nâng cao trải nghiệm người dùng và hỗ trợ kiểm tra thông tin khi cần thiết.
### 2. Luồng nghiệp vụ (User Workflow)
* Xem danh sách lịch sử đặt bàn

| Bước | Hành động người dùng        | Phản hồi hệ thống                       |
| :--- | :-------------------------- | :-------------------------------------- |
| 1    | Truy cập `/my-reservations` | Hiển thị danh sách đơn                  |
| 2    | Hệ thống tải dữ liệu        | Hiển thị các đơn đặt bàn của người dùng |
| 3    | Cuộn trang / phân trang     | Tải thêm dữ liệu                        |

* Xem chi tiết đơn đặt bàn

| Bước | Hành động người dùng                                 | Phản hồi hệ thống       |
| :--- | :--------------------------------------------------- | :---------------------- |
| 1    | Nhấn vào một đơn                                     | Hiển thị chi tiết       |
| 2    | Xem thông tin (thời gian, bàn, số người, trạng thái) | Hiển thị đầy đủ dữ liệu |

### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
* Không yêu cầu nhập liệu (chỉ hiển thị dữ liệu)
* Bộ lọc (tùy chọn):
    * Status: enum
    * Date: date

#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* Bảng `reservations`
    * id
    * user_id
    * table_id
    * reservation_time
    * number_of_guests
    * status
    * created_at
* Bảng `tables`
    * id
    * table_name

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Phân quyền:** Người dùng chỉ xem được đơn của chính mình
* **Xác thực**: Bắt buộc đăng nhập mới được truy cập
* **Bảo mật dữ liệu:** Không lộ thông tin người dùng khác

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Không có lịch sử đặt bàn.  
  * **Xử lý:** Hiển thị: "Bạn chưa có đơn đặt bàn nào".
* **Trường hợp:** Mất kết nối server:  
  * **Xử lý:** Hiển thị: "Không thể tải dữ liệu"

### 6. Giao diện (UI/UX)
* Hiển thị danh sách dạng:
    * Table view hoặc Card view
* Có bộ lọc theo trạng thái / thời gian
* Có nút "Xem chi tiết"
* Hiển thị loading khi tải dữ liệu



## Phần 2: Đặc tả chức năng (Functional Requirements)
- Là một khách hàng, tôi muốn xem lịch sử đặt bàn của mình để theo dõi các lần đặt trước đây.
- Là một khách hàng, tôi muốn xem chi tiết từng đơn đặt bàn để biết thông tin như thời gian, số lượng khách .
