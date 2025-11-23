-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2025 at 03:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.23

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
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `jumlah_bayar` decimal(50,2) DEFAULT NULL,
  `metode` enum('tunai','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `order_id`, `tanggal_pembayaran`, `jumlah_bayar`, `metode`, `bukti_bayar`, `snap_token`) VALUES
(135, 43, '2025-06-15', '500000.00', 'transfer', '1749995965_bukti bayar.jpg', ''),
(136, 43, '2025-06-15', '60000000.00', 'tunai', NULL, ''),
(151, 52, '2025-11-20', '500000.00', 'transfer', '1763655817_Screenshot 2025-11-16 143248.png', ''),
(152, 51, '2025-11-20', '500000.00', 'transfer', '1763655841_Screenshot 2025-11-16 143248.png', ''),
(153, 51, '2025-11-20', '300000000.00', 'transfer', '1763655907_Screenshot 2025-11-16 143248.png', ''),
(154, 51, '2025-11-20', '700000000.00', 'transfer', NULL, ''),
(155, 52, '2025-11-23', '120000000.00', 'transfer', '1763862861_Screenshot 2025-11-16 143248.png', NULL),
(156, 56, '2025-11-23', '500000.00', 'transfer', '1763867536_Screenshot 2025-11-16 143248.png', NULL),
(157, 57, '2025-11-23', '500000.00', 'transfer', '1763867633_Screenshot 2025-11-16 143248.png', NULL),
(158, 59, '2025-11-23', '500000.00', 'transfer', '1763897064_welcome2.png', NULL),
(159, 60, '2025-11-23', '500000.00', 'transfer', '1763897159_Screenshot 2025-11-16 143248.png', NULL),
(160, 61, '2025-11-23', '500000.00', 'transfer', '1763898017_Screenshot 2025-11-16 143248.png', NULL),
(161, 61, '2025-11-23', '120000000.00', 'transfer', '1763898115_Screenshot 2025-11-16 143248.png', NULL),
(162, 61, '2025-11-23', '280000000.00', 'tunai', NULL, NULL),
(163, 62, '2025-11-23', '500000.00', 'transfer', '1763909745_Screenshot 2025-11-16 143248.png', NULL),
(164, 62, '2025-11-23', '60000000.00', 'transfer', '1763910286_Screenshot 2025-11-16 143248.png', NULL),
(165, 62, '2025-11-23', '140000000.00', 'transfer', '1763910391_Screenshot 2025-11-16 143248.png', NULL),
(166, 59, '2025-11-23', '900000000.00', 'tunai', NULL, NULL),
(167, 59, '2025-11-23', '2100000000.00', 'transfer', '1763910729_Screenshot 2025-11-16 143248.png', NULL),
(168, 60, '2025-11-23', '60000000.00', 'transfer', '1763910777_Screenshot 2025-11-16 143248.png', NULL);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
