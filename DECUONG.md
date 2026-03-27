# BÁO CÁO ĐỒ ÁN WEB NÂNG CAO  
## Hệ thống Đặt Bàn Nhà Hàng

---

# CHƯƠNG 1: TỔNG QUAN

## 1.1. Giới thiệu
Hệ thống đặt bàn nhà hàng trực tuyến là một ứng dụng web được xây dựng nhằm hỗ trợ khách hàng thực hiện việc đặt bàn trước một cách nhanh chóng và thuận tiện thông qua internet. Thay vì phải đến trực tiếp hoặc gọi điện, người dùng có thể dễ dàng tìm kiếm bàn phù hợp và đặt lịch chỉ với vài thao tác đơn giản.

Đối với nhà hàng, hệ thống giúp tối ưu hóa quy trình quản lý, giảm thiểu sai sót trong việc sắp xếp bàn, đồng thời nâng cao hiệu quả vận hành và chất lượng phục vụ. Việc số hóa quy trình đặt bàn cũng góp phần cải thiện trải nghiệm khách hàng và tăng khả năng cạnh tranh trong môi trường kinh doanh hiện đại.

## 1.2. Mục tiêu
Hệ thống được xây dựng nhằm đạt được các mục tiêu chính sau:

- Xây dựng một nền tảng web cho phép người dùng đặt bàn trực tuyến một cách dễ dàng và nhanh chóng
- Phân quyền rõ ràng giữa hai nhóm người dùng: Customer và Admin nhằm đảm bảo tính kiểm soát và quản lý hệ thống
- Đảm bảo an toàn và bảo mật thông tin người dùng trong quá trình đăng ký, đăng nhập và sử dụng hệ thống
- Hỗ trợ nhà quản trị theo dõi, quản lý đơn đặt bàn và thống kê doanh thu theo thời gian

## 1.3. Phạm vi
Phạm vi của hệ thống được giới hạn trong các chức năng cơ bản của một ứng dụng web đặt bàn nhà hàng, bao gồm:

- Hệ thống hoạt động trên nền tảng web, có thể truy cập thông qua trình duyệt
- Cung cấp các chức năng chính như đăng ký, đăng nhập, tìm kiếm và đặt bàn
- Hỗ trợ quản lý dữ liệu cho phía quản trị viên

## 1.4. Công nghệ sử dụng
Hệ thống được xây dựng dựa trên các công nghệ phổ biến trong phát triển web, bao gồm:

- Backend: Sử dụng ngôn ngữ lập trình PHP để xử lý logic nghiệp vụ và tương tác với cơ sở dữ liệu
- Frontend: Sử dụng HTML, CSS và JavaScript để xây dựng giao diện người dùng thân thiện và dễ sử dụng
- Cơ sở dữ liệu: Sử dụng MySQL để lưu trữ và quản lý dữ liệu như thông tin người dùng, bàn và đơn đặt

Các công nghệ này giúp hệ thống đảm bảo tính ổn định, dễ triển khai và phù hợp với yêu cầu của đề tài môn học.

## 1.5. Bảo mật
Để đảm bảo an toàn cho hệ thống và dữ liệu người dùng, các cơ chế bảo mật cơ bản được áp dụng bao gồm:

- Mã hóa mật khẩu: Sử dụng thuật toán bcrypt thông qua hàm password_hash() trong PHP để lưu trữ mật khẩu dưới dạng mã hóa, tránh lưu plaintext
- Xác thực người dùng: Sử dụng session để quản lý trạng thái đăng nhập và kiểm soát truy cập hệ thống
- Kiểm tra dữ liệu đầu vào: Áp dụng validate dữ liệu nhằm ngăn chặn các lỗ hổng phổ biến như:
   - SQL Injection
   - Cross-Site Scripting (XSS)

Các biện pháp trên giúp tăng cường độ an toàn và đảm bảo tính bảo mật cho hệ thống trong quá trình vận hành.

---

# CHƯƠNG 2: PHÂN TÍCH HỆ THỐNG

## 2.1. Đối tượng sử dụng
Hệ thống được thiết kế phục vụ hai nhóm người dùng chính với quyền hạn và chức năng khác nhau:

- Customer là người trực tiếp sử dụng hệ thống để thực hiện việc đặt bàn. Nhóm người dùng này có thể:

   - Tạo tài khoản và đăng nhập vào hệ thống
   - Tìm kiếm bàn phù hợp với nhu cầu
   - Thực hiện đặt bàn theo thời gian mong muốn
   - Theo dõi và quản lý các đơn đặt của mình


- Admin là người quản lý và vận hành hệ thống. Nhóm này có quyền cao hơn và chịu trách nhiệm:

   - Quản lý thông tin người dùng
   - Quản lý danh sách bàn
   - Xử lý và cập nhật trạng thái đơn đặt
   - Theo dõi và thống kê doanh thu

## 2.2. Chức năng hệ thống

Hệ thống cung cấp các chức năng chính tương ứng với từng nhóm người dùng.

### Customer
- Đăng ký / Đăng nhập: Cho phép người dùng tạo tài khoản mới và đăng nhập vào hệ thống để sử dụng các chức năng.
- Tìm kiếm bàn: Người dùng có thể tìm kiếm bàn dựa trên các tiêu chí như loại bàn, số lượng chỗ ngồi hoặc thời gian đặt.
- Đặt bàn: Sau khi chọn được bàn phù hợp, người dùng tiến hành đặt bàn và xác nhận thông tin.
- Quản lý tài khoản: Cho phép cập nhật thông tin cá nhân và thay đổi mật khẩu.
- Xem lịch sử: Hiển thị danh sách các đơn đặt trước đó để người dùng theo dõi.

