-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2022 at 05:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustaka_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` varchar(12) NOT NULL,
  `tgl_booking` date NOT NULL,
  `batas_ambil` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pengarang` varchar(60) NOT NULL,
  `penerbit` varchar(60) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `isbn` varchar(60) NOT NULL,
  `stok` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `dibooking` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `deskripsi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `id_kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `stok`, `dipinjam`, `dibooking`, `image`, `deskripsi`) VALUES
(1, 'Statistika Dengan Pemrograman Komputer', 1, 'Ahmad Kholiqul Amin', 'Deep Publish', 2014, '9786022809432', 10, 0, 0, 'img1645688846.jpg', 'Dalam buku ini dibahas secara lengkap menenai statistika program pada komputer mulai dari menggunakna excel untuk perhitungan validitas blitir instrumen hinggan korelasi dan regresi. Diharapkan buku ini dapat bermanfaat bagi mahasiswa.'),
(2, 'Mudah Belajar Komputer Untuk Anak', 1, 'Bambang Agus Setiawan', 'Huta Media', 2014, '9786025118500', 10, 0, 0, 'img1557402397.jpg', ''),
(3, 'PHP Komplet', 1, 'Jubilee', 'Elex Media Komputindo', 2017, '834676753547', 10, 0, 0, 'img1555522493.jpg', 'PHP merupakan pemrograman wajib bagi para web developer. Buku ini menjelaskan PHP sejak dari dasar hingga pemrograman web berbasis database.'),
(4, 'Detektif Conan Eps 200', 9, 'Okigawa Sasuke', 'Cultura', 2016, '874387583987', 10, 0, 0, 'img1557401465.jpg', ''),
(5, 'Bahasa Indonesia', 2, 'Umri Nur\'aini dan Indriyani', 'Pusat Perbukuan', 2015, '757254724884', 10, 0, 0, 'img1557402703.jpg', ''),
(6, 'Komunikasi Lintas Budaya', 5, 'Dr. Deddy Kurnia', 'Published', 2015, '878674646488', 10, 0, 0, 'img1557403156.jpg', ''),
(7, 'Kolaborasi Codigniter Dan Ajax', 1, 'Anton Subagia', 'Elex Media Computindo', 2017, '43345356577', 10, 0, 0, 'img1557403502.jpg', 'Buku ini akan membahas tentang pengenalan Codeigniter secara singkat dan mudah, teknik dasar Ajax, kolaborasi Ajax dengan jQuery, teknik dasar Codeigniter, kolaborasi Codeigniter dengan Ajax dan juga operasi CRUD dengan Ajax.'),
(8, 'From Hobby To Money', 4, 'Deasylawati', 'Elex Media Komputindo', 2015, '8796868678789', 10, 0, 0, 'img1557403658.jpg', 'Buku ini menguraikan tentang bagaimana cara kita untuk memanfaatkan hobi yang kita punya sebagai sumber penghasilan tambahan dan mendapatkan keuntungan dari hal tersebut.'),
(9, 'Buku Saku Pramuka', 8, 'Rudi Himawan', 'Pusat Perbukuan', 2016, '97868687978796', 10, 0, 0, 'img1557404613.jpg', 'Buku ini merangkum segala sesuatunya tentang Pramuka dan organisasi kepanduan dunia yang harus kamu ketahui. Buku ini sangat bermanfaat bagi para anggota kegiatan pramuka.'),
(10, 'Bahasa Keajaiban Bumi', 3, 'Nurul Ihsan', 'Luxima', 2014, '56575656578868', 10, 0, 0, 'img1557404689.jpg', 'Keajaiban alam dengan segala isinya, terjadi baik di langit maupun di bumi. Dalam seri Keajaiban Bumi ini akan diperkenalkan beberapa benda dan fenomena yang berhubungan dengan bumi.'),
(12, 'Rich Dad Poor Dad', 26, 'Robert T.Kiyosaki', 'Gramedia Pustaka', 1997, '9786020333175', 10, 0, 0, 'richdadpoordad.jpg', 'Rich Dad, Poor Dad (Ayah Kaya, Ayah Miskin) adalah buku yang membahas masalah finansial yang dihadapi banyak orang dikarenakan ajaran keliru orang tua mereka mengenai keuangan, yang juga dialaminya semasa kecil dan remaja.'),
(15, 'Psychology Of Money', 26, 'Morgan Housel', ' Wealth Management', 2020, '9827817999788', 10, 0, 0, '2129dcc5b40aa6abc4a2a03e43cc92c7.jpg', 'Buku The Psychology of Money memuat 19 cerita pendek yang membahas dan mengupas berbagai hal terkait uang dan aspek-aspek kehidupan. Mengatur uang lebih dari sekadar memikirkan soal kekayaan.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Komputer'),
(2, 'Bahasa'),
(3, 'Sains'),
(4, 'Hobby'),
(5, 'Komunikasi'),
(6, 'Hukum'),
(7, 'Agama'),
(8, 'Populer'),
(9, 'Komik'),
(16, 'Seni Budaya'),
(26, 'Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `no_pinjam` varchar(12) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('Pinjam','Kembali','','') NOT NULL,
  `total_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_detail`
--

CREATE TABLE `pinjam_detail` (
  `id` int(11) NOT NULL,
  `no_pinjam` varchar(12) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `id_user` varchar(12) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role`, `is_active`, `date_created`) VALUES
(1, 'Eka Wardana', 'ekaskitzo25@gmail.com', '1666111075098.jpg', '$2y$10$ecp8zx3N4aQJUxnUx4kD0.gIgw4re8W5bUo/J2z56ROJkAqmPUiru', 'admin', 1, 1645592425),
(6, 'Eka Skitzo', 'eka@gmail.com', '9e90906d7621b0f9fa761583af427fa8.jpg', '$2y$10$83osJ68hCSHXy5hmh9XH4eZb8t83JVQZhgnYO9Ioq/yLjR6lsMuG2', 'member', 1, 1670823951),
(8, 'Yunilawati', 'yuni@gmail.com', 'default.png', '$2y$10$RzcveOpy.0z0GRa88plv2uijIn6nFk7oxG8X57tG4uXclFOrbush2', 'member', 1, 1671084665),
(9, 'Ahmad Maulana', 'ahmad@gmail.com', 'default.png', '$2y$10$ZIjoW.n9eBkUuLEEFTRD/uPuPCBNI0ugGt7KB0FNmPDuCl/Ye0djO', 'member', 1, 1671084879),
(10, 'Masayu Shenny Rizky', 'shenny@gmail.com', 'naruto_uchiha_itachi_mangekyou_sharingan_112353_2048x2048.jpg', '$2y$10$nblzSzBHWQpE8jCHRTUGaOSvlNjrOkqpUxVMWKIKZwwZbe5GTnEze', 'member', 1, 1671087114);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `pinjam_detail`
--
ALTER TABLE `pinjam_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjam_detail`
--
ALTER TABLE `pinjam_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
