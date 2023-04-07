-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2023 pada 23.52
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `informasi` text NOT NULL,
  `file_informasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `title`, `informasi`, `file_informasi`) VALUES
('I001', 'Buka Bersama', '<p>Informasi Buka Bersama&nbsp;</p>\r\n\r\n<p>Tanggal</p>\r\n\r\n<p>Hari</p>\r\n\r\n<p>Tempat</p>\r\n\r\n<p>&nbsp;</p>\r\n', '6a00e54ee8552c883300e54f5d01818833-800wi.gif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `judul`
--

CREATE TABLE `judul` (
  `id_judul` varchar(50) NOT NULL,
  `nama_judul` varchar(255) NOT NULL,
  `sub_judul` varchar(255) NOT NULL,
  `judul2` varchar(255) NOT NULL,
  `akses_pendaftaran` enum('Buka Akses','Tutup Akses') NOT NULL,
  `foto_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `judul`
--

INSERT INTO `judul` (`id_judul`, `nama_judul`, `sub_judul`, `judul2`, `akses_pendaftaran`, `foto_logo`) VALUES
('J001', 'Buka Bersama OSSABA 2023', 'pendaftaran buka bersama', 'Pendaftaran Buka Bersama', 'Buka Akses', '12520924785-picsay.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `panitia`
--

CREATE TABLE `panitia` (
  `id_panitia` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `panitia`
--

INSERT INTO `panitia` (`id_panitia`, `nama`, `no_hp`, `username`, `password`, `level`) VALUES
('P001', 'Fannisa Tiara Salsabila', '12345', 'panser', '202cb962ac59075b964b07152d234b70', 'Panitia'),
('P002hokYUw', 'Erik Wahyudi', '081456141227', 'erik', '202cb962ac59075b964b07152d234b70', 'Panitia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `level`) VALUES
(2, 'Erik Wahyudi', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` varchar(50) NOT NULL,
  `nama_periode` varchar(255) NOT NULL,
  `status_periode` enum('Belum Penuh','Penuh') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `nama_periode`, `status_periode`) VALUES
('T0011k2k9B', '2014 ~ Isna Nur Arifin', 'Belum Penuh'),
('T002V0msGG', '2015 ~ Agung Wicaksono', 'Belum Penuh'),
('T003okE2mZ', '2016 ~ Erik Wahyudi', 'Belum Penuh'),
('T0049ng7eL', '2017 ~ Annisa Ayu Dianitami', 'Belum Penuh'),
('T005jf9a5u', '2018 ~ Elly Elviana', 'Belum Penuh'),
('T006xL2Puo', '2019 ~ Eva Adelia / Singgih P', 'Belum Penuh'),
('T007WpNrA9', '2020 ~ Nanda Septian Bintang / Dian', 'Belum Penuh'),
('T008vdmfyX', '2021 ~ Elsa Ayu Wanda / Meilan Galang', 'Belum Penuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nominal_pembayaran` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `id_periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `alamat`, `no_hp`, `tgl_daftar`, `nominal_pembayaran`, `bukti_pembayaran`, `id_periode`) VALUES
('P001FDia79', 'Ibrahim Al Anshor', 'Jl. Agus salim jalen balong ponorogo', '6282225634392', '2023-04-01', '30000', '', 'T0049ng7eL');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `judul`
--
ALTER TABLE `judul`
  ADD PRIMARY KEY (`id_judul`);

--
-- Indeks untuk tabel `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id_panitia`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
