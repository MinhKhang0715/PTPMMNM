-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2022 at 02:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_web2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id_admin_roles` int NOT NULL,
  `admin_admin_id` int NOT NULL,
  `roles_id_roles` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id_admin_roles`, `admin_admin_id`, `roles_id_roles`) VALUES
(239, 1, 1),
(240, 1, 2),
(241, 1, 3),
(242, 1, 4),
(243, 1, 5),
(244, 1, 6),
(245, 1, 7),
(255, 12, 1),
(256, 12, 2),
(257, 12, 7),
(258, 10, 1),
(259, 10, 3),
(260, 10, 4),
(261, 14, 1),
(262, 14, 2),
(263, 14, 4),
(264, 14, 6),
(265, 13, 1),
(266, 13, 3),
(267, 13, 5),
(268, 13, 7),
(269, 16, 1),
(270, 16, 2),
(271, 16, 4),
(272, 16, 5),
(273, 15, 1),
(274, 15, 2),
(275, 15, 3),
(276, 15, 5),
(277, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_23_083923_create_tbl_admin_table', 1),
(5, '2021_03_24_080259_create_tbl_category_product', 2),
(6, '2021_03_26_035402_create_tbl_brand_product', 3),
(7, '2021_03_26_083414_create_tbl_product', 4),
(8, '2021_04_02_182410_create_tbl_category_product', 5),
(9, '2021_04_02_182836_create_tbl_product', 6),
(10, '2021_04_02_182927_create_tbl_brand_product', 7),
(11, '2021_04_06_095420_tbl_customer', 8),
(12, '2021_04_06_163207_tbl_shipping', 9),
(13, '2021_04_08_054051_tbl_payment', 10),
(14, '2021_04_08_054124_tbl_order', 10),
(15, '2021_04_08_054156_tbl_order_details', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int UNSIGNED NOT NULL,
  `admin_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$IqTe0ZBfZiFtqsx38k2BL.mxjdM6/2ELrPVHam8za4GIxuA8GNYjy', 'Trần Duy Nhân', '0935318978', '2021-03-23 15:59:02', NULL),
(13, 'tdn@gmail.com', '$2y$10$IqTe0ZBfZiFtqsx38k2BL.mxjdM6/2ELrPVHam8za4GIxuA8GNYjy', 'Duy Nhan', '0375156448', '2022-11-22 20:07:04', NULL),
(14, 'ngocman@gmail.com', '$2y$10$IqTe0ZBfZiFtqsx38k2BL.mxjdM6/2ELrPVHam8za4GIxuA8GNYjy', 'Phạm Ngọc Mẫn', '0389651425', '2022-11-22 20:12:00', NULL),
(15, 'minhkhang@gmail.com', '$2y$10$1/hyqittFCLBIWIjZO9Qu.TuDzykw.QbkqgtY1RQc8yzL0EpEjFOC', 'Nguyễn Triều Minh Khan', '0356842157', '2022-11-22 20:19:10', NULL),
(16, 'quangminh@gmail.com', '$2y$10$BYZabiKqmCdnmAfmlgn3WOo7.lWI46E8S/03pS5Rd8Ok40wrf2vfa', 'Nguyễn Quang Minh', '0385694215', '2022-11-22 20:55:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int UNSIGNED NOT NULL,
  `brand_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_desc`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'Apple', 0, NULL, NULL),
(3, 'Samsung', 'Samsung', 0, NULL, NULL),
(4, 'Lenovo', 'Lenovo', 0, NULL, NULL),
(6, 'Sony', 'Sony', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int UNSIGNED NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'Điện thoại', 0, NULL, NULL),
(2, 'Tai Nghe', 'Tai Nghe', 0, NULL, NULL),
(3, 'Laptop', 'Laptop', 0, NULL, NULL),
(4, 'Tablet', 'Tablet', 0, NULL, NULL),
(6, 'abcd', 'abcd', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `created_at`, `updated_at`) VALUES
(1, 'Ngoc Man', 'ngocman@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0935318978', NULL, NULL),
(2, 'Minh Khang', 'minhkhang@gmail.com', '3e998ee237318e2e4b29ac238c68aa78', '0935318978', NULL, NULL),
(3, 'Quang Minh', 'quangminh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0935318978', NULL, NULL),
(4, 'Trần Duy Nhân', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0935318978', NULL, NULL),
(5, 'tran duy nhan', 'tdn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0375156448', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int NOT NULL,
  `gallery_name` varchar(255) NOT NULL,
  `gallery_image` varchar(255) NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_name`, `gallery_image`, `product_id`) VALUES
(33, 'iphone-12-xanh-duong-new-600x60086.jpg', 'iphone-12-xanh-duong-new-600x60086.jpg', 31),
(34, 'iphone-12-pro-max-xanh-duong-new-600x600-200x20035.jpg', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20035.jpg', 32),
(35, 'iphone-12-pro-max-xanh-duong-new-600x600-200x20066.jpg', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20066.jpg', 33),
(36, 'iphone-11-pro-xam-600x600-200x20078.jpg', 'iphone-11-pro-xam-600x600-200x20078.jpg', 34),
(37, 'iphone-11-pro-xam-600x600-200x20014.jpg', 'iphone-11-pro-xam-600x600-200x20014.jpg', 35),
(38, 'iphone-xs-max-gold-600x60038.jpg', 'iphone-xs-max-gold-600x60038.jpg', 36),
(39, 'samsung-galaxy-a32-4g-thumb-xanh-600x600-200x20035.jpg', 'samsung-galaxy-a32-4g-thumb-xanh-600x600-200x20035.jpg', 37),
(40, 'galaxy-a32-147.jpg', 'galaxy-a32-147.jpg', 37),
(41, 'Samsung-Galaxy-A32-5G-Bluetooth-face23.png', 'Samsung-Galaxy-A32-5G-Bluetooth-face23.png', 37),
(42, 'samsung-galaxy-a32-4g-00247.jpg', 'samsung-galaxy-a32-4g-00247.jpg', 37),
(43, 'thinkpadgen697.jpg', 'thinkpadgen697.jpg', 38),
(44, 'csm_teaser_806ad2789520.jpg', 'csm_teaser_806ad2789520.jpg', 38),
(45, 'laptop_lenovo_thinkpad_x1_carbon_gen_3_1_2_2_1_1_155.jpg', 'laptop_lenovo_thinkpad_x1_carbon_gen_3_1_2_2_1_1_155.jpg', 38),
(46, 'laptop_lenovo_thinkpad_x1_carbon_gen_3_2_2_2_1_1_184.jpg', 'laptop_lenovo_thinkpad_x1_carbon_gen_3_2_2_2_1_1_184.jpg', 38),
(47, 'x1-gen-8-35.jpg', 'x1-gen-8-35.jpg', 39),
(48, 'GS55.jpg', 'GS55.jpg', 40),
(49, 'ipad-air-4-wifi-64gb-2020-xanhduong-600x600-200x20093.jpg', 'ipad-air-4-wifi-64gb-2020-xanhduong-600x600-200x20093.jpg', 41),
(50, 'ipad-air-4-wifi-64gb-2020-121020-020722259.jpg', 'ipad-air-4-wifi-64gb-2020-121020-020722259.jpg', 41),
(51, 'ipad-air-4-wifi-64gb-2020-121020-020733790.jpg', 'ipad-air-4-wifi-64gb-2020-121020-020733790.jpg', 41),
(52, 'ipad-air-4-wifi-64gb-2020-121020-020731685.jpg', 'ipad-air-4-wifi-64gb-2020-121020-020731685.jpg', 41),
(53, 'ipad-air-4-wifi-64gb-2020-121020-02073484.jpg', 'ipad-air-4-wifi-64gb-2020-121020-02073484.jpg', 41),
(54, 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', 42),
(55, 'ipad-pro-12-9-inch-wifi-128gb-2020-140520-033259052.jpg', 'ipad-pro-12-9-inch-wifi-128gb-2020-140520-033259052.jpg', 42),
(56, 'ipad-pro-12-9-inch-wifi-128gb-2020-140520-033405170.jpg', 'ipad-pro-12-9-inch-wifi-128gb-2020-140520-033405170.jpg', 42),
(57, 'ipad-pro-12-9-inch-wifi-128gb-2020-073320-033345-68797.jpg', 'ipad-pro-12-9-inch-wifi-128gb-2020-073320-033345-68797.jpg', 42),
(58, 'tai-nghe-true-wireless-sony-wf-xb700-187.jpg', 'tai-nghe-true-wireless-sony-wf-xb700-187.jpg', 43),
(59, '202220191482.jpeg', '202220191482.jpeg', 44),
(60, '8662729028.jpeg', '8662729028.jpeg', 44),
(65, 'iphone-12-pro-512gb-281120-121253463.jpg', 'iphone-12-pro-512gb-281120-121253463.jpg', 31),
(66, 'iphone-12-pro-512gb-071220-094554092.jpg', 'iphone-12-pro-512gb-071220-094554092.jpg', 31),
(67, 'iphone-12-pro-512gb-281120-121248115.jpg', 'iphone-12-pro-512gb-281120-121248115.jpg', 31),
(68, 'iphone-12-pro-512gb-281120-121247071.jpg', 'iphone-12-pro-512gb-281120-121247071.jpg', 31),
(69, 'iphone-12-pro-512gb-281120-121253457.jpg', 'iphone-12-pro-512gb-281120-121253457.jpg', 32),
(70, 'iphone-12-pro-512gb-071220-094554073.jpg', 'iphone-12-pro-512gb-071220-094554073.jpg', 32),
(71, 'iphone-12-pro-512gb-281120-121248129.jpg', 'iphone-12-pro-512gb-281120-121248129.jpg', 32),
(72, 'iphone-12-pro-512gb-281120-12124706.jpg', 'iphone-12-pro-512gb-281120-12124706.jpg', 32),
(73, 'iphone-12-pro-512gb-281120-121253427.jpg', 'iphone-12-pro-512gb-281120-121253427.jpg', 33),
(74, 'iphone-12-pro-512gb-071220-094554091.jpg', 'iphone-12-pro-512gb-071220-094554091.jpg', 33),
(75, 'iphone-12-pro-512gb-281120-121248180.jpg', 'iphone-12-pro-512gb-281120-121248180.jpg', 33),
(76, 'iphone-12-pro-512gb-281120-121247096.jpg', 'iphone-12-pro-512gb-281120-121247096.jpg', 33),
(77, '-iphone-xs-max-man-hinh70.jpg', '-iphone-xs-max-man-hinh70.jpg', 36),
(78, '-iphone-xs-max-a1254.jpg', '-iphone-xs-max-a1254.jpg', 36),
(79, '-iphone-xs-max-thiet-ke84.jpg', '-iphone-xs-max-thiet-ke84.jpg', 36),
(80, 'vi-vn-samsung-galaxy-a32-4g-cauhinh48.jpg', 'vi-vn-samsung-galaxy-a32-4g-cauhinh48.jpg', 37),
(81, 'vi-vn-samsung-galaxy-a32-4g-thietke96.jpg', 'vi-vn-samsung-galaxy-a32-4g-thietke96.jpg', 37),
(82, 'vi-vn-samsung-galaxy-a32-4g-tongquan51.jpg', 'vi-vn-samsung-galaxy-a32-4g-tongquan51.jpg', 37),
(83, 'iphone-12-pro-512gb-281120-121253492.jpg', 'iphone-12-pro-512gb-281120-121253492.jpg', 35),
(84, 'iphone-12-pro-512gb-071220-09455404.jpg', 'iphone-12-pro-512gb-071220-09455404.jpg', 35),
(85, 'iphone-12-pro-512gb-281120-12124813.jpg', 'iphone-12-pro-512gb-281120-12124813.jpg', 35),
(86, 'iphone-12-pro-512gb-281120-121247036.jpg', 'iphone-12-pro-512gb-281120-121247036.jpg', 35),
(87, 'iphone-12-pro-512gb-281120-121253415.jpg', 'iphone-12-pro-512gb-281120-121253415.jpg', 34),
(88, 'iphone-12-pro-512gb-071220-094554083.jpg', 'iphone-12-pro-512gb-071220-094554083.jpg', 34),
(89, 'iphone-12-pro-512gb-281120-121248120.jpg', 'iphone-12-pro-512gb-281120-121248120.jpg', 34),
(90, 'iphone-12-pro-512gb-281120-121247058.jpg', 'iphone-12-pro-512gb-281120-121247058.jpg', 34),
(98, 'samsung-galaxy-s21-ultra-1_1_210.jpg', 'samsung-galaxy-s21-ultra-1_1_210.jpg', 47),
(99, 'samsung-galaxy-s21-ultra-1_1_240.jpg', 'samsung-galaxy-s21-ultra-1_1_240.jpg', 48),
(100, 'samsung-galaxy-s21-ultra-1_1_225.jpg', 'samsung-galaxy-s21-ultra-1_1_225.jpg', 49),
(101, 'samsung-galaxy-s21-ultra-1_1_218.jpg', 'samsung-galaxy-s21-ultra-1_1_218.jpg', 50),
(102, 'samsung-galaxy-s21-ultra-1_1_236.jpg', 'samsung-galaxy-s21-ultra-1_1_236.jpg', 51),
(103, 'samsung-galaxy-s21-ultra-1_1_279.jpg', 'samsung-galaxy-s21-ultra-1_1_279.jpg', 52),
(106, '202220191430.jpeg', '202220191430.jpeg', 54),
(107, '866272905.jpeg', '866272905.jpeg', 54);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `shipping_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `order_status` int NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_status`, `created_at`, `updated_at`) VALUES
(36, 2, 24, 50, 1, '2021-04-20', NULL),
(37, 2, 26, 51, 0, '2021-04-24', NULL),
(38, 2, 27, 52, 0, '2021-04-24', NULL),
(39, 2, 28, 53, 0, '2021-04-24', NULL),
(40, 5, 47, 72, 0, NULL, NULL),
(41, 5, 47, 73, 0, NULL, NULL),
(42, 5, 48, 77, 1, '2022-11-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_id_details` bigint UNSIGNED NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sales_quantity` int NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_id_details`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_sales_quantity`, `created_at`, `updated_at`) VALUES
(58, 51, 54, 'Tai nghe Bluetooth Apple AirPods Pro VN/A', '202220191430.jpeg', '6000000', 1, '2022-11-01', NULL),
(59, 51, 42, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', '27000000', 3, '2022-11-01', NULL),
(60, 52, 54, 'Tai nghe Bluetooth Apple AirPods Pro VN/A', '202220191430.jpeg', '6000000', 1, '2022-11-01', NULL),
(61, 52, 32, 'Iphone 12 Đen 128GB', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20035.jpg', '20000000', 2, '2022-11-01', NULL),
(62, 53, 39, 'Lenovo Thinkpad x1 Carbon Gen 8', 'x1-gen-8-35.jpg', '58000000', 1, '2022-11-01', NULL),
(63, 54, 41, 'Ipad Air 4 wifi 64GB', 'ipad-air-4-wifi-64gb-2020-xanhduong-600x600-200x20093.jpg', '17000000', 1, NULL, NULL),
(64, 54, 40, 'Lenovo Yoga slim 7 carbon', 'GS55.jpg', '28000000', 1, NULL, NULL),
(65, 54, 39, 'Lenovo Thinkpad x1 Carbon Gen 8', 'x1-gen-8-35.jpg', '58000000', 1, NULL, NULL),
(66, 55, 32, 'Iphone 12 Đen 128GB', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20035.jpg', '20000000', 1, NULL, NULL),
(67, 56, 37, 'Samsung Galaxy A32', 'samsung-galaxy-a32-4g-thumb-xanh-600x600-200x20035.jpg', '7000000', 2, NULL, NULL),
(68, 56, 42, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', '27000000', 1, NULL, NULL),
(69, 56, 40, 'Lenovo Yoga slim 7 carbon', 'GS55.jpg', '28000000', 2, NULL, NULL),
(70, 41, 42, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', '27000000', 1, NULL, NULL),
(71, 42, 54, 'Tai nghe Bluetooth Apple AirPods Pro VN/A', '202220191430.jpeg', '6000000', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(56, '2', 'Đang chờ xử lý', NULL, NULL),
(57, '2', 'Đang chờ xử lý', NULL, NULL),
(58, '2', 'Đang chờ xử lý', NULL, NULL),
(59, '2', 'Đang chờ xử lý', NULL, NULL),
(60, '2', 'Đang chờ xử lý', NULL, NULL),
(61, '2', 'Đang chờ xử lý', NULL, NULL),
(62, '2', 'Đang chờ xử lý', NULL, NULL),
(63, '2', 'Đang chờ xử lý', NULL, NULL),
(64, '2', 'Đang chờ xử lý', NULL, NULL),
(65, '2', 'Đang chờ xử lý', NULL, NULL),
(66, '2', 'Đang chờ xử lý', NULL, NULL),
(67, '2', 'Đang chờ xử lý', NULL, NULL),
(68, '2', 'Đang chờ xử lý', NULL, NULL),
(69, '2', 'Đang chờ xử lý', NULL, NULL),
(70, '2', 'Đang chờ xử lý', NULL, NULL),
(71, '2', 'Đang chờ xử lý', NULL, NULL),
(72, '2', 'Đang chờ xử lý', NULL, NULL),
(73, '2', 'Đang chờ xử lý', NULL, NULL),
(74, '2', 'Đang chờ xử lý', NULL, NULL),
(75, '2', 'Đang chờ xử lý', NULL, NULL),
(76, '2', 'Đang chờ xử lý', NULL, NULL),
(77, '2', 'Đang chờ xử lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_desc`, `product_content`, `product_qty`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`) VALUES
(31, 1, 1, 'Iphone 12 Xanh 256GB', 'Iphone 12 Xanh 256GB', 'Iphone 12 Xanh 256GB', 10, '20000000', 'iphone-12-xanh-duong-new-600x60086.jpg', 0, NULL, NULL),
(32, 1, 1, 'Iphone 12 Đen 128GB', 'Iphone 12 Đen 128GB', 'Iphone 12 Đen 128GB', 10, '20000000', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20035.jpg', 0, NULL, NULL),
(33, 1, 1, 'Iphone 12 Đen 256GB', 'Iphone 12 Đen 256GB', 'Iphone 12 Đen 256GB', 10, '20000000', 'iphone-12-pro-max-xanh-duong-new-600x600-200x20066.jpg', 0, NULL, NULL),
(34, 1, 1, 'Iphone 11 Pro Max Đen 256GB', 'Iphone 11 Pro Max Đen 256GB', 'Iphone 11 Pro Max Đen 256GB', 10, '18000000', 'iphone-11-pro-xam-600x600-200x20078.jpg', 0, NULL, NULL),
(35, 1, 1, 'Iphone 11  Đen 128GB', 'Iphone 11 Đen 128GB', 'Iphone 11 Đen 128GB', 10, '18000000', 'iphone-11-pro-xam-600x600-200x20014.jpg', 0, NULL, NULL),
(36, 1, 1, 'Iphone Xs max', 'Iphone Xs max 256GB', 'Iphone Xs max 256GB', 10, '10000000', 'iphone-xs-max-gold-600x60038.jpg', 0, NULL, NULL),
(37, 1, 3, 'Samsung Galaxy A32', 'Samsung Galaxy A32', 'Samsung Galaxy A32', 10, '7000000', 'samsung-galaxy-a32-4g-thumb-xanh-600x600-200x20035.jpg', 0, NULL, NULL),
(38, 3, 4, 'Lenovo Thinkpad x1 Carbon Gen 6', 'Lenovo Thinkpad x1 Carbon Gen 6', 'CPU : 8th Gen Intel® Core™ i5 8350U  1.7Ghz up to 3.6GHz  6MB\r\n\r\nRAM : 8GB LPDDR3-2133\r\n\r\nSSD : 256GB M.2 PCIe NVMe Solid State Drive (M.2 SSD)\r\n\r\nMàn hình : 14\" Full HD (1920x1080) , IPS, anti-glare\r\n\r\nCard đồ họa : Share Intel® UHD Graphics 620', 10, '20000000', 'thinkpadgen697.jpg', 0, NULL, NULL),
(39, 3, 4, 'Lenovo Thinkpad x1 Carbon Gen 8', 'Lenovo Thinkpad x1 Carbon Gen 8', 'Màn hình: 14 inch, FHD IPS (1920×1080)\r\nCPU: Intel® Core™ i5-10210U Processor 6M Cache, up to 4.10 GHz\r\nRAM: 8GB LPDDR3 2133 MHz\r\nỔ cứng: 256GB PCIe SSD\r\nĐồ họa: Intel UHD Graphics\r\nTrọng lượng: 1.1 kg\r\nXuất xứ: Nhập khẩu từ Mỹ, New 100%\r\nBảo hành: 3 năm chính hãng', 10, '58000000', 'x1-gen-8-35.jpg', 0, NULL, NULL),
(40, 3, 4, 'Lenovo Yoga slim 7 carbon', 'Lenovo Yoga slim 7 carbon', 'CPU: Intel® Core™ i7-1165G7 (tối đa 4.70GHz, 12MB)\r\nRAM: 16GB LPDDR4x 4266MHz\r\nỔ cứng: 1TB M.2 PCIe NVMe SSD\r\nVGA: Intel IrisXe Graphics', 10, '28000000', 'GS55.jpg', 0, NULL, NULL),
(41, 4, 1, 'Ipad Air 4 wifi 64GB', 'Ipad Air 4 wifi 64GB', 'Ipad Air 4 wifi 64GB', 10, '17000000', 'ipad-air-4-wifi-64gb-2020-xanhduong-600x600-200x20093.jpg', 0, NULL, NULL),
(42, 4, 1, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 10, '27000000', 'ipad-pro-12-9-inch-wifi-128gb-2020-bac-600x600-1-200x20040.jpg', 0, NULL, NULL),
(43, 2, 6, 'Tai Nghe True Wireless Sony WF-XB700', 'Tai Nghe True Wireless Sony WF-XB700', 'Tai Nghe True Wireless Sony WF-XB700', 10, '3000000', 'tai-nghe-true-wireless-sony-wf-xb700-187.jpg', 0, NULL, NULL),
(54, 2, 1, 'Tai nghe Bluetooth Apple AirPods Pro VN/A', 'Tai nghe Bluetooth Apple AirPods Pro VN/A', 'Tai nghe Bluetooth Apple AirPods Pro VN/A', 9, '6000000', '202220191430.jpeg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id_roles` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_roles`, `name`) VALUES
(1, 'admin'),
(2, 'product'),
(3, 'brand'),
(4, 'category'),
(5, 'order'),
(6, 'slider'),
(7, 'stat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` bigint UNSIGNED NOT NULL,
  `shipping_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_notes`, `shipping_address`, `shipping_phone`, `shipping_email`, `created_at`, `updated_at`) VALUES
(36, 'Pham Ngoc Man', 'Hàng dễ vỡ nha', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(37, 'Pham Ngoc Man', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(38, 'Pham Ngoc Man', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(39, 'Pham Ngoc Man', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(40, 'Nguyen Trieu Minh Khang', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(41, 'Nguyen Trieu Minh Khang', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(42, 'Nguyen Trieu Minh Khang', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(43, 'Nguyen Trieu Minh Khang', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'minhkhang@gmail.com', NULL, NULL),
(44, 'Nguyen Quang Minh', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'quangminh@gmail.com', NULL, NULL),
(45, 'Nguyen Quang Minh', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'quangminh@gmail.com', NULL, NULL),
(46, 'Nguyen Quang Minh', 'Hàng dễ vỡ', '271 Ngô Gia Tự P.3 Q.10', '0935318978', 'quangminh@gmail.com', NULL, NULL),
(47, 'Tran Duy Nhan', 'Hang De Vo', '99, An Duong Vuong Street, Ward 16, Dictrict 8, Ho Chi Minh City, Viet Nam', '0375156448', 'tdn@gmail.com', NULL, NULL),
(48, 'Tran Duy Nhan', 'de vo', '99, An Duong Vuong Street, Ward 16, Dictrict 8, Ho Chi Minh City, Viet Nam', '0375156448', 'vtbntdntda@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `slider_status` int NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_name`, `slider_status`, `slider_image`, `slider_desc`) VALUES
(8, 'Iphone 12', 0, '1213.jpg', 'Iphone 12'),
(9, 'Iphone 12', 0, '2918.png', 'Iphone 12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id_admin_roles`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_id_details`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id_admin_roles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_id_details` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
