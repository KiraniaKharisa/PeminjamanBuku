-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2026 at 03:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint UNSIGNED NOT NULL,
  `kode_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `sampul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `penulis`, `penerbit`, `tanggal_terbit`, `kategori_id`, `stok`, `sampul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'B001', 'With J', 'Fahmy', 'Tech Press', '2023-01-01', 2, 11, '1.jpeg', 'Novel romantis yang mengisahkan perjalanan cinta dan tantangan hidup.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ab veritatis molestiae perspiciatis atque ea alias cupiditate provident dolore commodi reiciendis ut ad maxime at delectus vel recusandae magnam harum nam mollitia similique accusamus, est rem temporibus. Consequatur, quo nisi minima, nulla neque magnam commodi magni tempora provident harum vel aliquid ex fugit dicta! Porro, voluptates maiores? Exercitationem eum veritatis esse recusandae, dolorem laborum fugiat! Harum, velit. Commodi at explicabo impedit ut libero repudiandae ratione nam reiciendis, facere iure, doloremque harum vel nulla quam ea asperiores provident quibusdam nostrum soluta nisi saepe. Ex placeat odio non, neque amet accusamus nisi.', '2026-01-18 20:15:04', '2026-01-30 00:53:08'),
(2, 'B002', 'Madu Mongso', 'Kirania', 'SMK DJ', '2026-01-20', 4, 1, '1768891104_afterDearJ.jpeg', 'Novel romantis yang mengisahkan perjalanan cinta dan tantangan hidup.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ab veritatis molestiae perspiciatis atque ea alias cupiditate provident dolore commodi reiciendis ut ad maxime at delectus vel recusandae magnam harum nam mollitia similique accusamus, est rem temporibus. Consequatur, quo nisi minima, nulla neque magnam commodi magni tempora provident harum vel aliquid ex fugit dicta! Porro, voluptates maiores? Exercitationem eum veritatis esse recusandae, dolorem laborum fugiat! Harum, velit. Commodi at explicabo impedit ut libero repudiandae ratione nam reiciendis, facere iure, doloremque harum vel nulla quam ea asperiores provident quibusdam nostrum soluta nisi saepe. Ex placeat odio non, neque amet accusamus nisi.', '2026-01-19 23:38:25', '2026-01-27 05:45:54'),
(3, 'B003', 'After Dear J', 'Kirania', 'Gramedia', '2026-01-30', 1, 10, '1769734315_afterWithJ.jpeg', 'Buku ini merupakan buku ke 2 dari novel Dear J, latar belakang di buku ini merupakan cerita masa depan dari Na Jaemin, Na Jeno dan kim Jeha yang dimana dimasa itu sudah ada robot untuk membantu orang dalam pekerjaan nya di juga sudah ada mobil terbang', '2026-01-30 00:51:56', '2026-01-30 00:51:56'),
(4, 'B004', 'Hujan', 'Tere Liye', 'Gramedia', '2025-12-01', 3, 15, '1769985978_hujan.jpeg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate repellat explicabo sapiente est, aperiam porro libero iure optio ratione doloremque ad, odio sunt voluptatibus quaerat! Vero quia accusantium, dolorum possimus aperiam aliquid beatae, eos id repellendus quaerat eaque eius ipsam, voluptate quod cupiditate dignissimos iste alias unde dolorem. Cumque harum doloribus, facilis molestias sunt ullam rerum adipisci nulla incidunt voluptatum, ipsam, accusamus repudiandae totam reiciendis tempore ex molestiae possimus illum. Exercitationem quod cupiditate eum assumenda incidunt ipsam eligendi voluptatem odit aliquam, temporibus quos repellat, quidem modi deleniti praesentium nisi et. Neque voluptas aliquam laboriosam pariatur quidem accusantium exercitationem reprehenderit praesentium!', '2026-02-01 22:46:20', '2026-02-01 22:46:20'),
(5, 'B005', 'Sunset Bersama Rosie', 'Tere Liye', 'Gramedia', '2025-11-01', 1, 20, '1769986058_sunset.jpeg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate repellat explicabo sapiente est, aperiam porro libero iure optio ratione doloremque ad, odio sunt voluptatibus quaerat! Vero quia accusantium, dolorum possimus aperiam aliquid beatae, eos id repellendus quaerat eaque eius ipsam, voluptate quod cupiditate dignissimos iste alias unde dolorem. Cumque harum doloribus, facilis molestias sunt ullam rerum adipisci nulla incidunt voluptatum, ipsam, accusamus repudiandae totam reiciendis tempore ex molestiae possimus illum. Exercitationem quod cupiditate eum assumenda incidunt ipsam eligendi voluptatem odit aliquam, temporibus quos repellat, quidem modi deleniti praesentium nisi et. Neque voluptas aliquam laboriosam pariatur quidem accusantium exercitationem reprehenderit praesentium!', '2026-02-01 22:47:38', '2026-02-01 22:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `buku_favorit`
--

CREATE TABLE `buku_favorit` (
  `id_favorit` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku_favorit`
