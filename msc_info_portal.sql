-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 03:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msc_info_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `full_name`, `createdAt`, `updatedAt`) VALUES
(1, 'admin@gmail.com', '$2b$10$NnA23GcmZoccDkuDu.aiQu/PdmSC8dUGN2.NCragy3ShMPZrUZ2aW', 'Admin', '2025-06-17 16:36:40', '2025-06-17 16:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `posted_at` datetime DEFAULT current_timestamp(),
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `cover_image`, `posted_at`, `createdAt`, `updatedAt`) VALUES
(2, 'Thông báo mới', 'Nội dung abcde', NULL, '2025-06-17 08:41:31', '2025-06-17 08:41:31', '2025-06-17 08:41:31'),
(3, 'Thông báo mới', 'Nội dung abcde', NULL, '2025-06-17 08:57:35', '2025-06-17 08:57:35', '2025-06-17 08:57:35'),
(4, 'Thông báo mới 21111', 'Nội dung cập nhật', '/uploads/1750349272767-647700854.jpg', '2025-06-17 08:57:51', '2025-06-17 08:57:51', '2025-06-19 16:07:52'),
(5, 'Thông báo mới', 'Nội dung abcde', NULL, '2025-06-17 09:42:25', '2025-06-17 09:42:25', '2025-06-17 09:42:25'),
(6, 'AB aaaa', '<p><strong>AB aaa</strong></p>', '/uploads/1750349677029-374037659.png', '2025-06-19 01:40:00', '2025-06-19 15:42:54', '2025-06-25 09:50:16'),
(7, 'Thông báo và hướng dẫn công tác đăng ký dự tuyển thạc sĩ, tiến sĩ đợt 2 năm 2025', '<p>Trường Đại học Khoa học Xã hội và Nhân văn thông báo kế hoạch tuyển sinh sau đại học đợt 2 năm 2025 và hướng dẫn thủ tục đăng ký dự tuyển, cụ thể như sau:</p><p>​<strong>A. KẾ HOẠCH TUYỂN SINH:</strong></p><figure class=\"table\"><table><tbody><tr><td><strong>STT</strong></td><td><strong>Nội dung</strong></td><td><strong>Thời gian</strong></td></tr><tr><td>1</td><td>Đăng ký dự thi trực tuyến tại cổng thông tin tuyển sinh:<a href=\"http://tssdh.vnu.edu.vn/\">http://tssdh.vnu.edu.vn</a></td><td>Từ 16/06/2025<br>đến 30/09/2025</td></tr><tr><td>2</td><td>Nộp hồ sơ dự tuyển:<br><i>- Gửi qua đường bưu điện:</i><br><i>- Nộp trực tiếp tại Phòng Đào tạo (</i>trong trường hợp không gửi được qua đường bưu điện)</td><td><br>- từ ngày 16/6 đến 20/9<br>- từ ngày 21/9 đến 30/9</td></tr><tr><td>3</td><td>Tổ chức xét tuyển thẳng thạc sĩ</td><td>Ngày 15/10/2025</td></tr><tr><td>4</td><td>Tổ chức xét tuyển thạc sĩ theo phương thức phỏng vấn (*)</td><td>Ngày 26/10/2025</td></tr><tr><td>5</td><td>Tổ chức xét tuyển nghiên cứu sinh (**)</td><td>Từ ngày 20/10/2025 đến &nbsp;29/10/2025</td></tr><tr><td>6</td><td>Thông báo kết quả tuyển sinh</td><td>14/11/2025 (dự kiến)</td></tr><tr><td>7</td><td>Công bố quyết định trúng tuyển</td><td>20/11/2025 (dự kiến)</td></tr><tr><td>8</td><td>Nhập học</td><td>Trước 30/11/2025</td></tr></tbody></table></figure><p><i>(*) Thí sinh dự tuyển thạc sĩ theo phương thức xét tuyển đủ điều kiện về đánh giá hồ sơ sẽ được thông báo lịch phỏng vấn<strong> trước 17h00 ngày 19/10/2025.</strong></i><br><i>(**) Thí sinh dự tuyển tiến sĩ theo phương thức đánh giá hồ sơ chuyên môn sẽ được thông báo lịch đánh giá<strong> trước 17h00 ngày 13/10/2025.</strong></i><br><strong>Chi tiết thông báo tuyển sinh xem tại đây:</strong><br><a href=\"https://drive.google.com/file/d/1_3M6p-gZ6qPrIGOJoolW8_43H-bcUWmc/view?usp=sharing\">https://drive.google.com/file/d/1_3M6p-gZ6qPrIGOJoolW8_43H-bcUWmc/view?usp=sharing</a><br><strong>B. CÁC NGÀNH/CTĐT TUYỂN SINH</strong><br>&nbsp;</p><figure class=\"image\"><img src=\"https://tuyensinh.ussh.edu.vn/images/ckeditor/images/TS%202.png\" alt=\"\"></figure><figure class=\"image\"><img src=\"https://tuyensinh.ussh.edu.vn/images/ckeditor/images/TS%203.png\" alt=\"\"></figure><p><br><strong>C. ĐIỀU KIỆN DỰ TUYỂN:</strong><br>- Danh mục ngành phù hợp dự tuyển thạc sĩ xem tại đây:<br><a href=\"https://drive.google.com/file/d/1cQzJPZB8ZaYYeuyIETu9_0B3OGkKn8Jk/view?usp=sharing\">https://drive.google.com/file/d/1cQzJPZB8ZaYYeuyIETu9_0B3OGkKn8Jk/view?usp=sharing</a><br>- Danh mục ngành phù hợp dự tuyển tiến sĩ xem tại đây:<br><a href=\"https://drive.google.com/file/d/1uSi7M3B6p8AYQF71mFp51whWt42Zossq/view?usp=sharing\">https://drive.google.com/file/d/1uSi7M3B6p8AYQF71mFp51whWt42Zossq/view?usp=sharing</a><br>- Danh mục đề cương phỏng vấn thạc sĩ xem tại đây: https://drive.google.com/drive/folders/1CDktpLVllj6QsfyW04sUNv5uxivKkhqv?usp=drive_link<br>- Danh mục chứng chỉ ngoại ngữ đáp ứng yêu cầu chuẩn đầu vào thạc sĩ, tiến sĩ:<br><a href=\"https://drive.google.com/file/d/1NOMDse7WOCGfyL5kpkU9pxi4ohppzHwX/view?usp=sharing\">https://drive.google.com/file/d/1NOMDse7WOCGfyL5kpkU9pxi4ohppzHwX/view?usp=sharing</a><br>- Danh sách các cơ sở đào tạo được cấp chứng chỉ ngoại ngữ:<br><a href=\"https://drive.google.com/file/d/1FyoYdJTfg_-YuKIMGR3XybUOBkOICYq-/view?usp=sharing\">https://drive.google.com/file/d/1FyoYdJTfg_-YuKIMGR3XybUOBkOICYq-/view?usp=sharing</a><br><i><strong>Thông tin về tổ chức các chương trình bổ sung kiến thức đối với thí sinh diện phải học bổ sung kiến thức trước khi dự tuyển xem tại đây:</strong></i><br><a href=\"https://tuyensinh.ussh.edu.vn/thong-bao-ve-viec-to-chuc-cac-lop-bo-sung-kien-thuc-sau-dai-hoc-du-tuyen-dao-tao-trinh-do-thac-si-tien-si-tai-truong-dai-hoc-khoa-hoc-xa-hoi-va-nhan-van-dai-hoc-quoc-gia-ha-noi-nam-2025.html\">https://tuyensinh.ussh.edu.vn/thong-bao-ve-viec-to-chuc-cac-lop-bo-sung-kien-thuc-sau-dai-hoc-du-tuyen-dao-tao-trinh-do-thac-si-tien-si-tai-truong-dai-hoc-khoa-hoc-xa-hoi-va-nhan-van-dai-hoc-quoc-gia-ha-noi-nam-2025.html</a><br><i><strong>Thông tin liên hệ đăng ký học bổ sung kiến thức:</strong></i><a href=\"https://drive.google.com/file/d/1TkvDqSFV-VGmKrvIezs2N90e5r-RJMQ9/view?usp=drive_link\">&nbsp;https://drive.google.com/file/d/1TkvDqSFV-VGmKrvIezs2N90e5r-RJMQ9/view?usp=drive_link</a><br><strong>D. THỦ TỤC ĐĂNG KÝ DỰ TUYỂN:</strong><br><strong>1. Đăng kí trực tuyến đối với thí sinh đăng kí dự thi thạc sĩ và tiến sĩ:</strong><br>- Thời gian đăng ký: Từ ngày 16/6 – 30/9/2025<br>- Thí sinh đăng ký trực tuyến tại địa chỉ: http://tssdh.vnu.edu.vn<br><strong>2. Hướng dẫn thủ tục đăng kí dự thi thạc sĩ, tiến sĩ:</strong><br><i><strong>2.1 Đăng ký trực tuyến trong thời gian quy định tại cổng thông tin tuyển sinh ở trên.</strong></i><br><i><strong>2.2 Nộp hồ sơ theo các nội dung quy định:</strong></i><br>- Hồ sơ dự tuyển thạc sĩ: theo các yêu cầu tại Điểm 2, mục IV, phần B trong Thông báo tuyển sinh.<br>- Hồ sơ dự tuyển tiến sĩ: Theo các yêu cầu tại Điểm 2, mục III, phần C trong Thông báo tuyển sinh.<br>- Thí sinh dự tuyển tiến sĩ ngoài hồ sơ tự chuẩn bị cẩn tải mẫu đề cương nghiên cứu và thư giới thiệu của nhà khoa học dưới đây:<br>Mẫu đề cương nghiên cứu:<br><a href=\"https://docs.google.com/document/d/1zCcIxLO7peI37Tt9KSapIhvpxNVoDQkf/edit?usp=drive_link&amp;ouid=106162224749683368313&amp;rtpof=true&amp;sd=true\">https://docs.google.com/document/d/1zCcIxLO7peI37Tt9KSapIhvpxNVoDQkf/edit?usp=drive_link&amp;ouid=106162224749683368313&amp;rtpof=true&amp;sd=true</a><br>Mẫu Thư giới thiệu của nhà khoa học:<br><a href=\"https://docs.google.com/document/d/1blxVNghIcdMQehHChU19baYb21H-xLPq/edit?usp=drive_link&amp;ouid=106162224749683368313&amp;rtpof=true&amp;sd=true\">https://docs.google.com/document/d/1blxVNghIcdMQehHChU19baYb21H-xLPq/edit?usp=drive_link&amp;ouid=106162224749683368313&amp;rtpof=true&amp;sd=true</a><br><strong>Lưu ý:</strong><br>- Đối với hồ sơ dự tuyển thạc sĩ: thí sinh phải nộp 01 bộ hồ sơ.<br>- Đối với hồ sơ dự tuyển tiến sĩ: thí sinh phải nộp tổng số 06 bộ hồ sơ (trong đó bao gồm 01 bộ bản chính và 05 bộ photo từ bản chính).<br>- Thí sinh không đăng ký trực tuyến hoặc đăng ký trực tuyến mà không nộp hồ sơ theo quy định sẽ không đủ điều kiện để dự tuyển.<br>- Hồ sơ thí sinh dự tuyển nộp phải trùng khớp với các thông tin đã khai báo trên cổng thông tin tuyển sinh, Hội đồng tuyển sinh sau đại học nhà trường sẽ xem xét hủy bỏ kết quả trúng tuyển của thí sinh nếu các thông tin đăng ký dự tuyển sai lệch với hồ sơ và không đáp ứng tiêu chuẩn dự thi.<br><strong>2.3 Hình thức nộp hồ sơ:</strong><br>- Gửi hồ sơ qua đường bưu điện (tính theo dấu bưu điện xác nhận):<br>Thời gian gửi hồ sơ: <strong>từ ngày 16/6 đến ngày 20/9/2025</strong><br>- Nộp trực tiếp tại Phòng Đào tạo (bộ phận tuyển sinh) trong trường hợp không gửi được qua đường bưu điện <strong>từ ngày 21/9 đến ngày 30/9/2025</strong> <strong>tại Phòng 102 nhà C, Trường Đại học Khoa học Xã hội và Nhân văn (không thu vào ngày Chủ Nhật)</strong><br>Yêu cầu khi nộp hồ sơ:<br>- Hồ sơ do thí sinh tự chuẩn bị theo đúng các yêu cầu trong Thông báo tuyển sinh.<br>- Hồ sơ dự tuyển phải được cho vào túi đựng hồ sơ (túi giấy), bên ngoài ghi rõ các thông tin: Họ và tên thí sinh, Mã đăng kí dự thi (được cấp sau khi đăng kí trực tuyến thành công), Hồ sơ dự tuyển sau đại học đợt 2 năm 2025. Thí sinh có thể sử dụng mẫu bìa hồ sơ theo link dưới đây:<br><a href=\"https://drive.google.com/file/d/1GyP1xaIXs80zNGybpEgTpKWyUAJfDejC/view?usp=sharing\">https://drive.google.com/file/d/1GyP1xaIXs80zNGybpEgTpKWyUAJfDejC/view?usp=sharing</a><br><strong>E. KINH PHÍ TUYỂN SINH</strong><br><strong>1. Lệ phí đăng ký và dự tuyển</strong> (không hoàn trả khi rút hồ sơ)<br>- Dự tuyển trình độ thạc sĩ:&nbsp; 300.000đ/thí sinh<br>- Dự tuyển tiến sĩ:<br>+ Từ cử nhân:&nbsp; 500.000đ/thí sinh<br>+ Từ thạc sĩ:&nbsp; 260.000đ/thí sinh<br>&nbsp;<strong>2. Phương thức nộp lệ phí:</strong><br>&nbsp;- Chuyển khoản:<br>&nbsp; + Đơn vị thụ hưởng: Trường Đại học Khoa học Xã hội và Nhân văn<br>&nbsp; + Số tài khoản: <strong>2220656899 (hoặc 2221.0000.656.899); tại Ngân hàng Đầu tư và Phát triển Việt Nam chi nhánh Thanh Xuân (BIDV Thanh Xuân)</strong><br>Cú pháp chuyển khoản: Họ tên người dự thi__Mã ĐKDT_LPTS Thạc sĩ/Tiến sĩ_Ngành dự thi<br>- Nộp trực tiếp tại Trường Đại học Khoa học Xã hội và Nhân văn khi nộp hồ sơ.<br><strong>F. THÔNG TIN LIÊN HỆ VÀ HỖ TRỢ THÍ SINH</strong><br><i>&nbsp;Phòng Đào tạo (bộ phận tuyển sinh), Phòng 102 nhà C, Trường Đại học Khoa học Xã hội và Nhân văn, 336 Nguyễn Trãi - Thanh Xuân - Hà Nội</i><br><i>Zalo: 0912.708.840 – Mr. Nguyễn Đình Trung (hỗ trợ đến trước 20h hàng ngày)</i><br><i>Website: </i><a href=\"http://tuyensinh.ussh.edu.vn/\"><i>http://tuyensinh.ussh.edu.vn</i></a><br><i>Email: </i><a href=\"http://tuyensinhsdh@ussh.edu.vn/\"><i>tuyensinhsdh@ussh.edu.vn</i></a><br>Trân trọng thông báo./.</p>', '/uploads/1750347926671-798262187.jpg', '2025-06-18 04:45:00', '2025-06-19 15:45:26', '2025-06-25 11:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `name`, `description`, `credits`, `createdAt`, `updatedAt`) VALUES
(1, 'KHMOIAAAA', 'Nội dung cập nhật', 'Mô tả mới', 5, '2025-06-17 08:40:39', '2025-06-17 08:46:43'),
(2, 'KHMOIAB', 'Tên khóa học', '<p><strong>Mô tả khóa học</strong></p>', 3, '2025-06-17 08:43:14', '2025-06-25 09:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses_lecturers`
--

CREATE TABLE `courses_lecturers` (
  `course_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses_lecturers`
--

INSERT INTO `courses_lecturers` (`course_id`, `lecturer_id`, `createdAt`, `updatedAt`) VALUES
(1, 2, '2025-06-28 10:47:34', '2025-06-28 10:47:34'),
(1, 3, '2025-06-28 10:47:30', '2025-06-28 10:47:30'),
(2, 3, '2025-06-28 10:44:23', '2025-06-28 10:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file_path`, `course_id`, `uploaded_at`, `createdAt`, `updatedAt`) VALUES
(2, 'Tai lieu moi', 'Mo ta', '/uploads/1750151568075-45560126.pdf', 1, '2025-06-17 09:12:48', '2025-06-17 09:12:48', '2025-06-17 09:12:48'),
(3, 'Tài liệu cập nhật 222', '<p>aaa</p>', '/uploads/1750358274174-303327939.pdf', 1, '2025-06-19 18:34:16', '2025-06-19 18:34:16', '2025-06-19 18:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `academic_title` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `full_name`, `academic_title`, `department`, `bio`, `image`, `createdAt`, `updatedAt`) VALUES
(2, 'Giang Vien Moi', 'Thac Si', 'Khoa CNTT', 'Gioi thieu', '/uploads/1750151080590-852109619.jpg', '2025-06-17 09:02:11', '2025-06-17 09:04:40'),
(3, 'Nguyễn văn an1', 'Tiến Sĩ', 'KHOA HỌC TỰ NHIÊN', '<p>aaa 11</p>', '/uploads/1750356699802-186873151.jpg', '2025-06-19 18:11:39', '2025-06-19 18:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `type` enum('support','admission') NOT NULL DEFAULT 'admission',
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `type`, `createdAt`, `updatedAt`) VALUES
(2, 'lien-he', 'Liên Hệ', '<p>Liên hệ tuyển sinh số 0399888999</p>', 'support', '2025-06-27 14:19:50', '2025-06-27 14:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `education` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `status` enum('pending','processed') NOT NULL DEFAULT 'pending',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registers`
--

INSERT INTO `registers` (`id`, `full_name`, `phone`, `email`, `address`, `education`, `major`, `status`, `createdAt`, `updatedAt`) VALUES
(3, 'Lại Văn Nam', '0999888999', 'laivannam@gmail.com', 'Hưng Yên', 'Thạc sĩ', 'Công nghệ phần mềm', 'pending', '2025-06-27 11:34:38', '2025-06-27 11:34:38'),
(4, 'Lại Văn Nam', '0999888999', 'laivannam@gmail.com', 'Hưng Yên', 'Thạc sĩ', 'Công nghệ phần mềm', 'processed', '2025-06-27 11:35:20', '2025-06-27 12:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `theses`
--

CREATE TABLE `theses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `abstract` text DEFAULT NULL,
  `author_name` varchar(100) DEFAULT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theses`
--

INSERT INTO `theses` (`id`, `title`, `abstract`, `author_name`, `lecturer_id`, `year`, `file_path`, `createdAt`, `updatedAt`) VALUES
(1, 'Ten de tai 1111', 'Tom tat', 'Nguyen van a', NULL, 2024, '/uploads/1750152390709-495005352.pdf', '2025-06-17 09:26:30', '2025-06-17 09:27:11'),
(2, 'Ten de tai', 'Tom tat', 'Nguyen van a', NULL, 2024, '/uploads/1750152399154-152992837.pdf', '2025-06-17 09:26:39', '2025-06-17 09:26:39'),
(3, 'Luận văn mới 2221', '<p>Luận văn mới 2221</p>', 'Nguyễn Văn Bình Luân', NULL, 2024, '/uploads/1750358647608-949792201.pdf', '2025-06-19 18:43:37', '2025-06-19 18:44:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_lecturers`
--
ALTER TABLE `courses_lecturers`
  ADD PRIMARY KEY (`course_id`,`lecturer_id`),
  ADD KEY `course_id` (`course_id`,`lecturer_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theses`
--
ALTER TABLE `theses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `theses`
--
ALTER TABLE `theses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses_lecturers`
--
ALTER TABLE `courses_lecturers`
  ADD CONSTRAINT `courses_lecturers_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `courses_lecturers_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `theses`
--
ALTER TABLE `theses`
  ADD CONSTRAINT `theses_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
