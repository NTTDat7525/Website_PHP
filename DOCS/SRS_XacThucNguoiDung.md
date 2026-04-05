# UC-01: Đăng ký / Đăng nhập

| Thuộc tính        | Chi tiết |
|-------------------|----------|
| Mã UC             | UC-01 |
| Tên chức năng     | Đăng ký / Đăng nhập |
| Người dùng liên quan | Customer, Admin |


### UC-01:Đăng nhập

**Mô tả:** Khách hàng tạo tài khoản và đăng nhập vào hệ thống để sử dụng các tính năng cá nhân hóa.
           Admin đăng nhập vào hệ thống quản lý riêng

**Người dùng liên quan:** Khách hàng, Admin

### Luồng nghiệp vụ (User Workflow)
| Bước | Hành động người dùng | Phản hồi hệ thống |
| :--- | :--- | :--- |
| 1 | Truy cập URL `/login` | Hiển thị Form đăng nhập (Username, Password, ). |
| 2 | Nhập thông tin và nhấn "Login" | Validate định dạng dữ liệu đầu vào . |
| 3 | Hệ thống kiểm tra thông tin | Server băm Password, so khớp với DB. Kiểm tra trạng thái tài khoản. |
| 4 | Xác thực thành công | Khởi tạo Session/Token, chuyển hướng về Dashboard. |
| 5 | Xác thực thất bại | Giữ nguyên trang, hiển thị thông báo lỗi và xóa trường Password. |

#### Luồng chính

1. Người dùng mở ứng dụng → chọn "Đăng ký" hoặc "Đăng nhập"
2. Nhập thông tin (tên, email, mật khẩu) hoặc chọn đăng nhập bằng tài khoản mạng xã hội (Google, Facebook,...)
3. Hệ thống xác thực thông tin người dùng
4. Đăng nhập thành công → chuyển về màn hình chính

#### Luồng thay thế

- Sai mật khẩu → hiển thị thông báo lỗi, cho phép thử lại tối đa 5 lần
- Quên mật khẩu → gửi email reset qua OTP
- Tài khoản bị khóa → thông báo và hướng dẫn liên hệ Admin

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-01.1 | Hệ thống cho phép đăng ký bằng email và mật khẩu |
| FR-01.2 | Hỗ trợ đăng nhập bằng tài khoản mạng xã hội (Google, Facebook) (OAuth 2.0) |
| FR-01.3 | Mật khẩu phải có ít nhất 8 ký tự, gồm chữ và số |
| FR-01.4 | Hệ thống gửi email xác nhận sau khi đăng ký thành công |
| FR-01.5 | Hỗ trợ chức năng quên mật khẩu qua email OTP |
| FR-01.6 | Admin đăng nhập qua giao diện riêng với phân quyền đặc biệt |
| FR-01.7 | Lưu trạng thái đăng nhập (Remember me) trong 30 ngày |

> **Điều kiện tiên quyết:** Ứng dụng đã được cài đặt, kết nối internet ổn định.
>
> **Điều kiện hậu:** Người dùng được xác thực và có session JWT hợp lệ.

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Mã hóa đường truyền: Bắt buộc TLS 1.2+ (HTTPS). Hủy bỏ mọi request qua HTTP thường.
* **Bảo mật lưu trữ**: Không lưu Plaintext. Sử dụng Argon2id (ưu tiên) hoặc Bcrypt với salt-round tối thiểu là 10.
* **Chống Brute-force**: * Sai 5 lần/1 phút: Khóa IP trong 15 phút.
                     Sai 10 lần liên tiếp: Khóa tài khoản, yêu cầu Reset Password qua Email.
* **Session Management**: Token phải có thời hạn (Expired time) và được thu hồi (Revoke) ngay khi người dùng Log out.

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Người dùng nhập Username chứa kí tự đặc biệt.  
  * **Xử lý:** Hiển thị lỗi ngay tại field: "Username chỉ có chữ và số, không chứa kí tự đặc biệt".
* **Trường hợp:** Tài khoản đã bị quản trị viên khóa .  
  * **Xử lý:** Thông báo: "Tài khoản của bạn tạm thời bị đình chỉ. Vui lòng liên hệ Admin".
* **Trường hợp:** Token CSRF hết hạn (do để trang quá lâu).  
  * **Xử lý:** Redirect về trang login với thông báo "Phiên làm việc hết hạn, vui lòng thử lại".