--

INSERT INTO `buku_favorit` (`id_favorit`, `user_id`, `buku_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(4, 1, 2, '2026-01-28 08:17:30', '2026-01-28 08:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(2, 'Teknologi', '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(3, 'Sejarah', '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(4, 'Edukasi', '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(5, 'Laravel', '2026-02-01 22:47:53', '2026-02-01 22:47:53'),
(6, 'Programmer', '2026-02-01 22:48:11', '2026-02-01 22:48:11'),
(7, 'Indonesia', '2026-02-01 22:48:23', '2026-02-01 22:48:23'),
(8, 'Politik', '2026-02-01 22:49:21', '2026-02-01 22:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_09_040747_role', 1),
(5, '2026_01_09_040941_create_bukus_table', 1),
(6, '2026_01_09_041030_create_transaksis_table', 1),
(7, '2026_01_09_041127_create_buku__favorits_table', 1),
(8, '2026_01_09_041137_create_kategoris_table', 1),
(9, '2026_01_09_053915_add_relationship_role_id_to_user_table', 1),
(10, '2026_01_09_054223_add_relationship_kategori_id_to_buku_table', 1),
(11, '2026_01_09_054505_add_relationship_user_and_buku_to_transaksi_table', 1),
(12, '2026_01_09_054701_add_relationship_user_and_buku_to_buku_favorit_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2026-01-18 20:15:04', '2026-01-18 20:15:04'),
(2, 'User', '2026-01-18 20:15:04', '2026-01-18 20:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('htPQzIqdtTtmJYnFF1o5b0KeybYRUbU4eM26gJqX', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTTlKOE93dlp1dndMdHFYalJLWHZzblVHNmtpWWlFMERYSVpSTFFzMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvZmF2b3JpdCI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idWt1LzQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1770090244);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `total_pinjam` int NOT NULL DEFAULT '1',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Sukses,2=Dikembalikan,3=Ditolak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `user_id`, `buku_id`, `total_pinjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-01-20', '2026-01-23', 2, '2026-01-18 20:15:04', '2026-01-21 05:31:53'),
(2, 1, 1, 3, '2026-01-20', '2026-01-23', 2, '2026-01-19 18:29:37', '2026-01-21 05:31:57'),
(3, 1, 1, 3, '2026-01-20', '2026-01-23', 1, '2026-01-19 18:32:39', '2026-01-21 05:32:15'),
(4, 1, 2, 9, '2026-01-27', '2026-01-28', 1, '2026-01-27 05:31:29', '2026-01-27 05:45:54'),
(5, 4, 4, 1, '2026-02-04', '2026-02-11', 0, '2026-02-03 01:32:04', '2026-02-03 01:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role_id`, `profil`, `created_at`, `updated_at`) VALUES
(1, 'Raniad', 'admin', '$2y$12$ScCVWiGzDSWTEev.csXzeee8LmZ0C3eB4hCdvsL/jVlK0joyBrX9m', 1, '1769813187_image.ranibuwuh.jpg', '2026-01-18 20:15:04', '2026-01-30 22:46:27'),
(2, 'kirania', 'kirania', '$2y$12$ScCVWiGzDSWTEev.csXzeee8LmZ0C3eB4hCdvsL/jVlK0joyBrX9m', 2, NULL, '2026-01-23 02:56:46', '2026-01-23 02:56:46'),
(3, 'Rania', 'rania', '$2y$12$ScCVWiGzDSWTEev.csXzeee8LmZ0C3eB4hCdvsL/jVlK0joyBrX9m', 2, NULL, '2026-01-27 04:11:18', '2026-01-27 04:11:18'),
(4, 'pembaca', 'pembaca', '$2y$12$U8zDfl9/WBbgWAT8opkNXOX/r9L2isIAblIeJSLQCTkr6SxFa0cSa', 2, NULL, '2026-02-03 01:30:48', '2026-02-03 01:30:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `buku_kode_buku_unique` (`kode_buku`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `buku_favorit`
--
ALTER TABLE `buku_favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `buku_favorit_user_id_foreign` (`user_id`),
  ADD KEY `buku_favorit_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `role_role_unique` (`role`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`),
  ADD KEY `transaksi_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD KEY `user_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku_favorit`
--
ALTER TABLE `buku_favorit`
  MODIFY `id_favorit` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku_favorit`
--
ALTER TABLE `buku_favorit`
  ADD CONSTRAINT `buku_favorit_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_favorit_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
