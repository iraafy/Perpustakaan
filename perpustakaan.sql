-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2022 at 04:22 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `kode_anggota` varchar(4) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jk_anggota` char(1) NOT NULL,
  `jurusan_anggota` varchar(50) NOT NULL,
  `email_anggota` varchar(50) NOT NULL,
  `no_telp_anggota` varchar(13) NOT NULL,
  `alamat_anggota` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama_anggota`, `jk_anggota`, `jurusan_anggota`, `email_anggota`, `no_telp_anggota`, `alamat_anggota`, `password`) VALUES
(1, 'iU4A', 'Ira Fitri Yani', 'P', 'Ilmu Komputer C3', 'iraafy@gmail.com', '1234567890', 'Jl. Jalan no 15', '123'),
(2, 'tWXz', 'Farras', 'L', 'Pendidikan Ilmu Komputer', 'farras@mail.com', '1234554321', 'Jl. Jalan no 14', '123');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` char(5) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `penulis_buku` varchar(50) NOT NULL,
  `penerbit_buku` varchar(50) NOT NULL,
  `tahun_penerbit` char(4) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `penulis_buku`, `penerbit_buku`, `tahun_penerbit`, `stok`) VALUES
(1, 'BK01', 'Algoritma Pemrograman', 'Jee Hkdjka', 'Hksj Kdsha', '2015', 2),
(2, 'BK02', 'Basis Data', 'Jhda Fhsuu', 'Saakf Fkeoe', '2006', 5),
(3, 'BK03', 'Machine Learning', 'Asjje Afrjjr', 'Afmkej Ejkdk', '2019', 4),
(4, 'BK04', 'Lika Liku Anak IT', 'Asjfw Lejgjr', 'Dsjsj Ekdji', '2020', 3),
(5, 'BK05', 'Resep Masakan Anak Kostan', 'Xjfjsa Aekeo', 'Sskjrk Sfoei', '2010', 6),
(6, 'BK07', 'Majalah BOBO', 'Ssjfie Sreoke', 'Skrje Elgrj', '2017', 6),
(7, 'BK08', '@#$^@(^#', 'Ejeiiw Leey', 'Sekie Merjj', '2015', 4),
(8, 'BK09', 'Kumpulan Kunjaw TP DPBO', 'Ariueg Ekgrj', 'Dfjir Pdfjh', '2007', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `sudah_dikembalikan` tinyint(1) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `sudah_dikembalikan`, `id_buku`, `id_anggota`) VALUES
(1, '2022-05-08', '2022-05-18', 0, 1, 1),
(2, '2022-05-08', '2022-05-19', 1, 7, 1),
(3, '2022-05-08', '2022-05-31', 0, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
