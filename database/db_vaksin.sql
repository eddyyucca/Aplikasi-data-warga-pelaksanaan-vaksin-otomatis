-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2022 pada 14.46
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vaksin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(10) NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `status` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `password`, `level`, `status`, `nik`) VALUES
(27, '4297f44b13955235245b2497399d7a93', 'user', 'aktif', '123456'),
(28, 'fae0b27c451c728867a567e8c1bb4e53', 'admin', 'aktif', '666');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `ttl` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `jk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `ttl`, `alamat`, `telpon`, `jk`) VALUES
(3, 'dr. rahman S.THT a', '2022-02-02', 'assaas aa', '081266666666', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_warga` varchar(11) NOT NULL,
  `dokter` varchar(255) NOT NULL,
  `vaksin` varchar(255) NOT NULL,
  `tgl` varchar(50) NOT NULL,
  `vaksin_ke` varchar(20) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_warga`, `dokter`, `vaksin`, `tgl`, `vaksin_ke`, `keterangan`) VALUES
(4, '1', 'dr. rahman S.THT a', '1', '2022-02-01', '', 'berhasil'),
(5, '4', 'dr. rahman S.THT a', '1', '2022-02-03', '1', 'berhasil'),
(6, '4', 'dr. rahman S.THT a', '4', '2022-02-03', '2', 'berhasil'),
(7, '4', 'dr. rahman S.THT a', 'Gagal', '2022-02-03', '', 'gagal'),
(8, '4', 'dr. rahman S.THT a', 'Gagal', '2022-02-03', '', 'gagal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_vaksin`
--

CREATE TABLE `permintaan_vaksin` (
  `id_permintaan` int(11) NOT NULL,
  `id_warga` varchar(11) NOT NULL,
  `tgl_vaksin` varchar(20) NOT NULL,
  `no_urut` varchar(100) NOT NULL,
  `hasil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_vaksin`
--

INSERT INTO `permintaan_vaksin` (`id_permintaan`, `id_warga`, `tgl_vaksin`, `no_urut`, `hasil`) VALUES
(1, '4', '2022-02-04', '1', '1'),
(2, '4', '2022-02-04', '2', '1'),
(3, '4', '2022-02-05', '1', '1'),
(4, '4', '2022-02-05', '2', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vaksin`
--

CREATE TABLE `vaksin` (
  `id_vaksin` int(11) NOT NULL,
  `nama_vaksin` varchar(100) NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vaksin`
--

INSERT INTO `vaksin` (`id_vaksin`, `nama_vaksin`, `jumlah`) VALUES
(1, 'sinovac', '330'),
(3, 'Moderna', '1000'),
(4, 'pfizer', '349');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warga`
--

CREATE TABLE `warga` (
  `id_warga` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ttl` varchar(20) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `status` text NOT NULL,
  `jk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `warga`
--

INSERT INTO `warga` (`id_warga`, `nik`, `nama`, `ttl`, `tempat`, `alamat`, `telpon`, `status`, `jk`) VALUES
(4, '123456', 'eddy adha saputra', '1997-04-17', 'banjarbaru', 'tapin', '081250653005', 'Gagal', 'Laki-Laki'),
(5, '666', 'admin', '1997-04-17', 'kandangan', 'TAPIN', '666', 'Gagal', 'Laki-Laki');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `permintaan_vaksin`
--
ALTER TABLE `permintaan_vaksin`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indeks untuk tabel `vaksin`
--
ALTER TABLE `vaksin`
  ADD PRIMARY KEY (`id_vaksin`);

--
-- Indeks untuk tabel `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `permintaan_vaksin`
--
ALTER TABLE `permintaan_vaksin`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `vaksin`
--
ALTER TABLE `vaksin`
  MODIFY `id_vaksin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `warga`
--
ALTER TABLE `warga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
