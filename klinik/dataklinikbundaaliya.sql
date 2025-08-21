-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2025 pada 18.23
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataklinikbundaaliya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidan`
--

CREATE TABLE `bidan` (
  `kode_bidan` varchar(10) NOT NULL,
  `nama_bidan` varchar(100) NOT NULL,
  `kode_poli` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidan`
--

INSERT INTO `bidan` (`kode_bidan`, `nama_bidan`, `kode_poli`) VALUES
('BD-001', 'Hj Romlah', 'PL-002'),
('BD-002', 'Dr. Tobing', 'PL-001'),
('BD-003', 'Dr. Gunawan', 'PL-002'),
('BD-004', 'Bidan Rani', 'PL-003'),
('BD-005', 'Dr. Rudi', 'PL-005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `kode_peserta` varchar(10) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`kode_peserta`, `nama_peserta`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `telepon`, `email`) VALUES
('PS-001', 'Bunda Aminah', '1995-04-10', 'Perempuan', 'Jl. Mawar 1', '0811111111', 'aminah@example.com'),
('PS-002', 'Anak Ahmad', '2020-01-05', 'Laki-Laki', 'Jl. Melati 1', '0822222222', 'ahmad@example.com'),
('PS-003', 'Bunda Nazwa', '1985-02-14', 'Perempuan', 'Jl. Raflesia 1', '0833333333', 'nazwa@example.com'),
('PS-004', 'Anak Aisyah', '2014-10-16', 'Perempuan', 'Jl. Anggrek 1', '0844444444', 'aisyah@example.com'),
('PS-005', 'Anak Rendra', '2020-01-21', 'Laki-Laki', 'Jl. Tulip 1', '0855555555', 'rendra@example.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `kode_poli` varchar(10) NOT NULL,
  `nama_poli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`kode_poli`, `nama_poli`) VALUES
('PL-001', 'Anak'),
('PL-002', 'Anestesi'),
('PL-003', 'Kebidanan'),
('PL-004', 'Penyakit Dalam'),
('PL-005', 'Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekammedis`
--

CREATE TABLE `rekammedis` (
  `no_transaksi` varchar(10) NOT NULL,
  `kode_peserta` varchar(10) NOT NULL,
  `tanggal_berobat` date NOT NULL,
  `kode_bidan` varchar(10) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `biaya_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekammedis`
--

INSERT INTO `rekammedis` (`no_transaksi`, `kode_peserta`, `tanggal_berobat`, `kode_bidan`, `keluhan`, `biaya_admin`) VALUES
('TR-001', 'PS-001', '2025-08-19', 'BD-001', 'Mulas tapi belum saatnya melahirkan', 150000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidan`
--
ALTER TABLE `bidan`
  ADD PRIMARY KEY (`kode_bidan`),
  ADD KEY `kode_poli` (`kode_poli`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`kode_peserta`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`kode_poli`);

--
-- Indeks untuk tabel `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `kode_peserta` (`kode_peserta`),
  ADD KEY `kode_bidan` (`kode_bidan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bidan`
--
ALTER TABLE `bidan`
  ADD CONSTRAINT `bidan_ibfk_1` FOREIGN KEY (`kode_poli`) REFERENCES `poli` (`kode_poli`);

--
-- Ketidakleluasaan untuk tabel `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD CONSTRAINT `rekammedis_ibfk_1` FOREIGN KEY (`kode_peserta`) REFERENCES `peserta` (`kode_peserta`),
  ADD CONSTRAINT `rekammedis_ibfk_2` FOREIGN KEY (`kode_bidan`) REFERENCES `bidan` (`kode_bidan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
