-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 06:49 AM
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
-- Database: `boneka2`
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
(1, 'ilham', '$2y$12$oMcYT3nr9l6YRaqwKfPGN.zNZgeYoMN81eHaKHTTJrlLuiUZXF3cu', 'ilham@gmail.com', 'ilham', '085691185824', '2025-05-11 20:31:14', '2025-05-11 20:31:14'),
(2, 'admin', '$2y$12$d92ej/5TrtVU877iINU8DunfK7NvnkLvF7I.O3lJKqGXqxWFLDzUe', 'admin@gmail.com', 'admin', '094534634634', '2025-12-13 20:30:45', '2025-12-13 20:30:45');

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
(7, 'Boneka cakil', 'cakil', '2025-11-23 04:18:42', '2025-11-23 04:18:42');

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
(1, 'asep', '123', 'asep@gmail.com', 'asep robianaa', '08080844', 'tigaraksa', '2025-05-12 02:02:17', '2025-05-28 22:46:24'),
(2, 'felan', '$2y$12$.ujiXE.7fykrP4ISt6n9i.Cetd5LsCat7VgM2ar47.a2fudklAmVK', 'felan@gmail.com', 'felan', '0852697567', 'pasar kemis', '2025-06-08 06:23:44', '2025-06-08 06:23:44'),
(3, 'prisma', '$2y$12$PpGXT1kl0srPSGQEwqHqau69KyT0NIVfpd/HZmLugZWZvLXZPWM5m', 'prisma@gmail.com', 'prisma', '0185875555', 'Cikupa', '2025-06-14 06:16:02', '2025-06-14 06:16:02'),
(4, 'user', '$2y$12$iwRWfDQ9B.HtA1kspnEFsOfO8LNXA0h/mLGprzneSLhmFs1UglHwK', 'user@gmail.com', 'user', '085691185824', 'pasar kemis tangerang', '2025-12-13 20:28:56', '2025-12-13 20:28:56');

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
  `status` enum('menunggu','diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci DEFAULT 'menunggu',
  `payment_method` enum('cod','gateway') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(25,2) NOT NULL,
  `shipping_cost` decimal(12,2) DEFAULT '0.00',
  `grand_total` decimal(25,2) NOT NULL,
  `receiver_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `status`, `payment_method`, `total_price`, `shipping_cost`, `grand_total`, `receiver_name`, `receiver_phone`, `shipping_address`, `customer_note`, `created_at`, `updated_at`) VALUES
(43, 1, '2025-06-14 17:00:00', 'menunggu', 'cod', '200500000.00', '0.00', '0.00', '', '', '', NULL, '2025-06-15 06:57:59', '2025-06-15 07:02:49'),
(44, 1, '2025-06-14 17:00:00', 'menunggu', 'cod', '40000500000.00', '0.00', '0.00', '', '', '', NULL, '2025-06-15 07:00:42', '2025-06-15 07:03:15'),
(45, 1, '2025-06-14 17:00:00', 'menunggu', 'cod', '500500000.00', '0.00', '0.00', '', '', '', NULL, '2025-06-15 07:01:48', '2025-06-15 07:03:29'),
(46, 1, '2025-06-14 17:00:00', 'menunggu', 'cod', '500500000.00', '0.00', '0.00', '', '', '', NULL, '2025-06-15 07:03:53', '2025-06-15 07:03:53'),
(59, 3, '2025-11-22 17:00:00', 'menunggu', 'cod', '3000500000.00', '0.00', '0.00', '', '', '', NULL, '2025-11-23 04:20:48', '2025-11-23 08:12:09'),
(60, 3, '2025-11-22 17:00:00', 'menunggu', 'cod', '200500000.00', '0.00', '0.00', '', '', '', NULL, '2025-11-23 04:22:36', '2025-11-23 08:12:57'),
(61, 3, '2025-11-22 17:00:00', 'menunggu', 'cod', '400500000.00', '0.00', '0.00', '', '', '', NULL, '2025-11-23 04:37:48', '2025-11-23 07:52:10'),
(62, 3, '2025-11-22 17:00:00', 'menunggu', 'cod', '200500000.00', '0.00', '0.00', '', '', '', NULL, '2025-11-23 07:54:41', '2025-11-23 08:06:31'),
(69, 2, '2025-12-13 10:43:12', 'menunggu', 'gateway', '1000000.00', '10000.00', '1010000.00', 'felan', '0852697567', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaa', '2025-12-13 10:43:42', '2025-12-13 10:50:29'),
(72, 2, '2025-12-13 11:48:13', 'menunggu', 'cod', '560000.00', '10000.00', '570000.00', 'felan', '0852697567', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', '2025-12-13 11:48:30', '2025-12-13 11:48:30'),
(73, 4, '2025-12-13 20:51:58', 'diproses', 'gateway', '1400000.00', '10000.00', '1410000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 20:52:19', '2025-12-13 23:32:03'),
(75, 4, '2025-12-13 20:55:58', 'dibatalkan', 'cod', '1960000.00', '10000.00', '1970000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 20:56:11', '2025-12-13 22:49:22'),
(77, 4, '2025-12-14 04:12:33', 'dibatalkan', 'cod', '1000000.00', '20000.00', '32000.00', 'asep', '65856567567', 'tahgfdass', NULL, '2025-12-14 04:14:27', '2025-12-13 21:17:34'),
(78, 4, '2025-12-13 21:18:17', 'dibatalkan', 'cod', '560000.00', '15000.00', '575000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 21:18:48', '2025-12-13 22:49:18'),
(79, 4, '2025-12-13 21:20:04', 'dibatalkan', 'cod', '1400000.00', '10000.00', '1410000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 21:20:17', '2025-12-13 22:49:09'),
(80, 4, '2025-12-13 21:45:02', 'diproses', 'cod', '1400000.00', '10000.00', '1410000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 21:45:19', '2025-12-13 21:45:19'),
(81, 4, '2025-12-13 23:09:02', 'diproses', 'gateway', '1400000.00', '10000.00', '1410000.00', 'user', '085691185824', 'pasar kemis tangerang', NULL, '2025-12-13 23:09:13', '2025-12-13 23:31:06');

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
(70, 69, 3, 1, '1000000.00'),
(73, 72, 3, 1, '1000000.00'),
(74, 73, 1, 1, '2000000.00'),
(76, 75, 3, 1, '1000000.00'),
(77, 75, 3, 1, '2000000.00'),
(79, 78, 3, 1, '1000000.00'),
(80, 79, 1, 1, '2000000.00'),
(81, 80, 1, 1, '2000000.00'),
(82, 81, 1, 1, '2000000.00');

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
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `order_id`, `tanggal_pembayaran`, `jumlah_bayar`, `bukti_bayar`, `snap_token`) VALUES
(176, 81, '2025-12-14', '1410000.00', 'bukti_pembayaran/1765693866_nailong3.jpg', NULL),
(177, 73, '2025-12-14', '1410000.00', 'bukti_pembayaran/1765693923_nailong3.jpg', NULL);

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
  `sku` varchar(100) DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `description` text,
  `price` decimal(30,2) NOT NULL,
  `discount` int DEFAULT '0',
  `harga_jual` decimal(30,2) DEFAULT NULL,
  `stock` int DEFAULT '0',
  `weight` int DEFAULT NULL,
  `dimension_length` int DEFAULT NULL,
  `dimension_width` int DEFAULT NULL,
  `dimension_height` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `image_url4` varchar(255) DEFAULT NULL,
  `image_url5` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `shipping_cost_total` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `sku`, `product_name`, `description`, `price`, `discount`, `harga_jual`, `stock`, `weight`, `dimension_length`, `dimension_width`, `dimension_height`, `image_url`, `image_url2`, `image_url3`, `image_url4`, `image_url5`, `category_id`, `shipping_cost_total`, `created_at`, `updated_at`) VALUES
(1, 'TRANS', 'Optimus Prime', 'Classic Transformers Action Figure Patung Pajangan Figure Transformers Class 01 - Optimus Prime\r\n\r\nBerlisensi Resmi (Official Licensed)\r\nTinggi Produk saat sudah dirakit = 13cm\r\nUntuk usia 12+ (12 tahun keatas) Tidak disarankan untuk anak dibawah umur 3 tahun\r\n\r\nLegendary commander of the heroic Autobots, Optimus Prime is a tireless defender of freedom, the common good, and the right of all sentient beings to determine their destiny. He believes every Autobot hes lost in battle is too many. His drive to protect those who remain and the humans they live among, will not stop until the Decepticon threat has been neutralized and his Autobots have returned to their home world of Cybertron.\r\n\r\nPackaging : With Box\r\nReady small kits for assembly directly\r\nNo brush required\r\nNo glue Required\r\nNo cutters required\r\n\r\nHampir semua bagian figur(kaki, tangan) dapat digerakkan untuk mendapatkan pose/postur bertarung yang keren!\r\n+Material : High Quality ABS\r\n+Finishing halus warna cerah\r\n+Detail Sangat Bagus, Presisi dan Modern\r\n+Sangat layak untuk dikoleksi,buat pajangan, objek foto, dsb\r\n\r\nCatatan :\r\n*Untuk proses komplain, mohon menyertakan video unboxing paket, foto resi dan foto produk berkendala/rusak untuk mempermudah validasi. Jika tidak ada bukti yang diminta, komplain tidak bisa diteruskan dan dianggap tidak sah, kecuali memang ada kesalahan dari pihak penjual.\r\n*Apabila kerusakan hanya terjadi pada bagian luar paket, Pembeli bisa melakukan komplain langsung ke Pihak Ekspedisi.', '2000000.00', 30, '1400000.00', 3, NULL, NULL, NULL, NULL, '1765683141.jpg', NULL, NULL, NULL, NULL, 7, '0.00', '2025-12-09 08:51:13', '2025-12-13 23:09:13'),
(3, 'NAILONG', 'nailong', 'sdfsdfsf', '1000000.00', 44, '560000.00', 0, NULL, NULL, NULL, NULL, '1765633532.jpg', NULL, NULL, NULL, NULL, 3, '0.00', '2025-12-11 05:50:36', '2025-12-13 21:18:48');

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
  ADD PRIMARY KEY (`product_id`);

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
  MODIFY `admin_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `FK_OrderDetails_Products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
