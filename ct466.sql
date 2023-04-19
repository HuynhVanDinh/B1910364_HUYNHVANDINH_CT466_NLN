-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 02:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct466`
--

-- --------------------------------------------------------

--
-- Table structure for table `benh`
--

CREATE TABLE `benh` (
  `benh_id` int(11) NOT NULL,
  `tenbenh` varchar(255) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `dongia` int(11) NOT NULL,
  `thuocdinhkem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benh`
--

INSERT INTO `benh` (`benh_id`, `tenbenh`, `mota`, `dongia`, `thuocdinhkem`) VALUES
(1, 'Khám răng', 'Uống trước khi ăn', 56000, 'Albendazol 400'),
(2, 'Niền răng', '1 ngày 2 lần, mỗi lần 2 viên', 350000, 'Effetahric 250'),
(3, 'Nhổ răng', 'Ăn trước khi uống', 45000, 'Alumina II'),
(4, 'Cạo vôi răng', '1 ngày 2 lần, mỗi lần 1 viên, uống trước khi ăn', 80000, 'Hobinkid'),
(5, 'Trám răng', '1 lần 2 viên, trước khi ăn', 70000, 'Cloxacilin 500mg');

-- --------------------------------------------------------

--
-- Table structure for table `benhnhan`
--

CREATE TABLE `benhnhan` (
  `MaBN` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `tk_dangnhap` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `gioitinh` varchar(5) NOT NULL,
  `namsinh` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `cmnd` int(11) NOT NULL,
  `created_day` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benhnhan`
--

