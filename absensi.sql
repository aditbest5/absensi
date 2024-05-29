-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2024 pada 03.28
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kehadiran`
--

CREATE TABLE `tbl_kehadiran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operasi` varchar(20) NOT NULL,
  `pilih_jadwal` varchar(10) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `created_date` date NOT NULL,
  `status` enum('checkin','checkout') NOT NULL DEFAULT 'checkout'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kehadiran`
--

INSERT INTO `tbl_kehadiran` (`id`, `user_id`, `operasi`, `pilih_jadwal`, `longitude`, `latitude`, `created_date`, `status`) VALUES
(22, 14, 'operasional', 'shift1', 106.5981811, -6.2472121, '2024-04-14', 'checkout'),
(24, 14, 'operasional', 'shift1', 106.5981747, -6.2471957, '2024-04-15', 'checkin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai','supervisor') NOT NULL DEFAULT 'pegawai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `nik`, `email`, `username`, `password`, `role`) VALUES
(14, 'ADITYA APRIANTO', '1111700008', 'adityaaprianto68@gma', 'aditya97', '$2y$10$hf/.8Bn/qHib4NUo0Q0dKe/4yev13RhQAoquxGO27W.fmAQLIXFxO', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_kehadiran`
--
ALTER TABLE `tbl_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
