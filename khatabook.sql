-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 01:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khatabook`
--

-- --------------------------------------------------------

--
-- Table structure for table `billdtl`
--

CREATE TABLE `billdtl` (
  `BillDtlID` int(10) NOT NULL,
  `BillID` int(10) NOT NULL,
  `ProdID` int(8) NOT NULL,
  `Qty` decimal(10,0) NOT NULL,
  `Rate` decimal(10,0) NOT NULL,
  `Isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billdtl`
--

INSERT INTO `billdtl` (`BillDtlID`, `BillID`, `ProdID`, `Qty`, `Rate`, `Isactive`) VALUES
(26, 17, 2, '10', '39', 0),
(27, 18, 5, '2', '110', 0),
(28, 19, 2, '2', '39', 0),
(29, 20, 2, '12', '39', 0),
(30, 21, 3, '15', '69', 0);

-- --------------------------------------------------------

--
-- Table structure for table `billmaster`
--

CREATE TABLE `billmaster` (
  `BillID` int(10) NOT NULL,
  `BillCode` varchar(100) NOT NULL,
  `TotalAmt` decimal(10,0) NOT NULL,
  `TotalPaidAmt` decimal(10,0) NOT NULL,
  `DateOfBill` datetime NOT NULL,
  `CustomerID` int(8) NOT NULL,
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billmaster`
--

INSERT INTO `billmaster` (`BillID`, `BillCode`, `TotalAmt`, `TotalPaidAmt`, `DateOfBill`, `CustomerID`, `UserID`) VALUES
(17, '00001', '390', '100', '2021-01-07 00:00:00', 4, 15),
(18, '00002', '220', '0', '2021-01-08 00:00:00', 9, 15),
(19, '00003', '78', '50', '2021-01-08 00:00:00', 5, 15),
(20, '00004', '468', '0', '2021-01-31 00:00:00', 6, 15),
(21, '00005', '1035', '0', '2021-01-31 00:00:00', 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `customermaster`
--

CREATE TABLE `customermaster` (
  `CustID` int(8) NOT NULL,
  `CustName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile` varchar(100) NOT NULL,
  `UserID` int(8) NOT NULL,
  `Isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customermaster`
--

INSERT INTO `customermaster` (`CustID`, `CustName`, `Email`, `Mobile`, `UserID`, `Isactive`) VALUES
(4, 'Naman Joshi 1', 'brahmbhattvishalr@gmail.com', '7622872096', 15, 1),
(5, 'Bhavin', 'bhavin@gmail.com', '7622872096', 15, 1),
(6, 'Nitin Parmar', 'nitin@gamil.com', '7622876969', 15, 1),
(7, 'Tejas Bhavsar', 'brahmbhattvishalr@gmail.com', '7622872096', 15, 1),
(8, 'ved 1', 'ved@gmail.com', '7622872096', 15, 1),
(9, 'urvis raval', 'urvis@gmail.com', '7622872096', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productmaster`
--

CREATE TABLE `productmaster` (
  `ProdID` int(8) NOT NULL,
  `ProdName` varchar(100) NOT NULL,
  `ProdDesc` varchar(100) NOT NULL,
  `RateOfPurchase` decimal(10,0) NOT NULL,
  `RateOfSell` decimal(10,0) NOT NULL,
  `UOM` varchar(20) NOT NULL,
  `UserID` int(8) NOT NULL,
  `Isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productmaster`
--

INSERT INTO `productmaster` (`ProdID`, `ProdName`, `ProdDesc`, `RateOfPurchase`, `RateOfSell`, `UOM`, `UserID`, `Isactive`) VALUES
(2, 'Sugar 1', ' ', '32', '39', 'KG', 15, 1),
(3, 'Tea', ' ', '65', '69', 'KG', 15, 1),
(4, 'Rice', ' ', '16', '20', 'KG', 15, 1),
(5, 'oil', ' ', '100', '110', 'Ltr', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usermaster`
--

CREATE TABLE `usermaster` (
  `UserID` int(8) NOT NULL,
  `EmailID` varchar(50) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `ShopName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `GSTNo` varchar(50) DEFAULT NULL,
  `OTP` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermaster`
--

INSERT INTO `usermaster` (`UserID`, `EmailID`, `Password`, `Name`, `ShopName`, `Address`, `GSTNo`, `OTP`) VALUES
(15, 'vishal.milkeyway@gmail.com', '123456', 'vishal', 'SEP', ' ', ' ', NULL),
(16, 'vishal@gmail.com', '123456', 'Vishal', 'ABCD', ' ', ' ', NULL),
(17, 'cb@gmail.com', '123456', 'chirag', 'abcderf', ' ', ' ', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billdtl`
--
ALTER TABLE `billdtl`
  ADD PRIMARY KEY (`BillDtlID`),
  ADD KEY `BillDtl_BillMaster` (`BillID`),
  ADD KEY `BillDtl_ProdMaster` (`ProdID`);

--
-- Indexes for table `billmaster`
--
ALTER TABLE `billmaster`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `BillMaster_CustomerMaster` (`CustomerID`),
  ADD KEY `BillMaster_UserMaster` (`UserID`);

--
-- Indexes for table `customermaster`
--
ALTER TABLE `customermaster`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `CustomerMaster_UserMaster` (`UserID`);

--
-- Indexes for table `productmaster`
--
ALTER TABLE `productmaster`
  ADD PRIMARY KEY (`ProdID`),
  ADD KEY `ProdMaster_UserMaster` (`UserID`);

--
-- Indexes for table `usermaster`
--
ALTER TABLE `usermaster`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billdtl`
--
ALTER TABLE `billdtl`
  MODIFY `BillDtlID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `billmaster`
--
ALTER TABLE `billmaster`
  MODIFY `BillID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customermaster`
--
ALTER TABLE `customermaster`
  MODIFY `CustID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `productmaster`
--
ALTER TABLE `productmaster`
  MODIFY `ProdID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usermaster`
--
ALTER TABLE `usermaster`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billdtl`
--
ALTER TABLE `billdtl`
  ADD CONSTRAINT `BillDtl_BillMaster` FOREIGN KEY (`BillID`) REFERENCES `billmaster` (`BillID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `BillDtl_ProdMaster` FOREIGN KEY (`ProdID`) REFERENCES `productmaster` (`ProdID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `billmaster`
--
ALTER TABLE `billmaster`
  ADD CONSTRAINT `BillMaster_CustomerMaster` FOREIGN KEY (`CustomerID`) REFERENCES `customermaster` (`CustID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `BillMaster_UserMaster` FOREIGN KEY (`UserID`) REFERENCES `usermaster` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customermaster`
--
ALTER TABLE `customermaster`
  ADD CONSTRAINT `CustomerMaster_UserMaster` FOREIGN KEY (`UserID`) REFERENCES `usermaster` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productmaster`
--
ALTER TABLE `productmaster`
  ADD CONSTRAINT `ProdMaster_UserMaster` FOREIGN KEY (`UserID`) REFERENCES `usermaster` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
