-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2021 at 08:55 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elektra_hardware`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jasa_pengiriman`
--

CREATE TABLE `tb_jasa_pengiriman` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(20) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jasa_pengiriman`
--

INSERT INTO `tb_jasa_pengiriman` (`id_jasa`, `nama_jasa`, `tarif`) VALUES
(1, 'JNE', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Laptop');

--
-- Triggers `tb_kategori`
--
DELIMITER $$
CREATE TRIGGER `hapus_merk` BEFORE DELETE ON `tb_kategori` FOR EACH ROW DELETE FROM tb_merk WHERE id_kategori = OLD.id_kategori
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsumen`
--

CREATE TABLE `tb_konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsumen`
--

INSERT INTO `tb_konsumen` (`id_konsumen`, `nama_lengkap`, `alamat`, `no_telp`, `email`, `password`) VALUES
(1, 'Reza Prima', 'Jl Raya Celuk No.13', '0987777773', 'raditya000@gmail.com', '$2y$12$vbJc0QQGzEHwG.z13TcuneyEBHsvDfboTgocvJKyJedjnWjwnusYq');

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `nama_merk` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `nama_merk`, `id_kategori`) VALUES
(2, 'Asus', 1);

--
-- Triggers `tb_merk`
--
DELIMITER $$
CREATE TRIGGER `hapus_produk_merk` BEFORE DELETE ON `tb_merk` FOR EACH ROW DELETE FROM tb_produk WHERE id_merk = OLD.id_merk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `foto_bukti` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Belum Dibayar',
  `tgl_pembayaran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_konsumen`, `id_jasa`, `total`, `foto_bukti`, `status`, `tgl_pembayaran`) VALUES
(2, 1, 1, 487666, 'node.png', 'Lunas', '2021-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_produk`
--

CREATE TABLE `tb_pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jml_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian_produk`
--

INSERT INTO `tb_pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jml_pembelian`) VALUES
(2, 2, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `isi` text NOT NULL,
  `balas` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id_pertanyaan`, `id_produk`, `id_konsumen`, `isi`, `balas`) VALUES
(1, 8, 1, 'Stoknya masih ada ?', 'Stoknya ada'),
(2, 8, 1, 'Berapa banyak fiturnya', 'ada 60');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `tgl_produk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `id_merk`, `id_kategori`, `harga`, `deskripsi`, `stok`, `foto_produk`, `tgl_produk`) VALUES
(8, 'Asus TUF 19x2', 2, 1, 233333, 'Laptop Terbaru', 6, '1514538568.jpg', '2021-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ulasan`
--

CREATE TABLE `tb_ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `isi` text NOT NULL,
  `rating` int(1) NOT NULL,
  `balasan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ulasan`
--

INSERT INTO `tb_ulasan` (`id_ulasan`, `id_produk`, `id_konsumen`, `isi`, `rating`, `balasan`) VALUES
(1, 8, 1, 'Produknya menarik', 5, 'terima kasih ya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `telp_user` varchar(20) NOT NULL,
  `level_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email_user`, `password_user`, `telp_user`, `level_user`) VALUES
(1, 'Reza Gunawan', 'raditya000@gmail.com', '$2y$12$vbJc0QQGzEHwG.z13TcuneyEBHsvDfboTgocvJKyJedjnWjwnusYq', '8835341', 'Admin'),
(2, 'Radit', 'raditya220@gmail.com', '$2y$12$0js2Kz8ZNPvFOyyVsCq7JuivhEFsa3OMpbDYRNVyQUmggLHFgol.y', '0987777773', 'Admin'),
(3, 'DataMahasiswa', 'root@yahoo.com', '$2y$12$iQnpzT4Rbxo4H1CqBCE.8OOOzZjFG9zJK2oJa/OZ8zRnX/jbFnYRy', '032138097', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jasa_pengiriman`
--
ALTER TABLE `tb_jasa_pengiriman`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_konsumen`
--
ALTER TABLE `tb_konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`),
  ADD KEY `fk_merk_kategori` (`id_kategori`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_pembelian_konsumen` (`id_konsumen`),
  ADD KEY `fk_pembelian_jasa` (`id_jasa`);

--
-- Indexes for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `fk_pem_pembelian` (`id_pembelian`),
  ADD KEY `fk_pem_produk` (`id_produk`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `fk_pertanyaan_produk` (`id_produk`),
  ADD KEY `fk_pertanyaan_konsumen` (`id_konsumen`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_merk_produk` (`id_merk`),
  ADD KEY `fk_kategori_produk` (`id_kategori`);

--
-- Indexes for table `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `fk_ulasan_produk` (`id_produk`),
  ADD KEY `fk_ulasan_konsumen` (`id_konsumen`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jasa_pengiriman`
--
ALTER TABLE `tb_jasa_pengiriman`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_konsumen`
--
ALTER TABLE `tb_konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD CONSTRAINT `fk_merk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`);

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `fk_pembelian_jasa` FOREIGN KEY (`id_jasa`) REFERENCES `tb_jasa_pengiriman` (`id_jasa`),
  ADD CONSTRAINT `fk_pembelian_konsumen` FOREIGN KEY (`id_konsumen`) REFERENCES `tb_konsumen` (`id_konsumen`);

--
-- Constraints for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  ADD CONSTRAINT `fk_pem_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id_pembelian`),
  ADD CONSTRAINT `fk_pem_produk` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);

--
-- Constraints for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD CONSTRAINT `fk_pertanyaan_konsumen` FOREIGN KEY (`id_konsumen`) REFERENCES `tb_konsumen` (`id_konsumen`),
  ADD CONSTRAINT `fk_pertanyaan_produk` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `fk_kategori_produk` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_merk_produk` FOREIGN KEY (`id_merk`) REFERENCES `tb_merk` (`id_merk`);

--
-- Constraints for table `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD CONSTRAINT `fk_ulasan_konsumen` FOREIGN KEY (`id_konsumen`) REFERENCES `tb_konsumen` (`id_konsumen`),
  ADD CONSTRAINT `fk_ulasan_produk` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

