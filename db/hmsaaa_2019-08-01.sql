-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2019 at 04:35 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsaaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaaappointments`
--

DROP TABLE IF EXISTS `hmsaaaappointments`;
CREATE TABLE IF NOT EXISTS `hmsaaaappointments` (
  `APID` int(20) NOT NULL AUTO_INCREMENT,
  `APPtID` int(20) NOT NULL,
  `APDcID` int(20) NOT NULL,
  `APDate` date NOT NULL,
  `APTime` time(6) NOT NULL,
  `APDealt` tinyint(2) NOT NULL,
  PRIMARY KEY (`APID`),
  UNIQUE KEY `APID` (`APID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaaappointmentsrl`
--

DROP TABLE IF EXISTS `hmsaaaappointmentsrl`;
CREATE TABLE IF NOT EXISTS `hmsaaaappointmentsrl` (
  `APID` int(50) NOT NULL AUTO_INCREMENT,
  `APPtID` int(30) NOT NULL,
  `APDcID` int(30) NOT NULL,
  `APDate` date NOT NULL,
  `APTime` time NOT NULL,
  `APTkn` int(30) NOT NULL,
  `APDealt` smallint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`APID`),
  UNIQUE KEY `APID` (`APID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaabillsp`
--

DROP TABLE IF EXISTS `hmsaaabillsp`;
CREATE TABLE IF NOT EXISTS `hmsaaabillsp` (
  `PRBID` int(20) NOT NULL,
  `PRBPtID` int(20) NOT NULL,
  `PRBDcFee` int(30) NOT NULL,
  `PRBTotal` int(50) NOT NULL,
  `PRBPaid` int(50) NOT NULL,
  `PRBDate` date NOT NULL,
  `PRBTime` time(6) NOT NULL,
  `PRBDiscount` int(20) NOT NULL,
  PRIMARY KEY (`PRBID`),
  UNIQUE KEY `PRBID` (`PRBID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaamedicines`
--

DROP TABLE IF EXISTS `hmsaaamedicines`;
CREATE TABLE IF NOT EXISTS `hmsaaamedicines` (
  `MDID` int(20) NOT NULL AUTO_INCREMENT,
  `MDName` varchar(50) NOT NULL,
  `MDUnit` varchar(10) NOT NULL,
  `MDSaleUnitPrice` float NOT NULL,
  `MDSaleLeastUnit` int(20) NOT NULL,
  `MDQuantity` float NOT NULL,
  `MDBarcode` varchar(300) NOT NULL,
  PRIMARY KEY (`MDID`),
  UNIQUE KEY `MDID` (`MDID`),
  UNIQUE KEY `MdBarcode` (`MDBarcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaapbmedicines`
--

DROP TABLE IF EXISTS `hmsaaapbmedicines`;
CREATE TABLE IF NOT EXISTS `hmsaaapbmedicines` (
  `BMUID` int(20) NOT NULL AUTO_INCREMENT,
  `PRBID` int(20) NOT NULL,
  `MDID` int(20) NOT NULL,
  `PRMDAmountPrescribed` int(30) NOT NULL,
  `PRMDAmountPrescribedPrice` float NOT NULL,
  PRIMARY KEY (`BMUID`),
  UNIQUE KEY `BMUID` (`BMUID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaapreb`
--

DROP TABLE IF EXISTS `hmsaaapreb`;
CREATE TABLE IF NOT EXISTS `hmsaaapreb` (
  `PRBID` int(20) NOT NULL AUTO_INCREMENT,
  `PRBPtID` int(20) NOT NULL,
  `PRBDcID` int(20) NOT NULL,
  `PRImg` varchar(200) NOT NULL,
  `PRBDate` date NOT NULL,
  `PRBTime` time(6) NOT NULL,
  `PRBReachedPharmacy` tinyint(1) NOT NULL,
  UNIQUE KEY `PRBID` (`PRBID`),
  KEY `PRBID_2` (`PRBID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmsaaausers`
--

DROP TABLE IF EXISTS `hmsaaausers`;
CREATE TABLE IF NOT EXISTS `hmsaaausers` (
  `UID` int(20) NOT NULL AUTO_INCREMENT,
  `URID` int(20) NOT NULL,
  `UFNaam` varchar(50) NOT NULL,
  `ULNaam` varchar(50) NOT NULL,
  `UNaam` varchar(50) NOT NULL,
  `UPwd` varchar(50) NOT NULL,
  `UAdress` varchar(100) NOT NULL,
  `UGender` varchar(10) NOT NULL,
  `UAge` date NOT NULL,
  `URegDate` date NOT NULL,
  `UPicture` varchar(100) NOT NULL,
  `UIDCardNumber` varchar(30) NOT NULL,
  `USpeciality` varchar(50) DEFAULT NULL,
  `UDcFee` int(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `UNaam` (`UNaam`),
  UNIQUE KEY `UID` (`UID`),
  UNIQUE KEY `UID_2` (`UID`),
  UNIQUE KEY `UIDCardNumber` (`UIDCardNumber`),
  UNIQUE KEY `UIDCardNumber_2` (`UIDCardNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hmsaaausers`
--

INSERT INTO `hmsaaausers` (`UID`, `URID`, `UFNaam`, `ULNaam`, `UNaam`, `UPwd`, `UAdress`, `UGender`, `UAge`, `URegDate`, `UPicture`, `UIDCardNumber`, `USpeciality`, `UDcFee`) VALUES
(1, 3, 'Receptionist', 'Abdul', 'rc', 'rc', 'Islamabad, Pakistan', 'Male', '1980-01-01', '2019-07-22', '', '33333-3333333-1', NULL, 0),
(2, 4, 'Pharmacist', 'Awais', 'ph', 'ph', 'Islamabad, Pakistan', 'Male', '1980-01-01', '2019-07-22', '', '44444-4444444-1', NULL, 0),
(3, 5, 'Admin', 'Asif', 'ad', 'ad', 'Islamabad, Pakistan', 'Male', '1980-01-01', '2019-07-22', '', '55555-5555555-1', NULL, 0),
(4, 1, 'Dr1', 'Ali', 'Dr1', 'Dr1', 'Islamabad, Pakistan', 'Male', '1991-08-08', '2019-07-22', '', '22222-2222222-1', 'Heart Specialist', 0),
(5, 1, 'Dr2', 'Adeel', 'Dr2', 'Dr2', 'Islamabad, Pakistan', 'Male', '1984-08-08', '2019-07-22', '', '22222-2222222-2', 'Skin Specialist', 0),
(7, 2, 'Patient', 'Khizar', 'TDK-AUG19-001', 'patient', 'Islamabad, Pakistan', 'Male', '1989-08-09', '2019-07-31', '../Images/UserImages/78169-Programmer-Code.jpg', '11111-1111111-1', NULL, 0),
(8, 2, 'Patient', 'Jahanzeb', 'TDK-AUG19-002', 'patient', 'Islamabad, Pakistan', 'Male', '1994-09-04', '2019-08-01', '../Images/UserImages/29954CountryLogoEqual_350x350.jpg', '11111-1111111-2', NULL, 0),
(9, 2, 'Patient', 'Javier', 'TDK-AUG19-003', 'patient', 'Islamabad, Pakistan', 'Male', '1983-08-03', '2019-08-01', '../Images/UserImages/268JavierDiaz.jpg', '11111-1111111-3', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_inventory`
--

DROP TABLE IF EXISTS `medicine_inventory`;
CREATE TABLE IF NOT EXISTS `medicine_inventory` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(25) NOT NULL,
  `price` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
