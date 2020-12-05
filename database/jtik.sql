-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2020 at 10:16 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jtik`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajukan_surat`
--

CREATE TABLE `ajukan_surat` (
  `id_surat` int(20) NOT NULL,
  `NIPNIM` varchar(255) DEFAULT NULL,
  `matakuliah_kode_mtk` varchar(128) DEFAULT NULL,
  `tanggal_matkul` varchar(128) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `perihal` varchar(128) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `presensi` enum('hadir','alfa','sakit','izin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ajukan_surat`
--

INSERT INTO `ajukan_surat` (`id_surat`, `NIPNIM`, `matakuliah_kode_mtk`, `tanggal_matkul`, `tanggal`, `perihal`, `file`, `status`, `presensi`) VALUES
(2, '4816040333', 'Basis  Data 1', '2020-07-11', '2020-07-11 15:46:44', 'Sakit', 'a1.png', 2, 'sakit');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` int(10) NOT NULL,
  `kelas_kode_kelas` varchar(100) NOT NULL,
  `matakuliah_kode_mtk` varchar(100) NOT NULL,
  `pegawai_nip` varchar(200) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang_kelas` varchar(100) NOT NULL,
  `tahunakademik_kode_ta` varchar(50) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dibuat_oleh` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `kelas_kode_kelas`, `matakuliah_kode_mtk`, `pegawai_nip`, `hari`, `jam_mulai`, `jam_selesai`, `ruang_kelas`, `tahunakademik_kode_ta`, `tanggal_upload`, `dibuat_oleh`) VALUES
(1121, 'TI 2A', 'Bahasa Indonesia untuk Teknik Informatika', 'Sekjur', 'SABTU', '11:05:00', '15:15:00', 'AA301', '201702', '2020-07-11 08:10:12', ''),
(1122, 'TI 2A', 'Basis  Data 1', 'Reno Kalih Madani', 'SABTU', '07:30:00', '11:55:00', 'GSG204', '201702', '2020-07-11 00:49:10', ''),
(1123, 'TI 2A', 'Aljabar Linier', 'Agus', 'RABU', '07:30:00', '11:05:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1124, 'TI 2A', 'Bahasa Inggris untuk TIK 2', 'Fitri', 'RABU', '11:05:00', '14:25:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1125, 'TI 2A', 'Jaringan Komputer dan Komunikasi', 'Herlino', 'KAMIS', '07:30:00', '13:35:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1126, 'TI 2A', 'Struktur Data', 'Dewiyanti', 'KAMIS', '13:35:00', '19:35:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1127, 'TI 2A', 'Pemrograman Web 1', 'Nia Safitri', 'JUMAT', '07:30:00', '13:35:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1128, 'TI 2A', 'Rekayasa Perangkat Lunak', 'Euis', 'JUMAT', '13:35:00', '16:35:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1129, 'TI 4A', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'SENIN', '07:30:00', '11:05:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1130, 'TI 4A', 'SIM', 'Weldy', 'SENIN', '12:45:00', '16:35:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1131, 'TI 4A', 'Kecerdasan Buatan ', 'Shinta', 'SELASA', '11:05:00', '15:15:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1132, 'TI 4A', 'Metodologi Penelitian', 'Euis', 'RABU', '07:30:00', '11:05:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1133, 'TI 4A', 'Datawarehouse', 'Nia Safitri', 'RABU', '11:05:00', '16:35:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1134, 'TI 4A', 'Pemrograman Berorientasi Objek 2', 'Oktav', 'KAMIS', '07:30:00', '13:35:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1135, 'TI 4A', 'Grafika Komputer', 'Ayu', 'KAMIS', '13:35:00', '17:25:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1136, 'TI 4A', 'Perancangan Antarmuka ', 'Ade', 'JUMAT', '07:30:00', '11:05:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1137, 'TI 4A', 'Perancangan dan Analisis Sistem', 'Asep', 'JUMAT', '12:45:00', '17:25:00', 'LAB-EBD', '201702', '2020-05-22 16:33:31', ''),
(1138, 'TI 4B', 'Objek Oriented Programming 2', 'Khadafi', 'SENIN', '07:30:00', '13:35:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1139, 'TI 4B', 'Grafika Komputer', 'Anggi', 'SENIN', '13:35:00', '17:25:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1140, 'TI 4B', 'Kecerdasan Buatan', 'Shinta', 'SELASA', '07:30:00', '11:05:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1141, 'TI 4B', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'SELASA', '11:05:00', '14:25:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1142, 'TI 4B', 'Analisis dan Perancangan Sistem', 'Asep', 'RABU', '07:30:00', '13:35:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1143, 'TI 4B', 'Perancangan Antarmuka', 'Ade', 'KAMIS', '07:30:00', '11:05:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1144, 'TI 4B', 'Metodologi Penelitian 1', 'Euis', 'KAMIS', '11:05:00', '14:25:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1145, 'TI 4B', 'SIM', 'Weldy', 'JUMAT', '07:30:00', '11:05:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1146, 'TI 4B', 'Datawarehouse', 'Nia Safitri', 'JUMAT', '13:35:00', '18:15:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1147, 'TI 6A', 'Data Mining', 'Rahmat', 'SENIN', '07:30:00', '11:05:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1148, 'TI 6A', 'Sistem Terdistribusi', 'Herlino', 'SENIN', '11:05:00', '15:15:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1149, 'TI 6A', 'Perencanaan Sumber Daya Perusahaan', 'Euis', 'SELASA', '07:30:00', '10:00:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1150, 'TI 6A', 'Hukum dan Etika  Dalam Teknologi Informasi dan Komunikasi ', 'Ayres', 'SELASA', '10:15:00', '13:35:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1151, 'TI 6A', 'Proyek sesuai kekhususan bidang Teknik Informatika', 'Hata', 'RABU', '07:30:00', '13:35:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1152, 'TI 6A', 'Pemrograman Web 3 ', 'Asep', 'KAMIS', '07:30:00', '13:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1153, 'TI 6A', 'Kewirausahaan dalam bidang teknologi', 'Fidri', 'KAMIS', '14:25:00', '17:25:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1154, 'TI 6A', 'Pemrograman Bergerak', 'Syamsi', 'JUMAT', '07:30:00', '13:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1155, 'TI 6A', 'Pengolahan Citra Digital', 'Anggi', 'JUMAT', '13:35:00', '17:25:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1156, 'TI 6B', 'Pemrograman Web 3', 'Chandra', 'SENIN', '07:30:00', '13:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1157, 'TI 6B', 'Hukum dan Etika dalam Teknologi Infromasi dan Komunikasi', 'Refirman', 'SENIN', '13:35:00', '16:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1158, 'TI 6B', 'Data Mining', 'Rahmat', 'SELASA', '07:30:00', '11:05:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1159, 'TI 6B', 'Sistem Terdistribusi', 'Herlino', 'SELASA', '11:05:00', '15:15:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1160, 'TI 6B', 'Kewirausahaan dalam bidang teknologi', 'Ayres', 'RABU', '07:30:00', '10:00:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1161, 'TI 6B', 'Pemrograman Bergerak', 'Syamsi', 'RABU', '12:45:00', '19:35:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1162, 'TI 6B', 'Pengolahan Citra Digital', 'Anggi', 'KAMIS', '07:30:00', '11:05:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1163, 'TI 6B', 'Perencanaan Sumber Daya Perusahaan', 'Hata', 'KAMIS', '12:45:00', '15:15:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1164, 'TI 6B', 'Proyek sesuai kekhususan bidang Teknik Informatika ', 'Shinta', 'JUMAT', '11:05:00', '17:25:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1165, 'TI 8A', 'Bahasa Inggris Komunikasi 3', 'Yoyok', 'SELASA', '11:05:00', '15:15:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1166, 'TI 8A', 'Kapita Selekta 2', 'Eriya', 'SABTU', '07:30:00', '13:35:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1167, 'TI 8A', 'Metodologi Penelitian 2', 'Ayres', 'SABTU', '13:35:00', '17:25:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1168, 'TI 4A MSU', 'Analisis dan Perancangan Sistem', 'hata', 'SENIN', '07:30:00', '13:35:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1169, 'TI 4A MSU', 'Metodologi Penelitian 1 ', 'Ayres', 'SENIN', '14:25:00', '17:25:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1170, 'TI 4A MSU', 'Perancangan Antarmuka', 'Iwan', 'SELASA', '07:30:00', '11:05:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1171, 'TI 4A MSU', 'Data Warehouse', 'Nia Safitri', 'SELASA', '13:35:00', '18:15:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1172, 'TI 4A MSU', 'Grafika Komputer', 'Ayu', 'RABU', '07:30:00', '11:05:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1173, 'TI 4A MSU', 'Kecerdasan Buatan ', 'Dewiyanti', 'KAMIS', '07:30:00', '11:05:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1174, 'TI 4A MSU', 'Pemrograman berorientasi Objek 2', 'Mauldy', 'KAMIS', '11:05:00', '17:25:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1175, 'TI 4A MSU', 'SIM', 'Eriya', 'JUMAT', '07:30:00', '11:05:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1176, 'TI 4A MSU', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'JUMAT', '11:05:00', '14:25:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1177, 'TI 4B MSU', 'Metodologi Penelitian 1', 'Aziz', 'SENIN', '09:10:00', '11:55:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1178, 'TI 4B MSU', 'Grafika Komputer', 'Ayu', 'SENIN', '14:25:00', '18:15:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1179, 'TI 4B MSU', 'Pemrograman berorientasi Objek 2', 'Mauldy', 'SELASA', '07:30:00', '13:35:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1180, 'TI 4B MSU', 'SIM', 'Weldy', 'SELASA', '13:35:00', '17:25:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1181, 'TI 4B MSU', 'Analisis dan Perancangan Sistem', 'Euis', 'RABU', '13:35:00', '19:35:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1182, 'TI 4B MSU', 'Data Warehouse', 'Nia Safitri', 'KAMIS', '07:30:00', '11:55:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1183, 'TI 4B MSU', 'Perancangan Antarmuka', 'Iwan', 'KAMIS', '13:35:00', '17:25:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1184, 'TI 4B MSU', 'Kecerdasan Buatan', 'Shinta', 'JUMAT', '07:30:00', '11:05:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1185, 'TI 4B MSU', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'JUMAT', '14:25:00', '17:25:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1186, 'TI 4A CBD', 'Data Warehouse', 'Reno Kalih Madani', 'SENIN', '10:15:00', '14:25:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1187, 'TI 4A CBD', 'Metodologi Penelitian 1', 'Prihatin', 'SENIN', '14:25:00', '18:15:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1188, 'TI 4A CBD', 'Kecerdasan Buatan ', 'Dewiyanti', 'SELASA', '10:15:00', '14:25:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1189, 'TI 4A CBD', 'Grafika', 'Defiana', 'SELASA', '14:25:00', '18:15:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1190, 'TI 4A CBD', 'Pemrograman berorientasi Objek 2', 'Anggi', 'RABU', '10:15:00', '14:25:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1191, 'TI 4A CBD', 'Analisis dan Perancangan Sistem', 'Shinta', 'RABU', '14:25:00', '18:15:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1192, 'TI 4A CBD', 'SIM', 'Eriya', 'KAMIS', '10:15:00', '14:25:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1193, 'TI 4A CBD', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'KAMIS', '14:25:00', '18:15:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1194, 'TI 4A CBD', 'Perancangan Antarmuka', 'Iwan', 'JUMAT', '07:30:00', '11:05:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1195, 'TI 4B CBD', 'Metodologi Penelitian 1', 'Prihatin', 'SENIN', '10:15:00', '14:25:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1196, 'TI 4B CBD', 'Data Warehouse', 'Reno Kalih Madani', 'SENIN', '14:25:00', '18:15:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1197, 'TI 4B CBD', 'Grafika Komputer', 'Defiana', 'SELASA', '10:15:00', '14:25:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1198, 'TI 4B CBD', 'Kecerdasan Buatan', 'Dewiyanti', 'SELASA', '14:25:00', '18:15:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1199, 'TI 4B CBD', 'Analisis dan Perancangan Sistem', 'Shinta', 'RABU', '10:15:00', '14:25:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1200, 'TI 4B CBD', 'Pemrograman berorientasi Objek 2', 'Anggi', 'RABU', '14:25:00', '18:15:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1201, 'TI 4B CBD', 'Bahasa Inggris Komunikasi 1', 'Dewi K', 'KAMIS', '10:15:00', '14:25:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1202, 'TI 4B CBD', 'SIM', 'Eriya', 'KAMIS', '14:25:00', '18:15:00', 'CBD1', '201702', '2020-05-22 16:33:31', ''),
(1203, 'TI 4B CBD', 'Perancangan Antarmuka', 'Iwan', 'JUMAT', '11:05:00', '15:15:00', 'CBD2', '201702', '2020-05-22 16:33:31', ''),
(1204, 'CCIT 2A', 'Bahasa Indonesia untuk Teknik Informatika', 'Novita', 'SENIN', '07:30:00', '11:05:00', 'TCR1', '201702', '2020-05-22 16:33:31', ''),
(1205, 'CCIT 2A', 'Aljabar Linier', 'Agus', 'SELASA', '07:30:00', '11:05:00', 'TCR1', '201702', '2020-05-22 16:33:31', ''),
(1206, 'CCIT 2A', 'Jaringan Komputer dan Komunikasi', 'Aziz', 'RABU', '07:30:00', '13:35:00', 'TCR2', '201702', '2020-05-22 16:33:31', ''),
(1207, 'CCIT 4A', 'Bahasa Inggris Komunikasi 1 ', 'Yoyok', 'SELASA', '07:30:00', '10:00:00', 'TCR2', '201702', '2020-05-22 16:33:31', ''),
(1208, 'CCIT 4A', 'Grafika Komputer', 'Hata', 'KAMIS', '07:30:00', '11:05:00', 'TCR2', '201702', '2020-05-22 16:33:31', ''),
(1209, 'CCIT 4A', 'Datawarehouse', 'Asep', 'JUMAT', '07:30:00', '11:55:00', 'TCR2', '201702', '2020-05-22 16:33:31', ''),
(1210, 'CCIT 4B', 'Data Warehouse ', 'Anggi', 'SENIN', '07:30:00', '11:55:00', 'TCR4', '201702', '2020-05-22 16:33:31', ''),
(1211, 'CCIT 4B', 'Grafika Komputer', 'Hata', 'SELASA', '07:30:00', '11:05:00', 'TCR4', '201702', '2020-05-22 16:33:31', ''),
(1212, 'CCIT 4B', 'Bahasa Inggris Komunikasi 1 ', 'Yoyok', 'KAMIS', '07:30:00', '10:00:00', 'TCR3', '201702', '2020-05-22 16:33:31', ''),
(1213, 'CCIT 6A', 'Pemrograman Web 3', 'Asep', 'SENIN', '07:30:00', '13:35:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1214, 'CCIT 6A', 'Proyek sesuai kekhususan bidang Teknik Informatika', 'Nia Safitri', 'SENIN', '13:35:00', '17:25:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1215, 'CCIT 6A', 'Manajemen Proyek TIK', 'Refirman', 'SELASA', '07:30:00', '11:05:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1216, 'CCIT 6A', 'Pengolahan Citra Digital', 'Anggi', 'SELASA', '11:05:00', '15:15:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1217, 'CCIT 6A', 'Hukum dan Etika dalam Teknologi', 'Ayres', 'RABU', '14:25:00', '17:25:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1218, 'CCIT 6A', 'Pemrograman Bergerak', 'Syamsi', 'KAMIS', '07:30:00', '13:35:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1219, 'CCIT 6A', 'Sistem Terdistribusi', 'Defiana', 'KAMIS', '13:35:00', '17:25:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1220, 'CCIT 6A', 'Data Mining', 'Euis', 'JUMAT', '07:30:00', '11:05:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1221, 'CCIT 6A', 'Perencanaan Sumber Daya Perusahaan ', 'Hata', 'JUMAT', '12:45:00', '15:15:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1222, 'CCIT 6B', 'Data Mining', 'Euis', 'SENIN', '07:30:00', '11:05:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1223, 'CCIT 6B', 'Hukum dan Etika  Dalam Teknologi Informasi dan Komunikasi', 'Ayres', 'SENIN', '11:05:00', '14:25:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1224, 'CCIT 6B', 'Pemrograman Web 3', 'Asep', 'SELASA', '07:30:00', '13:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1225, 'CCIT 6B', 'Sistem Terdistribusi', 'Fachroni', 'SELASA', '13:35:00', '17:25:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1226, 'CCIT 6B', 'Proyek sesuai kekhususan bidang Teknik Informatika', 'Reno Kalih Madani', 'RABU', '07:30:00', '11:05:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1227, 'CCIT 6B', 'Manajemen Proyek TIK', 'Refirman', 'RABU', '11:05:00', '15:15:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1228, 'CCIT 6B', 'Perencanaan Sumber Daya Perusahaan ', 'Hata', 'RABU', '15:45:00', '18:15:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1229, 'CCIT 6B', 'Pengolahan Citra Digital', 'Hadi', 'KAMIS', '13:35:00', '17:25:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1230, 'CCIT 6B', 'Pemrograman Bergerak', 'Syamsi', 'JUMAT', '13:35:00', '19:35:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1231, 'CCIT 8', 'Bahasa Inggris Komunikasi 3', 'Dewi K', 'RABU', '12:45:00', '16:35:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1232, 'CCIT 8', 'Metodologi Penelitian 2', 'Yoyok', 'JUMAT', '11:05:00', '15:15:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1233, 'CCIT 8', 'Kapita Selekta 2', 'Reno Kalih Madani', 'SABTU', '07:30:00', '13:35:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1234, 'TMJ 2', 'Interaksi Manusia dan Komputer', 'Maria', 'SENIN', '07:30:00', '11:05:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1235, 'TMJ 2', 'Bahasa Inggris untuk TIK2', 'Dewi K', 'SENIN', '11:05:00', '14:25:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1236, 'TMJ 2', 'Protokol Perutean dan Penyambungan', 'Fachroni', 'SELASA', '07:30:00', '13:35:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1237, 'TMJ 2', 'Aljabar Linier', 'Agus', 'SELASA', '14:25:00', '18:15:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1238, 'TMJ 2', 'Sistem Multimedia', 'Indahsari', 'RABU', '07:30:00', '11:05:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1239, 'TMJ 2', 'Piranti Komputer', 'Ayu', 'RABU', '11:05:00', '16:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1240, 'TMJ 2', 'Sistem Operasi Jaringan', 'Abub', 'KAMIS', '07:30:00', '11:55:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1241, 'TMJ 2', 'Bahasa Indonesia untuk TIK', 'Novita', 'KAMIS', '13:35:00', '16:35:00', 'LABGSG3', '201702', '2020-05-22 16:33:31', ''),
(1242, 'TMJ 2', 'Pemrograman Berorientasi Obyek', 'Mauldy', 'JUMAT', '07:30:00', '11:55:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1243, 'TMJ 4', 'Kepemimpinan dan pengembangan karakter', 'Taufik', 'SENIN', '07:30:00', '10:00:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1244, 'TMJ 4', 'Metodologi Penelitian 1', 'Euis', 'SENIN', '11:05:00', '14:25:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1245, 'TMJ 4', 'Jaringan Komputer lanjut', 'Ayu', 'SELASA', '07:30:00', '13:35:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1246, 'TMJ 4', 'Teknologi Embeded', 'Hadi', 'SELASA', '13:35:00', '17:25:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1247, 'TMJ 4', 'Teknologi Audio Video', 'Maria', 'RABU', '07:30:00', '11:05:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1248, 'TMJ 4', 'Teknologi Nirkabel', 'Nurfauzi', 'RABU', '11:05:00', '17:25:00', 'LAB-EBD', '201702', '2020-05-22 16:33:31', ''),
(1249, 'TMJ 4', 'Jaringan Cerdas', 'Nyoman', 'KAMIS', '07:30:00', '11:05:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1250, 'TMJ 4', 'Komputasi Awan dan Grid', 'Abub', 'KAMIS', '12:45:00', '16:35:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1251, 'TMJ 4', 'Kriptografi', 'Yohan', 'JUMAT', '07:30:00', '11:05:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1252, 'TMJ 6', 'Jaringan Enterprise', 'Ayu', 'SENIN', '07:30:00', '11:55:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1253, 'TMJ 6', 'Teknologi Migrasi', 'Nyoman', 'SELASA', '07:30:00', '13:35:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1254, 'TMJ 6', 'Bahasa Inggris Komunikasi 2', 'Fitri', 'RABU', '07:30:00', '10:00:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1255, 'TMJ 6', 'Teknologi Sensor', 'Maria', 'RABU', '11:05:00', '17:25:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1256, 'TMJ 6', 'Robotika', 'Hadi', 'KAMIS', '07:30:00', '11:55:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1257, 'TMJ 6', 'Proyek Multimedia Jaringan', 'Indri', 'KAMIS', '13:35:00', '17:25:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1258, 'TMJ 6', 'Keamanan Jaringan', 'Defiana', 'JUMAT', '07:30:00', '13:35:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1259, 'TMJ 6', 'Kewirausahaan dalam bidang Multimedia Jaringan ', 'Hamid', 'JUMAT', '13:35:00', '16:35:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1260, 'TMJ 8', 'Bahasa Inggris untuk tata tulis ilmiah lanjut', 'Fitri', 'SENIN', '07:30:00', '11:05:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1261, 'TMJ 8', 'Kapita Selekta 2', 'Defiana', 'SABTU', '07:30:00', '13:35:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1262, 'TMJ 8', 'Metodologi penelitian lanjut', 'Indri', 'SABTU', '13:35:00', '17:25:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1263, 'TMJ 8 LR', 'Metodologi Penelitian Lanjut', 'Indri', 'JUMAT', '11:05:00', '15:15:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1264, 'TMJ 8 LR', 'Kapita Selekta 2', 'Mauldy', 'SABTU', '07:30:00', '13:35:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1265, 'TMJ 8 LR', 'Bahasa Inggris untuk tata tulis ilmiah lanjut', 'fitri', 'SABTU', '13:35:00', '17:25:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1266, 'CCIT SEC 2A', 'Civic', 'Yusuf', 'SENIN', '07:30:00', '10:00:00', 'TCR3', '201702', '2020-05-22 16:33:31', ''),
(1267, 'CCIT SEC 2A', 'English 2', 'Fitri', 'KAMIS', '07:30:00', '11:05:00', 'TCR1', '201702', '2020-05-22 16:33:31', ''),
(1268, 'CCIT SEC 2A', 'Mathematics 1 (Discrete Mathematics)', 'Agus', 'JUMAT', '07:30:00', '11:05:00', 'TCR1', '201702', '2020-05-22 16:33:31', ''),
(1269, 'CCIT SEC 4A', 'Ethical Hacker', 'Defiana', 'KAMIS', '07:30:00', '11:05:00', 'TCR4', '201702', '2020-05-22 16:33:31', ''),
(1270, 'CCIT SEC 4A', 'English 4', 'Yoyok', 'JUMAT', '07:30:00', '11:05:00', 'TCR4', '201702', '2020-05-22 16:33:31', ''),
(1271, 'CCIT SEC 4B', 'Ethical Hacking', 'Defiana', 'SENIN', '07:30:00', '11:05:00', 'TCR2', '201702', '2020-05-22 16:33:31', ''),
(1272, 'CCIT SEC 4B', 'English 4', 'Yoyok', 'RABU', '07:30:00', '11:05:00', 'TCR4', '201702', '2020-05-22 16:33:31', ''),
(1273, 'CCIT SEC 6', 'Project Management', 'Refirman', 'SENIN', '07:30:00', '11:05:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1274, 'CCIT SEC 6', 'English 6', 'Fitri', 'SENIN', '13:35:00', '17:25:00', 'GSG202', '201702', '2020-05-22 16:33:31', ''),
(1275, 'CCIT SEC 6', 'Distributed Systems', 'Herlino', 'SELASA', '07:30:00', '11:05:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1276, 'CCIT SEC 6', 'Project of Information System Security', 'Mauldy', 'RABU', '07:30:00', '13:35:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1277, 'CCIT SEC 6', 'Security Web Platforms', 'Asep', 'RABU', '13:35:00', '17:25:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1278, 'CCIT SEC 6', 'Shell Script Programming 2', 'Ayu', 'KAMIS', '07:30:00', '11:05:00', 'LAB-EBD', '201702', '2020-05-22 16:33:31', ''),
(1279, 'CCIT SEC 6', 'Routing and Switching 2 (Mikrotik)', 'Fachroni', 'KAMIS', '13:35:00', '17:25:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1280, 'CCIT SEC 6', 'Java Programming (Oracle Academy)', 'Hata', 'JUMAT', '07:30:00', '11:55:00', 'LAB-EBD', '201702', '2020-05-22 16:33:31', ''),
(1281, 'CCIT SEC 6', 'Cryptography 2 (Asymetrics)', 'Yohan', 'JUMAT', '13:35:00', '17:25:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1282, 'CCIT SEC 8', 'Cloud Computing', 'Aziz', 'SENIN', '13:35:00', '18:15:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1283, 'CCIT SEC 8', 'Research Methodology', 'Yoyok', 'SELASA', '15:45:00', '18:15:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1284, 'CCIT SEC 8', 'Security Mobile Platforms', 'Syamsi', 'RABU', '07:30:00', '11:55:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1285, 'CCIT SEC 8', 'Mathematics 3 (Statistics)', 'Euis', 'KAMIS', '07:30:00', '10:00:00', 'AR1', '201702', '2020-05-22 16:33:31', ''),
(1286, 'TMD 2', 'Desain Web', 'Ade', 'SENIN', '07:30:00', '11:05:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1287, 'TMD 2', 'Kepemimpinan dan pengembangan karakter dalam TIK', 'Taufik', 'SELASA', '07:30:00', '11:05:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1288, 'TMD 2', 'Struktur Data', 'Maria', 'SELASA', '13:35:00', '17:25:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1289, 'TMD 2', 'Multimedia Lanjut', 'Irma', 'RABU', '07:30:00', '13:35:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1290, 'TMD 2', 'Bahasa Indonesia dalam TIK', 'Novita', 'RABU', '13:35:00', '16:35:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1291, 'TMD 2', 'Gambar Manual', 'Toni', 'KAMIS', '07:30:00', '11:05:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1292, 'TMD 2', 'Pengantar Jaringan Komputer', 'Chandra', 'KAMIS', '12:45:00', '18:15:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1293, 'TMD 2', 'Bahasa Inggris untuk TIK 2', 'Dewi K', 'JUMAT', '07:30:00', '10:00:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1294, 'TMD 2', 'Sistem Basis Data', 'Reno Kalih Madani', 'JUMAT', '10:15:00', '14:25:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1295, 'TMD 4', 'Pemodelan 3D', 'Indahsari', 'SENIN', '07:30:00', '13:35:00', 'LABGSG4', '201702', '2020-05-22 16:33:31', ''),
(1296, 'TMD 4', 'Metoda Statitiska dalam TIK', 'Hata', 'SENIN', '13:35:00', '17:25:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1297, 'TMD 4', 'Pemrograman Visual', 'Khadafi', 'SELASA', '07:30:00', '11:55:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1298, 'TMD 4', 'Bahasa Inggris Komunikasi 1', 'fitri', 'SELASA', '15:45:00', '18:15:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1299, 'TMD 4', 'Pemrograman Game 1 (2D)', 'Iwan', 'RABU', '07:30:00', '11:05:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1300, 'TMD 4', 'Antarmuka Multimedia', 'Ade', 'RABU', '15:45:00', '19:35:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1301, 'TMD 4', 'Teknik Digital', 'Indri', 'KAMIS', '07:30:00', '11:05:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1302, 'TMD 4', 'Pemrograman Basis Data', 'Anggi', 'KAMIS', '12:45:00', '17:25:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1303, 'TMD 4', 'Metodologi Penelitian 1', 'Ayres', 'JUMAT', '07:30:00', '10:00:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1304, 'TMD 6', 'Pengembangan Web Multimedia', 'Maria', 'SENIN', '13:35:00', '17:25:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1305, 'TMD 6', 'Multimedia Embedded System', 'Hadi', 'SELASA', '07:30:00', '13:35:00', 'AA204', '201702', '2020-05-22 16:33:31', ''),
(1306, 'TMD 6', 'Multimedia Authoring & Scripting', 'Ade', 'SELASA', '13:35:00', '17:25:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1307, 'TMD 6', 'Proyek Kekhususan', 'Eriya', 'RABU', '07:30:00', '13:35:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1308, 'TMD 6', 'Augmented Reality', 'Irma', 'RABU', '14:25:00', '18:15:00', 'AA303', '201702', '2020-05-22 16:33:31', ''),
(1309, 'TMD 6', 'Pemrograman Game 2 (3D)', 'Iwan', 'KAMIS', '07:30:00', '11:05:00', 'GSG203', '201702', '2020-05-22 16:33:31', ''),
(1310, 'TMD 6', 'Animasi 3D', 'Indahsari', 'JUMAT', '07:30:00', '13:35:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1311, 'TMD 6', 'Manajemen Proyek TIK', 'Refirman', 'JUMAT', '13:35:00', '17:25:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1312, 'TMD 8', 'Bahasa Inggis Komunikasi 3', 'Fitri', 'RABU', '14:25:00', '17:25:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1313, 'TMD 8', 'Kapita Selekta 2', 'Iwan', 'SABTU', '07:30:00', '13:35:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1314, 'TMD 8', 'Metodologi Penelitian 2', 'Yoyok', 'SABTU', '13:35:00', '17:25:00', 'AA302', '201702', '2020-05-22 16:33:31', ''),
(1315, 'TMD 2 AeU', 'Data Structure', 'Eriya', 'SENIN', '07:30:00', '11:05:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1316, 'TMD 2 AeU', 'Introduction to Multimedia', 'Iwan', 'SENIN', '11:05:00', '15:15:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1317, 'TMD 2 AeU', 'Introduction Computer Network', 'Indri', 'SELASA', '07:30:00', '13:35:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1318, 'TMD 2 AeU', 'Database System', 'Nia Safitri', 'RABU', '07:30:00', '11:05:00', 'AA304', '201702', '2020-05-22 16:33:31', ''),
(1319, 'TMD 2 AeU', 'Algoritma dan Pemrograman', 'Indahsari', 'RABU', '11:05:00', '16:35:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1320, 'TMD 2 AeU', 'Fundamental Of ICT', 'Fidri', 'KAMIS', '07:30:00', '11:05:00', 'AA301', '201702', '2020-05-22 16:33:31', ''),
(1321, 'TMD 2 AeU', 'Bahasa Inggris untuk tata tulis ilmiah lanjut', 'Fitri', 'KAMIS', '11:05:00', '14:25:00', 'GSG201', '201702', '2020-05-22 16:33:31', ''),
(1322, 'TMD 2 AeU', 'Dischreete Mathematics', 'Agus', 'KAMIS', '14:25:00', '18:15:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1323, 'TMD 2 AeU', 'Web Design', 'Ade', 'JUMAT', '11:05:00', '15:15:00', 'AA305', '201702', '2020-05-22 16:33:31', ''),
(1324, 'TMD 2 MSU', 'Sistem Basis Data', 'Nia Safitri', 'SENIN', '07:30:00', '11:05:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1325, 'TMD 2 MSU', 'Struktur Data', 'Eriya', 'SENIN', '11:05:00', '15:15:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1326, 'TMD 2 MSU', 'Bahasa Inggris untuk TIK 2', 'Dewi K', 'SELASA', '07:30:00', '10:00:00', 'AA201', '201702', '2020-05-22 16:33:31', ''),
(1327, 'TMD 2 MSU', 'Bahasa Indonesia dalam TIK', 'Novita', 'SELASA', '10:15:00', '14:25:00', 'AA201', '201702', '2020-05-22 16:33:31', ''),
(1328, 'TMD 2 MSU', 'Kepemimpinan dan pengembangan karakter dalam TIK', 'Taufik', 'RABU', '07:30:00', '11:05:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1329, 'TMD 2 MSU', 'Desain Web', 'Ade', 'RABU', '11:05:00', '15:15:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1330, 'TMD 2 MSU', 'Multimedia Lanjut', 'Irma', 'KAMIS', '07:30:00', '13:35:00', 'AA201', '201702', '2020-05-22 16:33:31', ''),
(1331, 'TMD 2 MSU', 'Gambar Manual', 'Toni', 'KAMIS', '13:35:00', '17:25:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1332, 'TMD 2 MSU', 'Pengantar Jaringan Komputer', 'Aziz', 'JUMAT', '07:30:00', '13:35:00', 'GSGInt', '201702', '2020-05-22 16:33:31', ''),
(1333, 'TKJ 2A', 'Perbaikan dan Perawatan', 'Taufik H', 'SENIN', '07:30:00', '17:25:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1334, 'TKJ 2A', 'Protokol Perutean', 'Aziz', 'SELASA', '07:30:00', '13:35:00', 'LABGSG5', '201702', '2020-05-22 16:33:31', ''),
(1335, 'TKJ 2A', 'Teknologi LAN dan WAN', 'Abub', 'SELASA', '13:35:00', '19:35:00', 'AA205', '201702', '2020-05-22 16:33:31', ''),
(1336, 'TKJ 2A', 'Pemrograman Jaringan', 'Irawati', 'RABU', '11:05:00', '16:35:00', 'GSG204', '201702', '2020-05-22 16:33:31', ''),
(1337, 'TKJ 2A', 'Keamanan Komputer dan Jaringan', 'Fachroni', 'KAMIS', '07:30:00', '13:35:00', 'AA003', '201702', '2020-05-22 16:33:31', ''),
(1338, 'TKJ 2A', 'Keamanan dan Keselamatan Kerja', 'Refirman', 'JUMAT', '07:30:00', '11:05:00', 'AA001', '201702', '2020-05-22 16:33:31', ''),
(1339, 'TKJ 2B', 'Teknologi LAN dan WAN', 'Abub', 'SELASA', '07:30:00', '13:35:00', 'LAB-EBD', '201702', '2020-05-22 16:33:31', ''),
(1340, 'TKJ 2B', 'Pemrograman Jaringan', 'Irawati', 'SELASA', '13:35:00', '18:15:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1341, 'TKJ 2B', 'Keamanan Komputer dan Jaringan', 'Fachroni', 'RABU', '07:30:00', '13:35:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1342, 'TKJ 2B', 'Keamanan dan Keselamatan Kerja', 'Refirman', 'RABU', '15:45:00', '19:35:00', '', '201702', '2020-05-22 16:33:31', ''),
(1343, 'TKJ 2B', 'Protokol Perutean', 'Aziz', 'KAMIS', '07:30:00', '13:35:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', ''),
(1344, 'TKJ 2B', 'Perbaikan dan Perawatan', 'Nurfauzi', 'JUMAT', '07:30:00', '17:25:00', 'UPT-PP', '201702', '2020-05-22 16:33:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_khd` int(11) NOT NULL,
  `nama_khd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_pengganti`
--

CREATE TABLE `kelas_pengganti` (
  `id_pengganti` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `kelas_kode_kelas` varchar(120) NOT NULL,
  `matakuliah_kode_mtk` varchar(500) NOT NULL,
  `jam_mulai` varchar(100) NOT NULL,
  `jam_selesai` varchar(100) NOT NULL,
  `ruang_kelas` varchar(100) NOT NULL,
  `Tanggal_Pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Dibuat_Oleh` varchar(120) NOT NULL,
  `status` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_pengganti`
--

INSERT INTO `kelas_pengganti` (`id_pengganti`, `hari`, `tanggal`, `kelas_kode_kelas`, `matakuliah_kode_mtk`, `jam_mulai`, `jam_selesai`, `ruang_kelas`, `Tanggal_Pengajuan`, `Dibuat_Oleh`, `status`) VALUES
(22, 'Jumat', '2020-06-11', 'TI 4B CBD', 'Data Warehouse', '12:00:00', '15:00:00', 'LABGSG4', '2020-06-07 05:45:23', 'Reno Kalih Madani', 'Menunggu Konfirmasi'),
(23, 'Sabtu', '2020-06-14', 'TI 4A CBD', 'Data Warehouse', '11:00:00', '13:00:00', 'AA204', '2020-06-07 05:47:41', 'Reno Kalih Madani', 'Menunggu Konfirmasi'),
(24, 'Senin', '2020-06-08', 'TI 4B CBD', 'Data Warehouse', '11:00:00', '15:00:00', 'LABGSG1', '2020-06-07 06:12:56', 'Reno Kalih Madani', 'Setuju');

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id` int(11) NOT NULL,
  `kode_jadwal` int(11) NOT NULL,
  `waktu_mengajar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_selesai` datetime DEFAULT NULL,
  `qr` varchar(255) NOT NULL,
  `materi_text` text,
  `materi_file` text,
  `alfa` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`id`, `kode_jadwal`, `waktu_mengajar`, `waktu_selesai`, `qr`, `materi_text`, `materi_file`, `alfa`) VALUES
(62, 1122, '2020-07-11 21:16:25', '2020-07-11 21:16:27', 'mtk-1122-20200711-211625', 'bisa yuk', 'mtk-1122-20200711-211625.pdf', 0),
(63, 1121, '2020-07-11 11:05:00', NULL, '', NULL, NULL, 1),
(64, 1166, '2020-07-11 07:30:00', NULL, '', NULL, NULL, 1),
(65, 1167, '2020-07-11 13:35:00', NULL, '', NULL, NULL, 1),
(66, 1233, '2020-07-11 07:30:00', NULL, '', NULL, NULL, 1),
(67, 1261, '2020-07-11 07:30:00', NULL, '', NULL, NULL, 1),
(68, 1262, '2020-07-11 13:35:00', NULL, '', NULL, NULL, 1),
(69, 1264, '2020-07-11 07:30:00', NULL, '', NULL, NULL, 1),
(70, 1265, '2020-07-11 13:35:00', NULL, '', NULL, NULL, 1),
(71, 1313, '2020-07-11 07:30:00', NULL, '', NULL, NULL, 1),
(72, 1314, '2020-07-11 13:35:00', NULL, '', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `id_perkuliahan` int(11) NOT NULL,
  `kode_jadwal` int(11) NOT NULL,
  `NI` varchar(128) NOT NULL,
  `waktu_presensi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_selesai` datetime DEFAULT NULL,
  `telat_menit` int(11) NOT NULL DEFAULT '0',
  `nilai_alfa` int(11) NOT NULL DEFAULT '0',
  `status` enum('hadir','alfa','sakit','izin') NOT NULL DEFAULT 'alfa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `id_perkuliahan`, `kode_jadwal`, `NI`, `waktu_presensi`, `waktu_selesai`, `telat_menit`, `nilai_alfa`, `status`) VALUES
(30, 62, 1122, '1982456789', '2020-07-11 21:16:25', '2020-07-11 21:16:27', 0, 0, 'hadir'),
(31, 63, 1121, '198202018290', '2020-07-11 11:05:00', NULL, 0, 4, 'alfa'),
(32, 62, 1122, '4816040333', '2020-07-11 07:30:00', NULL, 0, 4, 'sakit'),
(33, 66, 1233, '1982456789', '2020-07-11 07:30:00', NULL, 0, 7, 'alfa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen_pengajar`
--

CREATE TABLE `tb_absen_pengajar` (
  `id_absen_pengajar` int(11) NOT NULL,
  `pegawai_nip` varchar(128) NOT NULL,
  `kode_jadwal` int(11) NOT NULL,
  `waktu_mengajar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ajukan_surat`
--

CREATE TABLE `tb_ajukan_surat` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `tangga_diajukan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_civitas`
--

CREATE TABLE `tb_civitas` (
  `NI` varchar(128) NOT NULL,
  `tempat_lahir_civitas` varchar(120) NOT NULL,
  `tanggal_lahir_civitas` varchar(120) NOT NULL,
  `jenis_kelamin_civitas` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `alamat_civitas` text NOT NULL,
  `kelurahan_civitas` varchar(120) NOT NULL,
  `kecamatan_civitas` varchar(120) NOT NULL,
  `kota_civitas` varchar(120) NOT NULL,
  `tlp_civitas` varchar(120) NOT NULL,
  `image` varchar(225) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_civitas`
--

INSERT INTO `tb_civitas` (`NI`, `tempat_lahir_civitas`, `tanggal_lahir_civitas`, `jenis_kelamin_civitas`, `agama`, `alamat_civitas`, `kelurahan_civitas`, `kecamatan_civitas`, `kota_civitas`, `tlp_civitas`, `image`, `date_created`) VALUES
('1982017291', 'Jakarta', '1050-09-22', 'Laki-Laki', 'Islam', 'Jakarta', 'Jakarta', 'Jakarta', 'Jakarta', '0812109229', '', '2020-06-18 04:42:49'),
('198202018290', 'Jakarta', '1970-08-13', 'Laki-Laki', 'Budha', 'Jakarta Selatan', 'Jakarta', 'Jakarta', 'Jakarta', '089818281911', '', '2020-06-18 04:41:45'),
('198245135', 'Jakarta', '1965-07-12', 'Laki-Laki', 'Islam', 'Depok', 'Depok', 'Depok', 'Depok', '082465838292', '', '2020-06-18 04:22:32'),
('19824527187', 'Jakarta', '1980-10-12', 'Laki-Laki', 'Katolik', 'Jakarta', 'Jakarta', 'Jakarta', 'Jakarta', '0827827829', '', '2020-06-18 04:43:34'),
('1982456789', 'Jakarta', '1998-10-17', 'Laki-Laki', 'Islam', 'Gang Mangga II oTista', 'Bidara Cina', 'Jatinegara', 'Jakarta Timur', '081210198922', '', '2020-06-07 05:22:39'),
('4816040333', 'Jakarta', '1998-06-16', 'Perempuan', 'Islam', 'Depok', 'Depok', 'Depok', 'Depok', '08571648222', '', '2020-06-18 04:39:39'),
('4816040334', 'Jakarta', '1998-06-16', 'Perempuan', 'Islam', 'Jatimulya', 'Kalimulya', 'Cilodong', 'Depok', '085716488967', '', '2020-06-18 02:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_group_akses`
--

CREATE TABLE `tb_group_akses` (
  `id` int(11) NOT NULL,
  `Nama_Group_Akses` varchar(255) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_group_akses`
--

INSERT INTO `tb_group_akses` (`id`, `Nama_Group_Akses`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'Super Admin', 2, '2019-12-18 07:19:37'),
(2, 'Admin', 2, '2019-12-18 07:19:37'),
(3, 'Kajur', 2, '2020-04-08 06:37:13'),
(4, 'Sekjur', 2, '2020-04-08 06:37:19'),
(5, 'KPSTI', 2, '2020-04-08 06:37:27'),
(6, 'KPSTMD', 2, '2020-04-08 06:37:33'),
(7, 'KPSTMJ', 2, '2020-04-08 06:37:43'),
(8, 'KPSTKJ', 2, '2020-04-07 17:00:00'),
(9, 'Dosen', 2, '2020-04-06 17:00:00'),
(10, 'Mahasiswa', 2, '2020-04-07 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hak_akses`
--

CREATE TABLE `tb_hak_akses` (
  `id` int(11) NOT NULL,
  `Nama_Hak_Akses` varchar(255) NOT NULL,
  `Controller_Name` varchar(255) NOT NULL,
  `group_akses_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hak_akses`
--

INSERT INTO `tb_hak_akses` (`id`, `Nama_Hak_Akses`, `Controller_Name`, `group_akses_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'create', 'Kurikulum', 1, 2, '2020-02-12 08:48:20'),
(2, 'create', 'SKS', 1, 2, '2019-12-18 07:19:38'),
(3, 'create', 'Kelas', 1, 2, '2019-12-18 07:19:38'),
(4, 'create', 'Group_Akses', 1, 2, '2019-12-18 07:19:38'),
(5, 'create', 'Dosen', 1, 2, '2019-12-18 07:19:38'),
(6, 'create', 'Krs', 1, 2, '2019-12-18 07:19:38'),
(7, 'create', 'Mahasiswa', 1, 2, '2019-12-18 07:19:38'),
(8, 'create', 'matakuliah', 1, 2, '2019-12-18 07:19:38'),
(9, 'create', 'Prodi', 1, 2, '2019-12-18 07:19:38'),
(10, 'create', 'Role', 1, 2, '2019-12-18 07:19:38'),
(11, 'create', 'Ruang_Kelas', 1, 2, '2019-12-18 07:19:38'),
(12, 'create', 'User', 1, 2, '2019-12-18 07:19:38'),
(13, 'create', 'Hak_Akses', 1, 2, '2019-12-18 07:19:38'),
(14, 'create', 'Jadwal_Kuliah', 5, 2, '2020-04-08 06:45:58'),
(15, 'create', 'Jurusan', 1, 2, '2019-12-18 07:19:38'),
(16, 'create', 'Absen', 1, 2, '2019-12-18 07:19:38'),
(17, 'create', 'Semester', 1, 2, '2019-12-18 07:19:38'),
(18, 'create', 'Perangkat_Pembelajaran', 1, 2, '2019-12-18 07:19:38'),
(19, 'create', 'Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(20, 'delete', 'Kurikulum', 1, 2, '2019-12-18 07:19:38'),
(21, 'delete', 'SKS', 1, 2, '2019-12-18 07:19:38'),
(22, 'delete', 'Kelas', 1, 2, '2019-12-18 07:19:38'),
(23, 'delete', 'Group_Akses', 1, 2, '2019-12-18 07:19:38'),
(24, 'delete', 'Dosen', 1, 2, '2019-12-18 07:19:38'),
(25, 'delete', 'Krs', 1, 2, '2019-12-18 07:19:38'),
(26, 'delete', 'Mahasiswa', 1, 2, '2019-12-18 07:19:38'),
(27, 'delete', 'matakuliah', 1, 2, '2019-12-18 07:19:38'),
(28, 'delete', 'Prodi', 1, 2, '2019-12-18 07:19:38'),
(29, 'delete', 'Role', 1, 2, '2019-12-18 07:19:38'),
(30, 'delete', 'Ruang_Kelas', 1, 2, '2019-12-18 07:19:38'),
(31, 'delete', 'User', 1, 2, '2019-12-18 07:19:38'),
(32, 'delete', 'Hak_Akses', 1, 2, '2019-12-18 07:19:38'),
(33, 'delete', 'Jadwal_Kuliah', 5, 2, '2020-04-08 06:46:02'),
(34, 'delete', 'Jurusan', 1, 2, '2019-12-18 07:19:38'),
(35, 'delete', 'Absen', 1, 2, '2019-12-18 07:19:38'),
(36, 'delete', 'Semester', 1, 2, '2019-12-18 07:19:38'),
(37, 'delete', 'Perangkat_Pembelajaran', 1, 2, '2019-12-18 07:19:38'),
(38, 'delete', 'Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(39, 'read', 'Kurikulum', 1, 2, '2019-12-18 07:19:38'),
(40, 'read', 'SKS', 1, 2, '2019-12-18 07:19:38'),
(41, 'read', 'Kelas', 1, 2, '2019-12-18 07:19:38'),
(42, 'read', 'Group_Akses', 1, 2, '2019-12-18 07:19:38'),
(43, 'read', 'Dosen', 1, 2, '2019-12-18 07:19:38'),
(44, 'read', 'Krs', 1, 2, '2019-12-18 07:19:38'),
(45, 'read', 'Mahasiswa', 1, 2, '2019-12-18 07:19:38'),
(46, 'read', 'matakuliah', 1, 2, '2019-12-18 07:19:38'),
(47, 'read', 'Prodi', 1, 2, '2019-12-18 07:19:38'),
(48, 'read', 'Role', 1, 2, '2019-12-18 07:19:38'),
(49, 'read', 'Ruang_Kelas', 1, 2, '2019-12-18 07:19:38'),
(50, 'read', 'User', 1, 2, '2019-12-18 07:19:38'),
(51, 'read', 'Hak_Akses', 1, 2, '2019-12-18 07:19:38'),
(52, 'read', 'Jadwal_Kuliah', 5, 2, '2020-04-08 06:46:06'),
(53, 'read', 'Jurusan', 1, 2, '2019-12-18 07:19:38'),
(54, 'read', 'Absen', 1, 2, '2019-12-18 07:19:38'),
(55, 'read', 'Semester', 1, 2, '2019-12-18 07:19:38'),
(56, 'read', 'Perangkat_Pembelajaran', 1, 2, '2019-12-18 07:19:38'),
(57, 'read', 'Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(58, 'update', 'Kurikulum', 1, 2, '2019-12-18 07:19:38'),
(59, 'update', 'SKS', 1, 2, '2019-12-18 07:19:38'),
(60, 'update', 'Kelas', 1, 2, '2019-12-18 07:19:38'),
(61, 'update', 'Group_Akses', 1, 2, '2019-12-18 07:19:38'),
(62, 'update', 'Dosen', 1, 2, '2019-12-18 07:19:38'),
(63, 'update', 'Krs', 1, 2, '2019-12-18 07:19:38'),
(64, 'update', 'Mahasiswa', 1, 2, '2019-12-18 07:19:38'),
(65, 'update', 'matakuliah', 1, 2, '2019-12-18 07:19:38'),
(66, 'update', 'Prodi', 1, 2, '2019-12-18 07:19:38'),
(67, 'update', 'Role', 1, 2, '2019-12-18 07:19:38'),
(68, 'update', 'Ruang_Kelas', 1, 2, '2019-12-18 07:19:38'),
(69, 'update', 'User', 1, 2, '2019-12-18 07:19:38'),
(70, 'update', 'Hak_Akses', 1, 2, '2019-12-18 07:19:38'),
(71, 'update', 'Jadwal_Kuliah', 5, 2, '2020-04-08 06:46:10'),
(72, 'update', 'Jurusan', 1, 2, '2019-12-18 07:19:38'),
(73, 'update', 'Absen', 1, 2, '2019-12-18 07:19:38'),
(74, 'update', 'Semester', 1, 2, '2019-12-18 07:19:38'),
(75, 'update', 'Perangkat_Pembelajaran', 1, 2, '2019-12-18 07:19:38'),
(76, 'update', 'Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(77, 'delete', 'Blocked_RFID', 1, 2, '2019-12-18 07:19:38'),
(78, 'update', 'Blocked_RFID', 1, 2, '2019-12-18 07:19:38'),
(79, 'read', 'Blocked_RFID', 1, 2, '2019-12-18 07:19:38'),
(80, 'create', 'Blocked_RFID', 1, 2, '2019-12-18 07:19:38'),
(81, 'delete', 'CP', 1, 2, '2019-12-18 07:19:38'),
(82, 'update', 'CP', 1, 2, '2019-12-18 07:19:38'),
(83, 'read', 'CP', 1, 2, '2019-12-18 07:19:38'),
(84, 'create', 'CP', 1, 2, '2019-12-18 07:19:38'),
(85, 'delete', 'Kontrak_Kuliah', 1, 2, '2019-12-18 07:19:38'),
(86, 'update', 'Kontrak_Kuliah', 1, 2, '2019-12-18 07:19:38'),
(87, 'read', 'Kontrak_Kuliah', 1, 2, '2019-12-18 07:19:38'),
(88, 'create', 'Kontrak_Kuliah', 1, 2, '2019-12-18 07:19:38'),
(89, 'delete', 'Kontrak_Kuliah_Detail', 1, 2, '2019-12-18 07:19:38'),
(90, 'update', 'Kontrak_Kuliah_Detail', 1, 2, '2019-12-18 07:19:38'),
(91, 'read', 'Kontrak_Kuliah_Detail', 1, 2, '2019-12-18 07:19:38'),
(92, 'create', 'Kontrak_Kuliah_Detail', 1, 2, '2019-12-18 07:19:38'),
(93, 'delete', 'Kriteria_Penilaian', 1, 2, '2019-12-18 07:19:38'),
(94, 'update', 'Kriteria_Penilaian', 1, 2, '2019-12-18 07:19:38'),
(95, 'read', 'Kriteria_Penilaian', 1, 2, '2019-12-18 07:19:38'),
(96, 'create', 'Kriteria_Penilaian', 1, 2, '2019-12-18 07:19:38'),
(97, 'delete', 'Rps_Detail', 1, 2, '2019-12-18 07:19:38'),
(98, 'update', 'Rps_Detail', 1, 2, '2019-12-18 07:19:38'),
(99, 'read', 'Rps_Detail', 1, 2, '2019-12-18 07:19:38'),
(100, 'create', 'Rps_Detail', 1, 2, '2019-12-18 07:19:38'),
(101, 'delete', 'Rps', 1, 2, '2019-12-18 07:19:38'),
(102, 'update', 'Rps', 1, 2, '2019-12-18 07:19:38'),
(103, 'read', 'Rps', 1, 2, '2019-12-18 07:19:38'),
(104, 'create', 'Rps', 1, 2, '2019-12-18 07:19:38'),
(105, 'delete', 'Sap_Detail', 1, 2, '2019-12-18 07:19:38'),
(106, 'update', 'Sap_Detail', 1, 2, '2019-12-18 07:19:38'),
(107, 'read', 'Sap_Detail', 1, 2, '2019-12-18 07:19:38'),
(108, 'create', 'Sap_Detail', 1, 2, '2019-12-18 07:19:38'),
(109, 'delete', 'Sap', 1, 2, '2019-12-18 07:19:38'),
(110, 'update', 'Sap', 1, 2, '2019-12-18 07:19:38'),
(111, 'read', 'Sap', 1, 2, '2019-12-18 07:19:38'),
(112, 'create', 'Sap', 1, 2, '2019-12-18 07:19:38'),
(113, 'delete', 'Kelas_Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(114, 'update', 'Kelas_Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(115, 'read', 'Kelas_Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(116, 'create', 'Kelas_Tahun_Akademik', 1, 2, '2019-12-18 07:19:38'),
(117, 'delete', 'Jadwal_Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(118, 'update', 'Jadwal_Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(119, 'read', 'Jadwal_Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(120, 'create', 'Jadwal_Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(121, 'delete', 'Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(122, 'update', 'Slot_Waktu', 1, 2, '2019-12-18 07:19:38'),
(123, 'create', 'SKS', 3, 2, '2019-12-18 07:19:38'),
(124, 'create', 'SKS', 5, 2, '2019-12-18 07:19:38'),
(150, 'read', 'Dosen_Submit', 1, 1, '2019-08-22 06:28:46'),
(151, 'create', 'Dosen_Submit', 1, 1, '2019-08-22 06:28:45'),
(152, 'delete', 'Dosen_Submit', 1, 1, '2019-08-22 06:29:55'),
(153, 'update', 'Dosen_Submit', 1, 1, '2019-08-22 06:29:48'),
(154, 'delete', 'Absen_Detail', 1, 1, '2019-09-30 05:09:34'),
(155, 'update', 'Absen_Detail', 1, 1, '2019-09-30 05:09:33'),
(156, 'read', 'Absen_Detail', 1, 1, '2019-09-30 05:09:32'),
(157, 'create', 'Absen_Detail', 1, 1, '2019-09-30 05:09:30'),
(159, 'create', 'Jadwal_Kuliah', 6, 2, '2020-04-08 06:46:25'),
(160, 'update', 'Jadwal_Kuliah', 6, 2, '2020-04-08 06:44:45'),
(161, 'delete', 'Jadwal_Kuliah', 6, 2, '2020-04-08 06:44:45'),
(162, 'read', 'Jadwal_Kuliah', 6, 2, '2020-04-08 06:44:45'),
(163, 'create', 'Jadwal_Kuliah', 7, 2, '2020-04-08 06:44:45'),
(164, 'update', 'Jadwal_Kuliah', 7, 2, '2020-04-08 06:44:45'),
(165, 'delete', 'Jadwal_Kuliah', 7, 2, '2020-04-08 06:44:45'),
(166, 'read', 'Jadwal_Kuliah', 7, 2, '2020-04-08 06:44:45'),
(167, 'create', 'Jadwal_Kuliah', 8, 2, '2020-04-08 06:44:45'),
(168, 'update', 'Jadwal_Kuliah', 8, 2, '2020-04-08 06:44:45'),
(169, 'delete', 'Jadwal_Kuliah', 8, 2, '2020-04-08 06:44:45'),
(170, 'read', 'Jadwal_Kuliah', 8, 2, '2020-04-08 06:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `Nama_Kelas` varchar(255) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `Nama_Kelas`, `prodi_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'TI 2A', 1, 7, '2019-12-18 07:06:50'),
(2, 'TI 4A', 1, 7, '2019-12-18 07:06:50'),
(3, 'TI 4B', 1, 7, '2019-12-18 07:06:50'),
(4, 'TI 6A', 1, 7, '2019-12-18 07:06:50'),
(5, 'TI 6B', 1, 7, '2019-12-18 07:06:50'),
(6, 'TI 8A', 1, 7, '2019-12-18 07:06:50'),
(7, 'TI 4A MSU', 2, 7, '2019-12-18 07:06:50'),
(8, 'TI 4B MSU', 2, 7, '2019-12-18 07:06:50'),
(9, 'TI 4A CBD', 2, 7, '2019-12-18 07:06:50'),
(10, 'TI 4B CBD', 2, 7, '2019-12-18 07:06:50'),
(11, 'CCIT 2A', 2, 7, '2019-12-18 07:06:50'),
(12, 'CCIT 4A', 2, 7, '2019-12-18 07:06:50'),
(13, 'CCIT 4B', 2, 7, '2019-12-18 07:06:50'),
(14, 'CCIT 6A', 2, 7, '2019-12-18 07:06:50'),
(15, 'CCIT 6B', 2, 7, '2019-12-18 07:06:50'),
(16, 'CCIT 8', 2, 7, '2019-12-18 07:06:50'),
(17, 'PBI 2', 1, 7, '2019-12-18 07:06:50'),
(18, 'PBI 4', 1, 7, '2019-12-18 07:06:50'),
(19, 'PBI 6', 1, 7, '2019-12-18 07:06:50'),
(20, 'PBI 8', 1, 7, '2019-12-18 07:06:50'),
(21, 'TI 4E STTJ', 2, 7, '2019-12-18 07:06:50'),
(22, 'TMJ 2', 3, 7, '2019-12-18 07:06:50'),
(23, 'TMJ 4', 3, 7, '2019-12-18 07:06:50'),
(24, 'TMJ 6', 3, 7, '2019-12-18 07:06:50'),
(25, 'TMJ 8', 3, 7, '2019-12-18 07:06:50'),
(26, 'TMJ 8 LR', 4, 7, '2019-12-18 07:06:50'),
(27, 'CCIT SEC 2A', 4, 7, '2019-12-18 07:06:50'),
(28, 'CCIT SEC 4A', 4, 7, '2019-12-18 07:06:50'),
(29, 'CCIT SEC 4B', 4, 7, '2019-12-18 07:06:50'),
(30, 'CCIT SEC 6', 4, 7, '2019-12-18 07:06:50'),
(31, 'CCIT SEC 8', 4, 7, '2019-12-18 07:06:50'),
(32, 'TMD 2', 5, 7, '2019-12-18 07:06:50'),
(33, 'TMD 4', 5, 7, '2019-12-18 07:06:50'),
(34, 'TMD 6', 5, 7, '2019-12-18 07:06:50'),
(35, 'TMD 8', 5, 7, '2019-12-18 07:06:50'),
(36, 'TMD 2 AeU', 6, 7, '2019-12-18 07:06:50'),
(37, 'TMD 2 MSU', 6, 7, '2019-12-18 07:06:50'),
(38, 'TKJ 2A', 7, 7, '2019-12-18 07:06:50'),
(39, 'TKJ 2B', 7, 7, '2019-12-18 07:06:50'),
(40, 'TI 2 STTJ', 2, 7, '2019-12-18 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurikulum`
--

CREATE TABLE `tb_kurikulum` (
  `id` int(11) NOT NULL,
  `Nama_Kurikulum` varchar(255) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kurikulum`
--

INSERT INTO `tb_kurikulum` (`id`, `Nama_Kurikulum`, `prodi_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, '2006', 1, 7, '2019-12-18 07:06:50'),
(2, '2006', 2, 7, '2019-12-18 07:06:50'),
(3, '2006', 3, 7, '2019-12-18 07:06:50'),
(4, '2006', 4, 7, '2019-12-18 07:06:50'),
(5, '2006', 5, 7, '2019-12-18 07:06:50'),
(6, '2006', 6, 7, '2019-12-18 07:06:50'),
(7, '2013', 1, 7, '2019-12-18 07:06:50'),
(8, '2013', 2, 7, '2019-12-18 07:06:50'),
(9, '2013', 3, 7, '2019-12-18 07:06:50'),
(10, '2013', 4, 7, '2019-12-18 07:06:50'),
(11, '2013', 5, 7, '2019-12-18 07:06:50'),
(12, '2013', 6, 7, '2019-12-18 07:06:50'),
(13, '2015', 1, 7, '2019-12-18 07:06:50'),
(14, '2015', 2, 7, '2019-12-18 07:06:50'),
(15, '2015', 3, 7, '2019-12-18 07:06:50'),
(16, '2015', 4, 7, '2019-12-18 07:06:50'),
(17, '2015', 5, 7, '2019-12-18 07:06:50'),
(18, '2015', 6, 7, '2019-12-18 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `NI` varchar(128) NOT NULL,
  `tempat_lahir_mahasiswa` varchar(120) NOT NULL,
  `tanggal_lahir_mahasiswa` varchar(120) NOT NULL,
  `alamat_mahasiswa` text NOT NULL,
  `kelurahan_mahasiswa` varchar(128) NOT NULL,
  `kecamatan_mahasiswa` varchar(128) NOT NULL,
  `kota_mahasiswa` varchar(120) NOT NULL,
  `jenis_kelamin_mahasiswa` varchar(120) NOT NULL,
  `nama_ayah_mahasiswa` varchar(120) NOT NULL,
  `alamat_ayah_mahasiswa` text NOT NULL,
  `kelurahan_ayah_mahasiswa` varchar(128) NOT NULL,
  `kecamatan_ayah_mahasiswa` varchar(128) NOT NULL,
  `kota_ayah_mahasiswa` varchar(128) NOT NULL,
  `nama_ibu_mahasiswa` varchar(128) NOT NULL,
  `alamat_ibu_mahasiswa` text NOT NULL,
  `kelurahan_ibu_mahasiswa` varchar(128) NOT NULL,
  `kecamatan_ibu_mahasiswa` varchar(128) NOT NULL,
  `kota_ibu_mahasiswa` varchar(128) NOT NULL,
  `tlp_mahasiswa` varchar(128) NOT NULL,
  `tlp_ayah` varchar(128) NOT NULL,
  `tlp_ibu` varchar(128) NOT NULL,
  `profesi_ayah` varchar(128) NOT NULL,
  `profesi_ibu` varchar(128) NOT NULL,
  `penghasilan_ayah` varchar(128) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `tahun_akademik` text NOT NULL,
  `agama_mahasiswa` varchar(120) NOT NULL,
  `agama_ayah` varchar(120) NOT NULL,
  `agama_ibu` varchar(120) NOT NULL,
  `image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`NI`, `tempat_lahir_mahasiswa`, `tanggal_lahir_mahasiswa`, `alamat_mahasiswa`, `kelurahan_mahasiswa`, `kecamatan_mahasiswa`, `kota_mahasiswa`, `jenis_kelamin_mahasiswa`, `nama_ayah_mahasiswa`, `alamat_ayah_mahasiswa`, `kelurahan_ayah_mahasiswa`, `kecamatan_ayah_mahasiswa`, `kota_ayah_mahasiswa`, `nama_ibu_mahasiswa`, `alamat_ibu_mahasiswa`, `kelurahan_ibu_mahasiswa`, `kecamatan_ibu_mahasiswa`, `kota_ibu_mahasiswa`, `tlp_mahasiswa`, `tlp_ayah`, `tlp_ibu`, `profesi_ayah`, `profesi_ibu`, `penghasilan_ayah`, `id_kelas`, `id_prodi`, `tahun_akademik`, `agama_mahasiswa`, `agama_ayah`, `agama_ibu`, `image`) VALUES
('4816040333', 'Jakarta', '1998-09-09', 'Jalan Otista II', 'Bidaracina', 'Jatinegara', 'Jakarta Timur', 'Laki-Laki', 'Sarindi', 'Jalan Otista II', 'Bidaracina', 'Jatinegara', 'Jakarta Timur', 'Ibu', 'Jalan Otista II', 'Bidaracina', 'Jatinegara', 'Jakarta Timur', '08121918918', '08930930390', '08776767678', 'Pegawai Negeri Sipil', 'Ibu Rumah Tangga', '3000000', 1, 1, '2016', 'Islam', 'Islam', 'Islam', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matakuliah`
--

CREATE TABLE `tb_matakuliah` (
  `id` int(11) NOT NULL,
  `Kode_MK` varchar(255) NOT NULL,
  `Nama_Matakuliah` varchar(255) NOT NULL,
  `SKS` int(11) NOT NULL,
  `Total_Jam_Perminggu` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`id`, `Kode_MK`, `Nama_Matakuliah`, `SKS`, `Total_Jam_Perminggu`, `semester_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'TIK1401', 'Matematika Diskrit', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(2, 'TIK1403', 'Pendidikan Agama dalam TIK', 0, 2, 57, 7, '2019-12-18 07:06:50'),
(3, 'PNJ1400', 'Pendidikan Kewarganegaraan', 0, 2, 57, 7, '2019-12-18 07:06:50'),
(4, 'TIK1406', 'Pengantar Multimedia ', 0, 6, 57, 7, '2019-12-18 07:06:50'),
(5, 'DIT1101', 'IT Fundamental and Office Productivity Tools ', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(6, 'DIT1102', 'Introduction  to Relational Data Base Design  ', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(7, 'DIT1201', 'Introduction to Programming Logic & Techniques', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(8, 'DIT1202', 'Implementing a Database Design on MS SQL Server 2005', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(9, 'DIT1203', 'SQL Server Administration', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(10, 'DIT1204', 'Effective Communication (ISAS)', 0, 4, 57, 7, '2019-12-18 07:06:50'),
(11, 'DIT1205', 'Information Technology Fundamental Project', 0, 0, 57, 7, '2019-12-18 07:06:50'),
(12, 'TIF2401', 'Aljabar Linier', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(13, 'TIK2401', 'Bahasa Indonesia untuk Teknik Informatika', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(14, 'TIF2404', 'Jaringan Komputer dan Komunikasi', 0, 6, 58, 7, '2019-12-18 07:06:50'),
(15, 'DIT2301', 'OOPS using C #', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(16, 'DIT2302', 'Data Structure & Algorithm', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(17, 'DIT2201', 'Developing Windows Application Using .Net Framework 2.0', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(18, 'DIT2101', 'E-Business', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(19, 'DIT2303', 'Introduction to  Java Programming Language', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(20, 'DIT2304', 'Introduction to Linux', 0, 4, 58, 7, '2019-12-18 07:06:50'),
(21, 'DIT2202', 'Basic Application Programmer Project', 0, 0, 58, 7, '2019-12-18 07:06:50'),
(22, 'TIF3401', 'Metode Numerik', 0, 4, 59, 7, '2019-12-18 07:06:50'),
(23, 'TIK3401', 'Bahasa Inggris untuk TIK 3', 0, 3, 59, 7, '2019-12-18 07:06:50'),
(24, 'TIF3404', 'Kepemimpinan Dan Pengembangan Karakter dalam TIK ', 0, 3, 59, 7, '2019-12-18 07:06:50'),
(25, 'DIT2301', 'Developing Web Application Using ASP.NET 2.0', 0, 5, 59, 7, '2019-12-18 07:06:50'),
(26, 'DIT2302', 'Developing Database Application Using  ADO.Net &JDBC', 0, 5, 59, 7, '2019-12-18 07:06:50'),
(27, 'DIT2201', 'Introduction to Web Conten Development', 0, 5, 59, 7, '2019-12-18 07:06:50'),
(28, 'DIT2101', 'Introduction to XML', 0, 5, 59, 7, '2019-12-18 07:06:50'),
(29, 'DIT2303', 'Object Oriented Analysis & Design Using UML', 0, 4, 59, 7, '2019-12-18 07:06:50'),
(30, 'DIT2304', 'Information System Architecture and Technology', 0, 4, 59, 7, '2019-12-18 07:06:50'),
(31, 'DIT2202', 'Advanced Application Programmer Project', 0, 0, 59, 7, '2019-12-18 07:06:50'),
(32, 'TIF4401', 'Grafika Komputer', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(33, 'TIK4401', 'Bahasa Inggris Komunikasi 1 ', 0, 3, 60, 7, '2019-12-18 07:06:50'),
(34, 'TIF4407', 'Data Warehouse ', 0, 5, 60, 7, '2019-12-18 07:06:50'),
(35, 'DIT4101', 'Understanding Software Quality Assurance and Testing', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(36, 'DIT4301', 'Introduction to Enterprise Java Bean ', 0, 3, 60, 7, '2019-12-18 07:06:50'),
(37, 'DIT4302', 'Developing Distributed Application Using .Net Framework', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(38, 'DIT4303', 'Developing Application for the J2EE Platform', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(39, 'DIT4304', 'Web Component Development with Servlet and JSP Technolgies ', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(40, 'DIT4305', 'Security Concept ', 0, 3, 60, 7, '2019-12-18 07:06:50'),
(41, 'DIT4201', 'Enterprise Application Development Project ', 0, 4, 60, 7, '2019-12-18 07:06:50'),
(42, 'TIF4405', 'Kewirausahaan dalam bidang teknologi', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(43, 'TIF4406', 'Perancangan Antarmuka', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(44, 'TIK4402', 'Metodologi Penelitian 1', 0, 3, 61, 7, '2019-12-18 07:06:50'),
(45, 'TIF4404', 'Kecerdasan Buatan', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(46, 'TIF5401', 'Probabilitas dan Statistik', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(47, 'TIF5402', 'Pembelajaran Mesin', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(48, 'TIF5404', 'Perencanaan Strategis Sistem Informasi ', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(49, 'TIK5401', 'Bahasa Inggris Komunikasi 2', 0, 3, 61, 7, '2019-12-18 07:06:50'),
(50, 'TIF5406', 'Penjaminan Kualitas Perangkat Lunak (SQA)', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(51, 'TIF5408', 'Sistem pendukung keputusan ', 0, 4, 61, 7, '2019-12-18 07:06:50'),
(52, 'TIF6401', 'Pemrograman Web 3', 0, 6, 62, 7, '2019-12-18 07:06:50'),
(53, 'TIF6402', 'Perencanaan Sumber Daya Perusahaan ', 0, 3, 62, 7, '2019-12-18 07:06:50'),
(54, 'TIF6403', 'Hukum dan Etika  Dalam Teknologi Informasi dan Komunikasi', 0, 3, 62, 7, '2019-12-18 07:06:50'),
(55, 'TIF6404', 'Manajemen Proyek TIK', 0, 4, 62, 7, '2019-12-18 07:06:50'),
(56, 'TIF6405', 'Proyek sesuai kekhususan bidang Teknik Informatika', 0, 4, 62, 7, '2019-12-18 07:06:50'),
(57, 'TIF6406', 'Data Mining', 0, 4, 62, 7, '2019-12-18 07:06:50'),
(58, 'TIF6407', 'Sistem Terdistribusi', 0, 4, 62, 7, '2019-12-18 07:06:50'),
(59, 'TIF6408', 'Pemrograman Bergerak', 0, 6, 62, 7, '2019-12-18 07:06:50'),
(60, 'TIF6409', 'Pengolahan Citra Digital', 0, 4, 62, 7, '2019-12-18 07:06:50'),
(61, 'TIK7401', 'Kapita Selekta I ', 0, 6, 63, 7, '2019-12-18 07:06:50'),
(62, 'TIK7402', 'Praktek Kerja Lapangan', 0, 18, 63, 7, '2019-12-18 07:06:50'),
(63, 'TIK7405', 'Seminar ', 0, 6, 63, 7, '2019-12-18 07:06:50'),
(64, 'TIK8401', 'Kapita Selekta 2 ', 0, 6, 64, 7, '2019-12-18 07:06:50'),
(65, 'TIK8402', 'Tugas Akhir', 0, 18, 64, 7, '2019-12-18 07:06:50'),
(66, 'TIK8403', 'Metodologi Penelitian 2', 0, 4, 64, 7, '2019-12-18 07:06:50'),
(67, 'TIK8404', 'Bahasa Inggris Komunikasi 3', 0, 4, 64, 7, '2019-12-18 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id` int(11) NOT NULL,
  `Nama_Prodi` varchar(255) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id`, `Nama_Prodi`, `jurusan_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'Teknik Informasi (TI) Reguler', 1, 7, '2019-12-18 07:06:50'),
(2, 'Teknik Informasi (TI) Program Kerjasama', 1, 7, '2019-12-18 07:06:50'),
(3, 'Teknik Media & Jaringan (TMJ) Reguler', 1, 7, '2019-12-18 07:06:50'),
(4, 'Teknik Media & Jaringan (TMJ) Program Kerjasama', 1, 7, '2019-12-18 07:06:50'),
(5, 'Teknik Multimedia Digital (TMD) Reguler', 1, 7, '2019-12-18 07:06:50'),
(6, 'Teknik Multimedia Digital (TMD) Program Kerjasama', 1, 7, '2019-12-18 07:06:50'),
(7, 'Teknik Komputer & Jaringan Reguler', 1, 7, '2019-12-18 07:06:50'),
(8, 'Teknik Komputer & Jaringan Program Kerjasama', 1, 7, '2019-12-18 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL,
  `Nama_Role` varchar(255) NOT NULL,
  `group_akses_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `Nama_Role`, `group_akses_id`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'Super Admin', 1, 2, '2019-12-18 07:19:37'),
(2, 'Admin', 2, 2, '2019-12-18 07:19:37'),
(3, 'Kajur', 3, 2, '2020-04-01 09:52:25'),
(4, 'Sekjur', 4, 2, '2020-04-02 09:19:51'),
(5, 'KPSTI', 5, 2, '2020-04-02 09:19:55'),
(6, 'KPSTMD', 6, 2, '2020-04-02 09:19:58'),
(7, 'KPSTMJ', 7, 2, '2020-04-02 09:20:02'),
(8, 'KPSTKJ', 8, 2, '2020-04-02 09:20:05'),
(9, 'Dosen', 9, 2, '2020-04-02 09:20:09'),
(10, 'Mahasiswa', 10, 2, '2020-04-02 09:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruang_kelas`
--

CREATE TABLE `tb_ruang_kelas` (
  `id` int(11) NOT NULL,
  `Nama_Ruang_Kelas` varchar(255) NOT NULL,
  `Kapasitas` varchar(255) NOT NULL,
  `Lantai_Kelas` varchar(255) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `Tanggal_Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ruang_kelas`
--

INSERT INTO `tb_ruang_kelas` (`id`, `Nama_Ruang_Kelas`, `Kapasitas`, `Lantai_Kelas`, `dibuat_oleh_user_id`, `Tanggal_Dibuat`) VALUES
(1, 'AA001', '25', '1', 2, '2019-12-18 07:18:27'),
(2, 'AA003', '25', '1', 2, '2019-12-18 07:18:27'),
(3, 'AA202', '20', '1', 2, '2019-12-18 07:18:27'),
(4, 'AA204', '32', '2', 2, '2019-12-18 07:18:27'),
(5, 'AA205', '25', '1', 2, '2019-12-18 07:18:27'),
(6, 'AA301', '32', '1', 2, '2019-12-18 07:18:27'),
(7, 'AA302', '30', '1', 2, '2019-12-18 07:18:27'),
(8, 'AA303', '30', '1', 2, '2019-12-18 07:18:27'),
(9, 'AA304', '30', '1', 2, '2019-12-18 07:18:27'),
(10, 'AA305', '32', '2', 2, '2019-12-18 07:18:27'),
(11, 'LABGSG1', '30', '2', 2, '2019-12-18 07:18:27'),
(12, 'LABGSG2', '30', '2', 2, '2019-12-18 07:18:27'),
(13, 'LABGSG3', '30', '2', 2, '2019-12-18 07:18:27'),
(14, 'LABGSG4', '30', '2', 2, '2019-12-18 07:18:27'),
(15, 'LABGSG5', '25', '2', 2, '2019-12-18 07:18:27'),
(16, 'GSG201', '25', '2', 2, '2019-12-18 07:18:27'),
(17, 'GSG202', '30', '2', 2, '2019-12-18 07:18:27'),
(18, 'GSG203', '30', '2', 2, '2019-12-18 07:18:27'),
(19, 'GSG204', '25', '2', 2, '2019-12-18 07:18:27'),
(20, 'LAB-EBD', '20', '2', 2, '2019-12-18 07:18:27'),
(21, 'UPT-PP', '30', '2', 2, '2019-12-18 07:18:27'),
(22, 'TCR1', '25', '2', 2, '2019-12-18 07:18:27'),
(23, 'TCR2', '25', '2', 2, '2019-12-18 07:18:27'),
(24, 'TCR3', '25', '2', 2, '2019-12-18 07:18:27'),
(25, 'TCR4', '25', '2', 2, '2019-12-18 07:18:27'),
(26, 'AA001', '25', '1', 2, '2019-12-18 07:19:37'),
(27, 'AA003', '25', '1', 2, '2019-12-18 07:19:37'),
(28, 'AA202', '20', '1', 2, '2019-12-18 07:19:37'),
(29, 'AA204', '32', '2', 2, '2019-12-18 07:19:37'),
(30, 'AA205', '25', '1', 2, '2019-12-18 07:19:37'),
(31, 'AA301', '32', '1', 2, '2019-12-18 07:19:37'),
(32, 'AA302', '30', '1', 2, '2019-12-18 07:19:37'),
(33, 'AA303', '30', '1', 2, '2019-12-18 07:19:37'),
(34, 'AA304', '30', '1', 2, '2019-12-18 07:19:37'),
(35, 'AA305', '32', '2', 2, '2019-12-18 07:19:37'),
(36, 'LABGSG1', '30', '2', 2, '2019-12-18 07:19:37'),
(37, 'LABGSG2', '30', '2', 2, '2019-12-18 07:19:37'),
(38, 'LABGSG3', '30', '2', 2, '2019-12-18 07:19:37'),
(39, 'LABGSG4', '30', '2', 2, '2019-12-18 07:19:37'),
(40, 'LABGSG5', '25', '2', 2, '2019-12-18 07:19:37'),
(41, 'GSG201', '25', '2', 2, '2019-12-18 07:19:37'),
(42, 'GSG202', '30', '2', 2, '2019-12-18 07:19:37'),
(43, 'GSG203', '30', '2', 2, '2019-12-18 07:19:37'),
(44, 'GSG204', '25', '2', 2, '2019-12-18 07:19:37'),
(45, 'LAB-EBD', '20', '2', 2, '2019-12-18 07:19:37'),
(46, 'UPT-PP', '30', '2', 2, '2019-12-18 07:19:37'),
(47, 'TCR1', '25', '2', 2, '2019-12-18 07:19:37'),
(48, 'TCR2', '25', '2', 2, '2019-12-18 07:19:37'),
(49, 'TCR3', '25', '2', 2, '2019-12-18 07:19:37'),
(50, 'TCR4', '25', '2', 2, '2019-12-18 07:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id` int(11) NOT NULL,
  `Nama_Semester` varchar(255) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `kurikulum_id` int(11) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id`, `Nama_Semester`, `kelas_id`, `kurikulum_id`, `dibuat_oleh_user_id`, `tanggal_dibuat`) VALUES
(1, 'Semester 1 (Ganjil)', 0, 1, 7, '2019-12-18 07:06:50'),
(2, 'Semester 2 (Genap)', 0, 1, 7, '2019-12-18 07:06:50'),
(3, 'Semester 3 (Ganjil)', 0, 1, 7, '2019-12-18 07:06:50'),
(4, 'Semester 4 (Genap)', 0, 1, 7, '2019-12-18 07:06:50'),
(5, 'Semester 5 (Ganjil)', 0, 1, 7, '2019-12-18 07:06:50'),
(6, 'Semester 6 (Genap)', 0, 1, 7, '2019-12-18 07:06:50'),
(7, 'Semester 7 (Ganjil)', 0, 1, 7, '2019-12-18 07:06:50'),
(8, 'Semester 8 (Genap)', 0, 1, 7, '2019-12-18 07:06:50'),
(9, 'Semester 1 (Ganjil)', 0, 2, 7, '2019-12-18 07:06:50'),
(10, 'Semester 2 (Genap)', 0, 2, 7, '2019-12-18 07:06:50'),
(11, 'Semester 3 (Ganjil)', 0, 2, 7, '2019-12-18 07:06:50'),
(12, 'Semester 4 (Genap)', 0, 2, 7, '2019-12-18 07:06:50'),
(13, 'Semester 5 (Ganjil)', 0, 2, 7, '2019-12-18 07:06:50'),
(14, 'Semester 6 (Genap)', 0, 2, 7, '2019-12-18 07:06:50'),
(15, 'Semester 7 (Ganjil)', 0, 2, 7, '2019-12-18 07:06:50'),
(16, 'Semester 8 (Genap)', 0, 2, 7, '2019-12-18 07:06:50'),
(17, 'Semester 1 (Ganjil)', 0, 3, 7, '2019-12-18 07:06:50'),
(18, 'Semester 2 (Genap)', 0, 3, 7, '2019-12-18 07:06:50'),
(19, 'Semester 3 (Ganjil)', 0, 3, 7, '2019-12-18 07:06:50'),
(20, 'Semester 4 (Genap)', 0, 3, 7, '2019-12-18 07:06:50'),
(21, 'Semester 5 (Ganjil)', 0, 3, 7, '2019-12-18 07:06:50'),
(22, 'Semester 6 (Genap)', 0, 3, 7, '2019-12-18 07:06:50'),
(23, 'Semester 7 (Ganjil)', 0, 3, 7, '2019-12-18 07:06:50'),
(24, 'Semester 8 (Genap)', 0, 3, 7, '2019-12-18 07:06:50'),
(25, 'Semester 1 (Ganjil)', 0, 4, 7, '2019-12-18 07:06:50'),
(26, 'Semester 2 (Genap)', 0, 4, 7, '2019-12-18 07:06:50'),
(27, 'Semester 3 (Ganjil)', 0, 4, 7, '2019-12-18 07:06:50'),
(28, 'Semester 4 (Genap)', 0, 4, 7, '2019-12-18 07:06:50'),
(29, 'Semester 5 (Ganjil)', 0, 4, 7, '2019-12-18 07:06:50'),
(30, 'Semester 6 (Genap)', 0, 4, 7, '2019-12-18 07:06:50'),
(31, 'Semester 7 (Ganjil)', 0, 4, 7, '2019-12-18 07:06:50'),
(32, 'Semester 8 (Genap)', 0, 4, 7, '2019-12-18 07:06:50'),
(33, 'Semester 1 (Ganjil)', 0, 5, 7, '2019-12-18 07:06:50'),
(34, 'Semester 2 (Genap)', 0, 5, 7, '2019-12-18 07:06:50'),
(35, 'Semester 3 (Ganjil)', 0, 5, 7, '2019-12-18 07:06:50'),
(36, 'Semester 4 (Genap)', 0, 5, 7, '2019-12-18 07:06:50'),
(37, 'Semester 5 (Ganjil)', 0, 5, 7, '2019-12-18 07:06:50'),
(38, 'Semester 6 (Genap)', 0, 5, 7, '2019-12-18 07:06:50'),
(39, 'Semester 7 (Ganjil)', 0, 5, 7, '2019-12-18 07:06:50'),
(40, 'Semester 8 (Genap)', 0, 5, 7, '2019-12-18 07:06:50'),
(41, 'Semester 1 (Ganjil)', 0, 6, 7, '2019-12-18 07:06:50'),
(42, 'Semester 2 (Genap)', 0, 6, 7, '2019-12-18 07:06:50'),
(43, 'Semester 3 (Ganjil)', 0, 6, 7, '2019-12-18 07:06:50'),
(44, 'Semester 4 (Genap)', 0, 6, 7, '2019-12-18 07:06:50'),
(45, 'Semester 5 (Ganjil)', 0, 6, 7, '2019-12-18 07:06:50'),
(46, 'Semester 6 (Genap)', 0, 6, 7, '2019-12-18 07:06:50'),
(47, 'Semester 7 (Ganjil)', 0, 6, 7, '2019-12-18 07:06:50'),
(48, 'Semester 8 (Genap)', 0, 6, 7, '2019-12-18 07:06:50'),
(49, 'Semester 1 (Ganjil)', 0, 7, 7, '2019-12-18 07:06:50'),
(50, 'Semester 2 (Genap)', 0, 7, 7, '2019-12-18 07:06:50'),
(51, 'Semester 3 (Ganjil)', 0, 7, 7, '2019-12-18 07:06:50'),
(52, 'Semester 4 (Genap)', 0, 7, 7, '2019-12-18 07:06:50'),
(53, 'Semester 5 (Ganjil)', 0, 7, 7, '2019-12-18 07:06:50'),
(54, 'Semester 6 (Genap)', 0, 7, 7, '2019-12-18 07:06:50'),
(55, 'Semester 7 (Ganjil)', 0, 7, 7, '2019-12-18 07:06:50'),
(56, 'Semester 8 (Genap)', 0, 7, 7, '2019-12-18 07:06:50'),
(57, 'Semester 1 (Ganjil)', 0, 8, 7, '2019-12-18 07:06:50'),
(58, 'Semester 2 (Genap)', 0, 8, 7, '2019-12-18 07:06:50'),
(59, 'Semester 3 (Ganjil)', 0, 8, 7, '2019-12-18 07:06:50'),
(60, 'Semester 4 (Genap)', 0, 8, 7, '2019-12-18 07:06:50'),
(61, 'Semester 5 (Ganjil)', 0, 8, 7, '2019-12-18 07:06:50'),
(62, 'Semester 6 (Genap)', 0, 8, 7, '2019-12-18 07:06:50'),
(63, 'Semester 7 (Ganjil)', 0, 8, 7, '2019-12-18 07:06:50'),
(64, 'Semester 8 (Genap)', 0, 8, 7, '2019-12-18 07:06:50'),
(65, 'Semester 1 (Ganjil)', 0, 9, 7, '2019-12-18 07:06:50'),
(66, 'Semester 2 (Genap)', 0, 9, 7, '2019-12-18 07:06:50'),
(67, 'Semester 3 (Ganjil)', 0, 9, 7, '2019-12-18 07:06:50'),
(68, 'Semester 4 (Genap)', 0, 9, 7, '2019-12-18 07:06:50'),
(69, 'Semester 5 (Ganjil)', 0, 9, 7, '2019-12-18 07:06:50'),
(70, 'Semester 6 (Genap)', 0, 9, 7, '2019-12-18 07:06:50'),
(71, 'Semester 7 (Ganjil)', 0, 9, 7, '2019-12-18 07:06:50'),
(72, 'Semester 8 (Genap)', 0, 9, 7, '2019-12-18 07:06:50'),
(73, 'Semester 1 (Ganjil)', 0, 10, 7, '2019-12-18 07:06:50'),
(74, 'Semester 2 (Genap)', 0, 10, 7, '2019-12-18 07:06:50'),
(75, 'Semester 3 (Ganjil)', 0, 10, 7, '2019-12-18 07:06:50'),
(76, 'Semester 4 (Genap)', 0, 10, 7, '2019-12-18 07:06:50'),
(77, 'Semester 5 (Ganjil)', 0, 10, 7, '2019-12-18 07:06:50'),
(78, 'Semester 6 (Genap)', 0, 10, 7, '2019-12-18 07:06:50'),
(79, 'Semester 7 (Ganjil)', 0, 10, 7, '2019-12-18 07:06:50'),
(80, 'Semester 8 (Genap)', 0, 10, 7, '2019-12-18 07:06:50'),
(81, 'Semester 1 (Ganjil)', 0, 11, 7, '2019-12-18 07:06:50'),
(82, 'Semester 2 (Genap)', 0, 11, 7, '2019-12-18 07:06:50'),
(83, 'Semester 3 (Ganjil)', 0, 11, 7, '2019-12-18 07:06:50'),
(84, 'Semester 4 (Genap)', 0, 11, 7, '2019-12-18 07:06:50'),
(85, 'Semester 5 (Ganjil)', 0, 11, 7, '2019-12-18 07:06:50'),
(86, 'Semester 6 (Genap)', 0, 11, 7, '2019-12-18 07:06:50'),
(87, 'Semester 7 (Ganjil)', 0, 11, 7, '2019-12-18 07:06:50'),
(88, 'Semester 8 (Genap)', 0, 11, 7, '2019-12-18 07:06:50'),
(89, 'Semester 1 (Ganjil)', 0, 12, 7, '2019-12-18 07:06:50'),
(90, 'Semester 2 (Genap)', 0, 12, 7, '2019-12-18 07:06:50'),
(91, 'Semester 3 (Ganjil)', 0, 12, 7, '2019-12-18 07:06:50'),
(92, 'Semester 4 (Genap)', 0, 12, 7, '2019-12-18 07:06:50'),
(93, 'Semester 5 (Ganjil)', 0, 12, 7, '2019-12-18 07:06:50'),
(94, 'Semester 6 (Genap)', 0, 12, 7, '2019-12-18 07:06:50'),
(95, 'Semester 7 (Ganjil)', 0, 12, 7, '2019-12-18 07:06:50'),
(96, 'Semester 8 (Genap)', 0, 12, 7, '2019-12-18 07:06:50'),
(97, 'Semester 1 (Ganjil)', 0, 13, 7, '2019-12-18 07:06:50'),
(98, 'Semester 2 (Genap)', 0, 13, 7, '2019-12-18 07:06:50'),
(99, 'Semester 3 (Ganjil)', 0, 13, 7, '2019-12-18 07:06:50'),
(100, 'Semester 4 (Genap)', 0, 13, 7, '2019-12-18 07:06:50'),
(101, 'Semester 5 (Ganjil)', 0, 13, 7, '2019-12-18 07:06:50'),
(102, 'Semester 6 (Genap)', 0, 13, 7, '2019-12-18 07:06:50'),
(103, 'Semester 7 (Ganjil)', 0, 13, 7, '2019-12-18 07:06:50'),
(104, 'Semester 8 (Genap)', 0, 13, 7, '2019-12-18 07:06:50'),
(105, 'Semester 1 (Ganjil)', 0, 14, 7, '2019-12-18 07:06:50'),
(106, 'Semester 2 (Genap)', 0, 14, 7, '2019-12-18 07:06:50'),
(107, 'Semester 3 (Ganjil)', 0, 14, 7, '2019-12-18 07:06:50'),
(108, 'Semester 4 (Genap)', 0, 14, 7, '2019-12-18 07:06:50'),
(109, 'Semester 5 (Ganjil)', 0, 14, 7, '2019-12-18 07:06:50'),
(110, 'Semester 6 (Genap)', 0, 14, 7, '2019-12-18 07:06:50'),
(111, 'Semester 7 (Ganjil)', 0, 14, 7, '2019-12-18 07:06:50'),
(112, 'Semester 8 (Genap)', 0, 14, 7, '2019-12-18 07:06:50'),
(113, 'Semester 1 (Ganjil)', 0, 15, 7, '2019-12-18 07:06:50'),
(114, 'Semester 2 (Genap)', 0, 15, 7, '2019-12-18 07:06:50'),
(115, 'Semester 3 (Ganjil)', 0, 15, 7, '2019-12-18 07:06:50'),
(116, 'Semester 4 (Genap)', 0, 15, 7, '2019-12-18 07:06:50'),
(117, 'Semester 5 (Ganjil)', 0, 15, 7, '2019-12-18 07:06:50'),
(118, 'Semester 6 (Genap)', 0, 15, 7, '2019-12-18 07:06:50'),
(119, 'Semester 7 (Ganjil)', 0, 15, 7, '2019-12-18 07:06:50'),
(120, 'Semester 8 (Genap)', 0, 15, 7, '2019-12-18 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_akademik`
--

CREATE TABLE `tb_tahun_akademik` (
  `id` int(11) NOT NULL,
  `Nama_Tahun_Akademik` varchar(255) NOT NULL,
  `dibuat_oleh_user_id` int(11) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tahun_akademik`
--

INSERT INTO `tb_tahun_akademik` (`id`, `Nama_Tahun_Akademik`, `dibuat_oleh_user_id`, `tanggal_dibuat`) VALUES
(1, '2013/2014', 2, '2019-12-18 07:19:37'),
(2, '2014/2015', 2, '2019-12-18 07:19:37'),
(3, '2015/2016', 2, '2019-12-18 07:19:37'),
(4, '2016/2017', 2, '2019-12-18 07:19:37'),
(5, '2017/2018', 2, '2019-12-18 07:19:37'),
(6, '2018/2019', 2, '2019-12-18 07:19:37'),
(7, '2019/2020', 2, '2019-12-18 07:19:37'),
(8, '2020/2021', 2, '2019-12-18 07:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `NI` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `NI`, `nama`, `email`, `username`, `password`, `role_id`, `status`, `tanggal_dibuat`, `image`) VALUES
(21, '1982456789', 'Reno Kalih Madani', 'dosen@gmail.com', '', '$2y$10$iTWGOo54K1QD.ZHXD8LPbua0ffk4NjYDZ3jHsEpGKwf2dluKrpXKy', 9, 1, '2020-07-11 00:48:43', 'default.jpg'),
(22, '1982892092', 'Admin', 'admin@gmail.com', '', '$2y$10$u84oSnEZPlHvw2PP10lcLudfObhuYms51X55p023gmqBuMIdJhKdm', 2, 1, '2020-06-18 04:24:34', 'default.jpg'),
(23, '198245135', 'KPS TI', 'kpsti@gmail.com', '', '$2y$10$W0g4tpbtBKSep.I5yygW6OjzE4BcFf2bvLUawJ1rw.Hjj0BRE16W.', 5, 1, '2020-06-18 04:24:49', 'default.jpg'),
(24, '4816040333', 'Mahasiswa', 'mahasiswa@gmail.com', '', '$2y$10$FfNjmz8j7lFLZ0ZUiVF8OuoOj.s7qmYZGn1yJTEjnIzkva.9ji9GS', 10, 1, '2020-06-18 04:39:39', 'default.jpg'),
(25, '198202018290', 'Sekjur', 'sekjur@gmail.com', '', '$2y$10$X4WEslFgJQo8PAmTxrA0begyTLULrwu6mwhvPp1B55dRa9rpChv92', 4, 1, '2020-06-18 04:43:46', 'default.jpg'),
(26, '1982017291', 'Kajur', 'kajur@gmail.com', '', '$2y$10$4.S38jsbA5CEKO5WB/JoX.f.bcJFJoIAG60Wc2BH/VoUKEJq699My', 3, 1, '2020-06-18 04:42:50', 'default.jpg'),
(27, '19824527187', 'Superadmin', 'superadmin@gmail.com', '', '$2y$10$oIBktUtPhYoBCp9oktBTVea/89ZHoOIugUEOHXkDU5yqYrjsyIkK.', 1, 1, '2020-06-18 04:43:34', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 4),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `email`, `waktu`) VALUES
(1, 'superadmin@gmail.com', '2020-07-11 11:28:00'),
(2, 'dosen@gmail.com', '2020-07-11 11:29:18'),
(3, 'dosen@gmail.com', '2020-07-11 11:43:37'),
(4, 'mahasiswa@gmail.com', '2020-07-11 11:44:19'),
(5, 'kajur@gmail.com', '2020-07-11 11:53:27'),
(6, 'kpsti@gmail.com', '2020-07-11 11:53:41'),
(7, 'dosen@gmail.com', '2020-07-11 13:19:39'),
(8, 'mahasiswa@gmail.com', '2020-07-11 14:12:37'),
(9, 'dosen@gmail.com', '2020-07-11 14:25:59'),
(10, 'mahasiswa@gmail.com', '2020-07-11 14:29:29'),
(11, 'dosen@gmail.com', '2020-07-11 14:31:33'),
(12, 'mahasiswa@gmail.com', '2020-07-11 14:32:22'),
(13, 'mahasiswa@gmail.com', '2020-07-11 14:36:26'),
(14, 'dosen@gmail.com', '2020-07-11 14:36:46'),
(15, 'mahasiswa@gmail.com', '2020-07-11 14:45:24'),
(16, 'admin@gmail.com', '2020-07-11 14:46:58'),
(17, 'dosen@gmail.com', '2020-07-11 14:50:35'),
(18, 'admin@gmail.com', '2020-07-11 14:51:41'),
(19, 'kpsti@gmail.com', '2020-07-11 15:14:00'),
(20, 'mahasiswa@gmail.com', '2020-07-11 17:24:25'),
(21, 'dosen@gmail.com', '2020-07-11 17:28:33'),
(22, 'admin@gmail.com', '2020-07-11 17:36:11'),
(23, 'kpsti@gmail.com', '2020-07-11 17:37:13'),
(24, 'admin@gmail.com', '2020-07-11 17:41:57'),
(25, 'mahasiswa@gmail.com', '2020-07-11 17:42:37'),
(26, 'dosen@gmail.com', '2020-07-11 17:45:47'),
(27, 'dosen@gmail.com', '2020-07-11 17:46:52'),
(28, 'mahasiswa@gmail.com', '2020-07-11 17:47:23'),
(29, 'admin@gmail.com', '2020-07-11 18:06:37'),
(30, 'dosen@gmail.com', '2020-07-11 18:10:59'),
(31, 'kajur@gmail.com', '2020-07-11 18:17:04'),
(32, 'kpsti@gmail.com', '2020-07-11 18:17:18'),
(33, 'mahasiswa@gmail.com', '2020-07-11 18:19:24'),
(34, 'superadmin@gmail.com', '2020-07-11 20:21:13'),
(35, 'admin@gmail.com', '2020-07-11 20:22:22'),
(36, 'dosen@gmail.com', '2020-07-11 20:28:34'),
(37, 'mahasiswa@gmail.com', '2020-07-11 20:52:48'),
(38, 'dosen@gmail.com', '2020-07-11 20:59:54'),
(39, 'admin@gmail.com', '2020-07-11 21:14:58'),
(40, 'dosen@gmail.com', '2020-07-11 21:16:19'),
(41, 'admin@gmail.com', '2020-07-11 21:16:45'),
(42, 'mahasiswa@gmail.com', '2020-07-11 21:20:13'),
(43, 'kpsti@gmail.com', '2020-07-11 21:32:51'),
(44, 'superadmin@gmail.com', '2020-07-11 21:40:17'),
(45, 'admin@gmail.com', '2020-07-11 21:53:44'),
(46, 'mahasiswa@gmail.com', '2020-07-11 21:57:37'),
(47, 'kpsti@gmail.com', '2020-07-11 22:08:34'),
(48, 'admin@gmail.com', '2020-07-11 22:24:52'),
(49, 'admin@gmail.com', '2020-07-11 22:29:06'),
(50, 'mahasiswa@gmail.com', '2020-07-11 22:53:35'),
(51, 'dosen@gmail.com', '2020-07-11 23:18:29'),
(52, 'kpsti@gmail.com', '2020-07-11 23:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin'),
(3, 'Dosen'),
(4, 'Kajur'),
(5, 'Kps'),
(6, 'Mahasiswa'),
(7, 'Sekjur');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 2, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Profil Saya', 'dosen', 'fas fa-fw fa-user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajukan_surat`
--
ALTER TABLE `ajukan_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_khd`);

--
-- Indexes for table `kelas_pengganti`
--
ALTER TABLE `kelas_pengganti`
  ADD PRIMARY KEY (`id_pengganti`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_absen_pengajar`
--
ALTER TABLE `tb_absen_pengajar`
  ADD PRIMARY KEY (`id_absen_pengajar`);

--
-- Indexes for table `tb_ajukan_surat`
--
ALTER TABLE `tb_ajukan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_civitas`
--
ALTER TABLE `tb_civitas`
  ADD PRIMARY KEY (`NI`);

--
-- Indexes for table `tb_group_akses`
--
ALTER TABLE `tb_group_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kurikulum`
--
ALTER TABLE `tb_kurikulum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`NI`);

--
-- Indexes for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajukan_surat`
--
ALTER TABLE `ajukan_surat`
  MODIFY `id_surat` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `kode_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1345;

--
-- AUTO_INCREMENT for table `kelas_pengganti`
--
ALTER TABLE `kelas_pengganti`
  MODIFY `id_pengganti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
