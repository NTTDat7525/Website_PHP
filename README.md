# Website Đặt Bàn Online - Golden Spoons

Hệ thống website đặt bàn online cho nhà hàng **Golden Spoons** xây dựng trên **Laravel 13** và **Tailwind CSS**. Hệ thống hỗ trợ đầy đủ luồng nghiệp vụ cho **khách hàng** (tìm bàn, đặt bàn, thanh toán VietQR, xem lịch sử) và **quản trị viên** (quản lý bàn, đặt bàn, thống kê doanh thu, xuất báo cáo Excel).

---

## Thành viên

| STT | Họ và tên             | Mã sinh viên |
| --- | --------------------- | ------------ |
| 1   | Nguyễn Trịnh Tiến Đạt | 23810310142  |
| 2   | Bùi Minh Đức          | 23810310110  |
| 3   | Đồng Việt Tiến        | 23810310148  |

---

## Mục lục

- [Công nghệ sử dụng](#công-nghệ-sử-dụng)
- [Cấu trúc thư mục](#cấu-trúc-thư-mục)
- [Cơ sở dữ liệu](#cơ-sở-dữ-liệu)
- [Chức năng chính](#chức-năng-chính)
- [Hướng dẫn cài đặt](#hướng-dẫn-cài-đặt)
- [Hướng dẫn sử dụng](#hướng-dẫn-sử-dụng)
- [Tài liệu SRS](#tài-liệu-srs)

---

## Công nghệ sử dụng

| Thành phần            | Công nghệ                         | Phiên bản |
| --------------------- | --------------------------------- | --------- |
| **Framework Backend** | Laravel                           | 13.x      |
| **Ngôn ngữ**          | PHP                               | >= 8.3    |
| **Database**          | MySQL                             | >= 5.7    |
| **Frontend**          | HTML5, JavaScript, Tailwind CSS   | —         |
| **Templating**        | Blade Templates                   | (Laravel) |
| **Build Tool**        | Vite                              | —         |
| **Web Server**        | Apache (XAMPP)                    | —         |
| **OAuth**             | Laravel Socialite (Google OAuth2) | ^5.26     |
| **Queue / Jobs**      | Laravel Queue (database driver)   | (Laravel) |
| **Email**             | Laravel Mail (SMTP)               | (Laravel) |
| **Export Excel**      | Maatwebsite Excel                 | ^3.1      |
| **QR Thanh toán**     | VietQR API                        | —         |

---

## Cấu trúc thư mục

```
website/
├── app/
│   ├── Exports/
│   │   └── ReportsExport.php          # Export báo cáo ra file Excel
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php    # Dashboard & thống kê admin
│   │   │   ├── AuthController.php     # Đăng ký, đăng nhập, OAuth Google, profile
│   │   │   ├── BookingController.php  # Toàn bộ luồng đặt bàn của khách hàng
│   │   │   ├── PaymentController.php  # Tích hợp VietQR, xác nhận thanh toán
│   │   │   ├── ReportController.php   # Báo cáo tổng hợp & xuất Excel
│   │   │   ├── RevenueController.php  # Thống kê doanh thu theo ngày/tháng
│   │   │   └── TableController.php    # CRUD quản lý bàn (admin)
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php    # Chặn route admin nếu không phải admin
│   │       └── UserMiddleware.php     # Chặn route customer nếu chưa đăng nhập
│   ├── Jobs/
│   │   └── SendPaymentSuccessEmailJob.php  # Job gửi email sau thanh toán (async)
│   ├── Mail/
│   │   └── PaymentSuccessMail.php     # Mailable gửi email xác nhận đặt bàn
│   ├── Models/
│   │   ├── User.php                   # Model người dùng
│   │   ├── Table.php                  # Model bàn nhà hàng
│   │   ├── Booking.php                # Model đặt bàn
│   │   └── Session.php                # Model phiên đăng nhập
│   └── Providers/
│       └── AppServiceProvider.php
│
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_tables_table.php
│   │   ├── *_create_bookings_table.php
│   │   ├── *_create_sessions_table.php
│   │   ├── *_create_jobs_table.php
│   │   └── *_add_name_to_users_table.php
│   └── seeders/
│       ├── UsersTableSeeder.php
│       └── TablesTableSeeder.php
│
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php         # Trang đăng nhập
│       │   └── register.blade.php      # Trang đăng ký
│       ├── customer/
│       │   ├── dashboard.blade.php     # Trang chủ khách hàng
│       │   ├── listTable.blade.php     # Danh sách bàn có thể đặt
│       │   ├── booking.blade.php       # Form đặt bàn
│       │   ├── confirmBooking.blade.php# Xác nhận & thanh toán VietQR
│       │   ├── detailBooking.blade.php # Chi tiết một đơn đặt bàn
│       │   ├── history.blade.php       # Lịch sử đặt bàn
│       │   └── profile.blade.php       # Hồ sơ cá nhân
│       ├── admin/
│       │   ├── dashboard.blade.php     # Dashboard admin (thống kê, biểu đồ)
│       │   ├── bookings.blade.php      # Quản lý đặt bàn
│       │   ├── tables.blade.php        # Quản lý danh sách bàn
│       │   ├── revenue.blade.php       # Thống kê doanh thu
│       │   ├── reports.blade.php       # Báo cáo tổng hợp
│       │   └── sidebar.blade.php       # Sidebar dùng chung cho admin
│       └── emails/
│           └── (template email)
│
├── routes/
│   ├── web.php                        # Routes Web (auth, customer, admin)
│   └── api.php                        # Routes API (xác nhận thanh toán)
│
├── .env                               # Biến môi trường
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── artisan
```

---

## Cơ sở dữ liệu

**Database**: `website` | **Engine**: InnoDB | **Charset**: UTF-8

### Sơ đồ quan hệ (ERD)

```
┌──────────────────────────────┐        ┌──────────────────────────────────────────┐
│           users              │        │               bookings                   │
├──────────────────────────────┤        ├──────────────────────────────────────────┤
│ id            BIGINT (PK)    │◄──┐    │ id              BIGINT (PK)              │
│ name          VARCHAR        │   └────│ user_id         BIGINT (FK → users.id)   │
│ username      VARCHAR UNIQUE │        │ table_id        BIGINT (FK → tables.id)  │
│ email         VARCHAR UNIQUE │        │ date            DATE                      │
│ password      VARCHAR        │        │ time            TIME                      │
│ phone         VARCHAR        │        │ guest_count     INT                       │
│ bio           TEXT           │        │ email           VARCHAR                   │
│ role          ENUM           │        │ phone           VARCHAR                   │
│               (customer/     │        │ special_requests TEXT                     │
│                admin)        │        │ total_price     BIGINT                    │
│ created_at    TIMESTAMP      │        │ status          ENUM                      │
│ updated_at    TIMESTAMP      │        │                 (pending/confirmed/       │
└──────────────────────────────┘        │                  cancelled)              │
          │                             │ payment_method  ENUM                      │
          │ 1                           │                 (Chuyển khoản/Tiền mặt)  │
          │                             │ payment_status  ENUM (unpaid/paid)        │
          │ N                           │ created_at      TIMESTAMP                 │
          ▼                             │ updated_at      TIMESTAMP                 │
┌──────────────────────────────┐        └──────────────────────────────────────────┘
│           sessions           │                   ▲
├──────────────────────────────┤                   │ N
│ id            BIGINT (PK)    │        ┌──────────┴───────────────────────────────┐
│ user_id       BIGINT         │        │               tables                     │
│               (FK→users.id)  │        ├──────────────────────────────────────────┤
│ ip_address    VARCHAR(45)    │        │ id            BIGINT (PK)                │
│ user_agent    TEXT           │        │ name          VARCHAR UNIQUE             │
│ payload       TEXT           │        │ capacity      INT                        │
│ last_activity INT            │        │ location      VARCHAR                    │
└──────────────────────────────┘        │               (Sảnh chính/Sân thượng/    │
                                        │                Khu VIP)                  │
┌──────────────────────────────┐        │ image         VARCHAR                    │
│             jobs             │        │ status        ENUM                       │
├──────────────────────────────┤        │               (available/reserved/       │
│ id            BIGINT (PK)    │        │                occupied)                 │
│ queue         VARCHAR        │        │ price         BIGINT                     │
│ payload       LONGTEXT       │        │ created_at    TIMESTAMP                  │
│ attempts      TINYINT        │        │ updated_at    TIMESTAMP                  │
│ reserved_at   INT            │        └──────────────────────────────────────────┘
│ available_at  INT            │
│ created_at    INT            │
└──────────────────────────────┘
  (Bảng hàng đợi gửi email async)
```

### Quan hệ giữa các bảng (Eloquent Relationships)

| Model     | Quan hệ     | Model liên kết | Mô tả                                        |
| --------- | ----------- | -------------- | -------------------------------------------- |
| `User`    | `hasMany`   | `Booking`      | Một user có nhiều đơn đặt bàn                |
| `User`    | `hasMany`   | `Session`      | Một user có nhiều phiên đăng nhập            |
| `Table`   | `hasMany`   | `Booking`      | Một bàn có thể được đặt nhiều lần (khác giờ) |
| `Booking` | `belongsTo` | `User`         | Đơn đặt bàn thuộc về một user                |
| `Booking` | `belongsTo` | `Table`        | Đơn đặt bàn thuộc về một bàn cụ thể          |
| `Session` | `belongsTo` | `User`         | Phiên đăng nhập thuộc về một user            |

### Ràng buộc khoá ngoại

- `bookings.user_id` → `users.id` (CASCADE DELETE)
- `bookings.table_id` → `tables.id` (CASCADE DELETE)
- `sessions.user_id` → `users.id` (CASCADE DELETE)

---

## Chức năng chính

### Xác thực người dùng (Authentication)

| Chức năng             | Mô tả                                                        |
| --------------------- | ------------------------------------------------------------ |
| **Đăng ký tài khoản** | Tạo tài khoản mới với username, email, mật khẩu              |
| **Đăng nhập**         | Xác thực bằng username + password, phân quyền admin/customer |
| **Đăng xuất**         | Hủy session, redirect về trang đăng nhập                     |
| **Đăng nhập Google**  | OAuth2 qua Laravel Socialite, liên kết tài khoản Google      |

### Phía Khách Hàng (Customer)

| Chức năng                 | Mô tả                                                                 |
| ------------------------- | --------------------------------------------------------------------- |
| **Dashboard**             | Trang chủ sau đăng nhập, tổng quan hệ thống                           |
| **Tìm kiếm bàn**          | Lọc bàn theo ngày, giờ, số lượng khách; ẩn bàn đã được đặt trùng lịch |
| **Xem danh sách bàn**     | Xem tất cả bàn có trạng thái, sức chứa, vị trí, giá                   |
| **Đặt bàn**               | Form đặt bàn: ngày, giờ, số khách, ghi chú, phương thức thanh toán    |
| **Xác nhận & Thanh toán** | Hiển thị mã QR VietQR, tự động xác nhận khi thanh toán thành công     |
| **Huỷ đặt bàn**           | Khách hàng có thể huỷ đơn đang ở trạng thái pending                   |
| **Xem chi tiết đặt bàn**  | Xem đầy đủ thông tin một đơn đặt bàn cụ thể                           |
| **Lịch sử đặt bàn**       | Danh sách toàn bộ đơn đặt bàn của khách hàng, sắp xếp mới nhất trước  |
| **Hồ sơ cá nhân**         | Xem & cập nhật tên, số điện thoại, tiểu sử; thống kê đặt bàn          |
| **Email xác nhận**        | Gửi email tự động sau khi thanh toán thành công (qua Queue Job)       |

### Phía Quản Trị Viên (Admin)

| Chức năng              | Mô tả                                                                            |
| ---------------------- | -------------------------------------------------------------------------------- |
| **Dashboard**          | Thống kê: đặt bàn hôm nay, bàn trống, doanh thu tháng, tổng user, biểu đồ 7 ngày |
| **Quản lý đặt bàn**    | Xem toàn bộ danh sách đặt bàn kèm thông tin user & bàn                           |
| **Quản lý bàn**        | CRUD bàn: thêm mới, sửa (tên, sức chứa, vị trí, giá, ảnh, trạng thái), xóa       |
| **Thống kê doanh thu** | Doanh thu tháng hiện tại; bảng doanh thu theo từng ngày (10 ngày gần nhất)       |
| **Báo cáo tổng hợp**   | Thống kê bàn theo trạng thái, tổng đặt bàn, tổng doanh thu, tổng & mới user      |
| **Xuất báo cáo Excel** | Xuất file `.xlsx` toàn bộ dữ liệu báo cáo qua Maatwebsite Excel                  |

---

## Hướng dẫn cài đặt

### Yêu cầu hệ thống

- **PHP** >= 8.3
- **Composer** >= 2.x
- **Node.js** >= 18
- **MySQL** >= 5.7
- **XAMPP** hoặc server tương đương

### Các bước cài đặt

1. **Di chuyển vào thư mục dự án**:

   ```bash
   cd website
   ```

2. **Cài đặt dependencies PHP**:

   ```bash
   composer install
   ```

3. **Cài đặt dependencies Node.js**:

   ```bash
   npm install
   ```

4. **Tạo file `.env` từ template**:

   ```bash
   copy .env.example .env
   ```

5. **Sinh Application Key**:

   ```bash
   php artisan key:generate
   ```

6. **Cấu hình Database trong file `.env`**:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=website
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Cấu hình Mail (SMTP) trong file `.env`** (để gửi email xác nhận):

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

8. **Cấu hình Google OAuth** (tùy chọn) trong `.env`:

   ```env
   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret
   GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
   ```

9. **Chạy migration để tạo bảng**:

   ```bash
   php artisan migrate
   ```

10. **Chạy seeder để thêm dữ liệu mẫu**:

    ```bash
    php artisan db:seed
    ```

11. **Build Tailwind CSS**:

    ```bash
    npm run dev
    ```

12. **Khởi động development server**:

    ```bash
    php artisan serve
    ```

13. **Khởi động Queue Worker** (để gửi email async):

    ```bash
    php artisan queue:work
    ```

14. **Truy cập ứng dụng**:
    - Trang đăng nhập: `http://127.0.0.1:8000/login`
    - Trang khách hàng: `http://127.0.0.1:8000/customer/dashboard`
    - Trang admin: `http://127.0.0.1:8000/admin/dashboard`

---

## Hướng dẫn sử dụng

### Đăng nhập Khách Hàng

1. Truy cập `http://127.0.0.1:8000/login`
2. Nhập thông tin:
   - username: `customer`
   - password: `password`
3. Sau khi đăng nhập có thể:
   - Tìm kiếm bàn theo ngày, giờ, số khách
   - Đặt bàn và thanh toán qua VietQR
   - Xem lịch sử và chi tiết đặt bàn
   - Huỷ đặt bàn (trạng thái pending)
   - Cập nhật hồ sơ cá nhân

### Đăng nhập Admin

1. Truy cập `http://127.0.0.1:8000/login`
2. Nhập thông tin:
   - username: `admin`
   - password: `password`
3. Sau khi đăng nhập được chuyển tới `http://127.0.0.1:8000/admin/dashboard`
4. Tại trang admin có thể:
   - Xem tổng quan thống kê và biểu đồ doanh thu
   - Quản lý toàn bộ đơn đặt bàn
   - Thêm, sửa, xóa bàn nhà hàng
   - Xem thống kê doanh thu theo ngày
   - Xem và xuất báo cáo tổng hợp ra Excel

---

## Tài liệu SRS

Tất cả tài liệu đặc tả yêu cầu phần mềm (SRS) được lưu trong thư mục `DOCS/`:

| File                                                      | Mô tả                                      |
| --------------------------------------------------------- | ------------------------------------------ |
| [`DECUONG.md`](DOCS/DECUONG.md)                           | Đề cương chức năng tổng quan toàn hệ thống |
| [`SRS_DatBan.md`](DOCS/SRS_DatBan.md)                     | Đặc tả chức năng đặt bàn                   |
| [`SRS_QuanLyBan.md`](DOCS/SRS_QuanLyBan.md)               | Đặc tả quản lý bàn                         |
| [`SRS_QuanLyDon.md`](DOCS/SRS_QuanLyDon.md)               | Đặc tả quản lý hóa đơn                     |
| [`SRS_QuanLyDatBan.md`](DOCS/SRS_QuanLyDatBan.md)         | Đặc tả quản lý đặt bàn                     |
| [`SRS_QuanLyTaiKhoan.md`](DOCS/SRS_QuanLyTaiKhoan.md)     | Đặc tả quản lý tài khoản                   |
| [`SRS_ThongKeDoanhThu.md`](DOCS/SRS_ThongKeDoanhThu.md)   | Đặc tả thống kê doanh thu                  |
| [`SRS_TimKiemBan.md`](DOCS/SRS_TimKiemBan.md)             | Đặc tả tìm kiếm bàn                        |
| [`SRS_XacThucNguoiDung.md`](DOCS/SRS_XacThucNguoiDung.md) | Đặc tả xác thực người dùng                 |
| [`SRS_XemLichSuDatBan.md`](DOCS/SRS_XemLichSuDatBan.md)   | Đặc tả xem lịch sử đặt bàn                 |

---

## Ghi chú quan trọng

- Đảm bảo MySQL server đang chạy trước khi khởi động ứng dụng
- File `.env` chứa thông tin nhạy cảm, không commit lên Git
- Phải chạy `php artisan queue:work` để email xác nhận được gửi sau thanh toán
- Tất cả routes được định nghĩa trong `routes/web.php` và `routes/api.php`
- Ảnh bàn được lưu trong `storage/app/public/table/`; cần chạy `php artisan storage:link` lần đầu
