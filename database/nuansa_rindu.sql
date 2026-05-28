-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2026 pada 15.27
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuansa_rindu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` tinyint(1) NOT NULL COMMENT '1: Super Admin, 2: Admin, 3: Kontributor',
  `allowed_modules` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Modul yang diizinkan (pisahkan koma)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `profile_picture`, `role_id`, `allowed_modules`, `created_at`) VALUES
(1, 'superadmin', '$2y$10$5yEz0t.Eq.HO/AtzLx3Wo.frwFuR82L.M.1jekfUROUFZ.5ahjz/S', 'superadmin@nuansarindu.id', NULL, 1, 'journeys,journals,galleries,fashions,leads', '2026-05-23 00:21:01'),
(2, 'administrator', '$2y$10$iSweWUqh0jhwHgcdpkbBGOuwr78CMHwCRB3kIsxJBd6e9huTXBUCy', 'administrator@nuansarindu.id', NULL, 2, 'journeys,journals,galleries,fashions,leads', '2026-05-23 08:20:04'),
(4, 'kontributor', '$2y$10$mx6Hi4u9StZYg2k63U7nV.IwtcLCxQqPDJaXkLUQACUy4StnJ3Dbu', 'kontributor@nuansarindu.id', NULL, 3, 'journals,galleries,journeys,fashions', '2026-05-23 10:34:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT 'Nuansa Rindu',
  `email` varchar(150) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `whatsapp_message` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `Maps_iframe` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `company_profile`
--

INSERT INTO `company_profile` (`id`, `company_name`, `email`, `whatsapp`, `whatsapp_message`, `phone`, `address`, `instagram_url`, `facebook_url`, `youtube_url`, `Maps_iframe`, `updated_at`) VALUES
(1, 'Nuansa Rindu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-28 12:20:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fashion_items`
--

CREATE TABLE `fashion_items` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_gallery` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Draft','Published') COLLATE utf8mb4_unicode_ci DEFAULT 'Draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_media`
--

CREATE TABLE `gallery_media` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT 1 COMMENT 'ID Admin pengunggah',
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` enum('Video','Photo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aspect_ratio` enum('Landscape','Portrait') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_slides`
--

CREATE TABLE `hero_slides` (
  `id` int(11) NOT NULL,
  `media_type` enum('Video','Photo') NOT NULL DEFAULT 'Video',
  `media_url` varchar(255) NOT NULL,
  `tagline` varchar(150) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `desc_text` text DEFAULT NULL,
  `btn1_text` varchar(50) DEFAULT NULL,
  `btn1_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(50) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `homepage_settings`
--

