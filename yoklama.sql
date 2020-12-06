-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 26, 2020 at 11:27 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yoklama`
--

-- --------------------------------------------------------

--
-- Table structure for table `dersler`
--

CREATE TABLE `dersler` (
  `id` int(9) NOT NULL,
  `adi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dersler`
--

INSERT INTO `dersler` (`id`, `adi`) VALUES
(1, 'İletişim'),
(2, 'Nesne Yönelimli Programlama 1'),
(3, 'Proje Yönetimi'),
(4, 'Öğretmenlik Uygulaması'),
(5, 'İnternet Tabanlı Programlama');

-- --------------------------------------------------------

--
-- Table structure for table `egitmen`
--

CREATE TABLE `egitmen` (
  `id` int(8) NOT NULL,
  `akaNo` int(9) NOT NULL,
  `sifre` int(11) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `unvan` varchar(50) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `egitmen`
--

INSERT INTO `egitmen` (`id`, `akaNo`, `sifre`, `ad`, `soyad`, `unvan`, `mail`, `durum`) VALUES
(1, 1381, 123456, 'Erman', 'Yükseltürk', 'Profesör Doktor', 'eyukselturk@gmail.com', 1),
(2, 1524, 123, 'kadir', 'uysal', 'prof doç ord xd', 'info@kadiruysal.com.tr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` int(8) NOT NULL,
  `ogrencino` int(9) NOT NULL,
  `sifre` varchar(128) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ogrenci`
--

INSERT INTO `ogrenci` (`id`, `ogrencino`, `sifre`, `mail`, `ad`, `soyad`, `durum`) VALUES
(1, 160805022, '123456', 'gorkemkoc97@yandex.com', 'Görkem', 'Koç', 1),
(2, 160805006, '123456', 'mhmmtdmrk21@gmail.com', 'Muhammet', 'Demirok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oturum`
--

CREATE TABLE `oturum` (
  `id` int(128) NOT NULL,
  `dersid` int(9) NOT NULL,
  `egitmenid` int(9) NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oturum`
--

INSERT INTO `oturum` (`id`, `dersid`, `egitmenid`, `durum`) VALUES
(1, 2, 2, 1),
(2, 1, 1, 0),
(3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `yoklama`
--

CREATE TABLE `yoklama` (
  `id` int(255) NOT NULL,
  `oturumid` int(128) NOT NULL,
  `ogrencino` int(9) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yoklama`
--

INSERT INTO `yoklama` (`id`, `oturumid`, `ogrencino`, `timestamp`) VALUES
(1, 2, 160805022, '2020-05-15 16:06:42'),
(2, 1, 160805022, '2020-05-15 17:06:41'),
(3, 3, 160805006, '2020-05-15 17:08:11'),
(4, 1, 160805022, '2020-05-15 18:17:34'),
(5, 3, 160805006, '2020-05-15 18:23:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `egitmen`
--
ALTER TABLE `egitmen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `akaNo` (`akaNo`);

--
-- Indexes for table `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ogrencino` (`ogrencino`);

--
-- Indexes for table `oturum`
--
ALTER TABLE `oturum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dersid` (`dersid`),
  ADD KEY `egitmenid` (`egitmenid`);

--
-- Indexes for table `yoklama`
--
ALTER TABLE `yoklama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oturumid` (`oturumid`),
  ADD KEY `ogrencino` (`ogrencino`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dersler`
--
ALTER TABLE `dersler`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `egitmen`
--
ALTER TABLE `egitmen`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oturum`
--
ALTER TABLE `oturum`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yoklama`
--
ALTER TABLE `yoklama`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oturum`
--
ALTER TABLE `oturum`
  ADD CONSTRAINT `oturum_ibfk_1` FOREIGN KEY (`dersid`) REFERENCES `dersler` (`id`),
  ADD CONSTRAINT `oturum_ibfk_2` FOREIGN KEY (`egitmenid`) REFERENCES `egitmen` (`id`);

--
-- Constraints for table `yoklama`
--
ALTER TABLE `yoklama`
  ADD CONSTRAINT `yoklama_ibfk_1` FOREIGN KEY (`oturumid`) REFERENCES `oturum` (`id`),
  ADD CONSTRAINT `yoklama_ibfk_2` FOREIGN KEY (`ogrencino`) REFERENCES `ogrenci` (`ogrencino`);
