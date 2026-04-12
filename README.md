# Website Đặt Bàn Online - Golden Spoons

Dự án xây dựng một hệ thống website đặt bàn online cho nhà hàng **Golden Spoons** sử dụng **Laravel 11** và **Tailwind CSS**. Hệ thống cung cấp đầy đủ chức năng cho **khách hàng** (đặt bàn, xem menu, quản lý lịch sử) và **quản trị viên** (quản lý bàn, đặt bàn, khách hàng, doanh thu, báo cáo).

---

## 👥 Thành viên

| STT | Họ và tên             | Mã sinh viên |
| --- | --------------------- | ------------ |
| 1   | Nguyễn Trịnh Tiến Đạt | 23810310142  |
| 2   | Bùi Minh Đức          | 23810310110  |
| 3   | Đồng Việt Tiến        | 23810310148  |

---

## Phân công công việc

### Nguyễn Trịnh Tiến Đạt - Hệ thống API và Database

- Quản lý database và migration
- Xây dựng API và model

### Đồng Việt Tiến - Giao diện Website Khách Hàng

- Trang Dashboard khách hàng
- Chức năng đặt bàn
- Chức năng xem menu
- Chức năng xem lịch sử đặt bàn
- Chức năng quản lý hồ sơ cá nhân

### Bùi Minh Đức - Giao diện Website Quản Lý (Admin)

- Bảng điều khiển admin
- Quản lý đặt bàn
- Quản lý danh sách bàn
- Quản lý người dùng
- Thống kê doanh thu
- Báo cáo hệ thống

---

## Mục lục

- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Cấu trúc thư mục](#-cấu-trúc-thư-mục)
- [Chức năng chính](#-chức-năng-chính)
- [Hướng dẫn cài đặt](#-hướng-dẫn-cài-đặt)
- [Hướng dẫn sử dụng](#-hướng-dẫn-sử-dụng)
- [Tài liệu SRS](#-tài-liệu-srs)

---

## Công nghệ sử dụng

| Thành phần            | Công nghệ                       | Lý do lựa chọn                                                            |
| --------------------- | ------------------------------- | ------------------------------------------------------------------------- |
| **Framework Backend** | Laravel 11                      | Framework PHP hiện đại, mạnh mẽ, hỗ trợ routing, ORM, migration tuyệt vời |
| **Database**          | MySQL                           | Hệ quản trị cơ sở dữ liệu quan hệ mạnh mẽ, tối ưu, truy vấn SQL chuẩn     |
| **Web Server**        | Apache (XAMPP)                  | Môi trường phát triển cục bộ trọn gói, dễ cài đặt và chạy ngay            |
| **Frontend**          | HTML5, JavaScript, Tailwind CSS | Chuẩn web hiện đại, responsive design, loading nhanh                      |
| **Templating**        | Blade Templates                 | Blade templating engine của Laravel, mạnh mẽ và linh hoạt                 |

---

## Cấu trúc thư mục

```
website/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controllers cho các trang
│   │   ├── Middleware/           # Middleware (Auth, Admin, ...)
│   │   └── UserController.php
│   ├── Models/
│   │   ├── User.php              # Model User
│   │   ├── Table.php             # Model Bàn
│   │   ├── Booking.php           # Model Đặt bàn
│   │   ├── Food.php              # Model Thực đơn
│   │   ├── Order.php             # Model Hóa đơn
│   │   ├── OrderItem.php         # Model Chi tiết hóa đơn
│   │   └── Session.php           # Model Session
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   ├── app.php
│   ├── providers.php
│   └── cache/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── mail.php
│   ├── session.php
│   └── ...
│
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_tables_table.php
│   │   ├── *_create_bookings_table.php
│   │   ├── *_create_foods_table.php
│   │   ├── *_create_orders_table.php
│   │   ├── *_create_order_items_table.php
│   │   └── *_create_sessions_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UsersTableSeeder.php
│       ├── TablesTableSeeder.php
│       └── FoodsTableSeeder.php
│
├── public/
│   ├── index.php                 # Entry point
│   └── robots.txt
│
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php   # Trang đăng nhập
│       │   └── register.blade.php  # Trang đăng ký
│       ├── customer/
│       │   └── dashboard.blade.php # Dashboard khách hàng (Danh sách bàn)
│       ├── booking/
│       │   ├── search.blade.php  # Đặt bàn (tìm kiếm)
│       │   ├── history.blade.php # Lịch sử đặt bàn
│       │   └── menu.blade.php    # Thực đơn
│       ├── profile/
│       │   └── profile.blade.php # Quản lý hồ sơ cá nhân
│       └── admin/
│           ├── dashboard.blade.php    # Dashboard admin
│           ├── bookings.blade.php     # Quản lý đặt bàn
│           ├── tables.blade.php       # Quản lý bàn
│           ├── users.blade.php        # Quản lý người dùng
│           ├── revenue.blade.php      # Thống kê doanh thu
│           └── reports.blade.php      # Báo cáo hệ thống
│
├── routes/
│   ├── web.php                   # Routes chính cho web
│   └── api.php                   # Routes API
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .env                          # Biến môi trường
├── composer.json                 # Dependencies PHP
├── package.json                  # Dependencies Node.js
├── tailwind.config.js            # Config Tailwind CSS
├── vite.config.js                # Config Vite
└── artisan                        # Laravel CLI tool
```

---

## Cơ sở dữ liệu

**Database**: `website` | **Engine**: InnoDB | **Charset**: UTF-8

### Bảng chính:

- **users** – Lưu thông tin người dùng (khách hàng, admin)
- **tables** – Danh sách các bàn trong nhà hàng (tên, sức chứa, trạng thái)
- **bookings** – Lịch sử đặt bàn (ngày, giờ, người dùng, bàn, trạng thái)
- **foods** – Danh sách thực đơn (tên, giá, mô tả)
- **orders** – Hóa đơn (tổng tiền, trạng thái)
- **order_items** – Chi tiết hóa đơn (món ăn, số lượng, giá)
- **sessions** – Lưu session người dùng

---

## Chức năng chính

### Phía Khách Hàng (Customer)

| Chức năng           | Mô tả                                                             |
| ------------------- | ----------------------------------------------------------------- |
| **Dashboard**       | Hiển thị danh sách bàn với trạng thái (Trống/Đã đặt/Đang sử dụng) |
| **Đặt Bàn**         | Tìm kiếm và đặt bàn theo số lượng khách, ngày, giờ                |
| **Lịch Sử Đặt Bàn** | Xem lịch sử các đặt bàn của khách hàng                            |
| **Thực Đơn**        | Xem danh sách menu các món ăn                                     |
| **Hồ Sơ Cá Nhân**   | Xem và chỉnh sửa thông tin tài khoản                              |
| **Đăng Ký**         | Tạo tài khoản khách hàng mới                                      |
| **Đăng Nhập**       | Xác thực người dùng                                               |
| **Đăng Xuất**       | Thoát khỏi hệ thống                                               |

### Phía Quản Trị Viên (Admin)

| Chức năng              | Mô tả                                                   |
| ---------------------- | ------------------------------------------------------- |
| **Dashboard**          | Tổng quan thống kê, các chỉ số hoạt động                |
| **Quản Lý Đặt Bàn**    | Xem danh sách, cập nhật trạng thái đặt bàn              |
| **Quản Lý Bàn**        | CRUD bàn (thêm, sửa, xóa), quản lý sức chứa, trạng thái |
| **Quản Lý Người Dùng** | Xem danh sách khách hàng, quản lý tài khoản             |
| **Thống Kê Doanh Thu** | Xem doanh thu theo ngày, tháng, năm                     |
| **Báo Cáo**            | Báo cáo tồn kho, hoạt động, khách hàng                  |

---

## Hướng dẫn cài đặt

### Yêu cầu hệ thống

- **PHP** >= 8.3
- **Composer** (để cài đặt dependencies Laravel)
- **Node.js** >= 16 (để build Tailwind CSS với Vite)
- **MySQL** >= 5.7
- **XAMPP** hoặc máy chủ web tương tự

### Các bước cài đặt

1. **Clone hoặc tải source code**:

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

4. **Tạo file .env từ template**:

   ```bash
   copy .env.example .env
   ```

5. **Sinh Application Key**:

   ```bash
   php artisan key:generate
   ```

6. **Cấu hình Database trong file .env**:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=website
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Chạy migration để tạo bảng**:

   ```bash
   php artisan migrate
   ```

8. **Chạy seeder để thêm dữ liệu mẫu** (tùy chọn):

   ```bash
   php artisan db:seed
   ```

9. **Build Tailwind CSS**:

   ```bash
   npm run dev
   ```

10. **Khởi động development server**:

    ```bash
    php artisan serve
    ```

11. **Truy cập ứng dụng**:
    - Trang khách hàng: `http://127.0.0.1:8000/customer/dashboard`
    - Trang admin: `http://127.0.0.1:8000/admin/dashboard`

---

## Hướng dẫn sử dụng

### Đăng Nhập Khách Hàng

1. Truy cập `http://127.0.0.1:8000/login`
2. Nhập tên đăng nhập và mật 
- username: customer
- password: password
3. Nhấn "Đăng nhập"
4. Sau khi đăng nhập, khách hàng có thể:
   - Xem danh sách bàn trên Dashboard
   - Đặt bàn bằng cách truy cập menu "Đặt bàn"
   - Xem lịch sử đặt bàn
   - Xem menu thực đơn
   - Cập nhật hồ sơ cá nhân

### Đăng Nhập Admin

1. Truy cập `http://127.0.0.1:8000/login`
2. Đăng nhập với tài khoản admin
- username: admin
- password: password
3. Chuyển hướng tới `http://127.0.0.1:8000/admin/dashboard`
4. Tại trang admin, quản trị viên có thể:
   - Xem tổng quan thống kê
   - Quản lý đặt bàn
   - Quản lý danh sách bàn
   - Quản lý người dùng
   - Xem thống kê doanh thu
   - Xem báo cáo hệ thống

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
- File `.env` chứa thông tin nhạy cảm, không nên commit lên Git
- Tất cả routes được định nghĩa trong `routes/web.php`
- Sử dụng Blade template syntax trong các file view

---
