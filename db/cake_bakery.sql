-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 05:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(45) DEFAULT NULL,
  `UserName` varchar(45) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8849248511, 'admin1234@gmail.com', '0192023a7bbd73250516f069df18b500', '2024-10-01 02:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(5) NOT NULL,
  `CategoryName` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `CreationDate`) VALUES
(1, 'Eggless cake', '2025-04-03 06:29:06'),
(2, 'Kids Cake', '2025-04-03 06:29:28'),
(3, 'Photo Cake', '2025-04-03 06:29:35'),
(4, 'Premium Cake', '2025-04-03 06:29:43'),
(5, 'Cup Cake', '2025-04-03 06:29:53'),
(6, 'First Birthday Cake', '2025-04-03 06:30:12'),
(7, 'Midnight Cake', '2025-04-03 06:30:19'),
(9, 'First Anniversary Cake', '2025-04-04 09:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`, `reply`) VALUES
(1, 'dgijrgf', 'Keyurpipaliya32@gmail.com', 'wejfrgred', '2025-03-17 17:36:41', 1, NULL),
(2, 'bhumi', 'bhumikasanjaybhai121212@gmail.com', 'hello', '2025-03-18 02:34:45', 1, 'hello'),
(3, 'keyur', 'Keyurpipaliya32@gmail.com', 'hello\r\n', '2025-03-25 18:15:50', 1, 'hello\r\n'),
(4, 'hi', 'Keyurpipaliya500@gmail.com', 'hi', '2025-03-25 18:30:07', 1, 'hi'),
(14, 'keyur', 'Keyurpipaliya32@gmail.com', 'cvxcb', '2025-03-27 18:05:19', 1, NULL),
(15, 'harsh', 'harsh123@gmail.com', 'hey shop time', '2025-03-27 18:10:58', 1, 'hey shop time is 8 am to 10 pm'),
(16, 'Keyur', 'Keyurpipaliya32@gmail.com', 'uyttg', '2025-04-03 12:28:02', 1, NULL),
(17, 'KEYUR', 'Keyurpipaliya32@gmail.com', 'HELLO', '2025-04-04 14:49:17', 1, 'hello\r\n'),
(18, 'bhut', 'bhumikasanjaybhai121212@gmail.com', '12345', '2025-04-04 15:11:27', 1, 'hello'),
(19, 'Keyur', 'Keyurpipaliya32@gmail.com', 'hello', '2025-04-04 17:17:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryboys`
--

CREATE TABLE `tbldeliveryboys` (
  `ID` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldeliveryboys`
--

INSERT INTO `tbldeliveryboys` (`ID`, `Name`, `Email`, `Phone`, `Password`, `Address`, `Status`, `RegDate`) VALUES
(4, 'Keyur Pipaliya', 'Keyurpipaliya32@gmail.com', '06353732077', '202cb962ac59075b964b07152d234b70', 'A 808\r\nSuman nisarg', 'Approved', '2025-03-27 21:10:45'),
(5, 'parth', 'parth1234@gmail.com', '9685741236', '202cb962ac59075b964b07152d234b70', 'kandfgdfg', 'Approved', '2025-03-28 04:40:57'),
(6, 'lakhman', 'lakhman123@gmail.com', '6353732077', '202cb962ac59075b964b07152d234b70', 'ayodhya', 'Approved', '2025-03-30 16:54:05'),
(7, 'bhumi', 'bhumi123@gmail.com', '9898255401', '202cb962ac59075b964b07152d234b70', 'yamuna', 'Approved', '2025-03-30 19:03:02'),
(8, 'meet', 'meet123@gmail.com', '9876543456', '202cb962ac59075b964b07152d234b70', 'avdhut', 'Approved', '2025-04-01 03:44:33'),
(9, 'Linda Pierce', 'holyqadid@mailinator.com', '+1 (855) 495-9224', '202cb962ac59075b964b07152d234b70', 'Porro nisi voluptate', 'Pending', '2025-04-04 17:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblfood`
--

CREATE TABLE `tblfood` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(120) DEFAULT NULL,
  `ItemName` varchar(120) DEFAULT NULL,
  `ItemPrice` varchar(120) DEFAULT NULL,
  `ItemDes` varchar(500) DEFAULT NULL,
  `Image` varchar(120) DEFAULT NULL,
  `ItemQty` varchar(120) DEFAULT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfood`
--

INSERT INTO `tblfood` (`ID`, `CategoryName`, `ItemName`, `ItemPrice`, `ItemDes`, `Image`, `ItemQty`, `Weight`, `CreationDate`) VALUES
(1, 'Eggless cake', 'fruit cake', '1000', 'A delicious cake made without eggs, perfect for vegetarians.                                                 	', 'b8c7bd97c0d64afadf2f788153cf7e72.jpg', '1', '1 kg', '2025-04-04 10:12:40'),
(2, 'Eggless cake', 'Chocolate cake', '750', 'A delicious cake made without eggs, perfect for vegetarians.', '6c22c2199e8fa8ebf4df2c09e1db231f.jpg', '1', '1 kg', '2025-04-04 10:13:48'),
(3, 'Kids Cake', 'Mickey mouse cake', '250', 'Fun and colorful cakes designed especially for children’s birthdays.                                                 	', 'f74da79571b1f8647176404c1388f82b.jpg', '1', '1 kg', '2025-04-04 10:14:30'),
(4, 'Kids Cake', 'face cake', '400', 'Fun and colorful cakes designed especially for children’s birthdays.                                                 	', '38b61c4fdedf5b1e96216eee362d742e.jpg', '1', '1 kg', '2025-04-04 10:15:09'),
(5, 'Photo Cake', 'love photo cake', '800', 'Personalized cakes with edible photo prints for special moments.                                                 	', '0fe8f2013b462a76b82fc6bf64854fe0.jpg', '1', '1 kg', '2025-04-04 10:16:19'),
(6, 'Photo Cake', 'family cake', '650', 'Personalized cakes with edible photo prints for special moments.                                                 	', 'ef7fb8359b6aad2cffd3ba1d4dcc8cce.jpg', '1', '1 kg', '2025-04-04 10:16:45'),
(7, 'Premium Cake', 'supar deluxe cake', '400', ' Luxurious cakes made with high-quality ingredients and elegant designs.                                                 	', '67aefc43eedf11219dd0b7628eb241a3.jpg', '1', '1 kg', '2025-04-04 10:17:52'),
(8, 'Premium Cake', 'strawberry cake', '450', '&nbsp;Luxurious cakes made with high-quality ingredients and elegant designs.                                                 	', 'da8431828c4a5b2cccb920ec40113ffc.jpg', '1', '1 kg', '2025-04-04 10:19:02'),
(9, 'Cup Cake', 'Chocolate cup cake', '200', 'Small, single-serving cakes available in various flavors and toppings.                                                 	', '5841d7d1db8048253b0e1828ff668de8.jpg', '1', '1 kg', '2025-04-04 10:19:47'),
(10, 'Cup Cake', 'butterscotch cup cake', '300', 'Small, single-serving cakes available in various flavors and toppings.                                                 	', '1a83f7679c1c8653153372b19b4b6293.jpg', '1', '1 kg', '2025-04-04 10:20:20'),
(11, 'First Birthday Cake', 'cartoon cake', '800', 'Special cakes designed to celebrate a baby’s first birthday.                                                 	', '4005ba39101cb34a2432a4de1ef8513e.jpg', '1', '1 kg', '2025-04-04 10:21:04'),
(12, 'First Birthday Cake', 'orange cake', '400', 'Special cakes designed to celebrate a baby’s first birthday.                                                 	', '5a8dc82852d1c0a42b41d8ca17a1dfa4.jpg', '1', '1 kg', '2025-04-04 10:21:43'),
(13, 'Midnight Cake', 'crunchy cake', '2000', 'Cakes delivered at midnight for surprise celebrations.                                                 	', 'ff69ea0dca8f5b5bb5027e8582b9106c.jpg', '1', '1 kg', '2025-04-04 10:23:02'),
(14, 'Midnight Cake', 'cherry cake', '760', 'Cakes delivered at midnight for surprise celebrations.                                                 	', 'd018adb962e8eb438aee03fb9448776c.jpg', '1', '1 kg', '2025-04-04 10:23:44'),
(15, 'First Anniversary Cake', 'wedding cake', '650', 'Romantic cakes to celebrate a couple’s first anniversary                                                 	', 'ff09a0261c2f0114afeca11692ccd345.jpg', '1', '1 kg', '2025-04-04 10:24:35'),
(16, 'First Anniversary Cake', 'couple cake', '500', 'Romantic cakes to celebrate a couple’s first anniversary                                                 	', 'a0f686a732e511c9299d2e7afdfccee6.jpg', '1', '1 kg', '2025-04-04 10:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblfoodtracking`
--

CREATE TABLE `tblfoodtracking` (
  `ID` int(10) NOT NULL,
  `OrderId` char(50) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `StatusDate` timestamp NULL DEFAULT current_timestamp(),
  `OrderCanclledByUser` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfoodtracking`
--

INSERT INTO `tblfoodtracking` (`ID`, `OrderId`, `remark`, `status`, `StatusDate`, `OrderCanclledByUser`) VALUES
(1, '158752434', 'fghj', 'Order Confirmed', '2025-04-03 11:45:52', NULL),
(2, '158752434', 'fdf', 'Cake being Prepared', '2025-04-03 20:35:11', NULL),
(3, '156703337', 'defghjgfd', 'Order Confirmed', '2025-04-04 02:48:16', NULL),
(4, '156703337', 'jhgfdfghgfdkjhgfd', 'Cake being Prepared', '2025-04-04 02:53:01', NULL),
(5, '156703337', 'ertyrewefrghgfd', 'Cake Pickup', '2025-04-04 02:53:14', NULL),
(6, '156703337', 'hgfdfghgfd', 'Cake Delivered', '2025-04-04 02:55:55', NULL),
(7, '443976436', 'xcvcdvbc', 'Order Cancelled', '2025-04-04 02:57:50', NULL),
(8, '793183964', 'hgfdf', 'Order Confirmed', '2025-04-04 12:55:29', NULL),
(9, '928855889', 'dfghjkhgfd', 'Order Confirmed', '2025-04-04 16:47:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblorderaddresses`
--

CREATE TABLE `tblorderaddresses` (
  `ID` int(11) NOT NULL,
  `UserId` char(100) DEFAULT NULL,
  `Ordernumber` varchar(50) DEFAULT NULL,
  `Flatnobuldngno` varchar(255) DEFAULT NULL,
  `StreetName` varchar(255) DEFAULT NULL,
  `Area` varchar(255) DEFAULT NULL,
  `Landmark` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `OrderTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `OrderFinalStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblorderaddresses`
--

INSERT INTO `tblorderaddresses` (`ID`, `UserId`, `Ordernumber`, `Flatnobuldngno`, `StreetName`, `Area`, `Landmark`, `City`, `OrderTime`, `OrderFinalStatus`) VALUES
(1, '4', '158752434', '', '', '', '', '', '2025-04-03 06:59:30', 'Cake being Prepared'),
(2, '4', '156703337', '', '', '', '', '', '2025-04-03 09:41:25', 'Cake Delivered'),
(3, '4', '443976436', '', '', '', '', '', '2025-04-03 11:34:53', 'Order Cancelled'),
(4, '4', '268827701', '', '', '', '', '', '2025-04-03 11:37:15', NULL),
(5, '4', '609414254', '808 suman nisarg', 'katargam', 'surat', 'surat', 'Surat', '2025-04-03 20:19:57', NULL),
(6, '4', '793183964', '808 suman nisarg', 'katargam', 'surat', 'surat', 'Surat', '2025-04-04 12:54:25', 'Order Confirmed'),
(7, '4', '928855889', '808 suman nisarg', 'katargam', 'surat', 'surat', 'Surat', '2025-04-04 16:08:13', 'Order Confirmed'),
(8, '6', '914880451', '540', 'Daquan Alvarez', 'Itaque sunt sint quo', 'Door ', 'Eaque ex sit ut iure', '2025-04-04 17:47:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `ID` int(11) NOT NULL,
  `UserId` char(10) DEFAULT NULL,
  `FoodId` char(10) DEFAULT NULL,
  `IsOrderPlaced` int(11) DEFAULT NULL,
  `OrderNumber` char(100) DEFAULT NULL,
  `CashonDelivery` varchar(100) DEFAULT 'Online ',
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Weight` varchar(30) NOT NULL,
  `Price` int(30) NOT NULL,
  `Quantity` int(11) DEFAULT 1,
  `PaymentMethod` varchar(50) DEFAULT 'Online Razorpay ',
  `PaymentID` varchar(255) DEFAULT NULL,
  `DeliveryBoyId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`ID`, `UserId`, `FoodId`, `IsOrderPlaced`, `OrderNumber`, `CashonDelivery`, `OrderDate`, `Weight`, `Price`, `Quantity`, `PaymentMethod`, `PaymentID`, `DeliveryBoyId`) VALUES
(1, '4', '2', 1, '158752434', 'Online ', '2025-04-03 06:59:00', '1kg', 525, 1, 'Online Razorpay ', 'pay_QEUhzCprpyZOX8', 8),
(2, '4', '2', 1, '156703337', 'Online ', '2025-04-03 09:40:28', '500g', 263, 1, 'Online Razorpay ', 'pay_QEXSx8p64Ei2qu', 5),
(6, '4', '1', 1, '443976436', 'Online ', '2025-04-03 11:31:38', '500g', 263, 1, 'Online Razorpay ', 'pay_QEZOtDZy7z3men', NULL),
(7, '4', '2', 1, '268827701', 'Online ', '2025-04-03 11:36:51', '500g', 263, 1, 'Online Razorpay ', 'pay_QEZROON3uKmTOD', NULL),
(18, '4', '2', 1, '609414254', 'Online ', '2025-04-03 12:55:17', '500g', 263, 1, 'Online Razorpay ', 'pay_QEiLXmdrCkKCRO', NULL),
(20, '4', '3', 1, '609414254', 'Online ', '2025-04-03 20:19:14', '1kg', 893, 1, 'Online Razorpay ', 'pay_QEiLXmdrCkKCRO', NULL),
(21, '4', '1', 1, '793183964', 'Online ', '2025-04-04 11:08:34', '1kg', 1050, 1, 'Online Razorpay ', 'pay_QEzI3SsQdYrGLr', 4),
(22, '22', '2', NULL, NULL, 'Online ', '2025-04-04 11:11:51', '500g', 394, 1, 'Online Razorpay ', NULL, NULL),
(23, '4', '2', 1, '928855889', 'Online ', '2025-04-04 16:07:17', '500g', 394, 1, 'Online Razorpay ', 'pay_QF2am11CGfPTlb', 4),
(24, '6', '1', 1, '914880451', 'Online ', '2025-04-04 17:45:25', '500g', 525, 1, 'Online Razorpay ', 'pay_QF4Ho03TVZt8NR', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', ' ', '<h4 style=\"text-align: center;\"><p class=\"MsoNormal\"><b>Your order is\r\ndelivered in 5 to 6 hours.&nbsp;.&nbsp;We provide you a trustworthy and\r\nconvenient platform to choose best gift for your family, friends etc. for every\r\noccasion like birthdays, anniversaries, marriage, love, farewell and many more.\r\nWe offer wide range of products in various categories like , eggless cake ,\r\nkids cake , photo cake , premium cake , cup cake , first birthday cake , &nbsp;collectibles, chocolates, bouquet, flowers\r\nbunch, soft toys, greeting cards, candles, photo frames, handicrafts etc. We\r\nalso customize gifts according to customer wish<o:p></o:p></b></p></h4>', NULL, NULL, '2025-04-04 10:31:33'),
(2, 'contactus', 'Contact Us', '12 , NILKANTH_BUSINESS_HUB , KATARGAM , SURAT 395003', 'cake_bakery_2024-2025@gmail.com', 91635332077, '2025-04-04 14:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `ID` int(5) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`ID`, `Email`, `DateofSub`) VALUES
(1, 'Hiren223@gmai.com', '2024-10-11 14:54:38'),
(2, 'Harshil289@gmail.com', '2024-10-11 14:55:01'),
(3, 'Bhumika888@gmail.com', '2024-10-11 14:55:22'),
(4, 'Kuldip55@gmail.com', '2024-10-11 14:55:38'),
(5, 'Neel226@gmail.com', '2024-10-11 14:56:03'),
(8, 'Keyurpipaliya32@gmail.com', '2025-04-03 07:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` text DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `LastName`, `Email`, `MobileNumber`, `Password`, `RegDate`, `status`) VALUES
(3, 'Keyur', 'Pipaliya', 'Keyurpipaliya32@gmail.com', 6886632055, '202cb962ac59075b964b07152d234b70', '2025-03-17 17:18:16', 'deleted'),
(4, 'bhumi', 'prajapati', 'bhumikasanjaybhai121212@gmail.co', 9898255401, '81dc9bdb52d04dc20036dbd8313ed055', '2025-03-18 02:30:08', 'active'),
(5, 'keyur', 'patel', 'rekhaben683@gmail.com', 8529674856, '202cb962ac59075b964b07152d234b70', '2025-03-18 05:24:26', 'active'),
(6, 'Keyur', 'Pipaliya', 'Keyurpipaliya500@gmail.com', 6353732077, '202cb962ac59075b964b07152d234b70', '2025-03-25 18:23:14', 'active'),
(14, 'harsh', 'patel', 'harsh123@gmail.com', 9696969696, '202cb962ac59075b964b07152d234b70', '2025-03-27 18:09:26', 'active'),
(15, 'kiran', 'pipaliya', 'kiran123@gmail.com', 9925709298, '202cb962ac59075b964b07152d234b70', '2025-03-28 16:02:21', 'active'),
(16, 'parth', 'parth', 'kaklotarparth2244@gmail.com', 7418529630, '202cb962ac59075b964b07152d234b70', '2025-03-28 16:39:43', 'deleted'),
(17, 'ram', 'ram', 'ram123@gmail.com', 8989898989, '202cb962ac59075b964b07152d234b70', '2025-03-30 16:52:48', 'active'),
(18, 'utsav', 'variya', 'utsav123@gmail.com', 7878789696, '202cb962ac59075b964b07152d234b70', '2025-04-01 03:43:10', 'active'),
(19, 'Suman', 'nisarg', 'suman123@gmail.com', 2525252525, '202cb962ac59075b964b07152d234b70', '2025-04-01 03:55:55', 'active'),
(20, 'rashi', 'rashi', 'rashienterprise2024.online@gmail.com', 1234567898, '202cb962ac59075b964b07152d234b70', '2025-04-03 10:43:51', 'deleted'),
(21, 'hari', 'unagar', 'hari123@gmail.com', 9878987898, '81dc9bdb52d04dc20036dbd8313ed055', '2025-04-03 14:25:22', 'deleted'),
(22, 'dev', 'dev', 'dev123@gmail.com', 8585858585, '202cb962ac59075b964b07152d234b70', '2025-04-04 11:10:48', 'deleted'),
(23, 'Macy', 'Coleman', 'maworuha@mailinator.com', 7534444444, '202cb962ac59075b964b07152d234b70', '2025-04-04 12:59:57', 'deleted'),
(24, 'Shelley', 'Castillo', 'tiruqovat@mailinator.com', 4444444444, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '2025-04-04 16:09:56', 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deleted_users`
--

CREATE TABLE `tbl_deleted_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_deleted_users`
--

INSERT INTO `tbl_deleted_users` (`id`, `user_id`, `email`, `deleted_at`) VALUES
(1, 1, 'parthkaklotar1222@gmail.com ', '2025-03-16 12:05:29'),
(2, 1, 'keyurpipaliya32@gmail.com', '2025-03-16 12:07:07'),
(3, 1, 'hetvighoghari8@gmail.com', '2025-03-16 12:10:39'),
(4, 1, 'keyurpipaliya32@gmail.com', '2025-03-16 12:20:35'),
(5, 2, 'parth@gmail.com', '2025-03-16 14:31:58'),
(6, 1, 'keyurpipaliya32@gmail.com', '2025-03-16 14:33:03'),
(7, 1, 'hetvighoghari8@gmail.com', '2025-03-16 14:50:12'),
(8, 3, 'Keyurpipaliya32@gmail.com', '2025-03-17 23:04:28'),
(9, 20, 'rashienterprise2024.online@gmail.com', '2025-04-04 16:33:16'),
(10, 16, 'kaklotarparth2244@gmail.com', '2025-04-04 22:12:19'),
(11, 24, 'tiruqovat@mailinator.com', '2025-04-04 22:33:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldeliveryboys`
--
ALTER TABLE `tbldeliveryboys`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `tblfood`
--
ALTER TABLE `tblfood`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblfoodtracking`
--
ALTER TABLE `tblfoodtracking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorderaddresses`
--
ALTER TABLE `tblorderaddresses`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserId` (`UserId`,`Ordernumber`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserId` (`UserId`,`FoodId`,`OrderNumber`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_deleted_users`
--
ALTER TABLE `tbl_deleted_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbldeliveryboys`
--
ALTER TABLE `tbldeliveryboys`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblfood`
--
ALTER TABLE `tblfood`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblfoodtracking`
--
ALTER TABLE `tblfoodtracking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblorderaddresses`
--
ALTER TABLE `tblorderaddresses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_deleted_users`
--
ALTER TABLE `tbl_deleted_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
