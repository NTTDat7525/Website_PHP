# Chức năng: Quản lý đặt bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-09 |
| Tên chức năng     | Quản lý đặt bàn |
| Người dùng liên quan | Customer ||

---

### 1. Mô tả tổng quan (Description)
Chức năng Quản lý đặt bàn cho phép khách hàng (Customer) thực hiện các thao tác quản lý đơn đặt bàn của mình, bao gồm: hủy lịch đặt và thay đổi thông tin đơn đặt (thời gian, số lượng khách, bàn).

Chức năng này giúp người dùng linh hoạt điều chỉnh kế hoạch, đồng thời hỗ trợ nhà hàng cập nhật tình trạng bàn chính xác và kịp thời.

### 2. Luồng nghiệp vụ (User Workflow)
* Hủy lịch đặt bàn
| Bước | Hành động người dùng        | Phản hồi hệ thống               |
| :--- | :-------------------------- | :------------------------------ |
| 1    | Truy cập `/my-reservations` | Hiển thị danh sách đơn          |
| 2    | Chọn đơn muốn hủy           | Hiển thị chi tiết               |
| 3    | Nhấn "Hủy đặt bàn"          | Hiển thị popup xác nhận         |
| 4    | Xác nhận hủy                | Gửi request                     |
| 5    | Thành công                  | Cập nhật trạng thái = Cancelled |

* Thay đổi thông tin đơn đặt
| Bước | Hành động người dùng                | Phản hồi hệ thống         |
| :--- | :---------------------------------- | :------------------------ |
| 1    | Chọn đơn cần chỉnh sửa              | Hiển thị thông tin        |
| 2    | Nhấn "Chỉnh sửa"                    | Hiển thị form             |
| 3    | Thay đổi (thời gian, số khách, bàn) | Validate dữ liệu          |
| 4    | Nhấn "Save"                         | Gửi request cập nhật      |
| 5    | Thành công                          | Lưu thay đổi và thông báo |


### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
 **Hủy đơn**
* Reservation ID: int, bắt buộc
 **Chỉnh sửa đơn**
* Reservation Date: date, bắt buộc
* Reservation Time: time, bắt buộc
* Number of Guests: int, >=1
* Table ID: int, tùy chọn (nếu đổi bàn)

#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* id
* user_id
* table_id
* reservation_time
* number_of_guests
* status
* updated_at

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Xác thực**: Bắt buộc đăng nhập.
* **Phân quyền**: Người dùng chỉ được thao tác trên đơn của mình
* **Data Integrity**: Không cho phép sửa đơn đã hoàn thành

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Đơn không tồn tại:
  * **Xử lý:** Hiển thị: "Đơn không tồn tại".
* **Trường hợp:** Không đủ điều kiện hủy/sửa:  
  * **Xử lý:** Hiển thị: "Không thể thực hiện thao tác này"
* **Trường hợp:** Thời gian mới bị trùng: 
  * **Xử lý:** Hiển thị: "Khung giờ đã có người đặt"

### 6. Giao diện (UI/UX)
* Hiển thị nút:
    * "Hủy đơn"
    * "Chỉnh sửa"
* Popup xác nhận khi hủy
* Form chỉnh sửa thân thiện
* Hiển thị trạng thái rõ ràng
* Có loading khi gửi request
* Thông báo thành công/thất bại (toast)

## Phần 1: Mô hình hóa quy trình (Business Flow)  
- Sơ đồ Use Case: [Click here](/PICTURES/UC_QLdatban.png)
- Sơ đồ Activity:
    - Chức năng hủy đặt bàn[Click here](/PICTURES/Active_Huydat.png)
    - Chức năng thay đổi thông tin đơn đặt bàn [Click here](/PICTURES/Active_Doithongtindat.png)

## Phần 2: Đặc tả chức năng (Functional Requirements)
- Là một khách hàng, tôi muốn quản lý các đơn đặt bàn của mình để có thể điều chỉnh hoặc hủy khi cần thiết.
- Là một khách hàng, tôi muốn hủy đơn đặt bàn khi không còn nhu cầu để giải phóng bàn cho người khác.
- Là một khách hàng, tôi muốn nhận được thông báo xác nhận sau khi hủy đơn để đảm bảo thao tác đã thành công.
- Là một khách hàng, tôi muốn chỉnh sửa thông tin đơn đặt bàn (thời gian, số lượng khách, bàn) để phù hợp với kế hoạch của mình.
