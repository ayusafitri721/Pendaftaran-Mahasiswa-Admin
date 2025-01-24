-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2025 pada 05.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaf_mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_mahasiswa`
--

CREATE TABLE `calon_mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nomor_tes` varchar(20) DEFAULT NULL,
  `status_pendaftaran` enum('Belum Tes','Lulus Tes','Daftar Ulang','Diterima') DEFAULT 'Belum Tes',
  `tanggal_registrasi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `calon_mahasiswa`
--

INSERT INTO `calon_mahasiswa` (`id`, `nama`, `alamat`, `nomor_handphone`, `username`, `password`, `nomor_tes`, `status_pendaftaran`, `tanggal_registrasi`) VALUES
(1, 'a', 'kl', '099822', 'j', '$2y$10$sU6', 'TES00001', 'Lulus Tes', '2025-01-23 12:53:33'),
(3, 'dsd', 'dsd2', '22', 'tt', '$2y$10$WuU', 'TES00003', 'Lulus Tes', '2025-01-23 13:06:52'),
(4, 'dfd', 'dfd', '4545', 'hgh', '$2y$10$6/m', 'TES00004', 'Lulus Tes', '2025-01-23 13:08:13'),
(11, 'po', 'kakja', '0789', 'opa', '$2y$10$DfL', 'TES00011', 'Diterima', '2025-01-23 13:25:17'),
(12, 'dsds', 'dsds', 'dsd', 'yutp', '$2y$10$YAj', 'TES00012', 'Diterima', '2025-01-23 13:56:26'),
(16, 'tyu', 'dfdsfds', '21312', 'pol', '$2y$10$AYK', 'TES00016', 'Belum Tes', '2025-01-23 15:56:06'),
(17, 'dmfkd', 'fdfkmdk', '0832', 'fr', '$2y$10$9sM', 'TES00017', 'Belum Tes', '2025-01-23 15:56:21'),
(18, 'ddddddddd', 'dff', '231', 'vf', '$2y$10$KBS', 'TES00018', 'Belum Tes', '2025-01-23 15:56:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_tes`
--

CREATE TABLE `hasil_tes` (
  `id` int(11) NOT NULL,
  `nomor_tes` varchar(20) NOT NULL,
  `nilai_tes` int(11) NOT NULL,
  `status_lulus` enum('Lulus','Tidak Lulus') DEFAULT 'Tidak Lulus',
  `tanggal_tes` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_tes`
--

INSERT INTO `hasil_tes` (`id`, `nomor_tes`, `nilai_tes`, `status_lulus`, `tanggal_tes`) VALUES
(1, 'TES00001', 90, 'Lulus', '2025-01-23 12:53:39'),
(2, 'TES00002', 21, 'Tidak Lulus', '2025-01-23 12:54:32'),
(3, 'TES00003', 98, 'Lulus', '2025-01-23 13:06:56'),
(4, 'TES00004', 88, 'Lulus', '2025-01-23 13:08:15'),
(9, 'TES00011', 99, 'Lulus', '2025-01-23 13:25:21'),
(10, 'TES00012', 99, 'Lulus', '2025-01-23 13:56:29'),
(14, 'TES00019', 8, 'Tidak Lulus', '2025-01-23 16:01:06'),
(15, 'TES00019', 31, 'Tidak Lulus', '2025-01-23 16:04:44'),
(16, 'TES00019', 29, 'Tidak Lulus', '2025-01-23 16:09:14'),
(25, 'TES00021', 100, 'Lulus', '2025-01-23 16:26:12'),
(26, 'TES00022', 90, 'Lulus', '2025-01-23 16:27:36'),
(27, 'TES00023', 50, 'Tidak Lulus', '2025-01-23 16:34:10'),
(28, 'TES00023', 90, 'Lulus', '2025-01-23 16:34:44'),
(29, 'TES00024', 100, 'Lulus', '2025-01-24 00:35:01'),
(30, 'TES00026', 100, 'Lulus', '2025-01-24 00:37:22'),
(31, 'TES00027', 100, 'Lulus', '2025-01-24 01:20:12'),
(32, 'TES00029', 100, 'Lulus', '2025-01-24 01:41:10'),
(33, 'TES00030', 100, 'Lulus', '2025-01-24 01:49:30'),
(34, 'TES00030', 100, 'Lulus', '2025-01-24 01:57:34'),
(35, 'TES00031', 100, 'Lulus', '2025-01-24 02:01:27'),
(36, 'TES00032', 90, 'Lulus', '2025-01-24 02:08:39'),
(37, 'TES00033', 100, 'Lulus', '2025-01-24 03:08:21'),
(38, 'TES00034', 100, 'Lulus', '2025-01-24 03:11:40'),
(39, 'TES00035', 100, 'Lulus', '2025-01-24 03:41:00'),
(40, 'TES00036', 100, 'Lulus', '2025-01-24 03:46:02'),
(41, 'TES00037', 100, 'Lulus', '2025-01-24 04:12:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal_diterima` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `nomor_handphone`, `username`, `tanggal_diterima`) VALUES
('NIM01752', 'sasa', 'jalan kaga', '24242', 'y', '2025-01-24 02:08:42'),
('NIM06888', 'ayuu', 'jlkja', '0896', 'yuy', '2025-01-23 13:19:33'),
('NIM11804', 'puya', 'jalan liza', '32424', 'v', '2025-01-24 03:08:23'),
('NIM18404', 'fdsfd', 'fdf', '3234', 'hg', '2025-01-24 04:12:06'),
('NIM19696', 'fdf', 'fdf', '65665', 'tht', '2025-01-23 16:34:46'),
('NIM26252', 'sasa', 'wada', '2113', 'o', '2025-01-24 02:01:28'),
('NIM32715', 'po', 'kakja', '0789', 'opa', '2025-01-23 13:25:22'),
('NIM34527', 'poia', 'akdnkan', '08968', 'apa', '2025-01-24 00:37:30'),
('NIM34866', 'wew', 'wew', '3242', 'fg', '2025-01-24 00:35:03'),
('NIM40711', 'dfd', 'dfd', '213', 'yy', '2025-01-23 13:15:30'),
('NIM42218', 'nbnvchfh', 'esree', 'opo8o9', 'gan45ryrty', '2025-01-24 03:11:45'),
('NIM48110', 'dsds', 'dsds', 'dsd', 'yutp', '2025-01-23 13:56:30'),
('NIM58408', 'ayu safitri', 'Jalan Kaja II', '2314567234', 'aysa', '2025-01-23 16:18:53'),
('NIM59400', 'sds', 'dsds', '333', 'rr', '2025-01-23 13:12:28'),
('NIM63592', 'sri', 'Jalan  II', '2314', 'parni', '2025-01-23 16:27:38'),
('NIM70301', 'we', 'wewe', '4654654', 'atytrdmin', '2025-01-24 03:46:05'),
('NIM77518', 'wewe', 'ewew', '4232', 'a', '2025-01-24 01:41:12'),
('NIM81037', 'zaki', 'jalan poncol', '080353', 'mad', '2025-01-24 01:20:16'),
('NIM83025', 'sds', 'sds', '545', 'admingdgd', '2025-01-24 03:41:02'),
('NIM87826', 'asda', 'adada', '3232', 'b', '2025-01-24 01:49:33'),
('NIM88680', 'ewew', 'fdfd', '3435', 'pola', '2025-01-23 13:58:22'),
('NIM89929', 'pulo', 'uajdba', '0980', 'opka', '2025-01-23 14:32:37'),
('NIM98195', 'df', 'fdf', '2121', 'dd', '2025-01-23 16:17:47'),
('NM08032', 'Ayu Safitri', 'Jalan Hajj', '0793735545', 'ayay', '2025-01-24 04:03:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_perkuliahan`
--

CREATE TABLE `materi_perkuliahan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi_perkuliahan`
--

INSERT INTO `materi_perkuliahan` (`id`, `judul`, `deskripsi`, `created_at`) VALUES
(1, 'Introduction to PHP', 'This material covers the basics of PHP programming including syntax, variables, and loops.', '2025-01-24 03:54:37'),
(2, 'Database Fundamentals', 'Learn about relational databases, SQL queries, and database design principles.', '2025-01-24 03:54:37'),
(3, 'Web Development Basics', 'Understand the core principles of web development, including HTML, CSS, and JavaScript.', '2025-01-24 03:54:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_test`
--

CREATE TABLE `soal_test` (
  `id` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `jawaban` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `soal_test`
--

INSERT INTO `soal_test` (`id`, `soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban`, `created_at`) VALUES
(1, 'Apa ibu kota Indonesia?', 'Surabaya', 'Jakarta', 'Bandung', 'Medan', 'B', '2025-01-23 15:52:03'),
(2, 'Siapa presiden pertama Indonesia?', 'Soeharto', 'B.J. Habibie', 'Sukarno', 'Megawati', 'C', '2025-01-23 15:52:03'),
(3, 'Apa warna langit pada siang hari?', 'Merah', 'Biru', 'Kuning', 'Hitam', 'B', '2025-01-23 15:52:03'),
(24, 'Siapa penemu komputer?', 'Charles Babbage', 'Alan Turing', 'Bill Gates', 'Steve Jobs', 'A', '2025-01-23 15:52:03'),
(25, 'Di kota mana Menara Eiffel berada?', 'London', 'Paris', 'Rome', 'New York', 'B', '2025-01-23 15:52:03'),
(26, 'Siapa yang menciptakan pesawat terbang?', 'Thomas Edison', 'Nikola Tesla', 'Wright Bersaudara', 'Orville Wright', 'C', '2025-01-23 15:52:03'),
(27, 'Di mana terdapat Patung Liberty?', 'Paris', 'London', 'New York', 'Washington DC', 'C', '2025-01-23 15:52:03'),
(28, 'Apa nama virus penyebab COVID-19?', 'SARS-CoV-2', 'MERS-CoV', 'Influenza A', 'HIV', 'A', '2025-01-23 15:52:03'),
(29, 'Siapa yang menulis lagu kebangsaan Indonesia Raya?', 'Sukarno', 'Bung Tomo', 'W.R. Supratman', 'Jenderal Sudirman', 'C', '2025-01-23 15:52:03'),
(30, 'Apa nama pulau terbesar di Indonesia?', 'Sumatera', 'Jawa', 'Kalimantan', 'Papua', 'C', '2025-01-23 15:52:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Level` enum('admin','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'gan', 'prof', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_handphone` (`nomor_handphone`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nomor_tes` (`nomor_tes`);

--
-- Indeks untuk tabel `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_tes` (`nomor_tes`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `materi_perkuliahan`
--
ALTER TABLE `materi_perkuliahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `soal_test`
--
ALTER TABLE `soal_test`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `hasil_tes`
--
ALTER TABLE `hasil_tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `materi_perkuliahan`
--
ALTER TABLE `materi_perkuliahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `soal_test`
--
ALTER TABLE `soal_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