INSERT INTO `benhnhan` (`MaBN`, `hoten`, `tk_dangnhap`, `matkhau`, `trangthai`, `gioitinh`, `namsinh`, `diachi`, `sdt`, `cmnd`, `created_day`) VALUES
(1, 'Huỳnh Văn Định', '342008837', 'b75e23d7cab7a7f4c56615d74b8e8b3c', 1, 'nam', 2001, 'Đồng Tháp', '0375751606', 342008837, '2023-04-03 14:42:35'),
(2, 'Nguyễn Thị Lan', '342008842', 'c5295718715c4bcbc7aaf648d4c5b0ae', 1, 'nữ', 2002, 'Cần Thơ', '0342303842', 342008842, '2023-04-03 15:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `bienlai`
--

CREATE TABLE `bienlai` (
  `ma_bl` int(11) NOT NULL,
  `id_benhnhan` int(11) NOT NULL,
  `ma_pk` int(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `ngaythu` datetime NOT NULL,
  `tinhtrang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bienlai`
--

INSERT INTO `bienlai` (`ma_bl`, `id_benhnhan`, `ma_pk`, `id_nhanvien`, `tongtien`, `ngaythu`, `tinhtrang`) VALUES
(4, 1, 1, 1, 101000, '0000-00-00 00:00:00', 1),
(5, 1, 1, 1, 56000, '0000-00-00 00:00:00', 1),
(6, 1, 1, 1, 56000, '0000-00-00 00:00:00', 1),
(7, 1, 1, 1, 136000, '0000-00-00 00:00:00', 1),
(8, 1, 1, 1, 476000, '0000-00-00 00:00:00', 1),
(9, 1, 1, 2, 350000, '0000-00-00 00:00:00', 1),
(10, 2, 2, 1, 430000, '2023-04-19 18:57:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ct_phieukham`
--

CREATE TABLE `ct_phieukham` (
  `ma_pk` int(11) NOT NULL,
  `ma_bl` int(11) NOT NULL,
  `id_benh` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ct_phieukham`
--

INSERT INTO `ct_phieukham` (`ma_pk`, `ma_bl`, `id_benh`, `ngay`, `soluong`, `thanhtoan`) VALUES
(1, 4, 1, '2023-04-03', 1, 1),
(1, 4, 3, '2023-04-03', 1, 1),
(1, 4, 1, '2023-04-03', 1, 1),
(1, 5, 1, '2023-04-03', 1, 1),
(1, 7, 1, '2023-04-03', 1, 1),
(1, 7, 4, '2023-04-03', 1, 1),
(1, 8, 1, '2023-04-03', 1, 1),
(1, 8, 2, '2023-04-03', 1, 1),
(1, 8, 5, '2023-04-03', 1, 1),
(1, 9, 2, '2023-04-03', 1, 1),
(2, 0, 2, '2023-04-19', 1, 1),
(2, 0, 4, '2023-04-19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lichhen`
--

CREATE TABLE `lichhen` (
  `ma_lh` int(11) NOT NULL,
  `ngayhen` date NOT NULL,
  `id_benhnhan` int(11) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL,
  `id_nhasi` int(11) NOT NULL,
  `giohen` time NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `duyet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lichhen`
--

INSERT INTO `lichhen` (`ma_lh`, `ngayhen`, `id_benhnhan`, `sdt`, `id_nhanvien`, `id_nhasi`, `giohen`, `ghichu`, `duyet`) VALUES
(1, '2023-04-04', 1, '', 3, 1, '07:02:00', 'khám răng', 2),
(2, '2023-04-04', 1, '', 3, 1, '08:25:00', 'khám răng', 2),
(3, '2023-04-04', 1, '', 3, 1, '07:30:00', 'khám răng', 2),
(4, '2023-04-05', 1, '', 3, 1, '09:30:00', 'tái khám', 2),
(6, '2023-04-06', 1, '', 3, 1, '09:35:00', 'tái khám', 2),
(7, '2023-04-04', 1, '', 3, 1, '19:43:00', 'khám răng', 2),
(8, '2023-04-05', 1, '', 3, 1, '09:47:00', 'tái khám', 2),
(10, '2023-04-05', 1, '', 3, 1, '04:49:00', 'khám răng', 2),
(11, '2023-04-06', 1, '', 3, 1, '05:00:00', 'hẹn khám răng', 2),
(12, '2023-04-05', 1, '', 3, 1, '05:13:00', 'khám răng', 2),
(13, '2023-04-05', 1, '', 5, 2, '07:30:00', 'niền răng', 2),
(14, '2023-04-21', 2, '0342303842', 3, 1, '08:30:00', 'niềng răng', 2),
(15, '2023-04-21', 1, '0375751606', 3, 1, '06:30:00', 'khám răng', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `dthoai` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coso` varchar(255) NOT NULL,
  `loinhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tennv` varchar(255) NOT NULL,
  `gt` varchar(5) NOT NULL,
  `nsinh` int(11) NOT NULL,
  `sodt` varchar(11) NOT NULL,
  `cccd` int(11) NOT NULL,
  `dc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `user_id`, `tennv`, `gt`, `nsinh`, `sodt`, `cccd`, `dc`) VALUES
(1, 3, 'Trần Thị Nhân Viên', 'nữ', 2000, '0375751600', 342008800, 'vĩnh long'),
(2, 5, 'Lê Nhân Viên Hai', 'nam', 1999, '0375751611', 342008811, 'Tiền Giang');

-- --------------------------------------------------------

--
-- Table structure for table `nhasi`
--

CREATE TABLE `nhasi` (
  `MaNS` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tenns` varchar(255) NOT NULL,
  `bangcap` varchar(255) NOT NULL,
  `kinhnghiem` varchar(255) NOT NULL,
  `diachinha` varchar(255) NOT NULL,
  `cm` int(11) NOT NULL,
  `gtinh` varchar(5) NOT NULL,
  `dt` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhasi`
--

INSERT INTO `nhasi` (`MaNS`, `user_id`, `tenns`, `bangcap`, `kinhnghiem`, `diachinha`, `cm`, `gtinh`, `dt`) VALUES
(1, 4, 'Nguyễn Nha Sĩ', 'Tốt nghiệp Đại học Y Dược Tp. Hồ Chí Minh', 'Phó Trưởng khoa cấp cứu bệnh viện Nhi Đồng 2. Giảng viên các chương trình giảng dạy về chăm sóc sơ sinh và cấp cứu', 'Cần thơ', 342008833, 'nam', '0375751633'),
(2, 6, 'Nha Sĩ Hai', 'Tốt nghiệp Đại học Bách Khoa Hà Nội', 'Chuyên khoa răng hàm mặt bệnh viện Win Smile', 'Hà Nội', 342008844, 'nam', '0375751644');

-- --------------------------------------------------------

--
-- Table structure for table `phieukham`
--

CREATE TABLE `phieukham` (
  `ma_pk` int(11) NOT NULL,
  `ngaykham` date NOT NULL,
  `id_benhnhan` int(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL,
  `id_nhasi` int(11) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `gionhan` time NOT NULL,
  `giotra` time NOT NULL,
  `xacnhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieukham`
--

INSERT INTO `phieukham` (`ma_pk`, `ngaykham`, `id_benhnhan`, `id_nhanvien`, `id_nhasi`, `noidung`, `gionhan`, `giotra`, `xacnhan`) VALUES
(1, '2023-04-05', 1, 2, 2, 'niền răng', '17:22:58', '17:22:58', 1),
(2, '2023-04-21', 2, 1, 1, 'niềng răng, cạo vôi răng', '18:57:05', '18:57:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `p_p` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`user_id`, `username`, `fullname`, `password`, `p_p`, `status`, `created_at`, `role`) VALUES
(1, 'admin', 'admin', 'e6e061838856bf47e1de730719fb2609', 'admin.png', 1, '2023-04-03 09:50:16', 1),
(3, '342008800', 'Trần Thị Nhân Viên', 'faf7ffa2442e1fc7e97a364a47c0e6cf', 'default2.jpg', 1, '2023-04-03 14:59:08', 2),
(4, '342008833', 'Nguyễn Nha Sĩ', '255b4c228be1e58506d7f5aa51c70047', 'default.jpg', 1, '2023-04-03 15:06:40', 3),
(5, '342008811', 'Lê Nhân Viên Hai', '8450891020a35b4a2e141ea86cc8bf84', 'default2.jpg', 1, '2023-04-03 17:19:11', 2),
(6, '342008844', 'Nha Sĩ Hai', '184d7ae1b79b63272132613c62e4c978', 'default.jpg', 1, '2023-04-03 17:21:43', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `noidung` varchar(1000) NOT NULL,
  `tieude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id`, `hinhanh`, `noidung`, `tieude`) VALUES
(1, 'nhorang.png', 'Răng khôn hay còn gọi là răng số 8 là những chiếc răng được mọc sau cùng và nằm phía trong trên cung hàm. Các răng này bắt đầu mọc khi xương hàm đã ngừng tăng trưởng và phát triển. Độ tuổi mọc răng khôn thông thường là trong độ tuổi trưởng thành từ 18 - 25 tuổi. Nhưng có một vài trường hợp đặc biệt hơn 30 tuổi răng khôn mới bắt đầu mọc.\r\n\r\nRăng khôn sở dĩ được gọi là răng số 8 bởi chúng thường mọc ở vị trí cuối cùng (nằm sau răng số 7 và sát vách hàm). <br>Cũng chính bởi răng mọc ở vị trí này nên thường xảy ra tình trạng bị lệch, ngầm khiến chúng ta cảm thấy đau đớn, khó chịu. Với những tình trạng răng mọc ngầm hay nghiêng còn ảnh hưởng đến các răng khác trên cung hàm.<br>\r\n\r\nMỗi người chúng ta thường sẽ mọc từ 1 - 4 chiếc răng khôn, hoặc cũng có thể không mọc chiếc nào. Theo các bác sĩ nha khoa thì răng khôn được gọi như sau:\r\n\r\nRăng khôn hàm trên là răng số 18, 28\r\nRăng khôn hàm dưới là 38, 48>>>', 'Răng khôn là gì?'),
(2, 'tay-trang-rang.jpg', 'Tẩy trắng răng là phương pháp giúp cải thiện tình trạng răng ố vàng, xỉn màu do nhiều nguyên nhân gây nên.<br>\r\n\r\nTrước nhu cầu tẩy trắng răng ngày càng cao, có rất nhiều phương pháp ra đời như: dùng ánh sáng xanh làm gãy chuỗi protein, tẩy trắng tại nhà bằng nguyên liệu tự nhiên hay bằng miếng dán…', 'Tẩy trắng răng là gì?'),
(3, 'dieu-tri-cuoi-hoi-loi.jpg', 'Trên thực tế, hàn trám răng không có sự khác biệt. Hai thuật ngữ này đều chỉ một phương pháp phục hình thẩm mỹ, giúp khôi phục, bù đắp phần mô răng bị khuyết do nhiều nguyên nhân gây nên như sâu răng, tai nạn gây sứt mẻ…\r\n<br>\r\nMục đích của việc hàn trám răng là khôi phục kích thước, cũng như hình dáng răng ban đầu, từ đó đảm bảo chức năng ăn nhai và thẩm mỹ cho răng. Bên cạnh đó, hàn trám răng còn có ý nghĩa quan trọng đó là ngăn ngừa bệnh lý răng miệng, điển hình như sâu răng.<br>\r\n\r\nHiện nay, phương pháp phục hình thẩm mỹ này được nhiều người lựa chọn bởi không chỉ khắc phục khuyết điểm hàm răng mà còn an toàn, không phải mài cùi, không ảnh hưởng đến cấu trúc của răng...>', 'Sự khác nhau giữa hàn răng và trám răng?'),
(4, '1.jpg', 'Tủy răng là tổ chức được cấu tạo bởi các mô liên kế bao gồm mạch máu, thần kinh và bạch cầu, có chức năng nuôi dưỡng và dẫn truyền thần kinh.<br>\r\n\r\nBệnh lý tủy răng là bệnh khá thường gặp hiện nay, tình trạng này gây nên do nhiều nguyên nhân như sâu răng, do vi khuẩn, viêm nha chu, mạch máu nuôi tủy răng bị đứt…<br>\r\n\r\nKhi bị bệnh lý tủy răng sẽ gây nên các cơn đau nhức, khó chịu… do đó cần điều trị tủy sớm để tránh ảnh hưởng đến chất lượng cuộc sống.<br>\r\n\r\nVề điều trị tủy, đây là thủ thuật nằm bảo tồn răng khi răng bị tổn thương tủy, không thể điều trị hoặc tự phục hồi được. Bệnh lý tủy răng được chia thành nhiều cấp độ khác nhau, mỗi cấp độ sẽ có những cách khắc phục riêng', 'Điều trị tủy răng là gì?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benh`
--
ALTER TABLE `benh`
  ADD PRIMARY KEY (`benh_id`);

--
-- Indexes for table `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`MaBN`);

--
-- Indexes for table `bienlai`
--
ALTER TABLE `bienlai`
  ADD PRIMARY KEY (`ma_bl`),
  ADD KEY `ma_pk` (`ma_pk`),
  ADD KEY `id_nhanvien` (`id_nhanvien`);

--
-- Indexes for table `ct_phieukham`
--
ALTER TABLE `ct_phieukham`
  ADD KEY `id_benh` (`id_benh`),
  ADD KEY `ma_pk` (`ma_pk`);

--
-- Indexes for table `lichhen`
--
ALTER TABLE `lichhen`
  ADD PRIMARY KEY (`ma_lh`),
  ADD KEY `id_benhnhan` (`id_benhnhan`),
  ADD KEY `id_nhasi` (`id_nhasi`);

--
-- Indexes for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nhasi`
--
ALTER TABLE `nhasi`
  ADD PRIMARY KEY (`MaNS`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `phieukham`
--
ALTER TABLE `phieukham`
  ADD PRIMARY KEY (`ma_pk`),
  ADD KEY `id_benhnhan` (`id_benhnhan`),
  ADD KEY `id_nhanvien` (`id_nhanvien`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benh`
--
ALTER TABLE `benh`
  MODIFY `benh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `benhnhan`
--
ALTER TABLE `benhnhan`
  MODIFY `MaBN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bienlai`
--
ALTER TABLE `bienlai`
  MODIFY `ma_bl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lichhen`
--
ALTER TABLE `lichhen`
  MODIFY `ma_lh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nhasi`
--
ALTER TABLE `nhasi`
  MODIFY `MaNS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phieukham`
--
ALTER TABLE `phieukham`
  MODIFY `ma_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bienlai`
--
ALTER TABLE `bienlai`
  ADD CONSTRAINT `bienlai_ibfk_1` FOREIGN KEY (`ma_pk`) REFERENCES `phieukham` (`ma_pk`),
  ADD CONSTRAINT `bienlai_ibfk_2` FOREIGN KEY (`id_nhanvien`) REFERENCES `nhanvien` (`MaNV`);

--
-- Constraints for table `ct_phieukham`
--
ALTER TABLE `ct_phieukham`
  ADD CONSTRAINT `ct_phieukham_ibfk_1` FOREIGN KEY (`id_benh`) REFERENCES `benh` (`benh_id`),
  ADD CONSTRAINT `ct_phieukham_ibfk_2` FOREIGN KEY (`ma_pk`) REFERENCES `phieukham` (`ma_pk`);

--
-- Constraints for table `lichhen`
--
ALTER TABLE `lichhen`
  ADD CONSTRAINT `lichhen_ibfk_1` FOREIGN KEY (`id_benhnhan`) REFERENCES `benhnhan` (`MaBN`),
  ADD CONSTRAINT `lichhen_ibfk_2` FOREIGN KEY (`id_nhasi`) REFERENCES `nhasi` (`MaNS`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `taikhoan` (`user_id`);

--
-- Constraints for table `nhasi`
--
ALTER TABLE `nhasi`
  ADD CONSTRAINT `nhasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `taikhoan` (`user_id`);

--
-- Constraints for table `phieukham`
--
ALTER TABLE `phieukham`
  ADD CONSTRAINT `phieukham_ibfk_1` FOREIGN KEY (`id_benhnhan`) REFERENCES `benhnhan` (`MaBN`),
  ADD CONSTRAINT `phieukham_ibfk_2` FOREIGN KEY (`id_nhanvien`) REFERENCES `nhanvien` (`MaNV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
