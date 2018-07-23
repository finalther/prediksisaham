-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2018 at 06:26 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `tgl_lahir`, `telepon`, `email`, `foto`) VALUES
('132', 'rindaman new', '2016-09-09', '56789', 'rinda@gmail.com', '07ed68f14f8b12af902868a03c0dc5a6.png');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(8989, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` int(11) NOT NULL,
  `nama_kurikulum` varchar(50) NOT NULL DEFAULT '0',
  `kode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id`, `nama_kurikulum`, `kode`) VALUES
(3, 'Cerdas dan Terampil', '123');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nis` varchar(50) NOT NULL,
  `id_jurusan` varchar(50) NOT NULL,
  `id_kurikulum` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `rt` varchar(50) NOT NULL,
  `rw` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nis`, `id_jurusan`, `id_kurikulum`, `status`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `rt`, `rw`, `kota`, `kode_pos`, `provinsi`, `negara`, `telepon`, `email`) VALUES
('7878', '', '', 'aktif', 'cristian ronaldo', '2018-11-30', 'L', 'Islam', 'balongcino', '006', '007', 'Kediri', 64219, 'jawa timur', 'indonesia', '085748773621', 'cristian@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kd_matkul` varchar(50) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `id_jurusan` varchar(50) DEFAULT NULL,
  `nama_matkul` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kd_matkul`, `nip`, `id_jurusan`, `nama_matkul`, `status`, `semester`, `sks`, `keterangan`) VALUES
('5656', NULL, NULL, 'MM', NULL, 7, 3, 'aktif'),
('8988', NULL, NULL, 'Pemdas', NULL, 6, 6, 'aktif'),
('9090', NULL, NULL, 'Pemrograman Jaringan', NULL, 4, 4, 'Dibuka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `last_login`, `created_at`, `updated_at`) VALUES
(6, 2, 'rachmad', '$2y$11$tTA2frOsb63/CV5xaWcKmuCmHk8pG4u/vNvwslWnF00mp4Oj7Z24K', '2018-07-13 06:24:04', '2018-07-02 07:46:07', '2018-07-13 11:24:04'),
(7, 1, 'admin', '$2y$11$WLpJCEsBC5CihHdaJBZq2.xTzCLIWhNBQ9OQJR6iR6SS.zwsxE8WK', '2018-07-13 06:24:15', '2018-07-02 07:46:07', '2018-07-13 11:24:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kd_matkul`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8990;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
