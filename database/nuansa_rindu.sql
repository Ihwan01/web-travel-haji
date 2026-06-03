-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2026 pada 20.08
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
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` tinyint(1) NOT NULL COMMENT '1: Super Admin, 2: Admin, 3: Kontributor',
  `allowed_modules` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Modul yang diizinkan (pisahkan koma)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `reset_token`, `reset_token_expires`, `email`, `profile_picture`, `role_id`, `allowed_modules`, `created_at`) VALUES
(1, 'superadmin', '$2y$10$e/gCeXxYSFurf9nqUoiCX.4c8vua4k77Jn0TdrFdVRed68P.OoHdq', NULL, NULL, 'superadmin@nuansarindu.id', 'assets/uploads/profile/cc3595c6f9976fb860145063cf0b3520.jpg', 1, 'journeys,journals,galleries,fashions,leads', '2026-05-23 00:21:01'),
(2, 'administrator', '$2y$10$iSweWUqh0jhwHgcdpkbBGOuwr78CMHwCRB3kIsxJBd6e9huTXBUCy', NULL, NULL, 'administrator@nuansarindu.id', NULL, 2, 'journeys,journals,galleries,fashions,leads', '2026-05-23 08:20:04'),
(4, 'kontributor', '$2y$10$lq5lQ224IQShJ9NJmtMvTOaUmXKWn0yivZXQitMul/IyZ6nmruLSS', 'c3915247d4ec81589584ec047c0bc8086683ee4e6ccc9a12771ade951838d938', '2026-06-02 16:30:49', 'rusman.putra.712@gmail.com', NULL, 3, 'journals,galleries,journeys,fashions,leads', '2026-05-23 10:34:52');

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
(1, 'Nuansa Rindu', '', '', '', '', '', 'https://www.instagram.com/nuansarindu.id', '', '', '', '2026-06-01 15:30:05');

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

--
-- Dumping data untuk tabel `fashion_items`
--

INSERT INTO `fashion_items` (`id`, `name`, `slug`, `description`, `fabric_details`, `image_gallery`, `status`, `created_at`) VALUES
(1, 'Abaya Hitam Elegan Al-Haram', 'abaya-hitam-elegan-al-haram', '<p>Abaya eksklusif yang dirancang khusus untuk kenyamanan maksimal saat beribadah di cuaca panas Mekkah.</p>', 'Katun Toyobo Premium', '[\"assets\\/uploads\\/fashions\\/6a1f0266698cf_1780417126_0.jpg\"]', 'Published', '2026-05-29 03:00:00'),
(2, 'Koko Putih Madinah Signature', 'koko-putih-madinah-signature', '<p>Baju koko berlengan panjang dengan potongan modern yang tetap menjaga kesopanan dan sirkulasi udara.</p>', 'Katun Madinah', '[\"assets\\/uploads\\/fashions\\/6a1f023601522_1780417078_0.jpg\"]', 'Published', '2026-05-29 03:15:00'),
(3, 'Bergo Instan Syari Safa', 'bergo-instan-syari-safa', '<p>Hijab bergo instan yang sangat praktis digunakan selama aktivitas Sa\'i dan Thawaf.</p>', 'Ceruty Babydoll', '[\"assets\\/uploads\\/fashions\\/6a1f020eeee22_1780417038_0.jpg\"]', 'Published', '2026-05-29 03:30:00'),
(4, 'Bagasi Eksklusif', 'bagasi-eksklusif', 'Bagasi Eksklusif dapat custom sesuai keinginan. Hindari kesan monoton dalam perjalanan anda', 'Tampilan hardcase custom', '[\"assets\\/uploads\\/fashions\\/6a1f02e6b3b16_1780417254_0.jpg\"]', 'Published', '2026-06-02 11:20:54'),
(5, 'Passport Holder Luxury', 'passport-holder-luxury', 'Bosan dengan aksesoris monoton? beragam keunikan kini berada di tangan anda', 'Genuine Leather', '[\"assets\\/uploads\\/fashions\\/6a1f03afb3be9_1780417455_0.jpg\",\"assets\\/uploads\\/fashions\\/6a1f03afc0f53_1780417455_1.jpg\"]', 'Published', '2026-06-02 11:24:15');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gallery_media`
--