* **Trường hợp:** Mất kết nối Database).  
  * **Xử lý:** Hiển thị lỗi 500 với thông báo thân thiện: "Hệ thống đang bận, vui lòng quay lại sau".

### 6. Giao diện (UI/UX)
* Thiết kế Responsive (hoạt động tốt trên cả Desktop và Mobile).
* Nút "Login" hiển thị trạng thái `processing` (spinner) khi đang gửi request.
* Hỗ trợ phím tắt: Nhấn `Enter` để gửi form.

---
### UC-02: Đăng ký


### 1. Mô tả tổng quan (Description)
Cho phép người dùng mới tạo tài khoản để truy cập hệ thống. Chức năng này bao gồm việc thu thập thông tin cá nhân, kiểm tra tính duy nhất của username và mã hóa mật khẩu trước khi lưu trữ.

### 2. Luồng nghiệp vụ (User Workflow)
| Bước | Hành động người dùng | Phản hồi hệ thống |
| :--- | :--- | :--- |
| 1 | Truy cập URL /register | Hiển thị Form đăng ký (Username, Email, Password, Confirm Password). |
| 2 | Nhập thông tin và nhấn "Sign Up" | Kiểm tra dữ liệu trống và định dạng (Client-side). |
| 3 | Hệ thống kiểm tra trùng lặp | Check Username trong Database xem đã tồn tại chưa. |
| 4 | Xác thực thành công | Băm (Hash) mật khẩu và tạo bản ghi người dùng mới với trạng thái Active. |
| 5 | Xác thực thất bại | Giữ nguyên trang, hiển thị thông báo lỗi |

### 3. Yêu cầu dữ liệu (Data Requirements)
* **Username:**`string`, tối đa 30 ký tự, không chứa ký tự đặc biệt.
* **Email:** `string`, định dạng email hợp lệ, bắt buộc.
* **Password:** `string`, tối thiểu 8 ký tự, ẩn ký tự khi nhập, bắt buộc.
* **Confirm Password:** `string`, phải trùng khớp hoàn toàn với trường Password.

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Mã hóa:** Mật khẩu không bao giờ được lưu dưới dạng văn bản thuần (Plaintext). Sử dụng thuật toán `Argon2` hoặc `Bcrypt`.

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Password và Confirm Password không khớp.  
  * **Xử lý:** Hiển thị lỗi: "Confirm Password không trùng khớp".
* **Trường hợp:** Username đã được đăng ký trước đó.  
  * **Xử lý:** Thông báo: "Username này đã được sử dụng.".
* **Trường hợp:** Nhập toàn khoảng trắng vào trường Username.  
  * **Xử lý:** Hệ thống tự động trim() hoặc báo lỗi "Tên không được để trống".

### 6. Giao diện (UI/UX)
* Thiết kế đồng bộ với trang Login (cùng tông màu, font chữ).
* Nút "Đã có tài khoản? Đăng nhập ngay" đặt ở dưới cùng để điều hướng nhanh.
* Hỗ trợ phím tắt: Nhấn `Enter` để gửi form.

## Phần 1: Mô hình hóa quy trình (Business Flow)  
- Sơ đồ Use Case: [Click here](/PICTURES/UC_Xacthucnguoidung.png)
- Sơ đồ Activity:
    - Chức năng đăng nhập [Click here](/PICTURES/Active_Dangnhap.png)
    - Chức năng đăng ký [Click here](/PICTURES/Active_Dangky.png)

## Phần 2: Đặc tả chức năng (Functional Requirements)
- Là một người dùng, tôi muốn đăng ký và đăng nhập vào hệ thống để sử dụng các chức năng đặt bàn.
- Là một khách hàng, tôi muốn nhận thông báo khi đăng ký thành công để biết rằng tài khoản đã được tạo.
- Là một người dùng, tôi muốn đăng nhập vào hệ thống bằng email và mật khẩu để truy cập tài khoản của mình.
- Là một người dùng, tôi muốn hệ thống kiểm tra thông tin đăng nhập để đảm bảo tính bảo mật.
- Là một người dùng, tôi muốn nhận thông báo lỗi khi nhập sai thông tin để có thể thử lại.
- Là một người dùng, tôi muốn đặt lại mật khẩu khi quên để có thể truy cập lại tài khoản.
