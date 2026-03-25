# SOFTWARE REQUIREMENTS SPECIFICATION
## Ứng dụng Đặt Bàn Nhà Hàng Trực Tuyến — MobileProject

| Thông tin | Chi tiết |
|-----------|----------|
| Phiên bản | 1.0 |
| Ngày tạo | 25/03/2026 |
| Nền tảng | React Native / Flutter |
| Người dùng | Khách hàng, Admin hệ thống |

---

## Mục lục

1. [Giới thiệu](#1-giới-thiệu)
2. [Mô tả tổng quan hệ thống](#2-mô-tả-tổng-quan-hệ-thống)
3. [Yêu cầu chức năng](#3-yêu-cầu-chức-năng)
   - [UC-01: Đăng ký / Đăng nhập](#uc-01-đăng-ký--đăng-nhập)
   - [UC-02: Tìm kiếm & Xem nhà hàng](#uc-02-tìm-kiếm--xem-nhà-hàng)
   - [UC-03: Đặt bàn & Chọn thời gian](#uc-03-đặt-bàn--chọn-thời-gian)
   - [UC-04: Quản lý đặt bàn](#uc-04-quản-lý-đặt-bàn-xác-nhận-huỷ)
   - [UC-05: Thanh toán online](#uc-05-thanh-toán-online)
   - [UC-06: Đánh giá & Bình luận](#uc-06-đánh-giá--bình-luận)
   - [UC-07: Thông báo đẩy](#uc-07-thông-báo-đẩy-push-notification)
   - [UC-08: Quản lý Menu nhà hàng](#uc-08-quản-lý-menu-nhà-hàng)
4. [Yêu cầu phi chức năng](#4-yêu-cầu-phi-chức-năng-nfr)
5. [Ma trận truy xuất yêu cầu](#5-ma-trận-truy-xuất-yêu-cầu)

---

## 1. Giới thiệu

### 1.1 Mục đích

Tài liệu này mô tả các yêu cầu phần mềm (SRS) cho ứng dụng di động đặt bàn nhà hàng trực tuyến. Hệ thống cho phép khách hàng tìm kiếm, đặt bàn và thanh toán trực tuyến; đồng thời cung cấp công cụ quản lý toàn diện cho Admin hệ thống.

### 1.2 Phạm vi

Ứng dụng phục vụ 2 nhóm người dùng chính:

- **Khách hàng (Customer):** Tìm kiếm nhà hàng, đặt bàn, thanh toán và đánh giá dịch vụ.
- **Admin hệ thống:** Quản lý nhà hàng, menu, đơn đặt bàn và người dùng.

Ứng dụng hoạt động trên nền tảng mobile iOS và Android, sử dụng công nghệ React Native hoặc Flutter.

### 1.3 Định nghĩa & Từ viết tắt

| Thuật ngữ | Giải thích |
|-----------|------------|
| SRS | Software Requirements Specification — Tài liệu đặc tả yêu cầu phần mềm |
| FR | Functional Requirement — Yêu cầu chức năng |
| NFR | Non-Functional Requirement — Yêu cầu phi chức năng |
| UC | Use Case — Kịch bản sử dụng |
| Admin | Quản trị viên hệ thống |
| KH | Khách hàng — Người dùng cuối của ứng dụng |
| API | Application Programming Interface |
| JWT | JSON Web Token — Cơ chế xác thực |

---

## 2. Mô tả tổng quan hệ thống

### 2.1 Người dùng hệ thống

| Người dùng | Mô tả | Quyền hạn |
|------------|-------|-----------|
| Khách hàng | Người dùng cuối sử dụng app để tìm nhà hàng, đặt bàn, thanh toán và đánh giá | Xem, đặt bàn, thanh toán, đánh giá |
| Admin | Quản trị viên quản lý toàn bộ dữ liệu nhà hàng, menu, đơn đặt và người dùng | Toàn quyền quản lý hệ thống |

### 2.2 Môi trường hoạt động

| Thành phần | Mô tả |
|------------|-------|
| Nền tảng | iOS 13+ và Android 8.0+ |
| Kết nối | Internet (WiFi / 4G/5G) |
| Công nghệ | React Native hoặc Flutter |
| Backend | REST API / Firebase |
| Thanh toán | VNPay / Momo / Stripe |
| Thông báo | Firebase Cloud Messaging (FCM) |

---

## 3. Yêu cầu chức năng

---

### UC-01: Đăng ký / Đăng nhập

**Mô tả:** Khách hàng tạo tài khoản và đăng nhập vào hệ thống để sử dụng các tính năng cá nhân hóa.

**Người dùng liên quan:** Khách hàng, Admin

#### Luồng chính

1. Người dùng mở ứng dụng → chọn "Đăng ký" hoặc "Đăng nhập"
2. Nhập thông tin (tên, email, mật khẩu) hoặc chọn đăng nhập Google/Facebook
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
| FR-01.2 | Hỗ trợ đăng nhập bằng Google / Facebook (OAuth 2.0) |
| FR-01.3 | Mật khẩu phải có ít nhất 8 ký tự, gồm chữ và số |
| FR-01.4 | Hệ thống gửi email xác nhận sau khi đăng ký thành công |
| FR-01.5 | Hỗ trợ chức năng quên mật khẩu qua email OTP |
| FR-01.6 | Admin đăng nhập qua giao diện riêng với phân quyền đặc biệt |
| FR-01.7 | Lưu trạng thái đăng nhập (Remember me) trong 30 ngày |

> **Điều kiện tiên quyết:** Ứng dụng đã được cài đặt, kết nối internet ổn định.
>
> **Điều kiện hậu:** Người dùng được xác thực và có session JWT hợp lệ.

---

### UC-02: Tìm kiếm & Xem nhà hàng

**Mô tả:** Khách hàng tìm kiếm nhà hàng theo tên, địa điểm, loại ẩm thực hoặc duyệt danh sách nhà hàng nổi bật.

**Người dùng liên quan:** Khách hàng

#### Luồng chính

1. Khách hàng vào màn hình tìm kiếm
2. Nhập từ khóa (tên nhà hàng, khu vực, loại món ăn)
3. Hệ thống hiển thị danh sách kết quả phù hợp
4. Khách hàng chọn nhà hàng → xem chi tiết (ảnh, địa chỉ, menu, đánh giá, giờ mở cửa)

#### Luồng thay thế

- Không tìm thấy kết quả → gợi ý nhà hàng tương tự
- Không có kết nối mạng → hiển thị lịch sử tìm kiếm cache
- Vị trí GPS không khả dụng → nhập địa chỉ thủ công

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-02.1 | Tìm kiếm nhà hàng theo tên, địa chỉ, loại ẩm thực |
| FR-02.2 | Lọc kết quả theo khoảng giá, đánh giá sao, khu vực |
| FR-02.3 | Hiển thị danh sách nhà hàng nổi bật / gợi ý trên trang chủ |
| FR-02.4 | Xem chi tiết nhà hàng: ảnh, địa chỉ, giờ mở cửa, số điện thoại |
| FR-02.5 | Xem menu nhà hàng (danh sách món ăn, giá, mô tả, ảnh) |
| FR-02.6 | Xem đánh giá & bình luận của khách hàng khác |
| FR-02.7 | Tìm kiếm theo vị trí hiện tại (GPS / Location Services) |
| FR-02.8 | Sắp xếp kết quả theo: gần nhất, đánh giá cao nhất, mới nhất |

> **Điều kiện tiên quyết:** Có kết nối internet. Dữ liệu nhà hàng đã được Admin cập nhật.
>
> **Điều kiện hậu:** Hiển thị đúng thông tin nhà hàng được chọn.

---

### UC-03: Đặt bàn & Chọn thời gian

**Mô tả:** Khách hàng thực hiện đặt bàn tại nhà hàng đã chọn, chỉ định ngày giờ, số lượng khách và yêu cầu đặc biệt.

**Người dùng liên quan:** Khách hàng

#### Luồng chính

1. Khách hàng chọn nhà hàng → nhấn "Đặt bàn"
2. Chọn ngày, giờ, số lượng người (người lớn, trẻ em)
3. Chọn khu vực / loại bàn (trong nhà, ngoài trời, phòng riêng)
4. Nhập yêu cầu đặc biệt: dị ứng thực phẩm, dịp đặc biệt, v.v.
5. Xác nhận thông tin → chuyển sang thanh toán hoặc gửi yêu cầu
6. Hệ thống tạo đơn đặt bàn và gửi thông báo xác nhận

#### Luồng thay thế

- Khung giờ đã hết chỗ → gợi ý khung giờ khác còn trống
- Người dùng chưa đăng nhập → yêu cầu đăng nhập trước
- Nhà hàng đóng cửa vào ngày chọn → thông báo và gợi ý ngày khác

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-03.1 | Cho phép chọn ngày và giờ đặt bàn từ lịch/calendar |
| FR-03.2 | Hiển thị các khung giờ còn trống / đã đầy theo thời gian thực |
| FR-03.3 | Nhập số lượng khách (người lớn và trẻ em riêng biệt) |
| FR-03.4 | Chọn loại bàn / khu vực ngồi phù hợp |
| FR-03.5 | Nhập ghi chú / yêu cầu đặc biệt (tối đa 500 ký tự) |
| FR-03.6 | Xem lại toàn bộ thông tin trước khi xác nhận đặt bàn |
| FR-03.7 | Gửi xác nhận đặt bàn qua email / SMS / thông báo đẩy |
| FR-03.8 | Khách hàng có thể xem lịch sử đặt bàn của mình |

> **Điều kiện tiên quyết:** Khách hàng đã đăng nhập. Nhà hàng còn chỗ trống trong khung giờ được chọn.
>
> **Điều kiện hậu:** Đơn đặt bàn được tạo với trạng thái "Chờ xác nhận".

---

### UC-04: Quản lý đặt bàn (Xác nhận, Huỷ)

**Mô tả:** Admin xem và xử lý các đơn đặt bàn; Khách hàng có thể huỷ đơn của mình theo chính sách quy định.

**Người dùng liên quan:** Admin, Khách hàng

#### Luồng chính

1. Admin vào danh sách đơn đặt bàn, lọc theo trạng thái
2. Xem chi tiết từng đơn (thông tin khách, thời gian, số người, yêu cầu đặc biệt)
3. Xác nhận hoặc từ chối đơn kèm theo lý do
4. Hệ thống gửi thông báo đến khách hàng về trạng thái đơn

#### Luồng thay thế

- Khách hàng huỷ đơn trước thời gian quy định → xử lý hoàn tiền tự động
- Admin không phản hồi trong 2 giờ → tự động xác nhận đơn
- Đơn quá hạn khung giờ → tự động huỷ và thông báo khách

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-04.1 | Admin xem danh sách tất cả đơn đặt bàn, lọc theo trạng thái |
| FR-04.2 | Admin xác nhận hoặc từ chối đơn đặt bàn kèm lý do |
| FR-04.3 | Cập nhật trạng thái đơn: Chờ xác nhận → Đã xác nhận → Hoàn thành / Huỷ |
| FR-04.4 | Khách hàng huỷ đơn trước thời gian quy định (VD: trước 2 giờ) |
| FR-04.5 | Tự động huỷ đơn nếu Admin không phản hồi trong thời gian quy định |
| FR-04.6 | Lưu lịch sử toàn bộ trạng thái đơn để truy vết |
| FR-04.7 | Admin xem thống kê đơn theo ngày / tuần / tháng |

> **Điều kiện tiên quyết:** Đơn đặt bàn đã được tạo với trạng thái "Chờ xác nhận".
>
> **Điều kiện hậu:** Trạng thái đơn được cập nhật và khách hàng được thông báo.

---

### UC-05: Thanh toán online

**Mô tả:** Khách hàng thanh toán đặt cọc hoặc toàn bộ hóa đơn trực tuyến thông qua cổng thanh toán tích hợp.

**Người dùng liên quan:** Khách hàng

#### Luồng chính

1. Sau khi xác nhận đặt bàn → chuyển đến màn hình thanh toán
2. Chọn phương thức thanh toán (VNPay, Momo, thẻ ngân hàng)
3. Nhập thông tin thanh toán hoặc quét mã QR
4. Hệ thống xử lý và xác nhận giao dịch
5. Hiển thị biên lai và gửi xác nhận qua email

#### Luồng thay thế

- Giao dịch thất bại → thông báo lỗi, cho phép thử lại
- Hết thời gian thanh toán (timeout 15 phút) → huỷ đơn và thông báo
- Hoàn tiền khi khách huỷ đúng chính sách → xử lý trong 3–5 ngày làm việc

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-05.1 | Tích hợp cổng thanh toán VNPay / Momo / Stripe |
| FR-05.2 | Hỗ trợ thanh toán bằng mã QR |
| FR-05.3 | Hỗ trợ thanh toán đặt cọc (partial) hoặc toàn bộ |
| FR-05.4 | Hiển thị tóm tắt thanh toán trước khi xác nhận |
| FR-05.5 | Gửi biên lai thanh toán qua email sau giao dịch thành công |
| FR-05.6 | Xử lý hoàn tiền khi khách huỷ đơn đúng chính sách |
| FR-05.7 | Lưu lịch sử giao dịch của khách hàng |
| FR-05.8 | Mã hoá thông tin thanh toán theo chuẩn PCI-DSS |

> **Điều kiện tiên quyết:** Đơn đặt bàn đã được tạo. Khách hàng đã đăng nhập.
>
> **Điều kiện hậu:** Giao dịch được ghi nhận, trạng thái đơn cập nhật sang "Đã thanh toán".

---

### UC-06: Đánh giá & Bình luận

**Mô tả:** Sau khi sử dụng dịch vụ, khách hàng có thể đánh giá và để lại bình luận về nhà hàng.

**Người dùng liên quan:** Khách hàng, Admin

#### Luồng chính

1. Sau khi đơn hoàn thành → hệ thống nhắc nhở khách đánh giá
2. Khách hàng vào đơn → chọn "Đánh giá"
3. Chọn số sao (1–5) và nhập nội dung bình luận
4. Tải ảnh thực tế (tuỳ chọn, tối đa 3 ảnh)
5. Gửi đánh giá → hiển thị công khai trên trang nhà hàng

#### Luồng thay thế

- Admin ẩn / xoá bình luận vi phạm chính sách
- Khách hàng chỉnh sửa đánh giá trong vòng 24 giờ sau khi gửi
- Khách hàng báo cáo bình luận không hợp lệ của người khác

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-06.1 | Chỉ khách hàng đã hoàn thành đơn mới được đánh giá |
| FR-06.2 | Đánh giá theo thang điểm sao từ 1 đến 5 |
| FR-06.3 | Cho phép nhập bình luận văn bản tối đa 500 ký tự |
| FR-06.4 | Cho phép đính kèm tối đa 3 ảnh thực tế |
| FR-06.5 | Hiển thị điểm đánh giá trung bình trên trang nhà hàng |
| FR-06.6 | Admin kiểm duyệt và ẩn/xoá bình luận vi phạm |
| FR-06.7 | Khách hàng chỉnh sửa đánh giá trong vòng 24 giờ |
| FR-06.8 | Sắp xếp đánh giá theo thời gian hoặc điểm số |

> **Điều kiện tiên quyết:** Đơn đặt bàn có trạng thái "Hoàn thành". Mỗi đơn chỉ được đánh giá 1 lần.
>
> **Điều kiện hậu:** Đánh giá được lưu và hiển thị công khai, điểm TB nhà hàng được cập nhật.

---

### UC-07: Thông báo đẩy (Push Notification)

**Mô tả:** Hệ thống gửi thông báo đẩy đến người dùng về các sự kiện quan trọng liên quan đến đơn đặt bàn và hoạt động tài khoản.

**Người dùng liên quan:** Khách hàng, Admin

#### Luồng chính

1. Xảy ra sự kiện (xác nhận đơn, nhắc lịch, khuyến mãi...)
2. Server gửi push notification đến thiết bị người dùng qua FCM
3. Thông báo hiển thị trên màn hình / notification tray
4. Người dùng nhấn vào → chuyển đến màn hình liên quan trong app

#### Luồng thay thế

- Thiết bị tắt thông báo → lưu trong Notification Center của app
- Gửi lại nếu thất bại lần đầu sau 5 phút

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-07.1 | Gửi thông báo khi đơn được xác nhận hoặc từ chối |
| FR-07.2 | Nhắc nhở trước giờ đặt bàn 1 giờ và 24 giờ |
| FR-07.3 | Thông báo khi đơn bị Admin huỷ |
| FR-07.4 | Thông báo khi giao dịch thanh toán thành công / thất bại |
| FR-07.5 | Gửi thông báo khuyến mãi / ưu đãi đặc biệt |
| FR-07.6 | Người dùng có thể bật / tắt từng loại thông báo trong cài đặt |
| FR-07.7 | Lưu lịch sử thông báo trong ứng dụng (Notification Center) |
| FR-07.8 | Admin gửi thông báo hàng loạt đến tất cả người dùng |

> **Điều kiện tiên quyết:** Người dùng đã cấp quyền nhận thông báo cho ứng dụng.
>
> **Điều kiện hậu:** Thông báo được gửi đến đúng người dùng trong thời gian thực.

---

### UC-08: Quản lý Menu nhà hàng

**Mô tả:** Admin quản lý toàn bộ danh sách món ăn, danh mục, giá cả và trạng thái của menu nhà hàng.

**Người dùng liên quan:** Admin

#### Luồng chính

1. Admin đăng nhập → vào mục "Quản lý Menu"
2. Thêm / sửa / xoá danh mục món (Khai vị, Món chính, Tráng miệng...)
3. Thêm món mới: nhập tên, mô tả, giá, ảnh, trạng thái
4. Cập nhật trạng thái món (Còn hàng / Hết hàng)
5. Lưu thay đổi → cập nhật ngay trên app khách hàng

#### Luồng thay thế

- Thiếu thông tin bắt buộc → thông báo lỗi, không lưu
- Xoá danh mục có món → yêu cầu xác nhận hoặc chuyển món sang danh mục khác

#### Yêu cầu chức năng

| Mã | Mô tả |
|----|-------|
| FR-08.1 | Admin thêm, sửa, xoá danh mục món ăn |
| FR-08.2 | Admin thêm, sửa, xoá từng món ăn trong danh mục |
| FR-08.3 | Mỗi món bao gồm: tên, mô tả, giá, ảnh, danh mục, trạng thái |
| FR-08.4 | Cập nhật trạng thái món: Còn hàng / Hết hàng / Ngừng kinh doanh |
| FR-08.5 | Tải ảnh món ăn từ thư viện hoặc chụp ảnh trực tiếp |
| FR-08.6 | Tìm kiếm và lọc món theo danh mục hoặc trạng thái |
| FR-08.7 | Thay đổi menu hiển thị ngay lập tức cho khách hàng (realtime) |
| FR-08.8 | Thiết lập giá đặc biệt / khuyến mãi theo thời gian |

> **Điều kiện tiên quyết:** Admin đã đăng nhập với quyền quản lý nhà hàng.
>
> **Điều kiện hậu:** Menu được cập nhật và hiển thị chính xác trên app khách hàng.

---

## 4. Yêu cầu phi chức năng (NFR)

| Mã | Loại | Mô tả |
|----|------|-------|
| NFR-01 | Hiệu năng | Thời gian phản hồi API < 2 giây trong điều kiện bình thường |
| NFR-02 | Hiệu năng | Ứng dụng hỗ trợ tối thiểu 500 người dùng đồng thời |
| NFR-03 | Bảo mật | Mã hoá dữ liệu nhạy cảm bằng AES-256, HTTPS cho mọi kết nối |
| NFR-04 | Bảo mật | Xác thực JWT token với thời gian hết hạn, refresh token hợp lệ |
| NFR-05 | Khả dụng | Uptime hệ thống đạt 99.5% (trừ thời gian bảo trì có kế hoạch) |
| NFR-06 | Mở rộng | Kiến trúc hỗ trợ scale ngang khi lưu lượng tăng đột biến |
| NFR-07 | Giao diện | Giao diện thân thiện, tuân thủ Material Design / Cupertino |
| NFR-08 | Tương thích | Hỗ trợ iOS 13+ và Android 8.0+ |
| NFR-09 | Dữ liệu | Sao lưu dữ liệu tự động hàng ngày, phục hồi trong < 4 giờ |
| NFR-10 | Ngôn ngữ | Hỗ trợ tiếng Việt và tiếng Anh (i18n) |

---

## 5. Ma trận truy xuất yêu cầu

| Mã UC | Chức năng | Người dùng | Ưu tiên | UC liên quan |
|-------|-----------|-----------|---------|--------------|
| UC-01 | Đăng ký / Đăng nhập | KH, Admin | 🔴 Cao | UC-03, UC-04 |
| UC-02 | Tìm kiếm & Xem nhà hàng | KH | 🔴 Cao | UC-03, UC-06 |
| UC-03 | Đặt bàn & Chọn thời gian | KH | 🔴 Cao | UC-01, UC-04, UC-05 |
| UC-04 | Quản lý đặt bàn | KH, Admin | 🔴 Cao | UC-03, UC-05, UC-07 |
| UC-05 | Thanh toán online | KH | 🟡 Trung bình | UC-03, UC-04 |
| UC-06 | Đánh giá & Bình luận | KH, Admin | 🟡 Trung bình | UC-02, UC-04 |
| UC-07 | Thông báo đẩy | KH, Admin | 🟡 Trung bình | UC-03, UC-04, UC-05 |
| UC-08 | Quản lý Menu nhà hàng | Admin | 🟢 Thấp hơn | UC-02 |

---

*— Hết tài liệu SRS — Phiên bản 1.0 — 25/03/2026 —*
