-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Okt 2025 pada 04.02
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubed`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataset`
--

CREATE TABLE `dataset` (
  `ID_DATASET` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `TAHUN` int(11) DEFAULT NULL,
  `MUSIM_PANEN` int(11) DEFAULT NULL,
  `LUAS` int(11) DEFAULT NULL,
  `QTY_TANAM` int(11) DEFAULT NULL,
  `LAMA` int(11) DEFAULT NULL,
  `PAKAN` int(11) DEFAULT NULL,
  `HASIL_PANEN` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dataset`
--

INSERT INTO `dataset` (`ID_DATASET`, `ID_USER`, `TAHUN`, `MUSIM_PANEN`, `LUAS`, `QTY_TANAM`, `LAMA`, `PAKAN`, `HASIL_PANEN`) VALUES
(164, NULL, 2020, 30, 500, 20, 60, 80, '125'),
(165, NULL, 2020, 20, 500, 15, 50, 50, '80'),
(166, NULL, 2020, 10, 500, 5, 55, 40, '45'),
(167, NULL, 2020, 30, 600, 20, 50, 80, '135'),
(168, NULL, 2020, 20, 600, 10, 52, 50, '90'),
(169, NULL, 2020, 10, 600, 7, 56, 50, '65'),
(170, NULL, 2020, 30, 550, 15, 60, 70, '110'),
(171, NULL, 2020, 20, 550, 10, 55, 50, '80'),
(172, NULL, 2020, 10, 550, 7, 60, 35, '50'),
(173, NULL, 2020, 30, 225, 15, 53, 50, '90'),
(174, NULL, 2020, 20, 225, 10, 55, 55, '75'),
(175, NULL, 2020, 10, 225, 5, 50, 20, '45'),
(176, NULL, 2020, 30, 280, 15, 55, 50, '80'),
(177, NULL, 2020, 20, 280, 10, 57, 40, '55'),
(178, NULL, 2020, 10, 280, 5, 50, 20, '50'),
(179, NULL, 2020, 30, 150, 12, 58, 40, '70'),
(180, NULL, 2020, 20, 150, 7, 57, 20, '55'),
(181, NULL, 2020, 10, 150, 5, 60, 20, '40'),
(182, NULL, 2020, 30, 100, 11, 50, 30, '57'),
(183, NULL, 2020, 20, 100, 6, 56, 20, '55'),
(184, NULL, 2020, 10, 100, 3, 51, 20, '30'),
(185, NULL, 2020, 30, 50, 4, 55, 20, '25'),
(186, NULL, 2020, 20, 50, 5, 57, 15, '35'),
(187, NULL, 2020, 10, 50, 2, 55, 15, '15'),
(188, NULL, 2020, 30, 100, 9, 60, 30, '56'),
(189, NULL, 2020, 20, 100, 6, 60, 25, '60'),
(190, NULL, 2020, 10, 100, 3, 59, 20, '35'),
(191, NULL, 2020, 30, 150, 11, 50, 40, '60'),
(192, NULL, 2020, 20, 150, 7, 58, 20, '55'),
(193, NULL, 2020, 10, 150, 5, 59, 20, '45'),
(194, NULL, 2021, 30, 500, 11, 55, 55, '76'),
(195, NULL, 2021, 20, 500, 8, 52, 35, '64'),
(196, NULL, 2021, 10, 500, 5, 48, 18, '36'),
(197, NULL, 2021, 30, 600, 14, 60, 85, '130'),
(198, NULL, 2021, 20, 600, 12, 55, 60, '76'),
(199, NULL, 2021, 10, 600, 7, 48, 35, '45'),
(200, NULL, 2021, 30, 550, 11, 55, 45, '88'),
(201, NULL, 2021, 20, 550, 7, 52, 40, '62'),
(202, NULL, 2021, 10, 550, 5, 48, 25, '35'),
(203, NULL, 2021, 30, 225, 6, 52, 36, '57'),
(204, NULL, 2021, 20, 225, 3, 48, 25, '36'),
(205, NULL, 2021, 10, 225, 3, 48, 10, '20'),
(206, NULL, 2021, 30, 280, 7, 52, 42, '56'),
(207, NULL, 2021, 20, 280, 3, 48, 25, '35'),
(208, NULL, 2021, 10, 280, 3, 55, 8, '12'),
(209, NULL, 2021, 30, 150, 3, 60, 15, '16'),
(210, NULL, 2021, 20, 150, 3, 50, 15, '20'),
(211, NULL, 2021, 10, 150, 3, 48, 15, '15'),
(212, NULL, 2021, 30, 100, 1, 50, 6, '6'),
(213, NULL, 2021, 20, 100, 2, 49, 10, '10'),
(214, NULL, 2021, 10, 100, 1, 55, 5, '10'),
(215, NULL, 2021, 30, 50, 3, 55, 15, '15'),
(216, NULL, 2021, 20, 50, 1, 48, 4, '4'),
(217, NULL, 2021, 10, 50, 1, 48, 5, '5'),
(218, NULL, 2021, 30, 100, 1, 47, 4, '4'),
(219, NULL, 2021, 20, 100, 1, 48, 4, '4'),
(220, NULL, 2021, 10, 100, 1, 52, 5, '5'),
(221, NULL, 2021, 30, 150, 2, 52, 10, '20'),
(222, NULL, 2021, 20, 150, 3, 48, 15, '30'),
(223, NULL, 2021, 10, 150, 2, 48, 12, '12'),
(224, NULL, 2022, 30, 500, 15, 55, 80, '110'),
(225, NULL, 2022, 20, 500, 12, 52, 42, '84'),
(226, NULL, 2022, 10, 500, 4, 48, 16, '32'),
(227, NULL, 2022, 30, 600, 17, 55, 75, '130'),
(228, NULL, 2022, 20, 600, 10, 52, 65, '75'),
(229, NULL, 2022, 10, 600, 6, 52, 24, '40'),
(230, NULL, 2022, 30, 550, 11, 55, 45, '88'),
(231, NULL, 2022, 20, 550, 9, 52, 35, '52'),
(232, NULL, 2022, 10, 550, 1, 48, 6, '6'),
(233, NULL, 2022, 30, 225, 3, 50, 15, '30'),
(234, NULL, 2022, 20, 225, 3, 48, 12, '24'),
(235, NULL, 2022, 10, 225, 3, 48, 10, '18'),
(236, NULL, 2022, 30, 280, 6, 52, 24, '48'),
(237, NULL, 2022, 20, 280, 2, 48, 12, '24'),
(238, NULL, 2022, 10, 280, 1, 55, 6, '12'),
(239, NULL, 2022, 30, 150, 1, 50, 5, '5'),
(240, NULL, 2022, 20, 150, 1, 50, 6, '12'),
(241, NULL, 2022, 10, 150, 3, 45, 12, '24'),
(242, NULL, 2022, 30, 100, 1, 55, 5, '5'),
(243, NULL, 2022, 20, 100, 2, 50, 8, '8'),
(244, NULL, 2022, 10, 100, 1, 48, 4, '4'),
(245, NULL, 2022, 30, 50, 2, 55, 12, '12'),
(246, NULL, 2022, 20, 50, 1, 55, 5, '10'),
(247, NULL, 2022, 10, 50, 2, 48, 12, '24'),
(248, NULL, 2022, 30, 100, 2, 56, 12, '24'),
(249, NULL, 2022, 20, 100, 1, 56, 5, '10'),
(250, NULL, 2022, 10, 100, 1, 49, 4, '8'),
(251, NULL, 2022, 30, 150, 2, 48, 8, '16'),
(252, NULL, 2022, 20, 150, 3, 48, 15, '15'),
(253, NULL, 2022, 10, 150, 2, 48, 4, '8'),
(254, NULL, 2023, 30, 500, 12, 52, 50, '85'),
(255, NULL, 2023, 20, 500, 10, 52, 55, '76'),
(256, NULL, 2023, 10, 500, 5, 48, 30, '45'),
(257, NULL, 2023, 30, 600, 15, 55, 65, '98'),
(258, NULL, 2023, 20, 600, 10, 52, 50, '80'),
(259, NULL, 2023, 10, 600, 5, 48, 35, '42'),
(260, NULL, 2023, 30, 550, 10, 55, 40, '80'),
(261, NULL, 2023, 20, 550, 6, 52, 25, '50'),
(262, NULL, 2023, 10, 550, 4, 48, 25, '35'),
(263, NULL, 2023, 30, 225, 7, 48, 30, '52'),
(264, NULL, 2023, 20, 225, 5, 48, 20, '35'),
(265, NULL, 2023, 10, 225, 3, 48, 15, '30'),
(266, NULL, 2023, 30, 280, 12, 52, 50, '70'),
(267, NULL, 2023, 20, 280, 7, 48, 30, '45'),
(268, NULL, 2023, 10, 280, 5, 48, 25, '30'),
(269, NULL, 2023, 30, 150, 2, 55, 8, '8'),
(270, NULL, 2023, 20, 150, 1, 52, 4, '8'),
(271, NULL, 2023, 10, 150, 2, 50, 8, '8'),
(272, NULL, 2023, 30, 100, 3, 56, 20, '30'),
(273, NULL, 2023, 20, 100, 5, 53, 15, '42'),
(274, NULL, 2023, 10, 100, 2, 51, 10, '10'),
(275, NULL, 2023, 30, 50, 1, 56, 4, '4'),
(276, NULL, 2023, 20, 50, 2, 53, 10, '20'),
(277, NULL, 2023, 10, 50, 2, 51, 10, '10'),
(278, NULL, 2023, 30, 100, 5, 48, 15, '25'),
(279, NULL, 2023, 20, 100, 3, 48, 15, '17'),
(280, NULL, 2023, 10, 100, 2, 48, 10, '12'),
(281, NULL, 2023, 30, 150, 5, 48, 15, '22'),
(282, NULL, 2023, 20, 150, 3, 48, 15, '18'),
(283, NULL, 2023, 10, 150, 3, 48, 6, '9'),
(284, NULL, 2024, 30, 500, 17, 55, 50, '83'),
(285, NULL, 2024, 20, 500, 12, 48, 55, '85'),
(286, NULL, 2024, 10, 500, 3, 48, 15, '30'),
(287, NULL, 2024, 30, 600, 16, 55, 60, '85'),
(288, NULL, 2024, 20, 600, 12, 52, 30, '45'),
(289, NULL, 2024, 10, 600, 7, 48, 25, '36'),
(290, NULL, 2024, 30, 550, 13, 60, 76, '85'),
(291, NULL, 2024, 20, 550, 9, 52, 45, '64'),
(292, NULL, 2024, 10, 550, 5, 48, 30, '45'),
(293, NULL, 2024, 30, 225, 2, 48, 20, '35'),
(294, NULL, 2024, 20, 225, 3, 48, 15, '35'),
(295, NULL, 2024, 10, 225, 3, 48, 15, '25'),
(296, NULL, 2024, 30, 280, 6, 52, 35, '50'),
(297, NULL, 2024, 20, 280, 6, 48, 20, '30'),
(298, NULL, 2024, 10, 280, 3, 48, 10, '12'),
(299, NULL, 2024, 30, 150, 5, 48, 25, '22'),
(300, NULL, 2024, 20, 150, 2, 48, 12, '24'),
(301, NULL, 2024, 10, 150, 2, 48, 12, '12'),
(302, NULL, 2024, 30, 100, 2, 48, 12, '24'),
(303, NULL, 2024, 20, 100, 2, 48, 6, '6'),
(304, NULL, 2024, 10, 100, 2, 48, 4, '8'),
(305, NULL, 2024, 30, 50, 1, 48, 4, '4'),
(306, NULL, 2024, 20, 50, 2, 48, 12, '20'),
(307, NULL, 2024, 10, 50, 2, 48, 5, '5'),
(308, NULL, 2024, 30, 100, 2, 48, 4, '8'),
(309, NULL, 2024, 20, 100, 3, 48, 18, '36'),
(310, NULL, 2024, 10, 100, 1, 48, 4, '7'),
(311, NULL, 2024, 30, 150, 3, 48, 12, '12'),
(312, NULL, 2024, 20, 150, 2, 48, 5, '10'),
(313, NULL, 2024, 10, 150, 2, 48, 6, '8'),
(314, NULL, 2024, 10, 1, 1, 1, 1, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `ID_HASIL` int(11) NOT NULL,
  `WAKTU_PREDIKSI` datetime DEFAULT NULL,
  `HASIL_PREDIKSI` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perhitungan`
--

CREATE TABLE `perhitungan` (
  `ID_DATASET` int(11) NOT NULL,
  `ID_HASIL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(225) DEFAULT NULL,
  `PASSWORD` varchar(225) DEFAULT NULL,
  `LEVEL` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `LEVEL`) VALUES
(1, 'admin', 'admin', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$jWazUPqjUYfQbnui84KOR.Vf.7TPPz2kOkoEt21rBBkZAZ3jaikLi', '2025-06-28 21:51:14', '2025-06-28 21:51:14', 'admin'),
(2, 'user', 'user@gmail.com', '$2y$10$fMGw2HxHIttaDRZpLpaPfOpXD6g0ish0SLFaH6qvwiXp6HluuWwRW', NULL, NULL, 'user'),
(6, 'percobaan', 'pc@gmail.com', '$2y$10$K89v8VvN8XemxjMWS/RR6.pbIjD3HJVoL54KPszCkaOUtoeJ8C6p6', NULL, NULL, 'user'),
(7, 'percobaan1', 'pc1@gmail.com', '$2y$10$HG/rdfoH.8Aal.ytprA6guuoQ1aqnhnEU9c.qdRLBwGupL93N3lU2', NULL, NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`ID_DATASET`),
  ADD KEY `32dxs` (`ID_USER`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`ID_HASIL`);

--
-- Indeks untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`ID_DATASET`,`ID_HASIL`),
  ADD KEY `FK_PERHITUNGAN2` (`ID_HASIL`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dataset`
--
ALTER TABLE `dataset`
  MODIFY `ID_DATASET` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD CONSTRAINT `FK_PERHITUNGAN2` FOREIGN KEY (`ID_HASIL`) REFERENCES `hasil` (`ID_HASIL`),
  ADD CONSTRAINT `wewwse` FOREIGN KEY (`ID_DATASET`) REFERENCES `dataset` (`ID_DATASET`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
