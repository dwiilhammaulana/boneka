-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2025 at 01:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualbelimobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `full_name`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'ilham', '$2y$12$oMcYT3nr9l6YRaqwKfPGN.zNZgeYoMN81eHaKHTTJrlLuiUZXF3cu', 'ilham@gmail.com', 'ilham', '085691185824', '2025-05-11 20:31:14', '2025-05-11 20:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', NULL, '2025-05-11 20:31:36', '2025-05-11 23:21:04'),
(2, 'Honda', NULL, '2025-05-24 23:19:23', '2025-05-24 23:19:23'),
(3, 'suzuki', NULL, '2025-05-27 03:34:05', '2025-05-27 03:34:05'),
(4, 'BYD', NULL, '2025-05-27 03:34:19', '2025-05-27 03:34:19'),
(5, 'Volvo', NULL, '2025-05-27 03:34:50', '2025-05-27 03:34:50'),
(6, 'Wulling', NULL, '2025-05-27 03:35:02', '2025-05-27 03:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `first_name`, `last_name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'ilham', 'ilham', 'abcd.uts@gmail.com', 'asas', 'sdafaeaedfdadc', '2025-06-09 07:05:23', '2025-06-09 07:05:23'),
(2, 'ilham', 'ilham', 'operator@gmail.com', 'asas', 'halo guys!!', '2025-06-14 06:26:11', '2025-06-14 06:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `password`, `email`, `full_name`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'asep', '$2y$12$ghhhjVK4vs4cVFmLIILLeuhT9DrmgXQJvhwLnKcNQqZjRPEqiRgym', 'asep@gmail.com', 'asep robianaa', '08080844', 'tigaraksa', '2025-05-12 02:02:17', '2025-05-28 22:46:24'),
(2, 'felan', '$2y$12$.ujiXE.7fykrP4ISt6n9i.Cetd5LsCat7VgM2ar47.a2fudklAmVK', 'felan@gmail.com', 'felan', '0852697567', 'pasar kemis', '2025-06-08 06:23:44', '2025-06-08 06:23:44'),
(3, 'prisma', '$2y$12$PpGXT1kl0srPSGQEwqHqau69KyT0NIVfpd/HZmLugZWZvLXZPWM5m', 'prisma@gmail.com', 'prisma', '0185875555', 'Cikupa', '2025-06-14 06:16:02', '2025-06-14 06:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` decimal(25,2) NOT NULL,
  `bukti_pesanan` int NOT NULL,
  `ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stnk` enum('pending','diproses','delivered','diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `bpkb` enum('pending','diproses','delivered','diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `logistik` enum('request_pickup','pickup') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `status` enum('Menunggu','Dikonfirmasi','DP','Lunas','Batal') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `sisa_tagihan` decimal(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_price`, `bukti_pesanan`, `ktp`, `stnk`, `bpkb`, `logistik`, `created_at`, `updated_at`, `status`, `sisa_tagihan`) VALUES
(43, 1, '2025-06-14 17:00:00', '200500000.00', 500000, '1749995879.jpg', 'diproses', 'diproses', NULL, '2025-06-15 06:57:59', '2025-06-15 07:02:49', 'Lunas', '0.00'),
(44, 1, '2025-06-14 17:00:00', '40000500000.00', 500000, '1749996042.jpg', 'diproses', 'diproses', NULL, '2025-06-15 07:00:42', '2025-06-15 07:03:15', 'DP', '28000000000.00'),
(45, 1, '2025-06-14 17:00:00', '500500000.00', 500000, '1749996108.jpg', 'pending', 'pending', NULL, '2025-06-15 07:01:48', '2025-06-15 07:03:29', 'Dikonfirmasi', '500000000.00'),
(46, 1, '2025-06-14 17:00:00', '500500000.00', 500000, '1749996233.jpg', 'pending', 'pending', NULL, '2025-06-15 07:03:53', '2025-06-15 07:03:53', 'Menunggu', '500500000.00'),
(47, 2, '2025-05-03 17:00:00', '5000500000.00', 500000, '1749996455.jpg', 'diproses', 'diproses', NULL, '2025-06-15 07:07:35', '2025-06-15 07:08:00', 'Lunas', '0.00'),
(48, 2, '2024-12-10 17:00:00', '300500000.00', 500000, '1749996502.jpg', 'diproses', 'diproses', NULL, '2025-06-15 07:08:22', '2025-06-15 07:10:12', 'Lunas', '0.00'),
(49, 2, '2022-12-07 17:00:00', '300500000.00', 500000, '1749998006.jpg', 'diproses', 'diproses', 'request_pickup', '2025-06-15 07:10:58', '2025-06-15 07:33:26', 'Lunas', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(25,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(44, 43, 72, 1, '200000000.00'),
(45, 44, 61, 1, '40000000000.00'),
(46, 45, 65, 1, '500000000.00'),
(47, 46, 60, 1, '500000000.00'),
(48, 47, 62, 1, '5000000000.00'),
(49, 48, 69, 1, '300000000.00'),
(50, 49, 59, 1, '300000000.00');

--
-- Triggers `order_details`
--
DELIMITER $$
CREATE TRIGGER `reduce_stock_after_order` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
    -- Mengurangi stok produk berdasarkan `product_id` dan jumlah `quantity` yang dipesan
    UPDATE `products`
    SET `stock` = `stock` - NEW.`quantity`
    WHERE `product_id` = NEW.`product_id`;

    -- Pastikan stok tidak negatif
    IF (SELECT `stock` FROM `products` WHERE `product_id` = NEW.`product_id`) < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stock tidak mencukupi!';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `jumlah_bayar` decimal(50,2) DEFAULT NULL,
  `metode` enum('tunai','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `order_id`, `tanggal_pembayaran`, `jumlah_bayar`, `metode`, `bukti_bayar`) VALUES
(135, 43, '2025-06-15', '500000.00', 'transfer', '1749995965_bukti bayar.jpg'),
(136, 43, '2025-06-15', '60000000.00', 'tunai', NULL),
(137, 43, '2025-06-15', '140000000.00', 'transfer', '1749996169_bukti bayar.jpg'),
(138, 44, '2025-06-15', '500000.00', 'transfer', '1749996182_bukti bayar.jpg'),
(139, 44, '2025-06-15', '12000000000.00', 'tunai', NULL),
(140, 45, '2025-06-15', '500000.00', 'transfer', '1749996209_bukti bayar.jpg'),
(141, 47, '2025-06-15', '500000.00', 'tunai', NULL),
(142, 47, '2025-06-15', '1500000000.00', 'tunai', NULL),
(143, 47, '2025-06-15', '3500000000.00', 'tunai', NULL),
(144, 48, '2025-06-15', '500000.00', 'transfer', '1749996594_bukti bayar2.jpg'),
(145, 48, '2025-06-15', '90000000.00', 'transfer', '1749996605_bukti bayar 3.png'),
(146, 48, '2025-06-15', '210000000.00', 'tunai', NULL),
(147, 49, '2025-06-15', '500000.00', 'tunai', NULL),
(148, 49, '2025-06-15', '90000000.00', 'tunai', NULL),
(149, 49, '2025-06-15', '210000000.00', 'tunai', NULL);

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `kurangi_sisa_tagihan` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
  UPDATE orders
  SET sisa_tagihan = sisa_tagihan - NEW.jumlah_bayar
  WHERE order_id = NEW.order_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `price` decimal(30,2) NOT NULL,
  `stock` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `warna` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `kilometer` int NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_by_id` int NOT NULL,
  `created_by_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `price`, `stock`, `description`, `image_url`, `image_url2`, `image_url3`, `image_url4`, `image_url5`, `created_at`, `updated_at`, `warna`, `tahun`, `kilometer`, `status`, `created_by_id`, `created_by_type`) VALUES
(59, 'ERTIGA', 3, '300000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1748342187.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:36:28', '2025-06-08 02:21:36', 'putih', 2022, 20000, 'approved', 1, 'App\\Models\\Admin'),
(60, 'mobil listrik', 4, '500000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1748342237.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:37:17', '2025-06-08 02:21:29', 'putih', 2025, 5, 'approved', 1, 'App\\Models\\Admin'),
(61, 'Supra', 1, '40000000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1748342286.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:38:06', '2025-06-08 02:21:24', 'putih', 2024, 30000, 'approved', 1, 'App\\Models\\Admin'),
(62, 'Volvo', 5, '5000000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1748342343.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:39:03', '2025-06-08 02:21:17', 'putih', 2021, 500000, 'approved', 1, 'App\\Models\\Admin'),
(63, 'wulling', 6, '400000000.00', 1, 'jika cocok dihati boleh laangsung dimahar!', '1748342418.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:40:19', '2025-06-08 02:20:58', 'putih', 2022, 20000, 'approved', 1, 'App\\Models\\Admin'),
(65, 'inova venturer', 1, '500000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1748342842.jpg', NULL, NULL, NULL, NULL, '2025-05-27 03:47:22', '2025-06-08 02:21:09', 'putih', 2025, 3, 'approved', 1, 'App\\Models\\Customer'),
(66, 'lamborgini', 1, '1000000000.00', 1, 'jika cocok dihati boleh laangsung dimahar!', '1749993992.png', NULL, NULL, NULL, NULL, '2025-06-05 23:38:51', '2025-06-15 06:26:32', 'putih', 2025, 1000, 'approved', 1, 'App\\Models\\Customer'),
(67, 'mustang', 3, '5000000000.00', 1, 'jika cocok dihati boleh laangsung dimahar!', '1749994072.png', NULL, NULL, NULL, NULL, '2025-06-05 23:40:06', '2025-06-15 06:27:52', 'putih', 2002, 1, 'approved', 1, 'App\\Models\\Admin'),
(68, 'angkot', 1, '3000000.00', 1, 'jika cocok dihati boleh laangsung dimahar!', '1749389409.png', NULL, NULL, NULL, NULL, '2025-06-08 06:30:09', '2025-06-08 06:30:09', 'coklat', 2015, 100000, 'pending', 2, 'App\\Models\\Customer'),
(69, 'avanza', 1, '300000000.00', 0, 'jika cocok dihati boleh laangsung dimahar!', '1749994022.png', NULL, NULL, NULL, NULL, '2025-06-14 06:24:30', '2025-06-15 06:27:02', 'abu abu', 2020, 1111, 'approved', 3, 'App\\Models\\Customer'),
(70, 'Seal', 4, '5000000000.00', 1, 'jika cocok dihati boleh laangsung dimahar!', '1749994199.png', NULL, NULL, NULL, NULL, '2025-06-14 10:07:33', '2025-06-15 06:29:59', 'putih', 2023, 32, 'approved', 1, 'App\\Models\\Customer'),
(72, 'jazz', 2, '200000000.00', 0, 'ssss', '1749995704.png', NULL, NULL, NULL, NULL, '2025-06-15 06:55:04', '2025-06-15 06:55:19', 'putih', 2024, 1000, 'approved', 1, 'App\\Models\\Customer');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext,
  `last_activity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_customers` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `last_activity` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