### Admin
- Quản lý người dùng: Admin có thể xem, chỉnh sửa hoặc xóa thông tin người dùng khi cần thiết.
- Quản lý bàn: Bao gồm thêm mới, chỉnh sửa hoặc xóa bàn trong hệ thống.
- Quản lý đơn: Theo dõi danh sách các đơn đặt và cập nhật trạng thái như:
   - pending (chờ xử lý)
   - confirmed (đã xác nhận)
   - completed (đã hoàn tất)
- Thống kê doanh thu: Tổng hợp dữ liệu từ các đơn hoàn tất để tính toán doanh thu theo thời gian.

---

## 2.3. Mô hình hệ thống
Hệ thống được xây dựng theo mô hình MVC (Model - View - Controller) nhằm tách biệt rõ ràng giữa các thành phần:

- Model: Xử lý dữ liệu và tương tác với cơ sở dữ liệu (MySQL).
- View: Hiển thị giao diện người dùng (HTML, CSS, JavaScript).
- Controller: Xử lý logic nghiệp vụ, nhận dữ liệu từ người dùng và điều phối giữa Model và View.

Việc áp dụng mô hình MVC giúp:

- Dễ bảo trì và mở rộng hệ thống
- Tăng tính tổ chức và rõ ràng trong code
- Giảm sự phụ thuộc giữa các thành phần

---

## 2.5. Database

### Bảng Users

| Trường | Kiểu | Mô tả |
|------|------|------|
| id | INT (PK) | ID |
| name | VARCHAR(100) | Tên |
| email | VARCHAR(100) | Email |
| password | VARCHAR(255) | Mật khẩu |
| role | ENUM | customer / admin |
| phone | VARCHAR(20) | SĐT |

---

### Bảng Tables

| Trường | Kiểu | Mô tả |
|------|------|------|
| id | INT (PK) | ID bàn |
| type | VARCHAR(50) | Loại |
| capacity | INT | Sức chứa |
| status | ENUM | available / reserved |

---

### Bảng Orders

| Trường | Kiểu | Mô tả |
|------|------|------|
| id | INT (PK) | ID đơn |
| user_id | INT (FK) | Người đặt |
| table_id | INT (FK) | Bàn |
| time | DATETIME | Thời gian |
| status | ENUM | pending / confirmed / completed |
| total_price | DECIMAL | Tổng tiền |

---

# CHƯƠNG 3: TRIỂN KHAI HỆ THỐNG

## 3.1. Luồng hoạt động

### Đặt bàn
1. Người dùng tìm bàn

- Người dùng nhập các tiêu chí tìm kiếm như loại bàn, số lượng chỗ hoặc thời gian mong muốn. Hệ thống sẽ truy vấn dữ liệu từ cơ sở dữ liệu để hiển thị danh sách các bàn phù hợp.

2. Kiểm tra khả dụng

- Hệ thống kiểm tra trạng thái của bàn tại thời điểm người dùng chọn nhằm đảm bảo bàn chưa được đặt trước đó. Nếu bàn không khả dụng, hệ thống sẽ thông báo và đề xuất lựa chọn khác.

3. Xác nhận đặt

- Người dùng xác nhận thông tin đặt bàn bao gồm thời gian, loại bàn và các thông tin liên quan.

4. Lưu vào database

- Sau khi xác nhận, hệ thống lưu thông tin vào bảng Orders với trạng thái ban đầu là pending.

### Quản lý đơn (Admin)
1. Xem danh sách

Admin truy cập vào hệ thống để xem danh sách tất cả các đơn đặt bàn, bao gồm thông tin người đặt, thời gian và trạng thái.

2. Cập nhật trạng thái
Admin có thể thay đổi trạng thái của đơn theo các bước:

- pending → confirmed (xác nhận đơn)
- confirmed → completed (hoàn tất)

### Doanh thu
Chức năng thống kê doanh thu hỗ trợ admin trong việc đánh giá hiệu quả kinh doanh:

- Hệ thống lọc các đơn có trạng thái completed
- Tổng hợp giá trị total_price của các đơn này
- Hiển thị kết quả 

Chức năng này giúp nhà quản lý đưa ra các quyết định kinh doanh phù hợp.

---

## 3.2. Giao diện

### Customer
- Trang chủ: Hiển thị thông tin chung về nhà hàng, các bàn nổi bật và chức năng tìm kiếm nhanh.
- Trang tìm bàn: Cho phép người dùng nhập các tiêu chí để tìm kiếm bàn phù hợp.
- Trang đặt bàn: Hiển thị thông tin chi tiết của bàn và form xác nhận đặt bàn.
- Trang cá nhân (Profile): Cho phép người dùng cập nhật thông tin cá nhân và xem lịch sử đặt bàn.

Giao diện Customer tập trung vào trải nghiệm người dùng, đảm bảo đơn giản và dễ thao tác. 

### Admin
- Dashboard: Hiển thị tổng quan hệ thống như số lượng đơn, doanh thu và trạng thái hoạt động.
- Quản lý bàn: Cho phép thêm, sửa, xóa bàn trong hệ thống.
- Quản lý đơn: Hiển thị danh sách đơn và cho phép cập nhật trạng thái.
- Thống kê: Cung cấp các báo cáo doanh thu dưới dạng bảng hoặc biểu đồ.

Giao diện Admin tập trung vào tính quản lý và khả năng kiểm soát dữ liệu.

---
