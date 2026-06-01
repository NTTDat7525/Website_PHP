<div align="center">

<h1>Golden Spoons</h1>

<p>
  <strong>Hệ thống đặt bàn nhà hàng trực tuyến</strong><br/>
</p>

<p>
  <a href="https://github.com/NTTDat7525/GoldenSpoons/blob/main/LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License: MIT"/>
  </a>
  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel"/>
  </a>
  <a href="https://www.php.net">
    <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?logo=php&logoColor=white" alt="PHP"/>
  </a>
  <a href="https://www.mysql.com">
    <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql&logoColor=white" alt="MySQL"/>
  </a>
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?logo=tailwindcss&logoColor=white" alt="TailwindCSS"/>
  <a href="https://tadneit07525.site">
    <img src="https://img.shields.io/badge/Demo-Live-brightgreen" alt="Live Demo"/>
  </a>
</p>
</div>

---

## Thành viên


| Thành viên            | Vai trò     | Mã sinh viên| Công việc thực hiện                                                                                |
| --------------------- | ----------- | ------------| ---------------------------------------------------------------------------------------------------|
| Nguyễn Trịnh Tiến Đạt | Nhóm trưởng | 23810310148 | Trang đặt bàn, nhập thông tin, thanh toán, xác nhận, lịch sử đặt bàn, deploy dự án, cấu hình route |
| Bùi Minh Đức          | Thành viên  | 23810310110 | Trang đăng ký, đăng nhập, quên mật khẩu, trang chủ, hồ sơ                                          |
| Đồng Việt Tiến        | Thành viên  | 23810310142 | Giao diện admin, kiểm thử hệ thống                                                                 |


---

## Mục lục

