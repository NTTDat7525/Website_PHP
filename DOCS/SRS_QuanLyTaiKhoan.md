# UC-04: Quản lý tài khoản

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-04 |
| Tên chức năng     | Quản lý tài khoản |
| Người dùng liên quan | Customer |
| Ưu tiên           | 🟡 Trung bình |
---

### 1. Mô tả tổng quan (Description)
Chức năng Quản lý tài khoản cho phép người dùng (Customer/Admin) thực hiện các thao tác liên quan đến tài khoản cá nhân bao gồm: đăng xuất khỏi hệ thống, thay đổi mật khẩu và cập nhật thông tin cá nhân.

Chức năng này giúp đảm bảo tính bảo mật, tính cá nhân hóa và nâng cao trải nghiệm người dùng khi sử dụng hệ thống đặt bàn nhà hàng.

### 2. Luồng nghiệp vụ (User Workflow)

* Đăng xuất

| Bước | Hành động người dùng | Phản hồi hệ thống                              |
| :--- | :------------------- | :--------------------------------------------- |
| 1    | Nhấn nút "Logout"    | Gửi request đăng xuất                          |
| 2    | Hệ thống xử lý       | Xóa Session/Token                              |
| 3    | Hoàn tất             | Chuyển hướng về trang chủ hoặc trang đăng nhập |

* Đổi mật khẩu

| Bước | Hành động người dùng                              | Phản hồi hệ thống                             |
| :--- | :------------------------------------------------ | :-------------------------------------------- |
| 1    | Truy cập trang `đổi mật khẩu`                 | Hiển thị form đổi mật khẩu                    |
| 2    | Nhập mật khẩu cũ, mật khẩu mới, xác nhận mật khẩu | Validate dữ liệu đầu vào                      |
| 3    | Gửi yêu cầu                                       | Kiểm tra mật khẩu cũ                          |
| 4    | Hợp lệ                                            | Cập nhật mật khẩu mới (hash)                  |
| 5    | Thành công                                        | Thông báo thành công và yêu cầu đăng nhập lại |

* Cập nhật thông tin tài khoản

| Bước | Hành động người dùng                      | Phản hồi hệ thống                      |
| :--- | :---------------------------------------- | :------------------------------------- |
| 1    | Truy cập `/profile`                       | Hiển thị thông tin hiện tại            |
| 2    | Chỉnh sửa thông tin (tên, SĐT, email,...) | Validate dữ liệu                       |
| 3    | Nhấn "Save"                               | Gửi request cập nhật                   |
| 4    | Thành công                                | Lưu vào database và hiển thị thông báo |


### 3. Yêu cầu dữ liệu (Data Requirements)
### 3.1. Dữ liệu đầu vào (Input Fields)
* Đổi mật khẩu
* Current Password: string, bắt buộc
* New Password: string, tối thiểu 8 ký tự, bắt buộc
* Confirm Password: string, phải trùng với New Password
* Cập nhật thông tin
* Full Name: string, bắt buộc
* Email: string, đúng định dạng email, unique
* Phone: string, 10-11 số
* Address: string, tùy chọn

#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* id: primary key
* full_name: string
* email: unique
* password: hashed
* phone: string
* address: string
* updated_at: timestamp

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Xác thực**: Chỉ người dùng đã đăng nhập mới được truy cập chức năng
* **HTTPS**: Bắt buộc sử dụng HTTPS
* **CSRF Token**: Áp dụng cho tất cả request POST/PUT
* **Mã hóa mật khẩu**: Sử dụng Bcrypt hoặc Argon2
* **Re-authentication**: Yêu cầu nhập lại mật khẩu cũ khi đổi mật khẩu

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Sai mật khẩu cũ:  
  * **Xử lý:** Hiển thị: "Mật khẩu hiện tại không đúng".
* **Trường hợp:** Mật khẩu mới không khớp:  
  * **Xử lý:** Hiển thị: "Xác nhận mật khẩu không khớp".
* **Trường hợp:** Người dùng chưa đăng nhập truy cập /profile:  
  * **Xử lý:** Redirect về trang login

### 6. Giao diện (UI/UX)
* Giao diện thân thiện, dễ sử dụng.
* Nút "Save" và "Change Password" hiển thị loading khi xử lý.
* Hiển thị thông báo thành công/thất bại rõ ràng.

## Phần 1: Mô hình hóa quy trình (Business Flow)  
- Sơ đồ Use Case: [Click here](/PICTURES/UC_QLtaikhoan.png)
- Sơ đồ Activity:
    - Chức năng thay đổi thông tin tài khoản [Click here](/PICTURES/Active_Doithongtintaikhoan.png)
    - Chức năng thay đổi mật khẩu [Click here](/PICTURES/Active_Doimatkhau.png)

## Phần 2: Đặc tả chức năng (Functional Requirements)
- Là một người dùng, tôi muốn chỉnh sửa thông tin cá nhân (tên, email, số điện thoại, địa chỉ) để đảm bảo thông tin luôn chính xác.
- Là một người dùng, tôi muốn nhận được thông báo sau khi cập nhật thông tin để xác nhận thay đổi đã thành công.
- Là một người dùng, tôi muốn thay đổi mật khẩu để tăng tính bảo mật cho tài khoản.
- Là một người dùng, tôi muốn hệ thống yêu cầu nhập mật khẩu hiện tại khi đổi mật khẩu để đảm bảo an toàn.
- Là một người dùng, tôi muốn đăng xuất khỏi hệ thống để bảo vệ tài khoản khi không sử dụng.