CREATE TABLE `homepage_settings` (
  `id` int(11) NOT NULL,
  `show_journey` tinyint(1) NOT NULL DEFAULT 1,
  `show_fashion` tinyint(1) NOT NULL DEFAULT 1,
  `is_slideshow` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Statis, 1: Slideshow',
  `slideshow_autoplay` tinyint(1) NOT NULL DEFAULT 1,
  `about_title` text DEFAULT NULL,
  `about_desc` text DEFAULT NULL,
  `about_media_type` enum('Video','Photo') NOT NULL DEFAULT 'Photo',
  `about_media` varchar(255) DEFAULT NULL,
  `about_video_thumbnail` varchar(255) DEFAULT NULL COMMENT 'Sampul untuk video YouTube unlisted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `homepage_settings`
--

INSERT INTO `homepage_settings` (`id`, `show_journey`, `show_fashion`, `is_slideshow`, `slideshow_autoplay`, `about_title`, `about_desc`, `about_media_type`, `about_media`, `about_video_thumbnail`) VALUES
(1, 1, 1, 0, 1, 'Lebih dari perjalanan,<br>ini tentang<br><em style=\"font-style:italic; color:var(--gold);\">pulang.</em>', 'Setiap detail kami rancang bukan untuk memenuhi itinerary, tetapi untuk merawat hati Anda sepanjang perjalanan.', 'Photo', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL COMMENT 'Pisahkan dengan koma',
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `journals`
--

INSERT INTO `journals` (`id`, `author_id`, `title`, `slug`, `tags`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Persiapan Spiritual Sebelum Berangkat Umroh', 'persiapan-spiritual-sebelum-berangkat-umroh', 'Persiapan, Spiritual, Umroh', '<p>Melakukan ibadah umroh bukan hanya tentang kesiapan fisik dan finansial, tetapi yang paling utama adalah kesiapan hati dan spiritual.</p><p>Berikut adalah beberapa hal yang perlu dipersiapkan...</p>', NULL, 'Draft', '2026-05-25 21:22:30', '2026-05-27 14:56:52'),
(2, 1, 'Cara Menjaga Kesehatan Selama di Mekkah', 'cara-menjaga-kesehatan-selama-di-mekkah', 'Kesehatan, Cuaca, Tips Mekkah', '<p>Menjaga hidrasi adalah kunci utama. Pastikan Anda selalu membawa botol minum sendiri dan meminum air zam-zam secara teratur. Cuaca yang panas di Mekkah bisa menyebabkan dehidrasi dengan cepat jika kita tidak waspada. Jangan lupa gunakan pelembap bibir dan <i>sunblock</i>.</p>', NULL, 'Published', '2026-05-26 09:15:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_comments`
--

CREATE TABLE `journal_comments` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'ID komentar klien yang dibalas',
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` text NOT NULL,
  `is_admin_reply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 jika ini balasan dari admin',
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `leads_consultation`
--

CREATE TABLE `leads_consultation` (
  `id` int(11) NOT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_interest` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `leads_consultation`
--

INSERT INTO `leads_consultation` (`id`, `client_name`, `whatsapp_number`, `package_interest`, `created_at`) VALUES
(1, 'Ahmad Fauzi', '081234567001', 'Rindu Classic', '2026-05-27 18:00:06'),
(2, 'Siti Aminah', '085712345002', 'Sacred Journey', '2026-05-27 18:00:06'),
(3, 'Budi Santoso', '081198765003', 'Rindu Signature', '2026-05-27 18:00:06'),
(4, 'Keluarga Bapak Ridwan', '082133445004', 'Rindu Private', '2026-05-27 18:00:06'),
(5, 'Nadia Saphira', '081344556005', 'Rindu Classic', '2026-05-27 18:00:06'),
(6, 'Andi Wijaya', '087811223006', NULL, '2026-05-27 18:00:06'),
(7, 'Diana Putri', '089677889007', 'Rindu Signature', '2026-05-27 18:00:06'),
(8, 'Hendra Gunawan', '085211223008', 'Sacred Journey', '2026-05-27 18:00:06'),
(9, 'Lestari Ningsih', '081299887009', 'Rindu Classic', '2026-05-27 18:00:06'),
(10, 'Reza Rahadian', '081122334010', 'Rindu Private', '2026-05-27 18:00:06'),
(11, 'Tari Puspita', '081355667788', 'Rindu Classic', '2026-05-27 18:25:46'),
(12, 'Yudi Pratama', '085799887766', 'Rindu Signature', '2026-05-27 18:25:46'),
(13, 'Maya Wulandari', '081233445566', 'Sacred Journey', '2026-05-27 18:25:46'),
(14, 'Dimas Anggara', '082111223344', 'Rindu Private', '2026-05-27 18:25:46'),
(15, 'Rina Safitri', '087855443322', 'Rindu Classic', '2026-05-27 18:25:46'),
(16, 'Agus Setiawan', '089611223344', NULL, '2026-05-27 18:25:46'),
(17, 'Ratna Sari', '081122334455', 'Rindu Signature', '2026-05-27 18:25:46'),
(18, 'Irfan Maulana', '085233445566', 'Sacred Journey', '2026-05-27 18:25:46'),
(19, 'Siska Amalia', '081344556677', 'Rindu Classic', '2026-05-27 18:25:46'),
(20, 'Bambang Susanto', '082199887766', 'Rindu Private', '2026-05-27 18:25:46'),
(21, 'Fitri Handayani', '085711223344', 'Rindu Classic', '2026-05-27 18:25:46'),
(22, 'Dedi Irawan', '087899887766', 'Sacred Journey', '2026-05-27 18:25:46'),
(23, 'Cinta Kirana', '081255667788', 'Rindu Signature', '2026-05-27 18:25:46'),
(24, 'Rizky Ramadhan', '081199887766', NULL, '2026-05-27 18:25:46'),
(25, 'Lestari Putri', '082155667788', 'Rindu Private', '2026-05-27 18:25:46'),
(26, 'Ayu Lestari', '089655667788', 'Rindu Classic', '2026-05-27 18:25:46'),
(27, 'Rafi Budiman', '081399887766', 'Sacred Journey', '2026-05-27 18:25:46'),
(28, 'Nita Agustina', '085755667788', 'Rindu Signature', '2026-05-27 18:25:46'),
(29, 'Bayu Segara', '081211223344', 'Rindu Private', '2026-05-27 18:25:46'),
(30, 'Putri Rahayu', '087811223344', 'Rindu Classic', '2026-05-27 18:25:46'),
(31, 'Anton Saputra', '085299887766', 'Sacred Journey', '2026-05-27 18:25:46'),
(32, 'Aura Mutiara', '081311223344', 'Rindu Signature', '2026-05-27 18:25:46'),
(33, 'Anang Hidayat', '082133445566', NULL, '2026-05-27 18:25:46'),
(34, 'Shanti Permata', '089633445566', 'Rindu Private', '2026-05-27 18:25:46'),
(35, 'Ivan Setiadi', '081155667788', 'Rindu Classic', '2026-05-27 18:25:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `collection_type` enum('Classic','Signature','Private','Sacred') NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `price_display` varchar(100) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `itinerary` text DEFAULT NULL,
  `hotel_details` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `name`, `slug`, `collection_type`, `tagline`, `price_display`, `price`, `itinerary`, `hotel_details`, `main_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Rindu Signature', 'rindu-signature', 'Signature', 'Pengalaman premium tak terlupakan', 'Hubungi Kami', 45000000, '<p>Paket umroh premium dengan akomodasi bintang 5 pilihan, pembimbingan personal, dan dokumentasi sinematik eksklusif untuk setiap jamaah.</p>', '<p><strong>Mekkah:</strong> Fairmont Makkah Clock Royal Tower</p><p><strong>Madinah:</strong> The Oberoi Madinah</p>', '5d26f04a647c2526136b3634f3a8c127.jpg', 'Published', '2026-05-25 19:33:12', NULL),
(3, 'Rindu Private', 'rindu-private', 'Private', 'Dirancang khusus untuk Anda', 'Custom', 75000000, '<p>Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan dan keinginan Anda. Jadwal fleksibel, layanan concierge personal, dan pengalaman tak tertandingi.</p>', '<p>Menyesuaikan dengan preferensi keluarga (Pilihan Hotel Bintang 5 VIP Ring 1).</p>', '29218be97a15abd18459038905187599.jpg', 'Draft', '2026-05-25 19:33:12', NULL),
(4, 'Sacred Journey', 'sacred-journey', 'Sacred', 'Perjalanan haji yang bermakna', 'Hubungi Kami', 250000000, '<p>Program haji kami dirancang untuk memastikan setiap jamaah menjalani ibadah haji dengan khusyuk, nyaman, dan penuh makna spiritual yang mendalam.</p>', '<p><strong>Mekkah:</strong> Raffles Makkah Palace</p><p><strong>Madinah:</strong> Dar Al Taqwa Hotel</p>', 'c34f2d245b2c48cffd08adabd2f2eeec.jpg', 'Published', '2026-05-25 19:33:12', NULL),
(5, 'Rindu Classic', 'rindu-classic', 'Classic', 'Perjalanan penuh ketenangan', 'Hubungi Kami', 35000000, '<p>Paket umroh reguler yang dirancang dengan penuh perhatian untuk memberikan ketenangan dan kenyamanan dalam setiap langkah perjalanan Anda menuju Baitullah.</p><p>Hari 1: Keberangkatan dari Jakarta menuju Jeddah.<br>Hari 2-4: Memperbanyak ibadah di Masjid Nabawi, Madinah. Ziarah Raudhah.<br>Hari 5-8: Perjalanan ke Mekkah. Melaksanakan Umroh Wajib dan ibadah di Masjidil Haram.<br>Hari 9: Kepulangan kembali ke Tanah Air.</p>', '<p>Mekkah: Swissôtel Makkah (Bintang 5) - Jarak 100m ke pelataran Masjidil Haram.<br>Madinah: Anwar Al Madinah Mövenpick (Bintang 5) - Berada tepat di depan pintu masuk Masjid Nabawi.</p>', 'ca64b7d2840df5fcf9b9c9133cb9210e.jpg', 'Published', '2026-05-25 15:31:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `seo_metadata`
--

CREATE TABLE `seo_metadata` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `seo_tracking_settings`
--

CREATE TABLE `seo_tracking_settings` (
  `id` int(11) NOT NULL,
  `gsc_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ga4_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_pixel_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `seo_tracking_settings`
--

INSERT INTO `seo_tracking_settings` (`id`, `gsc_code`, `ga4_code`, `meta_pixel_code`, `updated_at`) VALUES
(1, '', NULL, NULL, '2026-05-26 04:23:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fashion_items`
--
ALTER TABLE `fashion_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `gallery_media`
--
ALTER TABLE `gallery_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero_slides`
--
ALTER TABLE `hero_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `homepage_settings`
--
ALTER TABLE `homepage_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `journal_comments`
--
ALTER TABLE `journal_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `leads_consultation`
--
ALTER TABLE `leads_consultation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seo_metadata`
--
ALTER TABLE `seo_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seo_tracking_settings`
--
ALTER TABLE `seo_tracking_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `fashion_items`
--
ALTER TABLE `fashion_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_media`
--
ALTER TABLE `gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hero_slides`
--
ALTER TABLE `hero_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `homepage_settings`
--
ALTER TABLE `homepage_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `journal_comments`
--
ALTER TABLE `journal_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `leads_consultation`
--
ALTER TABLE `leads_consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `seo_metadata`
--
ALTER TABLE `seo_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seo_tracking_settings`
--
ALTER TABLE `seo_tracking_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