- [Công nghệ sử dụng](#công-nghệ-sử-dụng)
- [Cấu trúc thư mục](#cấu-trúc-thư-mục)
- [Cơ sở dữ liệu](#cơ-sở-dữ-liệu)
- [Chức năng chính](#chức-năng-chính)
- [Hướng dẫn cài đặt](#hướng-dẫn-cài-đặt)
- [Hướng dẫn sử dụng](#hướng-dẫn-sử-dụng)

---

## Quick Start 
```bash
git clone https://github.com/NTTDat7525/Website_PHP.git
cd website
composer install
npm install
copy .env.example .env
php artisan key:generate
 php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```
---

## Công nghệ sử dụng

| Thành phần            | Công nghệ                         | Phiên bản |
| --------------------- | --------------------------------- | --------- |
| **Framework Backend** | Laravel                           | 13.x      |
| **Ngôn ngữ**          | PHP                               | >= 8.3    |
| **Database**          | MySQL                             | >= 5.7    |
| **Frontend**          | HTML5, JavaScript, Tailwind CSS   | 4.x       |
| **Templating**        | Blade Templates                   | Laravel   |
| **Build Tool**        | Vite                              | 8.x       |
| **OAuth**             | Laravel Socialite (Google OAuth2) | ^5.26     |
| **Queue / Jobs**      | Laravel Queue                     | database  |
| **Email**             | Laravel Mail (SMTP)               | Laravel   |
| **Export Excel**      | Maatwebsite Excel                 | ^3.1      |
| **Thanh toán**        | SePay Webhook + VietQR            | API       |
| **Dev Tools**         | Laravel Pail, Laravel Pint, PHPUnit | Laravel |

---

## Cấu trúc thư mục

```text
website/
├── app/
│   ├── Exports/
│   │   └── ReportsExport.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── BookingController.php
│   │   │   ├── PaymentController.php
│   │   │   ├── ReportController.php
│   │   │   ├── RevenueController.php
│   │   │   ├── TableController.php
│   │   │   └── UserController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       ├── CheckEmailVerified.php
│   │       └── UserMiddleware.php
│   ├── Jobs/
│   │   └── SendPaymentSuccessEmailJob.php
│   ├── Mail/
│   │   ├── ForgotPasswordMail.php
│   │   ├── PaymentSuccessMail.php
│   │   └── SendOtpMail.php
│   ├── Models/
│   │   ├── Booking.php
│   │   ├── EmailOtp.php
│   │   ├── Session.php
│   │   ├── Table.php
│   │   ├── Transaction.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_04_04_105042_create_tables_table.php
│   │   ├── 2026_04_04_105117_create_bookings_table.php
│   │   ├── 2026_04_04_105211_create_sessions_table.php
│   │   ├── 2026_04_15_011345_create_jobs_table.php
│   │   ├── 2026_04_22_150850_add_name_to_users_table.php
│   │   ├── 2026_04_29_130421_create_failed_jobs_table.php
│   │   ├── 2026_05_08_044745_create_transactions_table.php
│   │   ├── 2026_05_10_202220_add_email_verified_to_users_table.php
│   │   └── 2026_05_10_205532_create_email_otps_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── TablesTableSeeder.php
│       └── UsersTableSeeder.php
│
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── admin/
│       │   ├── bookings.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── reports.blade.php
│       │   ├── revenue.blade.php
│       │   ├── sidebar.blade.php
│       │   └── tables.blade.php
│       ├── auth/
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── customer/
│       │   ├── booking.blade.php
│       │   ├── confirmBooking.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── detailBooking.blade.php
│       │   ├── history.blade.php
│       │   ├── listTable.blade.php
│       │   └── profile.blade.php
│       └── emails/
│           ├── bookingSuccessMail.blade.php
│           ├── forgot-password.blade.php
│           └── otp.blade.php
│
├── routes/
│   ├── api.php
│   └── web.php
├── config/
│   ├── booking.php
│   └── payment.php
├── composer.json
├── package.json
├── .env.example
├── tailwind.config.js
├── vite.config.js
└── artisan
```

---

## Cơ sở dữ liệu

**Database khuyến nghị**: `website`  
**Engine**: InnoDB  
**Charset**: UTF-8 / utf8mb4

### Các bảng chính

| Bảng | Mục đích |
| ---- | -------- |
| `users` | Lưu tài khoản khách hàng và quản trị viên |
| `tables` | Lưu thông tin bàn nhà hàng |
| `bookings` | Lưu đơn đặt bàn |
| `transactions` | Lưu giao dịch nhận từ SePay webhook |
| `email_otps` | Lưu mã OTP xác thực email |
| `sessions` | Lưu phiên đăng nhập khi dùng database session |
| `jobs` | Hàng đợi gửi email bất đồng bộ |
| `failed_jobs` | Lưu job bị lỗi |

### Sơ đồ quan hệ rút gọn

```text
users 1 ─── N bookings N ─── 1 tables
              │
              │ 1
              ▼
          transactions

users 1 ─── N sessions

email_otps dùng để xác thực email theo địa chỉ email.
jobs và failed_jobs dùng cho Laravel Queue.
```

### Bảng `users`

| Cột | Kiểu dữ liệu | Ghi chú |
| --- | ------------ | ------- |
| `id` | BIGINT | Primary key |
| `name` | VARCHAR, nullable | Tên hiển thị |
| `username` | VARCHAR, unique | Tên đăng nhập |
| `email` | VARCHAR, unique | Email |
| `password` | VARCHAR | Mật khẩu đã hash |
| `phone` | VARCHAR | Số điện thoại |
| `bio` | TEXT, nullable | Giới thiệu cá nhân |
| `role` | ENUM | `customer`, `admin` |
| `email_verified` | BOOLEAN | Trạng thái xác thực email |
| `created_at`, `updated_at` | TIMESTAMP | Thời gian tạo/cập nhật |

### Bảng `tables`

| Cột | Kiểu dữ liệu | Ghi chú |
| --- | ------------ | ------- |
| `id` | BIGINT | Primary key |
| `name` | VARCHAR | Tên bàn |
| `capacity` | INT | Sức chứa |
| `location` | VARCHAR, nullable | Vị trí bàn |
| `image` | VARCHAR, nullable | Ảnh bàn |
| `status` | ENUM | `available`, `reserved`, `occupied` |
| `price` | BIGINT | Phí đặt bàn |
| `created_at`, `updated_at` | TIMESTAMP | Thời gian tạo/cập nhật |

### Bảng `bookings`

| Cột | Kiểu dữ liệu | Ghi chú |
| --- | ------------ | ------- |
| `id` | BIGINT | Primary key |
| `user_id` | BIGINT | FK -> `users.id`, cascade delete |
| `table_id` | BIGINT | FK -> `tables.id`, cascade delete |
| `date` | DATE | Ngày đặt |
| `time` | TIME | Giờ đặt |
| `guest_count` | INT | Số lượng khách |
| `email` | VARCHAR | Email nhận xác nhận |
| `phone` | VARCHAR, nullable | Số điện thoại |
| `special_requests` | TEXT, nullable | Ghi chú |
| `total_price` | BIGINT | Tổng tiền |
| `status` | ENUM | `pending`, `confirmed`, `cancelled` |
| `payment_method` | ENUM | `bank_transfer`, `cash` |
| `payment_status` | ENUM | `unpaid`, `paid`, `failed` |
| `paid_at` | TIMESTAMP, nullable | Thời điểm thanh toán |
| `created_at`, `updated_at` | TIMESTAMP | Thời gian tạo/cập nhật |

### Bảng `transactions`

| Cột | Kiểu dữ liệu | Ghi chú |
| --- | ------------ | ------- |
| `id` | BIGINT | Primary key |
| `booking_id` | BIGINT, nullable | FK -> `bookings.id`, null on delete |
| `gateway` | VARCHAR | Cổng/ngân hàng thanh toán |
| `transaction_date` | TIMESTAMP, nullable | Ngày giao dịch |
| `account_number` | VARCHAR, nullable | Số tài khoản |
| `sub_account` | VARCHAR, nullable | Tài khoản phụ |
| `amount_in` | DECIMAL(15,2) | Tiền vào |
| `amount_out` | DECIMAL(15,2) | Tiền ra |
| `accumulated` | DECIMAL(15,2) | Số dư tích lũy |
| `code` | VARCHAR, nullable | Mã tham chiếu/booking code |
| `transaction_content` | TEXT, nullable | Nội dung giao dịch |
| `reference_number` | VARCHAR, nullable | Mã tham chiếu ngân hàng |
| `body` | TEXT, nullable | Nội dung webhook |
| `raw_data` | JSON, nullable | Payload gốc |
| `created_at`, `updated_at` | TIMESTAMP | Thời gian tạo/cập nhật |

### Quan hệ Eloquent

| Model | Quan hệ | Model liên kết | Mô tả |
| ----- | ------- | -------------- | ----- |
| `User` | `hasMany` | `Booking` | Một user có nhiều đơn đặt bàn |
| `Table` | `hasMany` | `Booking` | Một bàn có thể có nhiều đơn đặt bàn ở các thời điểm khác nhau |
| `Booking` | `belongsTo` | `User` | Đơn đặt bàn thuộc về một user |
| `Booking` | `belongsTo` | `Table` | Đơn đặt bàn thuộc về một bàn |
| `Booking` | `hasMany` | `Transaction` | Một đơn đặt bàn có thể ghi nhận nhiều giao dịch |
| `Session` | `belongsTo` | `User` | Phiên đăng nhập thuộc về một user |

---

## Chức năng chính

### Xác thực người dùng

| Chức năng | Mô tả |
| --------- | ----- |
| Đăng ký tài khoản | Tạo tài khoản với username, email, mật khẩu |
| Đăng nhập | Xác thực bằng username và password |
| Phân quyền | Điều hướng theo vai trò `admin` hoặc `customer` |
| Đăng xuất | Hủy session và quay về trang đăng nhập |
| Đăng nhập Google | OAuth2 qua Laravel Socialite |
| Xác thực email OTP | Gửi và kiểm tra mã OTP qua email |
| Quên mật khẩu | Gửi email hỗ trợ lấy lại mật khẩu |
| Cập nhật hồ sơ | Cập nhật tên, số điện thoại, tiểu sử |
| Đổi mật khẩu | Đổi mật khẩu từ trang hồ sơ |

### Phía khách hàng

| Chức năng | Mô tả |
| --------- | ----- |
| Dashboard | Trang chủ khách hàng sau đăng nhập |
| Xem danh sách bàn | Xem bàn, sức chứa, vị trí, ảnh, giá và trạng thái |
| Tìm kiếm bàn | Lọc bàn theo ngày, giờ, số lượng khách |
| Đặt bàn | Nhập ngày, giờ, số khách, ghi chú, email, số điện thoại |
| Xác nhận đặt bàn | Xem thông tin đặt bàn trước khi thanh toán |
| Thanh toán SePay/VietQR | Hiển thị QR chuyển khoản và cập nhật trạng thái qua webhook |
| Kiểm tra trạng thái | Theo dõi trạng thái thanh toán/đặt bàn |
| Hủy đặt bàn | Hủy đơn đặt bàn theo nghiệp vụ trong controller |
| Chi tiết đặt bàn | Xem thông tin một đơn đặt bàn cụ thể |
| Lịch sử đặt bàn | Xem danh sách đơn đặt bàn của tài khoản |
| Email xác nhận | Gửi email sau khi thanh toán thành công qua queue job |

### Phía quản trị viên

| Chức năng | Mô tả |
| --------- | ----- |
| Dashboard | Thống kê tổng quan hoạt động nhà hàng |
| Quản lý đặt bàn | Xem toàn bộ danh sách đặt bàn kèm thông tin user và bàn |
| Quản lý bàn | Thêm, sửa, xóa bàn; cập nhật ảnh, sức chứa, vị trí, giá, trạng thái |
| Chiếm bàn / giải phóng bàn | Cập nhật nhanh trạng thái `occupied` hoặc `available` |
| Thống kê doanh thu | Theo dõi doanh thu theo ngày/tháng |
| Báo cáo tổng hợp | Tổng hợp số lượng bàn, đặt bàn, doanh thu, người dùng |
| Xuất Excel | Xuất báo cáo `.xlsx` bằng Maatwebsite Excel |

---

## Hình ảnh minh họa hệ thống

### [Đăng ký tài khoản](./PICTURES/Giao%20diện%20demo/DangKy.png)

![Đăng ký](./PICTURES/Giao%20diện%20demo/DangKy.png)

---

### [Đăng nhập hệ thống](./PICTURES/Giao%20diện%20demo/Dangnhap.png)

![Đăng nhập](./PICTURES/Giao%20diện%20demo/Dangnhap.png)

---

### [Quên mật khẩu](./PICTURES/Giao%20diện%20demo/QuenMk.png)

![Quên mật khẩu](./PICTURES/Giao%20diện%20demo/QuenMk.png)

---

### [Trang chủ khách hàng](./PICTURES/Giao%20diện%20demo/Userhome.png)

![User Home](./PICTURES/Giao%20diện%20demo/Userhome.png)

---

### [Danh sách bàn khách hàng](./PICTURES/Giao%20diện%20demo/Userdb.png)

![User Dashboard](./PICTURES/Giao%20diện%20demo/Userdb.png)

---

### [Lịch sử đặt bàn khách hàng](./PICTURES/Giao%20diện%20demo/Userlsdb.png)

![User List Table](./PICTURES/Giao%20diện%20demo/Userlsdb.png)

---

### [Chi tiết đặt bàn khách hàng](./PICTURES/Giao%20diện%20demo/Userctdb.png)

![User Chi tiết bàn](./PICTURES/Giao%20diện%20demo/Userctdb.png)

---

### [Thanh toán khách hàng](./PICTURES/Giao%20diện%20demo/Usertt.png)

![User Đặt bàn](./PICTURES/Giao%20diện%20demo/Usertt.png)

---

### [Xác nhận đặt bàn](./PICTURES/Giao%20diện%20demo/Userxndb.png)

![User Xác nhận đặt bàn](./PICTURES/Giao%20diện%20demo/Userxndb.png)

---

### [Quản lý tài khoản](./PICTURES/Giao%20diện%20demo/Userqltk.png)

![User Lịch sử đặt bàn](./PICTURES/Giao%20diện%20demo/Userqltk.png)

---

### [Cập nhật thông tin cá nhân](./PICTURES/Giao%20diện%20demo/Usercntt.png)

![User Profile](./PICTURES/Giao%20diện%20demo/Usercntt.png)

---

### [Dashboard admin](./PICTURES/Giao%20diện%20demo/adminDashboard.png)

![Admin Dashboard](./PICTURES/Giao%20diện%20demo/adminDashboard.png)

---

### [Quản lý bàn](./PICTURES/Giao%20diện%20demo/AdminQlb.png)

![Admin Quản lý bàn](./PICTURES/Giao%20diện%20demo/AdminQlb.png)

---

### [Quản lý doanh thu](./PICTURES/Giao%20diện%20demo/AdminDt.png)

![Admin Chi tiết bàn](./PICTURES/Giao%20diện%20demo/AdminDt.png)

---

### [Báo cáo tổng hợp](./PICTURES/Giao%20diện%20demo/AdminBc.png)

![Admin Báo cáo](./PICTURES/Giao%20diện%20demo/AdminBc.png)

---

### [Quản lý đặt bàn](./PICTURES/Giao%20diện%20demo/AdminQldb.png)

![Admin Quản lý đặt bàn](./PICTURES/Giao%20diện%20demo/AdminQldb.png)

## Hướng dẫn cài đặt

### Yêu cầu hệ thống

- **PHP** >= 8.3
- **Composer** >= 2.x
- **Node.js** >= 20 và npm
- **MySQL** >= 5.7
- **Git**
- **XAMPP**, Laragon hoặc web server tương đương

### Cài đặt thủ công

1. Di chuyển vào thư mục dự án:

   ```bash
   cd website
   ```

2. Cài dependencies PHP:

   ```bash
   composer install
   ```

3. Cài dependencies Node.js:

   ```bash
   npm install
   ```

4. Tạo file `.env`:

   ```bash
   copy .env.example .env
   ```

   Nếu repository hiện tại không có `.env.example`, hãy tạo file `.env` thủ công dựa trên các cấu hình ở phần bên dưới.

5. Sinh application key:

   ```bash
   php artisan key:generate
   ```

6. Cấu hình database trong `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=website
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Cấu hình session và queue:

   ```env
   SESSION_DRIVER=database
   QUEUE_CONNECTION=database
   ```

8. Cấu hình mail SMTP:

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@gmail.com
   MAIL_PASSWORD=your_app_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email@gmail.com
   MAIL_FROM_NAME="Golden Spoons"
   ```

9. Cấu hình Google OAuth nếu dùng đăng nhập Google:

   ```env
   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret
   GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
   ```

10. Cấu hình SePay/VietQR:

    ```env
    SEPAY_BANK_CODE=your_bank_code
    SEPAY_ACCOUNT_NO=your_account_number
    SEPAY_ACCOUNT_NAME="GOLDEN SPOONS"
    SEPAY_SECRET=your_webhook_secret
    ```

11. Chạy migration và seeder:

    ```bash
    php artisan migrate --seed
    ```

12. Tạo symbolic link cho ảnh upload:

    ```bash
    php artisan storage:link
    ```

13. Build hoặc chạy frontend:

    ```bash
    npm run build
    ```

    Khi phát triển giao diện:

    ```bash
    npm run dev
    ```

14. Khởi động Laravel server:

    ```bash
    php artisan serve
    ```

15. Khởi động queue worker để gửi email bất đồng bộ:

    ```bash
    php artisan queue:work
    ```

### Chạy môi trường phát triển bằng Composer

`composer.json` có script `dev` để chạy đồng thời server Laravel, queue listener, Laravel Pail và Vite:

```bash
composer run dev
```

---

## Hướng dẫn sử dụng

### Tài khoản mẫu

Seeder hiện tạo 2 tài khoản:

| Vai trò | Username   | Email                  | Password   |
| ------- | ---------- | ---------------------- | ---------- |
| Admin   | `admin`    | `admin@example.com`    | `password` |
| Customer| `customer` | `customer@example.com` | `password` |

### Đăng nhập khách hàng

1. Truy cập `http://127.0.0.1:8000/login`
2. Đăng nhập bằng tài khoản customer
3. Sau khi đăng nhập có thể:
   - Xem dashboard khách hàng
   - Tìm kiếm bàn theo ngày, giờ, số khách
   - Đặt bàn và chọn phương thức thanh toán
   - Thanh toán bằng QR chuyển khoản
   - Xem chi tiết và lịch sử đặt bàn
   - Hủy đơn đặt bàn nếu nghiệp vụ cho phép
   - Cập nhật hồ sơ và đổi mật khẩu

### Đăng nhập admin

1. Truy cập `http://127.0.0.1:8000/login`
2. Đăng nhập bằng tài khoản admin
3. Sau khi đăng nhập được chuyển tới `http://127.0.0.1:8000/admin/dashboard`
4. Tại trang admin có thể:
   - Xem dashboard thống kê
   - Quản lý toàn bộ đặt bàn
   - Thêm, sửa, xóa bàn
   - Chuyển trạng thái bàn sang chiếm bàn hoặc giải phóng bàn
   - Xem thống kê doanh thu
   - Xem báo cáo tổng hợp
   - Xuất báo cáo Excel

### Các route chính

| URL | Mục đích |
| --- | -------- |
| `/login` | Đăng nhập |
| `/register` | Đăng ký |
| `/auth/google` | Đăng nhập bằng Google |
| `/verify-email` | Trang xác thực email |
| `/forgot-password` | Quên mật khẩu |
| `/customer/dashboard` | Dashboard khách hàng |
| `/customer/booking` | Danh sách/tìm kiếm bàn |
| `/customer/history` | Lịch sử đặt bàn |
| `/customer/profile` | Hồ sơ khách hàng |
| `/admin/dashboard` | Dashboard admin |
| `/admin/bookings` | Quản lý đặt bàn |
| `/admin/tables` | Quản lý bàn |
| `/admin/revenue` | Thống kê doanh thu |
| `/admin/reports` | Báo cáo tổng hợp |
| `/admin/export` | Xuất Excel |
| `/webhook/sepay` | Webhook thanh toán SePay |
| `/api/sepay/webhook` | Webhook SePay qua API route |

---

### Video demo
- https://youtu.be/0lkIprKQVto?si=WwbyMzPJxDq2I9sH
## Website deploy online 
- Website: https://tadneit07525.site
