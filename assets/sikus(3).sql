-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2016 at 09:02 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikus`
--

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(15);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2016-12-11 16:47:52', '2016-12-11 16:45:47', '0049006E0066006F0020006E0061006D0061002000740069006E0067006B00610074', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Info nama tingkat', 4, '', 'true'),
('2016-12-11 16:19:14', '2016-12-11 15:32:09', '', '9999', 'Default_No_Compression', '', '', -1, 'info bayar 1', 3, '', 'true'),
('2016-12-11 16:48:48', '2016-12-11 16:48:38', '0049006E0066006F00200062006100790061007200200031', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Info bayar 1', 5, '', 'true'),
('2016-12-11 16:50:48', '2016-12-11 16:50:40', '0049006E0066006F00200062006100790061007200200031', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Info bayar 1', 6, '', 'true'),
('2016-12-11 16:52:05', '2016-12-11 16:52:00', '0049006E0066006F00200062006100790061007200200031', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Info bayar 1', 7, '', 'true'),
('2016-12-11 16:57:05', '2016-12-11 16:56:57', '0049006E0066006F00200066006F0072006D0061007400200073006D0073', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Info format sms', 8, '', 'true');

--
-- Triggers `inbox`
--
DELIMITER $$
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `id_jnsbyr` int(11) NOT NULL,
  `id_namabyr` int(11) NOT NULL,
  `biaya` varchar(50) NOT NULL,
  `id_thnajar` int(11) NOT NULL,
  `id_kls` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_bayar`
--

INSERT INTO `jenis_bayar` (`id_jnsbyr`, `id_namabyr`, `biaya`, `id_thnajar`, `id_kls`) VALUES
(3, 1, '50000', 1, '17');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kls` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `tingkat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kls`, `kelas`, `tingkat`) VALUES
(17, 'A', '1'),
(18, 'A', '2'),
(19, 'A', '3'),
(20, 'B', '1'),
(21, 'B', '2'),
(22, 'B', '3'),
(23, 'C', '1'),
(24, 'C', '2'),
(25, 'C', '3'),
(26, 'C', '4');

-- --------------------------------------------------------

--
-- Table structure for table `nama_bayar`
--

CREATE TABLE `nama_bayar` (
  `id_namabyr` int(11) NOT NULL,
  `nama_byr` varchar(50) NOT NULL,
  `ket` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nama_bayar`
--

INSERT INTO `nama_bayar` (`id_namabyr`, `nama_byr`, `ket`) VALUES
(1, 'Spp', 'bulan'),
(5, 'UTS', 'lain');

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  `Retries` int(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Triggers `outbox`
--
DELIMITER $$
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE `pbk` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Putra Code', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'bendahara');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `NetCode` varchar(10) DEFAULT 'ERROR',
  `NetName` varchar(35) DEFAULT 'ERROR',
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`ID`, `UpdatedInDB`, `InsertIntoDB`, `TimeOut`, `Send`, `Receive`, `IMEI`, `NetCode`, `NetName`, `Client`, `Battery`, `Signal`, `Sent`, `Received`) VALUES
('', '2016-12-11 16:58:37', '2016-12-11 16:47:31', '2016-12-11 16:58:47', 'yes', 'yes', '351047882158674', '510 01', '', 'Gammu 1.37.0, Linux, kernel 4.4.0-53-generic (#74-Ubuntu SMP Fri Dec 2 15:59:10 UTC 2016), GCC 5.3', 0, 42, 6, 5);

--
-- Triggers `phones`
--
DELIMITER $$
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sentitems`
--

INSERT INTO `sentitems` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `DeliveryDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `SenderID`, `SequencePosition`, `Status`, `StatusError`, `TPMR`, `RelativeValidity`, `CreatorID`) VALUES
('2016-12-11 16:47:36', '2016-12-11 16:19:14', '2016-12-11 16:47:36', NULL, '0028005300700070002D003500300030003000300029', '9999', 'Default_No_Compression', '', '+62816124', -1, '(Spp-50000)', 124, '', 1, 'SendingOK', -1, 26, 255, ''),
('2016-12-10 16:08:15', '2016-12-10 16:08:05', '2016-12-10 16:08:15', NULL, '0064006100720069002000730069006B00750073000D000A', '085735307194', 'Default_No_Compression', '', '+62816124', -1, 'dari sikus\r\n', 117, '', 1, 'SendingOK', -1, 24, 255, ''),
('2016-12-11 01:42:18', '2016-12-11 01:38:29', '2016-12-11 01:42:18', NULL, '00730064006600640073006600730064', '898979', 'Default_No_Compression', '', '+62816124', -1, 'sdfdsfsd', 118, '', 1, 'SendingOK', -1, 25, 255, ''),
('2016-12-11 16:48:10', '2016-12-11 16:47:52', '2016-12-11 16:48:10', NULL, '004E0061006D0061002000540069006E0067006B00610074003A00200031002C00200032002C00200033002C00200034', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'Nama Tingkat: 1, 2, 3, 4', 125, '', 1, 'SendingOK', -1, 27, 255, ''),
('2016-12-11 16:49:13', '2016-12-11 16:48:48', '2016-12-11 16:49:13', NULL, '0028005300700070002D003500300030003000300029', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, '(Spp-50000)', 126, '', 1, 'SendingOK', -1, 28, 255, ''),
('2016-12-11 16:51:17', '2016-12-11 16:50:48', '2016-12-11 16:51:17', NULL, '0028005300700070002D002000520070002E0020003500300030003000300029', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, '(Spp- Rp. 50000)', 127, '', 1, 'SendingOK', -1, 29, 255, ''),
('2016-12-11 16:52:22', '2016-12-11 16:52:05', '2016-12-11 16:52:22', NULL, '0028005300700070002D00520070002E003500300030003000300029', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, '(Spp-Rp.50000)', 128, '', 1, 'SendingOK', -1, 30, 255, ''),
('2016-12-11 16:57:26', '2016-12-11 16:57:05', '2016-12-11 16:57:26', NULL, '0049004E0046004F0020004E0041004D0041002000540049004E0047004B004100540020007C007C00200049004E0046004F0020004200410059004100520020004E0041004D0041005F00540049004E004B0041005400200028006300740068003A00200049004E0046004F002000420041005900410052002000310029', '+6285735307194', 'Default_No_Compression', '', '+62816124', -1, 'INFO NAMA TINGKAT || INFO BAYAR NAMA_TINKAT (cth: INFO BAYAR 1)', 129, '', 1, 'SendingOK', -1, 31, 255, '');

