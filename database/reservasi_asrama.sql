-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_asrama`
--

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `facility_code` varchar(20) NOT NULL,
  `facility_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable','maintenance') NOT NULL DEFAULT 'available',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_code`, `facility_name`, `category`, `price`, `capacity`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'PUTRA02', 'PUTRA API UPDATE', 'Kamar Putra', 200000.00, 1, 'Kamar mahasiswa putra', NULL, 'available', '2026-06-18 15:00:57', '2026-07-02 18:44:52'),
(3, 'PUTRA03', 'Putra-03', 'Kamar Putra', 150000.00, 1, 'Kamar mahasiswa putra', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(4, 'PUTRA04', 'Putra-04', 'Kamar Putra', 150000.00, 1, 'Kamar mahasiswa putra', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(5, 'PUTRA05', 'Putra-05', 'Kamar Putra', 150000.00, 1, 'Kamar mahasiswa putra', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(6, 'PUTRI01', 'Putri-01', 'Kamar Putri', 150000.00, 1, 'Kamar mahasiswa putri', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(7, 'PUTRI02', 'Putri-02', 'Kamar Putri', 150000.00, 1, 'Kamar mahasiswa putri', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(8, 'PUTRI03', 'Putri-03', 'Kamar Putri', 150000.00, 1, 'Kamar mahasiswa putri', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(9, 'PUTRI04', 'Putri-04', 'Kamar Putri', 150000.00, 1, 'Kamar mahasiswa putri', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(10, 'PUTRI05', 'Putri-05', 'Kamar Putri', 150000.00, 1, 'Kamar mahasiswa putri', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(11, 'TAMU01', 'Tamu-01', 'Kamar Tamu', 100000.00, 2, 'Kamar tamu asrama', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(12, 'TAMU02', 'Tamu-02', 'Kamar Tamu', 100000.00, 2, 'Kamar tamu asrama', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(13, 'TAMU03', 'Tamu-03', 'Kamar Tamu', 100000.00, 2, 'Kamar tamu asrama', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(14, 'TAMU04', 'Tamu-04', 'Kamar Tamu', 100000.00, 2, 'Kamar tamu asrama', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(15, 'TAMU05', 'Tamu-05', 'Kamar Tamu', 100000.00, 2, 'Kamar tamu asrama', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(16, 'PARKIRMOBIL', 'Parkir Mobil', 'Parkir', 20000.00, 25, 'Area parkir mobil', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(17, 'PARKIRBUS', 'Parkir Bus', 'Parkir', 50000.00, 10, 'Area parkir bus', NULL, '', '2026-06-18 15:00:57', '2026-06-18 15:00:57'),
(18, 'Test-01', 'Kamar Testing', 'Kamar', 250000.00, 2, 'testing fasilitas pertama', NULL, '', '2026-06-20 09:27:40', '2026-06-20 09:27:40'),
(22, 'TEST-001', 'Kamar Uji Sistem update', 'Testing', 75000.00, 2, 'data test crud', NULL, '', '2026-06-24 18:21:54', '2026-06-24 18:24:16'),
(24, 'API001', 'Kamar Testing API', 'Kamar Tamu', 75000.00, 1, 'Testing endpoint API', NULL, 'available', '2026-07-02 18:42:58', '2026-07-02 18:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-18-141539', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1781793806, 1),
(2, '2026-06-18-141708', 'App\\Database\\Migrations\\CreateFacilitiesTable', 'default', 'App', 1781793806, 1),
(3, '2026-06-18-141717', 'App\\Database\\Migrations\\CreateReservationsTable', 'default', 'App', 1781793806, 1),
(4, '2026-06-18-141726', 'App\\Database\\Migrations\\CreatePaymentsTable', 'default', 'App', 1781793806, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `reservation_id` int(11) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `payment_method` enum('Transfer Bank','QRIS') NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_status` enum('Belum Bayar','Menunggu Verifikasi','Lunas','Ditolak') NOT NULL DEFAULT 'Belum Bayar',
  `payment_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reservation_id`, `invoice_number`, `payment_method`, `payment_proof`, `payment_status`, `payment_date`, `created_at`, `updated_at`) VALUES
(6, 11, 'INV-3427', 'Transfer Bank', '1782669353_834a4b352d5d739541ec.png', 'Lunas', NULL, '2026-06-28 17:55:53', '2026-06-28 17:56:01'),
(7, 12, 'INV-4178', 'Transfer Bank', '1782669425_82a3685682fe27d28fa3.png', 'Lunas', NULL, '2026-06-28 17:57:05', '2026-06-28 17:57:15'),
(9, 15, 'INV-6186', 'Transfer Bank', '1782823466_50d80f277a4d4dc152c6.png', 'Lunas', NULL, '2026-06-30 12:44:26', '2026-06-30 12:44:45'),
(10, 16, 'INV-2014', 'Transfer Bank', '1782823847_9397cef693c725f86c9a.png', 'Lunas', NULL, '2026-06-30 12:50:47', '2026-06-30 12:50:58'),
(11, 17, 'INV-6500', 'Transfer Bank', '1782881043_6c8a6e6aa87302bfe13a.png', 'Lunas', NULL, '2026-07-01 04:44:03', '2026-07-01 04:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) UNSIGNED NOT NULL,
  `reservation_code` varchar(50) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `purpose` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Selesai','Checkout') NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `reservation_code`, `user_id`, `facility_id`, `purpose`, `start_date`, `end_date`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(11, 'RSV-20260628-002', 6, 3, 'mahasiswa', '2026-07-01', '2026-07-31', 300000.00, 'Selesai', '2026-06-28 17:55:11', '2026-06-28 17:56:01'),
(12, 'RSV-20260628-003', 6, 16, 'parkir mobil', '2026-07-01', '2026-07-04', 80000.00, 'Selesai', '2026-06-28 17:56:38', '2026-06-28 17:57:15'),
(15, 'RSV-20260630-001', 6, 2, 'mahasiswa ', '2026-07-01', '2026-07-31', 300000.00, 'Selesai', '2026-06-30 12:14:02', '2026-06-30 12:44:45'),
(16, 'RSV-20260630-002', 6, 4, 'mahasiswa ', '2026-07-01', '2026-07-31', 300000.00, 'Checkout', '2026-06-30 12:21:07', '2026-06-30 20:19:49'),
(17, 'RSV-20260701-001', 6, 4, 'mahasiswa ', '2026-07-01', '2026-07-31', 300000.00, 'Selesai', '2026-07-01 04:43:03', '2026-07-01 04:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('admin','user','guest') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@asrama.com', '$2y$10$aC7nLlA5oG4ZE6GA4OhTc.WzINeFDrlgzo74487mJatfS1/O/rZOO', '081234567890', 'admin', '2026-06-18 14:56:37', '2026-06-18 14:56:37'),
(5, 'Guest Testing', 'guest@asrama.com', '$2y$10$5lKbEz8WAyhuHUe3K86WLusVItPAFJhnS/KMIfGj1xy58nWy8/bNS', '081111111111', 'guest', NULL, NULL),
(6, 'User Testing', 'user@asrama.com', '$2y$10$tthEQeRKndW9hXKdHROVpu99iXV5lwzmMTC0NsZ3vLFs4yVAOMHQC', '082222222222', 'user', '2026-06-25 14:02:02', '2026-06-26 15:27:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_reservation_id_foreign` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_facility_id_foreign` (`facility_id`);

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
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