INSERT INTO `gallery_media` (`id`, `author_id`, `title`, `media_type`, `file_url`, `thumbnail_url`, `created_at`) VALUES
(1, 1, 'Senja di Masjid Nabawi', 'Photo', 'assets/uploads/gallery/photos/6a1eff81a382e_1780416385.jpg', 'thumb_nabawi_senja.jpg', '2026-05-29 04:00:00'),
(4, 1, 'Madinah yang dirindukan', 'Photo', 'assets/uploads/gallery/photos/6a1eed6c68e14_1780411756.jpg', NULL, '2026-06-02 09:49:16'),
(5, 1, 'Senja di Ka\'bah', 'Photo', 'assets/uploads/gallery/photos/6a1f0134a3915_1780416820.jpg', NULL, '2026-06-02 11:13:40'),
(6, 1, 'Senja di Madinah', 'Photo', 'assets/uploads/gallery/photos/6a1f01487edd2_1780416840.jpg', NULL, '2026-06-02 11:14:00'),
(7, 1, 'Ka\'bah cerah Tawaf berkah', 'Photo', 'assets/uploads/gallery/photos/6a1f0173890a9_1780416883.jpg', NULL, '2026-06-02 11:14:43'),
(8, 1, 'Senja Syahduh Ka\'bah Kurindu', 'Photo', 'assets/uploads/gallery/photos/6a1f019a326f5_1780416922.jpg', NULL, '2026-06-02 11:15:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_slides`
--

CREATE TABLE `hero_slides` (
  `id` int(11) NOT NULL,
  `media_type` enum('Video','Photo') NOT NULL DEFAULT 'Video',
  `media_url` varchar(255) NOT NULL,
  `video_thumbnail` varchar(255) DEFAULT NULL,
  `tagline` varchar(150) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `desc_text` text DEFAULT NULL,
  `btn_text` varchar(50) DEFAULT NULL,
  `btn_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hero_slides`
--

INSERT INTO `hero_slides` (`id`, `media_type`, `media_url`, `video_thumbnail`, `tagline`, `title`, `desc_text`, `btn_text`, `btn_url`, `sort_order`) VALUES
(3, 'Video', 'https://youtu.be/L-YyR1oN66w?si=Y__YFSJEK4uXqAec', NULL, 'Perjalanan Spiritual', 'Kembali ke Baitullah bersama Nuansa Rindu', 'Wujudkan kerinduan Anda ke Tanah Suci dengan pelayanan premium dan bimbingan ibadah yang khusyuk.', 'Jelajahi Paket', '/packages', 0);

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
(1, 1, 1, 0, 1, 'Lebih dari perjalanan,<br>ini tentang<br><em xss=removed>pulang.</em>', 'Setiap detail kami rancang bukan untuk memenuhi itinerary, tetapi untuk merawat hati Anda sepanjang perjalanan.', 'Photo', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
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

INSERT INTO `journals` (`id`, `author_id`, `category_id`, `title`, `slug`, `tags`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Persiapan Spiritual Sebelum Berangkat Umroh', 'persiapan-spiritual-sebelum-berangkat-umroh', 'Persiapan, Spiritual, Umroh', '<p>Melakukan ibadah umroh bukan hanya tentang kesiapan fisik dan finansial, tetapi yang paling utama adalah kesiapan hati dan spiritual.</p><p>Berikut adalah beberapa hal yang perlu dipersiapkan...</p>', 'fea44d70ee14490b2c8958fb7ec3f205.jpg', 'Published', '2026-05-25 21:22:30', '2026-06-02 17:51:02'),
(2, 1, 2, 'Cara Menjaga Kesehatan Selama di Mekkah', 'cara-menjaga-kesehatan-selama-di-mekkah', 'Kesehatan, Cuaca, Tips Mekkah', '<p>Menjaga hidrasi adalah kunci utama. Pastikan Anda selalu membawa botol minum sendiri dan meminum air zam-zam secara teratur. Cuaca yang panas di Mekkah bisa menyebabkan dehidrasi dengan cepat jika kita tidak waspada. Jangan lupa gunakan pelembap bibir dan <i>sunblock</i>.</p>', '70396676c20915fc9ab5f92c99deaebb.jpg', 'Published', '2026-05-26 09:15:00', '2026-06-02 17:49:43'),
(3, 2, 1, 'Mengapa Madinah Selalu Dirindukan?', 'mengapa-madinah-selalu-dirindukan', 'Madinah, Inspirasi, Rindu', '<p>Kota Madinah Al-Munawwarah selalu memiliki tempat khusus di hati para jamaah. Ketenangan yang merasuk ke dalam jiwa saat menginjakkan kaki di pelataran Masjid Nabawi tidak bisa diungkapkan dengan kata-kata.</p><p>Banyak ulama mengatakan bahwa Madinah adalah kota di mana hati merasa pulang. Di sinilah letak makam manusia paling mulia, Rasulullah SAW.</p>', '889d609a568c2585b2bdf762578fa4f3.jpg', 'Published', '2026-05-27 10:00:00', '2026-06-02 18:05:44'),
(4, 1, 3, 'Mengenal Sejarah Hajar Aswad', 'mengenal-sejarah-hajar-aswad', 'Sejarah, Mekkah, Hajar Aswad', '<p>Hajar Aswad adalah batu hitam yang terletak di sudut timur Ka\'bah. Mencium atau menyentuh Hajar Aswad adalah sunnah bagi jamaah yang sedang melakukan Thawaf.</p><p>Sejarah mencatat bahwa Hajar Aswad diturunkan langsung dari surga dan awalnya berwarna sangat putih, namun menghitam karena dosa-dosa manusia.</p>', 'bb0d6d2a41d5be4e6e96d7aeff0efad0.jpg', 'Published', '2026-05-28 14:30:00', '2026-06-02 18:05:03'),
(5, 4, 2, 'Tips Memilih Paket Umroh yang Tepat untuk Keluarga', 'tips-memilih-paket-umroh-yang-tepat-untuk-keluarga', 'Tips, Paket Umroh, Keluarga', '<p>Membawa keluarga, terutama anak-anak atau orang tua yang sudah lanjut usia untuk beribadah umroh membutuhkan pertimbangan khusus.</p><p>Pertama, pastikan jarak hotel ke masjid tidak terlalu jauh. Kedua, perhatikan jadwal maskapai penerbangan agar jamaah lansia bisa beristirahat dengan baik selama perjalanan.</p>', 'a49766e5db341f49063a4ff2a10dc195.jpg', 'Published', '2026-05-29 09:15:00', '2026-06-02 18:03:56'),
(6, 1, 3, 'Keutamaan Shalat di Hijir Ismail', 'keutamaan-shalat-di-hijir-ismail', 'Mekkah, Fiqih, Ka\'bah', '<p>Hijir Ismail adalah area setengah lingkaran yang berada di sebelah utara Ka\'bah. Tahukah Anda bahwa shalat di dalam Hijir Ismail hukumnya sama dengan shalat di dalam Ka\'bah?</p><p>Oleh karena itu, area ini selalu dipenuhi oleh jamaah yang ingin memanjatkan doa-doa khusus mereka.</p>', '21c76722c8507b073194e2350f495268.jpg', 'Published', '2026-05-30 11:00:00', '2026-06-02 18:02:29'),
(7, 2, 1, 'Pengalaman Umroh di Bulan Ramadhan', 'pengalaman-umroh-di-bulan-ramadhan', 'Ramadhan, Umroh, Inspirasi', '<p>Nabi Muhammad SAW bersabda, \"Umroh di bulan Ramadhan pahalanya sama dengan menunaikan haji bersamaku.\"</p><p>Suasana berbuka puasa bersama jutaan umat muslim dari seluruh dunia di pelataran Masjidil Haram adalah pengalaman spiritual puncak yang akan terus membekas seumur hidup.</p>', '941996bbdf39a18f1f7f194d216b1059.jpg', 'Published', '2026-06-01 16:45:00', '2026-06-02 18:00:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_categories`
--

CREATE TABLE `journal_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `journal_categories`
--

INSERT INTO `journal_categories` (`id`, `name`, `slug`) VALUES
(1, 'Inspirasi & Hikmah', 'inspirasi-hikmah'),
(2, 'Tips & Panduan Umroh', 'tips-panduan-umroh'),
(3, 'Sejarah & Kajian Islam', 'sejarah-kajian-islam');

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

--
-- Dumping data untuk tabel `journal_comments`
--

INSERT INTO `journal_comments` (`id`, `journal_id`, `parent_id`, `name`, `email`, `comment`, `is_admin_reply`, `status`, `created_at`) VALUES
(1, 1, NULL, 'Bapak Santoso', 'santoso.b@email.com', 'Artikel yang sangat bermanfaat. Apakah ada sesi manasik khusus untuk mematangkan persiapan ini?', 0, 'Approved', '2026-05-28 08:30:00'),
(2, 1, 1, 'Admin Nuansa Rindu', 'admin@nuansarindu.id', 'Terima kasih Bapak Santoso. Betul, kami menyediakan sesi manasik eksklusif sebanyak 3 kali sebelum keberangkatan.', 1, 'Approved', '2026-05-28 09:00:00'),
(3, 1, 2, 'Bapak Santoso', 'santoso.b@email.com', 'Alhamdulillah, lokasinya di mana ya min untuk manasiknya? Dan apakah boleh membawa keluarga yang tidak ikut berangkat?', 0, 'Approved', '2026-05-28 10:15:00'),
(4, 1, 3, 'Admin Nuansa Rindu', 'admin@nuansarindu.id', 'Lokasi manasik biasanya diadakan di aula kantor pusat kami atau di hotel rekanan terdekat, Pak. Untuk keluarga diperbolehkan ikut mendampingi.', 1, 'Approved', '2026-05-28 10:45:00'),
(5, 1, 4, 'Bapak Santoso', 'santoso.b@email.com', 'Baik, terima kasih banyak informasinya. Sangat membantu.', 0, 'Pending', '2026-05-28 11:00:00'),
(6, 2, NULL, 'Ibu Aminah', 'aminah.siti@email.com', 'Tipsnya sangat membantu, kebetulan saya punya riwayat asma, apakah obat bawaan boleh masuk ke kabin pesawat?', 0, 'Pending', '2026-05-29 07:15:00'),
(7, 2, NULL, 'Promo Umroh Murah', 'spam@email.com', 'Jual obat herbal kuat stamina umroh murah meriah klik link ini...', 0, 'Rejected', '2026-05-29 08:00:00'),
(8, 3, NULL, 'Fatimah Az-Zahra', 'fatimah.azz@email.com', 'MasyaAllah, membaca artikel ini membuat kerinduan ke Madinah semakin membuncah. Semoga tahun depan bisa kembali bersama Nuansa Rindu.', 0, 'Approved', '2026-05-28 07:10:00'),
(9, 3, 8, 'Kontributor (Admin)', 'kontributor@nuansarindu.id', 'Aamiin Yaa Rabbal \'Alamin. Kami senantiasa mendoakan dan menantikan kehadiran Ibu Fatimah kembali di baitullah.', 1, 'Approved', '2026-05-28 08:05:00'),
(10, 4, NULL, 'Rizky Fadillah', 'rizky.fadillah@email.com', 'Apakah sangat sulit untuk mencium Hajar Aswad saat musim umroh biasa?', 0, 'Approved', '2026-05-29 10:20:00'),
(11, 4, 10, 'Admin Nuansa Rindu', 'superadmin@nuansarindu.id', 'Halo Bapak Rizky. Kondisinya fluktuatif, namun pembimbing kami (Muthawwif) akan selalu membantu mencarikan celah waktu terbaik.', 1, 'Approved', '2026-05-29 11:15:00'),
(12, 4, NULL, 'Hamba Allah', 'hamba@email.com', 'Bismillah, semoga Allah mudahkan saya dan keluarga tahun depan bisa mendaftar paket Sacred Journey.', 0, 'Pending', '2026-05-30 09:00:00'),
(13, 5, NULL, 'Rusman', 'emaildummy@gmail.com', 'tes komentar hehe', 0, 'Approved', '2026-06-03 19:52:58'),
(14, 5, 13, 'superadmin (Admin)', NULL, 'Terima kasih komentarnya', 1, 'Approved', '2026-06-04 00:53:23'),
(15, 5, 14, 'Rusman', 'hehe@gmail.ad', 'Dikit lagi beres', 0, 'Approved', '2026-06-03 19:54:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `leads_consultation`
--

CREATE TABLE `leads_consultation` (
  `id` int(11) NOT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_interest` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `leads_consultation`
--

INSERT INTO `leads_consultation` (`id`, `client_name`, `whatsapp_number`, `package_interest`, `message`, `created_at`) VALUES
(1, 'Ahmad Fauzi', '081234567001', 'Rindu Classic', NULL, '2026-05-27 18:00:06'),
(2, 'Siti Aminah', '085712345002', 'Sacred Journey', NULL, '2026-05-27 18:00:06'),
(3, 'Budi Santoso', '081198765003', 'Rindu Signature', NULL, '2026-05-27 18:00:06'),
(4, 'Keluarga Bapak Ridwan', '082133445004', 'Rindu Private', NULL, '2026-05-27 18:00:06'),
(5, 'Nadia Saphira', '081344556005', 'Rindu Classic', NULL, '2026-05-27 18:00:06'),
(6, 'Andi Wijaya', '087811223006', NULL, NULL, '2026-05-27 18:00:06'),
(7, 'Diana Putri', '089677889007', 'Rindu Signature', NULL, '2026-05-27 18:00:06'),
(8, 'Hendra Gunawan', '085211223008', 'Sacred Journey', NULL, '2026-05-27 18:00:06'),
(9, 'Lestari Ningsih', '081299887009', 'Rindu Classic', NULL, '2026-05-27 18:00:06'),
(10, 'Reza Rahadian', '081122334010', 'Rindu Private', NULL, '2026-05-27 18:00:06'),
(11, 'Tari Puspita', '081355667788', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(12, 'Yudi Pratama', '085799887766', 'Rindu Signature', NULL, '2026-05-27 18:25:46'),
(13, 'Maya Wulandari', '081233445566', 'Sacred Journey', NULL, '2026-05-27 18:25:46'),
(14, 'Dimas Anggara', '082111223344', 'Rindu Private', NULL, '2026-05-27 18:25:46'),
(15, 'Rina Safitri', '087855443322', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(16, 'Agus Setiawan', '089611223344', NULL, NULL, '2026-05-27 18:25:46'),
(17, 'Ratna Sari', '081122334455', 'Rindu Signature', NULL, '2026-05-27 18:25:46'),
(18, 'Irfan Maulana', '085233445566', 'Sacred Journey', NULL, '2026-05-27 18:25:46'),
(19, 'Siska Amalia', '081344556677', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(20, 'Bambang Susanto', '082199887766', 'Rindu Private', NULL, '2026-05-27 18:25:46'),
(21, 'Fitri Handayani', '085711223344', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(22, 'Dedi Irawan', '087899887766', 'Sacred Journey', NULL, '2026-05-27 18:25:46'),
(23, 'Cinta Kirana', '081255667788', 'Rindu Signature', NULL, '2026-05-27 18:25:46'),
(24, 'Rizky Ramadhan', '081199887766', NULL, NULL, '2026-05-27 18:25:46'),
(25, 'Lestari Putri', '082155667788', 'Rindu Private', NULL, '2026-05-27 18:25:46'),
(26, 'Ayu Lestari', '089655667788', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(27, 'Rafi Budiman', '081399887766', 'Sacred Journey', NULL, '2026-05-27 18:25:46'),
(28, 'Nita Agustina', '085755667788', 'Rindu Signature', NULL, '2026-05-27 18:25:46'),
(29, 'Bayu Segara', '081211223344', 'Rindu Private', NULL, '2026-05-27 18:25:46'),
(30, 'Putri Rahayu', '087811223344', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(31, 'Anton Saputra', '085299887766', 'Sacred Journey', NULL, '2026-05-27 18:25:46'),
(32, 'Aura Mutiara', '081311223344', 'Rindu Signature', NULL, '2026-05-27 18:25:46'),
(33, 'Anang Hidayat', '082133445566', NULL, NULL, '2026-05-27 18:25:46'),
(34, 'Shanti Permata', '089633445566', 'Rindu Private', NULL, '2026-05-27 18:25:46'),
(35, 'Ivan Setiadi', '081155667788', 'Rindu Classic', NULL, '2026-05-27 18:25:46'),
(36, 'Rusman', '62812345678910', '', '', '2026-06-03 15:31:18'),
(37, 'Rusman', '62812345678910', '', 'tes pesan', '2026-06-03 15:31:46');

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
(3, 'Rindu Private', 'rindu-private', 'Private', 'Dirancang khusus untuk Anda', 'Custom', 75000000, '<p>Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan dan keinginan Anda. Jadwal fleksibel, layanan concierge personal, dan pengalaman tak tertandingi.</p>', '<p>Menyesuaikan dengan preferensi keluarga (Pilihan Hotel Bintang 5 VIP Ring 1).</p>', '29218be97a15abd18459038905187599.jpg', 'Published', '2026-05-25 19:33:12', '2026-06-02 16:46:42'),
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
-- Indeks untuk tabel `journal_categories`
--
ALTER TABLE `journal_categories`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gallery_media`
--
ALTER TABLE `gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `hero_slides`
--
ALTER TABLE `hero_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `homepage_settings`
--
ALTER TABLE `homepage_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `journal_categories`
--
ALTER TABLE `journal_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `journal_comments`
--
ALTER TABLE `journal_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `leads_consultation`
--
ALTER TABLE `leads_consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