--
-- Triggers `sentitems`
--
DELIMITER $$
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `telp_siswa` varchar(20) NOT NULL,
  `nama_ortu` varchar(100) NOT NULL,
  `telp_ortu` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `alamat`, `telp_siswa`, `nama_ortu`, `telp_ortu`, `status`) VALUES
('123', 'Denny', 'L', 'alamat 1', '085735307891', 'orang tua 1', '085735307194', 'aktif'),
('124', 'siswa 2', 'P', 'alamat 2', '085735307892', 'orang tua 2', '112', 'aktif'),
('125', 'siswa 3', 'L', 'alamat 3', '085735307893', 'orang tua 3', '113', 'aktif'),
('126', 'siswa 4', 'L', 'alamat 4', '085735307894', 'orang tua 4', '114', 'aktif'),
('127', 'siswa 5', 'P', 'alamat 5', '085735307895', 'orang tua 5', '115', 'aktif'),
('128', 'siswa 6', 'P', 'alamat 6', '085735307896', 'orang tua 6', '116', 'aktif'),
('129', 'siswa 7', 'L', 'alamat 7', '085735307897', 'orang tua 7', '117', 'aktif'),
('130', 'siswa 8', 'L', 'alamat 8', '085735307898', 'orang tua 8', '118', 'aktif'),
('131', 'siswa 9', 'L', 'alamat 9', '085735307899', 'orang tua 9', '119', 'aktif'),
('132', 'siswa 10', 'P', 'alamat 10', '085735307800', 'orang tua 10', '120', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelas`
--

CREATE TABLE `siswa_kelas` (
  `id_sk` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `id_kls` int(11) NOT NULL,
  `id_thnajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_kelas`
--

INSERT INTO `siswa_kelas` (`id_sk`, `nis`, `id_kls`, `id_thnajar`) VALUES
(5, '123', 17, 1),
(6, '124', 18, 1),
(7, '125', 19, 1),
(8, '126', 20, 1),
(9, '127', 21, 1),
(10, '128', 22, 1),
(11, '129', 23, 1),
(12, '130', 24, 1),
(13, '131', 25, 1),
(14, '132', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajr`
--

CREATE TABLE `tahun_ajr` (
  `id_thnajar` int(11) NOT NULL,
  `thn_ajr` varchar(50) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajr`
--

INSERT INTO `tahun_ajr` (`id_thnajar`, `thn_ajr`, `status`) VALUES
(1, '2016-2017', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `id_kls` int(10) NOT NULL,
  `id_jnsbyr` int(5) NOT NULL,
  `tgl_byr` date NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nis`, `id_kls`, `id_jnsbyr`, `tgl_byr`, `ket`) VALUES
(1, '123', 17, 1, '2016-12-07', 'lunas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  ADD PRIMARY KEY (`id_jnsbyr`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kls`);

--
-- Indexes for table `nama_bayar`
--
ALTER TABLE `nama_bayar`
  ADD PRIMARY KEY (`id_namabyr`);

--
-- Indexes for table `outbox`
--
ALTER TABLE `outbox`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  ADD KEY `outbox_sender` (`SenderID`(250));

--
-- Indexes for table `outbox_multipart`
--
ALTER TABLE `outbox_multipart`
  ADD PRIMARY KEY (`ID`,`SequencePosition`);

--
-- Indexes for table `pbk`
--
ALTER TABLE `pbk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`IMEI`);

--
-- Indexes for table `sentitems`
--
ALTER TABLE `sentitems`
  ADD PRIMARY KEY (`ID`,`SequencePosition`),
  ADD KEY `sentitems_date` (`DeliveryDateTime`),
  ADD KEY `sentitems_tpmr` (`TPMR`),
  ADD KEY `sentitems_dest` (`DestinationNumber`),
  ADD KEY `sentitems_sender` (`SenderID`(250));

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indexes for table `tahun_ajr`
--
ALTER TABLE `tahun_ajr`
  ADD PRIMARY KEY (`id_thnajar`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  MODIFY `id_jnsbyr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `nama_bayar`
--
ALTER TABLE `nama_bayar`
  MODIFY `id_namabyr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `outbox`
--
ALTER TABLE `outbox`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `pbk`
--
ALTER TABLE `pbk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tahun_ajr`
--
ALTER TABLE `tahun_ajr`
  MODIFY `id_thnajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
