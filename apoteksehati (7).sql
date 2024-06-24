-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Jun 2024 pada 08.25
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteksehati`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apoteker`
--

CREATE TABLE `apoteker` (
  `id_apoteker` int NOT NULL,
  `nama_apoteker` varchar(34) NOT NULL,
  `password` varchar(24) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jabatan` varchar(16) NOT NULL,
  `pend_terakhir` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `apoteker`
--

INSERT INTO `apoteker` (`id_apoteker`, `nama_apoteker`, `password`, `alamat`, `jabatan`, `pend_terakhir`) VALUES
(1, 'H. Muhamad Umar M.si', 'umar123', 'Jakarta', 'Owner', 'S2 Farmasi'),
(2, 'Alisya Syakirah S.farm', 'alisya123', 'serang', 'Apoteker', 'S1 Farmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kode_obat` int NOT NULL,
  `nama_obat` varchar(24) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `id_pemasok` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kode_obat`, `nama_obat`, `harga`, `stok`, `id_pemasok`) VALUES
(1, 'Paramex', 3000, 750, 1),
(2, 'Oskadon Sp', 4000, 270, 1),
(3, 'paracetamol', 15000, 317, 1),
(4, 'promag', 5000, 295, 1),
(6, 'Insto', 10000, 50, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_apoteker` int DEFAULT NULL,
  `kode_obat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `password`, `alamat`, `tanggal_lahir`, `id_apoteker`, `kode_obat`) VALUES
(2, 'wibowo', 'bowo123', 'lembang', '2024-06-04', 2, 3),
(3, 'akmal', 'akmal123', 'korea', '2016-02-24', 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int NOT NULL,
  `nama_pemasok` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kontak_pemasok` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `password`, `kontak_pemasok`, `alamat`) VALUES
(1, 'kevin', 'kevin123', 'kevins@gmail.com', 'Jakarta Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_Transaksi` int NOT NULL,
  `obat_yang_dibeli` varchar(50) NOT NULL,
  `jumlah` varchar(24) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int NOT NULL,
  `id_pasien` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_Transaksi`, `obat_yang_dibeli`, `jumlah`, `tanggal_transaksi`, `total_harga`, `id_pasien`) VALUES
(6, '3', '5', '2024-06-23', 75000, 2),
(7, '4', '5', '2024-06-24', 25000, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `apoteker`
--
ALTER TABLE `apoteker`
  ADD PRIMARY KEY (`id_apoteker`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`),
  ADD KEY `id_pemasok` (`id_pemasok`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_apoteker` (`id_apoteker`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_Transaksi`),
  ADD KEY `FK_PasienOrder` (`id_pasien`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `kode_obat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_Transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`);

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_apoteker`) REFERENCES `apoteker` (`id_apoteker`),
  ADD CONSTRAINT `pasien_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode_obat`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_PasienOrder` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
