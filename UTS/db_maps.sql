-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Bulan Mei 2020 pada 07.56
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_maps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat`
--

CREATE TABLE `tempat` (
  `Id_Tempat` int(11) NOT NULL,
  `Nama_Tempat` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Id_Tipe` int(11) DEFAULT NULL,
  `Lat` varchar(50) DEFAULT NULL,
  `Lng` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tempat`
--

INSERT INTO `tempat` (`Id_Tempat`, `Nama_Tempat`, `Alamat`, `Id_Tipe`, `Lat`, `Lng`) VALUES
(1, 'Ayam Bakar Pak D', 'Jl. Arief Rahman Hakim No.2, Klampis Ngasem, Sukolilo, Surabaya City, East Java 60117, Indonesia', 2, '-7.289350805368203', '112.78146028518677'),
(2, 'Mini Market Handayani', 'Jl. Arief Rahman Hakim No.103, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117, Indonesia', 4, '-7.289015578271929', '112.78102040290833'),
(3, 'Parkir Arif Rahman Hakim', 'Jl. Arief Rachman Hakim No.100, RT.005/RW.02, Klampis Ngasem, Sukolilo, Surabaya City, East Java 60117, Indonesia', 5, '-7.289239063030653', '112.78019428253174'),
(4, 'Coffee Toffee', 'Jl. Klampis Jaya No. 15, Klampis Ngasem, Sukolilo, Surabaya City, East Java, 60117, Indonesia', 3, '-7.286871183134009', '112.7756667137146');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `Id_Tipe` int(11) NOT NULL,
  `Tipe` varchar(50) DEFAULT NULL,
  `Image_Path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`Id_Tipe`, `Tipe`, `Image_Path`) VALUES
(1, 'Apartement', 'img/icon/5ebe1fb7127df_1589518263.png'),
(2, 'Restoran', 'img/icon/5ebe226b909b5_1589518955.png'),
(3, 'Warung Kopi', 'img/icon/5ebe234b2ef46_1589519179.png'),
(4, 'Market', 'img/icon/5ebe23a823fd6_1589519272.png'),
(5, 'Bangunan', 'img/icon/5ebe23bbd826e_1589519291.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`Id_Tempat`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`Id_Tipe`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tempat`
--
ALTER TABLE `tempat`
  MODIFY `Id_Tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `Id_Tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
