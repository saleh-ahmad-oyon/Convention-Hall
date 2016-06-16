-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2016 at 04:43 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_orders` (IN `orderID` INT)  BEGIN
SELECT user.u_fname, user.u_lname, user.u_email, user.u_contact, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `food`, `guest_number`, gate.g_title, gate.g_image, gate.g_price, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, stage.st_title, stage.st_image, stage.st_price, status.status_cond, `total_cost`, `paid_cost`, hall_booking.fullFood, hall_booking.date_of_booking
FROM `hall_booking`
INNER JOIN user ON user.s_id = hall_booking.user_id
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN status ON status.status_id = hall_booking.order_status WHERE `order_id` = orderID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `give_booking` (IN `usr` INT, IN `dat` DATE, IN `shift` TEXT, IN `purpose` TEXT, IN `service` TEXT, IN `guest` INT, IN `gate` INT, IN `stage` INT, IN `food` TEXT, IN `totalCost` DECIMAL(10,2), IN `fullamount` TEXT, IN `setMenu` INT, IN `today` DATE)  BEGIN
INSERT INTO `hall_booking`(`user_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `guest_number`, `welcome_gate`, `stage`, `food`, `total_cost`, `fullFood`, `set_menu`, `date_of_booking`) VALUES (usr,dat,shift,purpose,service,guest,gate,stage,food, totalCost, fullamount, setMenu, today);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_addi_food` (IN `foodTitle` TEXT, IN `foodImage` TEXT, IN `foodPrice` DECIMAL(10,2), IN `foodKeywords` TEXT)  BEGIN
INSERT INTO `additional_menu`(`am_title`, `am_image`, `am_price`, `keywords`) 
VALUES (foodTitle,foodImage,foodPrice,foodKeywords);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_advantage` (IN `newAdv` TEXT)  BEGIN
INSERT INTO `advantages`(`adv_desc`) VALUES (newAdv);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_feature` (IN `feat` TEXT)  BEGIN
INSERT INTO `features`(`f_desc`) VALUES (feat);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_gate` (IN `addname` TEXT, IN `addImage` TEXT, IN `addPrice` DECIMAL(10,2))  BEGIN
INSERT INTO `gate`(`g_title`, `g_image`, `g_price`) VALUES (addname,addImage,addPrice);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_schedule` (IN `newShift` TEXT, IN `newTime` TEXT)  BEGIN
INSERT INTO `shift`(`shift_name`, `shift_time`) VALUES (newShift, newTime);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_service` (IN `serv` TEXT, IN `price` DECIMAL(10,2))  BEGIN
INSERT INTO `services`(`serv_name`, `Serv_price`) VALUES (serv, price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_setmenu` (IN `title` TEXT, IN `description` TEXT, IN `cost` DECIMAL(10,2))  BEGIN
INSERT INTO `set_menu`(`sm_title`, `sm_description`, `sm_price`) VALUES (title, description, cost);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_stage` (IN `title` TEXT, IN `image` TEXT, IN `cost` DECIMAL(10,2))  BEGIN
INSERT INTO `stage`(`st_title`, `st_image`, `st_price`) VALUES (title,image,cost);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_user` (IN `fname` TEXT, IN `lname` TEXT, IN `email` VARCHAR(255), IN `contact` TEXT, IN `pass` TEXT)  BEGIN
INSERT INTO `user`(`u_fname`, `u_lname`, `u_email`, `u_contact`, `u_pass`) VALUES (fname, lname, email, contact, pass);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_orders` (IN `orderID` INT)  BEGIN
SELECT hall_booking.order_date, hall_booking.order_shift, `order_id`,  hall_booking.order_purpose, hall_booking.services, status.status_cond, hall_booking.guest_number, gate.g_title, gate.g_image, gate.g_price, stage.st_title, stage.st_image, stage.st_price, hall_booking.food, hall_booking.total_cost, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, hall_booking.paid_cost, hall_booking.fullFood, hall_booking.date_of_booking
FROM hall_booking
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN `status` ON status.status_id = hall_booking.order_status WHERE hall_booking.order_id = orderID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `additional_menu`
--

CREATE TABLE `additional_menu` (
  `am_id` int(11) NOT NULL COMMENT 'Additional Menu ID',
  `am_title` text NOT NULL,
  `am_image` text NOT NULL,
  `am_price` decimal(10,2) NOT NULL,
  `keywords` text NOT NULL COMMENT 'Keywords for Searching'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_menu`
--

INSERT INTO `additional_menu` (`am_id`, `am_title`, `am_image`, `am_price`, `keywords`) VALUES
(1, 'Beef Liver', 'beef_kaliza.png', '85.00', 'beef kaliza\r\nbeef liver\r\ngorur koliza\r\ngorur liver'),
(2, 'Chicken Rezala', 'Chicken-Rezala.jpg', '100.00', 'chicken rezala\r\nmurgi rezala\r\nmorgi rezala'),
(3, 'Chicken Curry', 'Chicken_Curry.JPG', '100.00', 'chicken curry\r\nmurgi kari\r\nmurgir torkari\r\nchicken torkari\r\nmorgi kari\r\nmurgi curry\r\nmorgi curry\r\nmurgir curry\r\nmorgir curry'),
(4, 'Rupchada Fry', 'rupchanda.jpg', '200.00', 'Rupchada Fish Fry\r\nrupchanda mach\r\nrupchada mach\r\nmach vaja\r\nrupchanda mach vaja\r\nrupchada mach vaja'),
(5, 'Hilsa Korma', 'korma_ilish.jpg', '100.00', 'Hilsa Fish Korma\r\nHilsha mach\r\nilish korma\r\nilish macher korma\r\nHilsa Fish corma\r\nilish corma\r\nilish macher corma'),
(6, 'Hilsa Fry', 'hilsa_fry.jpg', '100.00', 'Hilsa Fish Fry\r\nilish mach fry\r\nilish mach vaga'),
(7, 'Full Chicken Roast', 'Full_Chicken_Roast.JPG', '400.00', 'Full Chicken Roast\nfull murgi roast\nfull morgi roast\nasta murgi\nasta morgi\nasta murgir roast\nasta morgir roast\nFull Chicken Rost\nfull murgi rost\nfull morgi rost\nasta murgir rost\nasta morgir rost'),
(8, 'Full Mutton Roast', 'Full_Mutton_Roast.jpg', '4500.00', 'Full Mutton Roast\r\nFull Mutton Rost\r\nFull khasir Roast\r\nFull khasir Rost\r\nFull kasir Roast\r\nFull kasir Rost\r\nFull khasi\r\nFull kasi\r\nasta khasi\r\nasta kasi\r\nasta mutton\r\nasta roast\r\nasta rost'),
(9, 'Full Hilsa Fry', 'Hilsha-full.jpg', '1000.00', 'Full Hilsa Fish Fry\r\nFull ilish fish Fry\r\nasta ilish fish fry\r\nasta hilsha fish\r\nfull hilsha fish\r\nfull hilsha fish fry'),
(10, 'Cup Doi', 'doi.jpg', '25.00', 'Cup Doi\r\ncup dodhi\r\nCup yogurt\r\nCup Dodi'),
(11, 'Prawn Korma', 'PrawnKorma.jpg', '150.00', 'Prawn Korma\r\nshrimp korma\r\nchingri korma\r\nPrawn corma\r\nshrimp corma\r\nchingri corma'),
(12, 'Mutton Vuna', 'muttonVuna.jpg', '100.00', 'Mutton Vuna\r\nkhasir vuna\r\nkhasit torkari\r\nmutton torkari'),
(13, 'Naan Roti', 'naan.jpg', '30.00', 'Naan Roti\r\nnan ruti\r\nnaan ruti\r\nnan rooti\r\nnaan ruti'),
(14, 'Chicken BBQ', 'bbq-roasted-chicken.jpg', '100.00', 'Chicken BBQ\r\nmurgi BBQ\r\nmorgi bbq\r\nmurgi vaga\r\nmorgi vaga'),
(15, 'Pakki Biriyani', 'pakki-biriyani.jpg', '190.00', 'Pakki Biriyani\r\nPakki Birani\r\nrice'),
(16, 'Fruit Salad', 'FruitSalad.jpg', '50.00', 'Fruit Salad\r\nfoler salad'),
(17, 'Chinese Vegetables', 'Chinese Vegetables.jpg', '30.00', 'Chinese Vegetables\r\nchinese sobji\r\nchinese sobgi'),
(18, 'Alu Bukhara Chatni', 'Alu Bukhara Chatni.jpg', '20.00', 'Alu Bukhara Chatni\r\nAlu Bukhara Chatny\r\nmojar chatni\r\ntasty chatni'),
(19, 'Cup Phirni', 'Cup Firni.jpg', '40.00', 'Cup Phirni\r\nCup firni'),
(20, 'Mutton Glassy', 'Khasir-Glassy.jpg', '150.00', 'Mutton Glassy\r\nkhasir glassy\r\nMutton Glasy\r\nkhasir glasy\r\n'),
(21, 'Beef Rezala', 'Beef Rezala.jpg', '85.00', 'Beef Rezala\r\ngorur rezala'),
(22, 'Beef Vuna', 'beef vuna.jpg', '85.00', 'Beef Vuna\r\ngoru vuna\r\ngorur vuna\r\ngorur torkari\r\ngoru torkari\r\nbeef torkari'),
(23, 'Rui Fry', 'Rui_fish_fry.jpg', '80.00', 'Rui Fish Fry\r\nrui mach fry\r\nrui mach vaga\r\nrui fish vaja\r\nrui mach vaja\r\nrui fish vaga'),
(24, 'Prawn Bhuna', 'Prawn-Bhuna.jpg', '100.00', 'Prawn Bhuna\r\nShrimp Bhuna\r\nChingri Bhuna\r\nChingrir bhuna\r\nPrawn vuna\r\nShrimp vuna\r\nChingri vuna\r\nChingrir vuna\r\nPrawn torkari\r\nShrimp torkari\r\nChingri torkari\r\nChingrir torkari'),
(25, 'Beef Tehari', 'Beef Tehari.jpg', '160.00', 'beef tehari\r\ngorur tehari\r\ngoru tehari\r\nrice'),
(26, 'Mutton Tehari', 'muttin tehari.jpg', '175.00', 'mutton tehari\r\nkhasi tehari\r\nkhasir tehari\r\nrice'),
(27, 'Crumb Fried Chicken', 'Crumbed-Chicken.jpg', '90.00', 'Crumb Fried Chicken\r\nCrumb Fry Chicken\r\nmurgi vaga\r\nmorgi vaga\r\nmurgi vaja\r\nmorgi vaja\r\nCrumb Fried morgi\r\nCrumb Fried murgi\r\nfry morgi\r\nfry murgi'),
(28, 'Plain Rice', 'Plain Rice.jpg', '30.00', 'Plain Rice\r\nplain vat\r\nplain vaat\r\nsada vat\r\nsada vaat\r\nhuda vaat\r\nhuda vat'),
(29, 'Ghono Dal', 'Yellow-Dal.jpg', '20.00', 'Yellow Dal\r\nghono dal\r\nYellow Daal\r\nghono daal\r\nYellow Dail\r\nghono dail\r\n\r\n'),
(30, 'Handi Gola Kabab', 'Handi-gola-kabab.jpg', '150.00', 'Handi gola kabab\r\nHandi gola kebab\r\n'),
(31, 'Piece Salad', 'piece-salad.jpg', '12.00', 'piece salad\r\ncucumber tomato carrot salad\r\ncucumber salad\r\ntomato salad\r\ncarrot salad\r\nhuda salad\r\nsosar salad\r\nsoshar salad\r\ngajorer salad\r\ngajor salad\r\ntomato salad\r\ntomator salad'),
(32, 'Raita Salad', 'raita-salad.jpg', '20.00', 'Raita Salad\r\nraitar salad'),
(33, 'Makha Salad', 'makha-salad.gif', '15.00', 'Makha Salad\r\nmakhano salad\r\ncucumber tomato carrot salad\r\ncucumber salad\r\ntomato salad\r\nhuda salad\r\nsosar salad\r\nsoshar salad\r\ntomato salad\r\ntomator salad'),
(34, 'Kacchi Biryani', 'Kacchi-Biryani.jpg', '200.00', 'Kacchi Biryani\r\nkacchi birani\r\nmutton kacchi\r\nkhasir kacchi\r\nkhasi kacchi\r\nrice'),
(35, 'Tiger Shrimp BBQ Full', 'giant-shrimp-grilled.jpg', '200.00', 'Tiger Shrimp BBQ Full\r\nTiger Prawn BBQ Full\r\nTiger Shrimp bar b q Full\r\nTiger Shrimp barbecue Full\r\nTiger prawn bar b q Full\r\nTiger prawn barbecue Full\r\nTiger chingri BBQ Full\r\nTiger chingri bar b q Full\r\nTiger chingri barbecue Full\r\nTiger chingrir BBQ Full\r\nTiger chingrir bar b q Full\r\nTiger chingrir barbecue Full'),
(36, 'Paan', 'paan.JPG', '25.00', 'paan pata\r\npan pata\r\npaan supari\r\npan supari');

-- --------------------------------------------------------

--
-- Stand-in structure for view `addi_food`
--
CREATE TABLE `addi_food` (
`am_id` int(11)
,`am_title` text
,`am_image` text
,`am_price` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `addi_food_full`
--
CREATE TABLE `addi_food_full` (
`am_id` int(11)
,`am_title` text
,`am_image` text
,`am_price` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `a_id` int(11) NOT NULL,
  `a_user` text NOT NULL,
  `a_pass` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`a_id`, `a_user`, `a_pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `advantages`
--

CREATE TABLE `advantages` (
  `adv_id` int(11) NOT NULL,
  `adv_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advantages`
--

INSERT INTO `advantages` (`adv_id`, `adv_desc`) VALUES
(1, '24 hours lift facility'),
(2, 'Internal Sound System'),
(3, 'Car Parking Facility'),
(4, '24 hrs trained guard service'),
(5, '24 hrs standby generator (without AC)');

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_booking_info`
--
CREATE TABLE `all_booking_info` (
`order_id` int(11)
,`order_date` date
,`order_purpose` text
,`total_cost` decimal(10,2)
,`paid_cost` decimal(10,2)
,`date_of_booking` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `approve_bookings`
--
CREATE TABLE `approve_bookings` (
`order_id` int(11)
,`order_date` date
,`order_purpose` text
,`total_cost` decimal(10,2)
,`paid_cost` decimal(10,2)
,`date_of_booking` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `complete_booking`
--
CREATE TABLE `complete_booking` (
`order_id` int(11)
,`order_date` date
,`order_purpose` text
,`total_cost` decimal(10,2)
,`paid_cost` decimal(10,2)
,`date_of_booking` date
);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `f_id` int(11) NOT NULL,
  `f_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`f_id`, `f_desc`) VALUES
(1, 'Stage Decoration, Extra Lighting, Projector, Red Carpet etc.'),
(2, 'You have to pay only 25% advanced for booking'),
(3, 'If you want to change the date then you will have to inform it to the manager');

-- --------------------------------------------------------

--
-- Table structure for table `gate`
--

CREATE TABLE `gate` (
  `g_id` int(11) NOT NULL,
  `g_title` text NOT NULL,
  `g_image` text NOT NULL,
  `g_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gate`
--

INSERT INTO `gate` (`g_id`, `g_title`, `g_image`, `g_price`) VALUES
(1, 'Gate 1', 'gate1.jpg', '100000.00'),
(2, 'Gate 2', 'gate2.jpg', '10000.00'),
(3, 'Gate 3', 'gate3.jpg', '5000.00'),
(4, 'Gate 4', 'gate4.jpg', '20000.00'),
(5, 'Gate 5', 'gate5.jpg', '30000.00'),
(6, 'Gate 6', 'gate6.jpeg', '10000.00'),
(7, 'Gate 7', 'gate7.jpg', '15000.00'),
(34, 'Gate 9', '173092000009.jpg', '65000.00'),
(30, 'Gate 8', 'gate8.jpg', '10000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `gate_view`
--
CREATE TABLE `gate_view` (
`g_id` int(11)
,`g_title` text
,`g_image` text
,`g_price` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `hall_booking`
--

CREATE TABLE `hall_booking` (
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_shift` text NOT NULL,
  `order_purpose` text NOT NULL,
  `services` text NOT NULL,
  `guest_number` int(11) NOT NULL,
  `welcome_gate` int(11) NOT NULL,
  `stage` int(11) NOT NULL,
  `food` text NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '1',
  `total_cost` decimal(10,2) NOT NULL,
  `paid_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fullFood` text NOT NULL,
  `set_menu` int(11) NOT NULL,
  `date_of_booking` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall_booking`
--

INSERT INTO `hall_booking` (`user_id`, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `guest_number`, `welcome_gate`, `stage`, `food`, `order_status`, `total_cost`, `paid_cost`, `fullFood`, `set_menu`, `date_of_booking`) VALUES
(1, 13, '2016-02-27', 'Evening 7:00 PM to 11:30 PM', 'Gaye Holud', '61|2|3', 300, 0, 7, '18|26', 2, '94875.00', '25000.00', '7|0;9|0;8|0;35|0', 0, '2016-02-17'),
(3, 12, '2016-02-29', 'Day 12:00 PM to 4:30 PM', 'Birthday Party', '1|2|3', 200, 6, 0, '0', 3, '164910.00', '164910.00', '7|1;9|0;8|0;35|0', 1, '2016-02-17'),
(3, 11, '2016-02-29', 'Evening 7:00 PM to 11:30 PM', 'Wedding Ceremony', '61|2|3', 500, 2, 3, '18|17|36', 1, '378350.00', '0.00', '7|5;9|0;8|1;35|0', 3, '2016-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE `misc` (
  `misc_id` int(11) NOT NULL,
  `misc_vat` double NOT NULL,
  `misc_extra_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`misc_id`, `misc_vat`, `misc_extra_cost`) VALUES
(1, 15, '50.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_date_shift`
--
CREATE TABLE `order_date_shift` (
`order_id` int(11)
,`order_date` date
,`order_shift` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pending_bookings`
--
CREATE TABLE `pending_bookings` (
`order_id` int(11)
,`order_date` date
,`order_purpose` text
,`total_cost` decimal(10,2)
,`paid_cost` decimal(10,2)
,`date_of_booking` date
);

-- --------------------------------------------------------

--
-- Table structure for table `puposes`
--

CREATE TABLE `puposes` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puposes`
--

INSERT INTO `puposes` (`p_id`, `p_name`) VALUES
(1, 'Wedding Ceremony'),
(2, 'Gaye Holud'),
(3, 'Birthday Party'),
(4, 'Office Party'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Stand-in structure for view `purpose_view`
--
CREATE TABLE `purpose_view` (
`p_name` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `schedule_view`
--
CREATE TABLE `schedule_view` (
`shift_id` int(11)
,`shift_name` text
,`shift_time` text
);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serv_id` int(11) NOT NULL,
  `serv_name` text NOT NULL,
  `Serv_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serv_id`, `serv_name`, `Serv_price`) VALUES
(1, 'Hall Charge', '50000.00'),
(2, 'Service Charge (Per Person)', '30.00'),
(3, 'Kitchen Charge(Upto 500 Persons)', '5000.00'),
(4, 'Kitchen Charge(Upto 1000 Persons)', '10000.00'),
(5, 'Extra Lighting', '10000.00'),
(6, 'Projector', '1500.00'),
(7, 'Red Carpet', '5000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `service_view`
--
CREATE TABLE `service_view` (
`serv_id` int(11)
,`serv_name` text
,`Serv_price` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `set_menu`
--

CREATE TABLE `set_menu` (
  `sm_id` bigint(20) NOT NULL,
  `sm_title` text NOT NULL,
  `sm_description` text NOT NULL,
  `sm_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_menu`
--

INSERT INTO `set_menu` (`sm_id`, `sm_title`, `sm_description`, `sm_price`) VALUES
(1, 'Set Menu 1', 'Plain Fried Rice|Chicken Roast|Mutton Rezala|Tikka Kebab|Piece Salad|Jorda|Borhani|Water, paan, Tissue', '360.00'),
(2, 'Set Menu 2', 'Mutton kacchi|Chicken Roast|Zali Kebab|Piece Salad|Jorda|Borhani|Water, paan, Tissue', '390.00'),
(3, 'Set Menu 3', 'Morog Polao|Mutton Rezala|Nargis Kebab|Piece Salad|Jorda|Borhani|Firni|Water, paan, Tissue', '450.00');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` text NOT NULL,
  `shift_time` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `shift_time`) VALUES
(1, 'Day', '12:00 PM to 4:30 PM'),
(2, 'Evening', '7:00 PM to 11:30 PM'),
(3, 'Mid-Night', '1:00 AM to 5:30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `st_id` int(11) NOT NULL,
  `st_title` text NOT NULL,
  `st_image` text NOT NULL,
  `st_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`st_id`, `st_title`, `st_image`, `st_price`) VALUES
(1, 'Stage 1', 'stage1.jpg', '100000.00'),
(2, 'Stage 2', 'stage2.jpg', '50000.00'),
(3, 'Stage 3', 'stage3.jpg', '30000.00'),
(4, 'Stage 4', 'stage4.jpg', '80000.00'),
(5, 'Stage 5', 'stage5.jpg', '20000.00'),
(6, 'Stage 6', 'stage6.jpg', '70000.00'),
(7, 'Stage 7', 'stage7.jpg', '10000.00'),
(8, 'Stage 8', 'stage8.jpg', '60000.00'),
(9, 'Stage 9', 'stage9.jpg', '120000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `stage_view`
--
CREATE TABLE `stage_view` (
`st_id` int(11)
,`st_title` text
,`st_image` text
,`st_price` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_cond` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_cond`) VALUES
(1, 'Pending'),
(2, 'Approve'),
(3, 'Complete'),
(4, 'Unaprove');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_fname` text NOT NULL,
  `u_lname` text NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_contact` text NOT NULL,
  `u_pass` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `time_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_fname`, `u_lname`, `u_email`, `u_contact`, `u_pass`, `s_id`, `time_of_registration`) VALUES
('Saleh', 'Oyon', 'salehoyon@hotmail.com', '+880-1520103065', '$2y$10$02uWh7z4FOADl4eusus1aOFgucFFp7/zb1751lBoXx1Bpx1ASbcTC', 1, '2016-02-17 18:59:40'),
('Sakib', 'Hasan', 'sakibhasan60@yahoo.com', '+880-1199080237', '$2y$10$U.hWpcMChAZRnSglDukDROvmZFm3yXZbYd5ehPI64jEZI.LtkwlpK', 2, '2016-02-17 18:59:45'),
('Saleh', 'Ahmad', 'nissongo102@gmail.com', '+880-1626785569', '$2y$10$/H/wb3pjIscHSTxiLG51G.PcqohYJ4W2iInxwEScH3l7ZKSP72zv2', 3, '2016-02-17 18:59:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_user`
--
CREATE TABLE `view_all_user` (
`u_fname` text
,`u_lname` text
,`u_email` varchar(255)
,`u_contact` text
,`time_of_registration` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `addi_food`
--
DROP TABLE IF EXISTS `addi_food`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addi_food`  AS  select `additional_menu`.`am_id` AS `am_id`,`additional_menu`.`am_title` AS `am_title`,`additional_menu`.`am_image` AS `am_image`,`additional_menu`.`am_price` AS `am_price` from `additional_menu` where (not((`additional_menu`.`am_title` like '%full%'))) order by `additional_menu`.`am_title` ;

-- --------------------------------------------------------

--
-- Structure for view `addi_food_full`
--
DROP TABLE IF EXISTS `addi_food_full`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addi_food_full`  AS  select `additional_menu`.`am_id` AS `am_id`,`additional_menu`.`am_title` AS `am_title`,`additional_menu`.`am_image` AS `am_image`,`additional_menu`.`am_price` AS `am_price` from `additional_menu` where (`additional_menu`.`am_title` like '%full%') order by `additional_menu`.`am_title` ;

-- --------------------------------------------------------

--
-- Structure for view `all_booking_info`
--
DROP TABLE IF EXISTS `all_booking_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_booking_info`  AS  select `hall_booking`.`order_id` AS `order_id`,`hall_booking`.`order_date` AS `order_date`,`hall_booking`.`order_purpose` AS `order_purpose`,`hall_booking`.`total_cost` AS `total_cost`,`hall_booking`.`paid_cost` AS `paid_cost`,`hall_booking`.`date_of_booking` AS `date_of_booking` from `hall_booking` order by `hall_booking`.`order_id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `approve_bookings`
--
DROP TABLE IF EXISTS `approve_bookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `approve_bookings`  AS  select `hall_booking`.`order_id` AS `order_id`,`hall_booking`.`order_date` AS `order_date`,`hall_booking`.`order_purpose` AS `order_purpose`,`hall_booking`.`total_cost` AS `total_cost`,`hall_booking`.`paid_cost` AS `paid_cost`,`hall_booking`.`date_of_booking` AS `date_of_booking` from `hall_booking` where (`hall_booking`.`order_status` = 2) order by `hall_booking`.`order_id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `complete_booking`
--
DROP TABLE IF EXISTS `complete_booking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `complete_booking`  AS  select `hall_booking`.`order_id` AS `order_id`,`hall_booking`.`order_date` AS `order_date`,`hall_booking`.`order_purpose` AS `order_purpose`,`hall_booking`.`total_cost` AS `total_cost`,`hall_booking`.`paid_cost` AS `paid_cost`,`hall_booking`.`date_of_booking` AS `date_of_booking` from `hall_booking` where (`hall_booking`.`order_status` = 3) order by `hall_booking`.`order_id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `gate_view`
--
DROP TABLE IF EXISTS `gate_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gate_view`  AS  select `gate`.`g_id` AS `g_id`,`gate`.`g_title` AS `g_title`,`gate`.`g_image` AS `g_image`,`gate`.`g_price` AS `g_price` from `gate` order by `gate`.`g_title` ;

-- --------------------------------------------------------

--
-- Structure for view `order_date_shift`
--
DROP TABLE IF EXISTS `order_date_shift`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_date_shift`  AS  select `hall_booking`.`order_id` AS `order_id`,`hall_booking`.`order_date` AS `order_date`,`hall_booking`.`order_shift` AS `order_shift` from `hall_booking` ;

-- --------------------------------------------------------

--
-- Structure for view `pending_bookings`
--
DROP TABLE IF EXISTS `pending_bookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pending_bookings`  AS  select `hall_booking`.`order_id` AS `order_id`,`hall_booking`.`order_date` AS `order_date`,`hall_booking`.`order_purpose` AS `order_purpose`,`hall_booking`.`total_cost` AS `total_cost`,`hall_booking`.`paid_cost` AS `paid_cost`,`hall_booking`.`date_of_booking` AS `date_of_booking` from `hall_booking` where (`hall_booking`.`order_status` = 1) order by `hall_booking`.`order_id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `purpose_view`
--
DROP TABLE IF EXISTS `purpose_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purpose_view`  AS  select `puposes`.`p_name` AS `p_name` from `puposes` ;

-- --------------------------------------------------------

--
-- Structure for view `schedule_view`
--
DROP TABLE IF EXISTS `schedule_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `schedule_view`  AS  select `shift`.`shift_id` AS `shift_id`,`shift`.`shift_name` AS `shift_name`,`shift`.`shift_time` AS `shift_time` from `shift` ;

-- --------------------------------------------------------

--
-- Structure for view `service_view`
--
DROP TABLE IF EXISTS `service_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `service_view`  AS  select `services`.`serv_id` AS `serv_id`,`services`.`serv_name` AS `serv_name`,`services`.`Serv_price` AS `Serv_price` from `services` ;

-- --------------------------------------------------------

--
-- Structure for view `stage_view`
--
DROP TABLE IF EXISTS `stage_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stage_view`  AS  select `stage`.`st_id` AS `st_id`,`stage`.`st_title` AS `st_title`,`stage`.`st_image` AS `st_image`,`stage`.`st_price` AS `st_price` from `stage` order by `stage`.`st_title` ;

-- --------------------------------------------------------

--
-- Structure for view `view_all_user`
--
DROP TABLE IF EXISTS `view_all_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_user`  AS  select `user`.`u_fname` AS `u_fname`,`user`.`u_lname` AS `u_lname`,`user`.`u_email` AS `u_email`,`user`.`u_contact` AS `u_contact`,`user`.`time_of_registration` AS `time_of_registration` from `user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_menu`
--
ALTER TABLE `additional_menu`
  ADD PRIMARY KEY (`am_id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `advantages`
--
ALTER TABLE `advantages`
  ADD PRIMARY KEY (`adv_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `gate`
--
ALTER TABLE `gate`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `hall_booking`
--
ALTER TABLE `hall_booking`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `misc`
--
ALTER TABLE `misc`
  ADD PRIMARY KEY (`misc_id`);

--
-- Indexes for table `puposes`
--
ALTER TABLE `puposes`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serv_id`);

--
-- Indexes for table `set_menu`
--
ALTER TABLE `set_menu`
  ADD PRIMARY KEY (`sm_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `u_email` (`u_email`),
  ADD UNIQUE KEY `u_email_2` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_menu`
--
ALTER TABLE `additional_menu`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Additional Menu ID', AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advantages`
--
ALTER TABLE `advantages`
  MODIFY `adv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gate`
--
ALTER TABLE `gate`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `hall_booking`
--
ALTER TABLE `hall_booking`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `misc`
--
ALTER TABLE `misc`
  MODIFY `misc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `puposes`
--
ALTER TABLE `puposes`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `set_menu`
--
ALTER TABLE `set_menu`
  MODIFY `sm_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
