-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2016 at 01:09 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `convention_hall`
--
CREATE DATABASE IF NOT EXISTS `convention_hall` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `convention_hall`;

DELIMITER $$
--
-- Procedures
--





END$$


END$$


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_schedule` (IN `newShift` TEXT, IN `newTime` TEXT)  BEGIN
INSERT INTO `shift`(`shift_name`, `shift_time`) VALUES (newShift, newTime);
END$$





END$$


END$$


END$$


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `additional_menu`
--



--
-- Dumping data for table `additional_menu`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `addi_food`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `addi_food_full`
--


-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--



--
-- Dumping data for table `adminlogin`
--



-- --------------------------------------------------------

--
-- Table structure for table `advantages`
--



--
-- Dumping data for table `advantages`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `all_booking_info`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `approve_bookings`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `complete_booking`
--


-- --------------------------------------------------------

--
-- Table structure for table `features`
--



--
-- Dumping data for table `features`
--



-- --------------------------------------------------------

--
-- Table structure for table `gate`
--



--
-- Dumping data for table `gate`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `gate_view`
--


-- --------------------------------------------------------

--
-- Table structure for table `hall_booking`
--



--
-- Dumping data for table `hall_booking`
--



-- --------------------------------------------------------

--
-- Table structure for table `misc`
--



--
-- Dumping data for table `misc`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `order_date_shift`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `pending_bookings`
--


-- --------------------------------------------------------

--
-- Table structure for table `puposes`
--



--
-- Dumping data for table `puposes`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `purpose_view`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `schedule_view`
--


-- --------------------------------------------------------

--
-- Table structure for table `services`
--



--
-- Dumping data for table `services`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `service_view`
--


-- --------------------------------------------------------

--
-- Table structure for table `set_menu`
--


--
-- Dumping data for table `set_menu`
--



-- --------------------------------------------------------

--
-- Table structure for table `shift`
--



--
-- Dumping data for table `shift`
--



-- --------------------------------------------------------

--
-- Table structure for table `stage`
--



--
-- Dumping data for table `stage`
--



-- --------------------------------------------------------

--
-- Stand-in structure for view `stage_view`
--


-- --------------------------------------------------------

--
-- Table structure for table `status`
--



--
-- Dumping data for table `status`
--



-- --------------------------------------------------------

--
-- Table structure for table `user`
--



--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_user`
--


-- --------------------------------------------------------

--
-- Structure for view `addi_food`
--

-- --------------------------------------------------------

--
-- Structure for view `addi_food_full`
--

-- --------------------------------------------------------

--
-- Structure for view `all_booking_info`
--

-- --------------------------------------------------------

--
-- Structure for view `approve_bookings`
--

-- --------------------------------------------------------

--
-- Structure for view `complete_booking`
--

-- --------------------------------------------------------

--
-- Structure for view `gate_view`
--

-- --------------------------------------------------------

--
-- Structure for view `order_date_shift`
--

-- --------------------------------------------------------

--
-- Structure for view `pending_bookings`
--

-- --------------------------------------------------------

--
-- Structure for view `purpose_view`
--

-- --------------------------------------------------------

--
-- Structure for view `schedule_view`
--

-- --------------------------------------------------------

--
-- Structure for view `service_view`
--

-- --------------------------------------------------------

--
-- Structure for view `stage_view`
--

-- --------------------------------------------------------

--
-- Structure for view `view_all_user`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_menu`
--


--
-- Indexes for table `adminlogin`
--


--
-- Indexes for table `advantages`
--


--
-- Indexes for table `features`
--


--
-- Indexes for table `gate`
--


--
-- Indexes for table `hall_booking`
--


--
-- Indexes for table `misc`
--


--
-- Indexes for table `puposes`
--


--
-- Indexes for table `services`
--


--
-- Indexes for table `set_menu`
--


--
-- Indexes for table `shift`
--


--
-- Indexes for table `stage`
--


--
-- Indexes for table `status`
--


--
-- Indexes for table `user`
--


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_menu`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
