# UC-02: Tìm kiếm bàn

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-02 |
| Tên chức năng     | Tìm kiếm bàn |
| Người dùng liên quan | Customer |

### 1. Mô tả tổng quan (Description)
Chức năng Tìm kiếm bàn cho phép khách hàng (Customer) tìm kiếm các bàn phù hợp trong nhà hàng dựa trên các tiêu chí như loại bàn, số lượng chỗ ngồi và thời gian đặt.

Hệ thống sẽ kiểm tra tính khả dụng của bàn theo thời gian thực, từ đó đề xuất các bàn còn trống phù hợp với yêu cầu của người dùng, giúp quá trình đặt bàn trở nên nhanh chóng và thuận tiện hơn.

### 2. Luồng nghiệp vụ (User Workflow)
Tìm kiếm bàn
| Bước | Hành động người dùng                          | Phản hồi hệ thống      |
| :--- | :-------------------------------------------- | :--------------------- |
| 1    | Truy cập `/search-table`                      | Hiển thị form tìm kiếm |
| 2    | Nhập tiêu chí (số người, thời gian, loại bàn) | Validate dữ liệu       |
| 3    | Nhấn "Search"                                 | Gửi request tìm kiếm   |
| 4    | Hệ thống xử lý                                | Kiểm tra bàn khả dụng  |
| 5    | Hiển thị kết quả                              | Danh sách bàn phù hợp  |

Xem chi tiết bàn
| Bước | Hành động người dùng                    | Phản hồi hệ thống       |
| :--- | :-------------------------------------- | :---------------------- |
| 1    | Chọn một bàn                            | Hiển thị chi tiết       |
| 2    | Xem thông tin (sức chứa, vị trí, mô tả) | Hiển thị đầy đủ dữ liệu |


### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
* **Number of Guests**: int, bắt buộc (>=1)
* **Reservation Date**: date, bắt buộc
* **Reservation Time**: time, bắt buộc
* **Table Type**: enum, tùy chọn
    * Standard
    * VIP
    * Outdoor

### 3.2 Dữ liệu xử lý
* Kiểm tra bàn có:
    * Sức chứa ≥ số khách
    * Không bị trùng thời gian đặt
* Có thể gợi ý:
    * Bàn gần đúng (nếu không có bàn chính xác)


#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* id: primary key
* table_name: string
* capacity: int
* type: enum
* status: available/unavailable

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Đồng bộ dữ liệu**: Kiểm tra trạng thái bàn theo thời gian thực


### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Không có bàn phù hợp: 
  * **Xử lý:** Hiển thị: "Không tìm thấy bàn phù hợp".
* **Trường hợp:** Thời gian đặt trong quá khứ: 
  * **Xử lý:** Hiển thị: "Thời gian không hợp lệ".
* **Trường hợp:** Số khách vượt quá sức chứa lớn nhất:  
  * **Xử lý:** Gợi ý chia bàn hoặc thông báo lỗi.

### 6. Giao diện (UI/UX)
* Form tìm kiếm đơn giản, dễ sử dụng
* Hiển thị danh sách bàn dạng:
    * Card view (ảnh + thông tin)
* Hiển thị loading khi tìm kiếm
