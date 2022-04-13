-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2022 pada 10.30
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1438856_fina_coin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_fina`
--

CREATE TABLE `admin_fina` (
  `id` int(11) NOT NULL,
  `wallet_admin` varchar(200) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_fina`
--

INSERT INTO `admin_fina` (`id`, `wallet_admin`, `username`, `password`) VALUES
(1, '0x7e7c538662565baac99259e3d2e102268e55fc65', 'glride ', '$2y$10$DCA86OTLaFDBaZt38aA8BO/U8xlJsM9qvU5GFBgcF0rCavwC6QNWi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus_sponsor_fina`
--

CREATE TABLE `bonus_sponsor_fina` (
  `id_sponsor` int(11) NOT NULL,
  `level_sponsor` int(11) NOT NULL,
  `profit_sponsor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bonus_sponsor_fina`
--

INSERT INTO `bonus_sponsor_fina` (`id_sponsor`, `level_sponsor`, `profit_sponsor`) VALUES
(1, 1, 10),
(2, 2, 2),
(3, 3, 1.5),
(4, 4, 1),
(5, 5, 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_transaksi_pin_fina`
--

CREATE TABLE `history_transaksi_pin_fina` (
  `id` int(11) NOT NULL,
  `pengirim_pin` varchar(20) NOT NULL,
  `penerima_pin` varchar(20) NOT NULL,
  `jumlah_pin` int(11) NOT NULL,
  `jenis_pin` enum('FNC Pin','Other') NOT NULL,
  `tgl_transaksi_pin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_transaksi_pin_fina`
--

INSERT INTO `history_transaksi_pin_fina` (`id`, `pengirim_pin`, `penerima_pin`, `jumlah_pin`, `jenis_pin`, `tgl_transaksi_pin`) VALUES
(1, 'Admin', 'asbudi', 1, 'FNC Pin', '2022-04-13 06:31:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `max_stacking`
--

CREATE TABLE `max_stacking` (
  `id` int(11) NOT NULL,
  `persen` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `max_stacking`
--

INSERT INTO `max_stacking` (`id`, `persen`) VALUES
(1, '300');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_fina`
--

CREATE TABLE `member_fina` (
  `id_member` int(11) NOT NULL,
  `tgl_join_member` timestamp NOT NULL DEFAULT current_timestamp(),
  `username_member` varchar(20) NOT NULL,
  `fnc_member` varchar(100) DEFAULT NULL,
  `bonus_staking_member` varchar(250) DEFAULT NULL,
  `nama_lengkap_member` varchar(100) DEFAULT NULL,
  `sponsor_member` varchar(20) NOT NULL,
  `email_member` varchar(250) NOT NULL,
  `status_suspend_member` enum('SUSPEND','UNSUSPEND') NOT NULL DEFAULT 'UNSUSPEND',
  `number_phone_member` int(16) DEFAULT NULL,
  `pin_transaksi_member` varchar(250) NOT NULL DEFAULT '$2y$10$e8rE0e2yEpqVRiXrJioxYuEx5gf9wcVsyf7YKt1WjMjpPcyJU.KK2',
  `password_member` varchar(250) NOT NULL,
  `status_member` enum('FREE','PAID') NOT NULL DEFAULT 'FREE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member_fina`
--

INSERT INTO `member_fina` (`id_member`, `tgl_join_member`, `username_member`, `fnc_member`, `bonus_staking_member`, `nama_lengkap_member`, `sponsor_member`, `email_member`, `status_suspend_member`, `number_phone_member`, `pin_transaksi_member`, `password_member`, `status_member`) VALUES
(1, '2022-04-13 06:23:34', 'asbudi', '0', '301', 'asbudi anugrah', 'register', 'asbudi@gmail.com', 'UNSUSPEND', NULL, '$2y$10$e8rE0e2yEpqVRiXrJioxYuEx5gf9wcVsyf7YKt1WjMjpPcyJU.KK2', '$2y$10$p034TwrLGYkfq7nN2Etty.L9gvcaxX3j54ng9NTdSlAbvEc7itrkG', 'PAID');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_fnc_fina`
--

CREATE TABLE `pembelian_fnc_fina` (
  `id` int(11) NOT NULL,
  `kode_pembelian` varchar(13) NOT NULL,
  `username_pembelian` varchar(20) NOT NULL,
  `nama_lengkap_pembelian` varchar(250) NOT NULL,
  `fnc_pembelian` varchar(12) NOT NULL,
  `usdt_pembelian` double NOT NULL,
  `idr_pembelian` varchar(15) NOT NULL,
  `tgl_order_pembelian` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_confirm_pembelian` datetime DEFAULT NULL,
  `status_pembelian` enum('Approve','No') NOT NULL DEFAULT 'No',
  `foto_bukti_pembelian` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_fnc_fina`
--

INSERT INTO `pembelian_fnc_fina` (`id`, `kode_pembelian`, `username_pembelian`, `nama_lengkap_pembelian`, `fnc_pembelian`, `usdt_pembelian`, `idr_pembelian`, `tgl_order_pembelian`, `tgl_confirm_pembelian`, `status_pembelian`, `foto_bukti_pembelian`) VALUES
(1, '#TR68530', 'asbudi', 'asbudi anugrah', '1000', 1042.6803837064, '15000000', '2022-04-13 06:50:07', '2022-04-13 08:50:18', 'Approve', ''),
(2, '#TR24304', 'asbudi', 'asbudi anugrah', '2000', 2085.7957310714, '30000000', '2022-04-13 07:54:08', '2022-04-13 09:54:33', 'Approve', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pin_activation_fina`
--

CREATE TABLE `pin_activation_fina` (
  `id_pin` int(11) NOT NULL,
  `tgl_pin` timestamp NOT NULL DEFAULT current_timestamp(),
  `name_pin` enum('FNC Pin','Other') NOT NULL DEFAULT 'FNC Pin',
  `code_pin` varchar(10) NOT NULL,
  `status_pin` enum('Active','Non Active') NOT NULL DEFAULT 'Active',
  `price_pin` varchar(15) NOT NULL DEFAULT '10',
  `pemilik_pin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pin_activation_fina`
--

INSERT INTO `pin_activation_fina` (`id_pin`, `tgl_pin`, `name_pin`, `code_pin`, `status_pin`, `price_pin`, `pemilik_pin`) VALUES
(1, '2022-04-13 06:24:46', 'FNC Pin', 'FNCO80NIEQ', 'Non Active', '10', 'asbudi'),
(2, '2022-04-13 06:24:46', 'FNC Pin', 'FNC2A4Y0KR', 'Active', '10', 'Admin FNC'),
(3, '2022-04-13 06:24:46', 'FNC Pin', 'FNCBSYDF9H', 'Active', '10', 'Admin FNC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_staking_fina`
--

CREATE TABLE `setting_staking_fina` (
  `id_setting` int(11) NOT NULL,
  `name_setting` varchar(20) NOT NULL,
  `amount_setting` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting_staking_fina`
--

INSERT INTO `setting_staking_fina` (`id_setting`, `name_setting`, `amount_setting`) VALUES
(1, 'Staking Bonus', 0.1),
(2, 'Price 1 FNC', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staking_member_fina`
--

CREATE TABLE `staking_member_fina` (
  `id_staking` int(11) NOT NULL,
  `member_staking` varchar(20) NOT NULL,
  `jumlah_fnc_staking` double NOT NULL,
  `tgl_staking` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `staking_member_fina`
--

INSERT INTO `staking_member_fina` (`id_staking`, `member_staking`, `jumlah_fnc_staking`, `tgl_staking`) VALUES
(4, 'asbudi', 1000, '2022-04-13 06:50:33'),
(6, 'asbudi', 1000, '2022-04-13 08:26:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `story_sponsor_fina`
--

CREATE TABLE `story_sponsor_fina` (
  `id` int(11) NOT NULL,
  `tgl_story_sponsor` date NOT NULL,
  `time_story_sponsor` time NOT NULL,
  `username_story_sponsor` varchar(20) NOT NULL,
  `upline_story_sponsor` varchar(20) NOT NULL,
  `fnc_story_sponsor` double NOT NULL,
  `lvl_story_sponsor` int(11) NOT NULL,
  `number_story_sponsor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `story_staking_fina`
--

CREATE TABLE `story_staking_fina` (
  `id` int(11) NOT NULL,
  `fnc_story` double NOT NULL,
  `tgl_story` date NOT NULL,
  `time_story` time NOT NULL,
  `id_staking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `story_staking_fina`
--

INSERT INTO `story_staking_fina` (`id`, `fnc_story`, `tgl_story`, `time_story`, `id_staking`) VALUES
(1, 3000, '2022-04-12', '14:02:02', 4),
(2, 1, '2022-04-13', '15:26:57', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `story_wd_fina`
--

CREATE TABLE `story_wd_fina` (
  `id` int(11) NOT NULL,
  `tgl_wd` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_confirm` timestamp NULL DEFAULT NULL,
  `username_wd` varchar(20) NOT NULL,
  `fullname_wd` varchar(250) NOT NULL,
  `bank_wd` varchar(100) NOT NULL,
  `no_rek_wd` varchar(100) NOT NULL,
  `fnc_wd` double NOT NULL,
  `idr_wd` double NOT NULL,
  `ecosystem_wd` double NOT NULL,
  `status_wd` enum('Approve','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_fina`
--
ALTER TABLE `admin_fina`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bonus_sponsor_fina`
--
ALTER TABLE `bonus_sponsor_fina`
  ADD PRIMARY KEY (`id_sponsor`),
  ADD KEY `level_sponsor` (`level_sponsor`);

--
-- Indeks untuk tabel `history_transaksi_pin_fina`
--
ALTER TABLE `history_transaksi_pin_fina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengirim_pin` (`pengirim_pin`),
  ADD KEY `penerima_pin` (`penerima_pin`);

--
-- Indeks untuk tabel `max_stacking`
--
ALTER TABLE `max_stacking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member_fina`
--
ALTER TABLE `member_fina`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `username_member_2` (`username_member`),
  ADD UNIQUE KEY `email_member` (`email_member`),
  ADD KEY `username_member` (`username_member`),
  ADD KEY `sponsor_member` (`sponsor_member`);

--
-- Indeks untuk tabel `pembelian_fnc_fina`
--
ALTER TABLE `pembelian_fnc_fina`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pin_activation_fina`
--
ALTER TABLE `pin_activation_fina`
  ADD PRIMARY KEY (`id_pin`),
  ADD KEY `code_pin` (`code_pin`),
  ADD KEY `status_pin` (`status_pin`),
  ADD KEY `pemilik_pin` (`pemilik_pin`);

--
-- Indeks untuk tabel `setting_staking_fina`
--
ALTER TABLE `setting_staking_fina`
  ADD PRIMARY KEY (`id_setting`),
  ADD KEY `name_setting` (`name_setting`);

--
-- Indeks untuk tabel `staking_member_fina`
--
ALTER TABLE `staking_member_fina`
  ADD PRIMARY KEY (`id_staking`);

--
-- Indeks untuk tabel `story_sponsor_fina`
--
ALTER TABLE `story_sponsor_fina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upline_story_sponsor` (`upline_story_sponsor`);

--
-- Indeks untuk tabel `story_staking_fina`
--
ALTER TABLE `story_staking_fina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_staking` (`id_staking`);

--
-- Indeks untuk tabel `story_wd_fina`
--
ALTER TABLE `story_wd_fina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_wd` (`username_wd`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_fina`
--
ALTER TABLE `admin_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bonus_sponsor_fina`
--
ALTER TABLE `bonus_sponsor_fina`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `history_transaksi_pin_fina`
--
ALTER TABLE `history_transaksi_pin_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `max_stacking`
--
ALTER TABLE `max_stacking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `member_fina`
--
ALTER TABLE `member_fina`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembelian_fnc_fina`
--
ALTER TABLE `pembelian_fnc_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pin_activation_fina`
--
ALTER TABLE `pin_activation_fina`
  MODIFY `id_pin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting_staking_fina`
--
ALTER TABLE `setting_staking_fina`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `staking_member_fina`
--
ALTER TABLE `staking_member_fina`
  MODIFY `id_staking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `story_sponsor_fina`
--
ALTER TABLE `story_sponsor_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `story_staking_fina`
--
ALTER TABLE `story_staking_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `story_wd_fina`
--
ALTER TABLE `story_wd_fina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
