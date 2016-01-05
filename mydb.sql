-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Des 2015 pada 18.43
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `user_Admin` varchar(25) NOT NULL,
  `nama_Admin` varchar(45) NOT NULL,
  `pswd_Admin` varchar(45) NOT NULL,
  `departemen_Admin` varchar(45) NOT NULL,
  `Departemen_id_Departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`user_Admin`, `nama_Admin`, `pswd_Admin`, `departemen_Admin`, `Departemen_id_Departemen`) VALUES
('admin', 'Admin', 'admin', '', 1),
('josi', 'Josi Aranda', 'admin', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_Departemen` int(11) NOT NULL,
  `nama_Departemen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_Departemen`, `nama_Departemen`) VALUES
(0, 'IC'),
(1, 'BAAK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen_has_pelaporan`
--

CREATE TABLE `departemen_has_pelaporan` (
  `Departemen_id_Departemen` int(11) NOT NULL,
  `Pelaporan_id_Pelaporan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `departemen_has_pelaporan`
--

INSERT INTO `departemen_has_pelaporan` (`Departemen_id_Departemen`, `Pelaporan_id_Pelaporan`) VALUES
(0, 5),
(0, 6),
(1, 5),
(1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategorilapor`
--

CREATE TABLE `kategorilapor` (
  `id_KategoriLapor` int(11) NOT NULL,
  `nama_KategoriLapor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategorilapor`
--

INSERT INTO `kategorilapor` (`id_KategoriLapor`, `nama_KategoriLapor`) VALUES
(1, 'Komplain'),
(2, 'Saran'),
(3, 'Kritik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` int(11) NOT NULL,
  `nama_Mahasiswa` varchar(45) NOT NULL,
  `pswd_Mahasiswa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama_Mahasiswa`, `pswd_Mahasiswa`) VALUES
(1, 'Agung', 'rahasia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_Pelaporan` int(11) NOT NULL,
  `isi_Pelaporan` text NOT NULL,
  `tgl_Pelaporan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ImagePath` varchar(100) DEFAULT NULL,
  `Mahasiswa_NIM` int(11) NOT NULL,
  `KategoriLapor_id_KategoriLapor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pelaporan`
--

INSERT INTO `pelaporan` (`id_Pelaporan`, `isi_Pelaporan`, `tgl_Pelaporan`, `ImagePath`, `Mahasiswa_NIM`, `KategoriLapor_id_KategoriLapor`) VALUES
(5, 'rusak nih', '2015-12-22 23:48:31', 'Image/default.jpg', 1, 1),
(6, 'wifi tidak jalan', '2015-12-30 23:38:30', 'Image/default.jpg', 1, 1),
(8, 'ban saya rusak', '2015-12-31 00:08:42', 'Image/20151230180842Hellaflush-05.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_Tanggapan` int(11) NOT NULL,
  `isi_Tanggapan` text NOT NULL,
  `tgl_Tanggapan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Administrator_user_Admin` varchar(25) NOT NULL,
  `Pelaporan_id_Pelaporan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_Tanggapan`, `isi_Tanggapan`, `tgl_Tanggapan`, `Administrator_user_Admin`, `Pelaporan_id_Pelaporan`) VALUES
(3, 'oke mas, kami segera selesaikan', '2015-12-31 00:17:16', 'admin', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`user_Admin`),
  ADD KEY `fk_Administrator_Departemen1_idx` (`Departemen_id_Departemen`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_Departemen`);

--
-- Indexes for table `departemen_has_pelaporan`
--
ALTER TABLE `departemen_has_pelaporan`
  ADD PRIMARY KEY (`Departemen_id_Departemen`,`Pelaporan_id_Pelaporan`),
  ADD KEY `fk_Departemen_has_Pelaporan_Pelaporan1_idx` (`Pelaporan_id_Pelaporan`),
  ADD KEY `fk_Departemen_has_Pelaporan_Departemen1_idx` (`Departemen_id_Departemen`);

--
-- Indexes for table `kategorilapor`
--
ALTER TABLE `kategorilapor`
  ADD PRIMARY KEY (`id_KategoriLapor`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_Pelaporan`),
  ADD KEY `fk_Pelaporan_Mahasiswa_idx` (`Mahasiswa_NIM`),
  ADD KEY `fk_Pelaporan_KategoriLapor1_idx` (`KategoriLapor_id_KategoriLapor`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_Tanggapan`),
  ADD KEY `fk_Tanggapan_Administrator1_idx` (`Administrator_user_Admin`),
  ADD KEY `fk_Tanggapan_Pelaporan1_idx` (`Pelaporan_id_Pelaporan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorilapor`
--
ALTER TABLE `kategorilapor`
  MODIFY `id_KategoriLapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_Pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_Tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `fk_Administrator_Departemen1` FOREIGN KEY (`Departemen_id_Departemen`) REFERENCES `departemen` (`id_Departemen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `departemen_has_pelaporan`
--
ALTER TABLE `departemen_has_pelaporan`
  ADD CONSTRAINT `fk_Departemen_has_Pelaporan_Departemen1` FOREIGN KEY (`Departemen_id_Departemen`) REFERENCES `departemen` (`id_Departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pelaporan` FOREIGN KEY (`Pelaporan_id_Pelaporan`) REFERENCES `pelaporan` (`id_Pelaporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `fk_Pelaporan_Mahasiswa` FOREIGN KEY (`Mahasiswa_NIM`) REFERENCES `mahasiswa` (`NIM`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kategori` FOREIGN KEY (`KategoriLapor_id_KategoriLapor`) REFERENCES `kategorilapor` (`id_KategoriLapor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `fk_Tanggapan_Administrator1` FOREIGN KEY (`Administrator_user_Admin`) REFERENCES `administrator` (`user_Admin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
