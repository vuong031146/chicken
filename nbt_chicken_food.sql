-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 20, 2025 lúc 08:24 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nbt_chicken_food`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`) VALUES
(1, 17, 5, 1, '2025-03-20 06:04:33'),
(2, 17, 6, 2, '2025-03-20 06:05:18'),
(3, 17, 7, 1, '2025-03-20 06:28:32'),
(4, 23, 5, 1, '2025-03-20 06:48:08'),
(5, 23, 6, 2, '2025-03-20 06:48:17'),
(6, 23, 11, 1, '2025-03-20 06:49:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `password`, `username`, `role`) VALUES
(17, 'Dinh Nam Ngo', 'admin@naminc.dev', '0347101143', '39 Street 19', '2025-03-19 17:51:11', 'naminc$', 'naminc', 1),
(23, 'TRoy Jome', 'inc006@xnaminc.com', '3067783344', 'Trống', '2025-03-20 05:17:14', 'phong123', 'phong123', 0),
(24, 'Daniel Hane', 'inc00c6@xnaminc.com', '3056689900', '313 St Rd', '2025-03-20 07:00:44', 'namincs', 'namincs', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `status`, `created_at`, `category`, `image_url`, `description`) VALUES
(5, 'Cánh gà 2 vị', 280000, 'available', '2025-03-19 14:47:24', 1, '/assest/img/ga-ran-2-loai-sot-gia-vi-sot-toi-cay-nguyen-xuong-rut-xuong32312-removebg-preview.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(6, 'Gà rán nửa con', 400000, 'available', '2025-03-19 14:47:24', 1, '/assest/img/ganuacon.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(7, 'Gà rán sốt nước tương', 279000, 'available', '2025-03-19 14:47:24', 2, '/assest/img/gasotnuoctuong.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(8, 'Cánh gà 3 vị', 280000, 'available', '2025-03-19 14:47:24', 1, '/assest/img/ga3vi.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(9, 'Gà rán không xương', 299000, 'available', '2025-03-19 14:47:24', 1, '/assest/img/gakhongxuong.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(10, 'Gà rán sốt hành Pandak - 2 vị', 340000, 'available', '2025-03-19 14:47:24', 2, '/assest/img/garansothanh.png', 'Gà được lăn trong bột chiên giòn với công thức nước sốt bí mật cùng với nguyên liệu thượng hạng. Mang cho chúng ta cảm giác ngon từ lần chạm môi đầu tiên'),
(11, 'Hành Trộn', 20000, 'available', '2025-03-20 05:36:25', 2, '/assest/img/hanhtron.png', 'Hành trộn thơm ngon');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `domain` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `system`
--

INSERT INTO `system` (`id`, `name`, `title`, `keyword`, `phone`, `address`, `created_at`, `domain`, `logo`, `email`, `status`) VALUES
(1, 'NBT Chicken Food', 'NBT Chicken Food', 'NBT Chicken Food', '0909090909', '39 đường số 19, phường Hiệp Bình Chánh,Thủ Đức', '2025-03-19 08:48:09', 'naminc.io', 'https://i.imgur.com/eR6wdzw.png', 'admin@naminc.dev', 'on');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


