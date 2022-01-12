-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 06:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kashi`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `photo` varchar(150) NOT NULL,
  `main_slider` int(11) NOT NULL DEFAULT '2',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `photo`, `main_slider`, `creationDate`, `updationDate`) VALUES
(12, 'Sports, Books & More', '', '', 2, '2021-01-27 15:20:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `State_Id` int(11) NOT NULL,
  `City_Name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `State_Id`, `City_Name`) VALUES
(2, 9, 'Varanasi'),
(3, 9, 'Ghazipur');

-- --------------------------------------------------------

--
-- Table structure for table `company_advert`
--

CREATE TABLE `company_advert` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `Rec_Time_Stamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lblcategory`
--

CREATE TABLE `lblcategory` (
  `id` int(11) NOT NULL,
  `Cat_Id` int(11) DEFAULT NULL,
  `Lbl_Cat_Name` varchar(255) DEFAULT NULL,
  `Description` varchar(200) NOT NULL,
  `Rec_Time_Stamp` date DEFAULT NULL,
  `main_slider` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lblcategory`
--

INSERT INTO `lblcategory` (`id`, `Cat_Id`, `Lbl_Cat_Name`, `Description`, `Rec_Time_Stamp`, `main_slider`) VALUES
(20, 12, 'Books', '', '2021-01-27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `sl` bigint(20) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `Invoice_No` varchar(100) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `photo` varchar(200) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `Total_Amount_BeforeDiscount` int(11) NOT NULL,
  `Total_Payable_Amount` int(11) NOT NULL,
  `Total_Old_Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) NOT NULL,
  `lblCategory` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productCompany` varchar(255) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `New_Price` varchar(100) NOT NULL,
  `productDescription` longtext NOT NULL,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `GST` int(255) NOT NULL,
  `main_slider` int(11) NOT NULL DEFAULT '2',
  `deal_of_the_month` int(11) NOT NULL DEFAULT '2',
  `slider_1` int(11) NOT NULL DEFAULT '2',
  `slider_2` int(11) NOT NULL DEFAULT '2',
  `category_slider` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `lblCategory`, `productName`, `productCompany`, `productPrice`, `discount`, `New_Price`, `productDescription`, `postingDate`, `GST`, `main_slider`, `deal_of_the_month`, `slider_1`, `slider_2`, `category_slider`) VALUES
(13, 12, 21, 20, 'BHU (CHS)', '', 339, 0, '218', '', '2021-01-27 15:33:00', 0, 2, 1, 2, 2, 2),
(14, 12, 29, 20, 'Indian Polity by M Laxmikanth', 'Mac Graw Hill', 769, 0, '550', '<p><span style=\"color: #333333; font-family: \'Amazon Ember\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">???????? ?????? - \" ???? ?? ??????????? \" ????? ???? ?? ????????? ?? ???????? ???? ??? ??????? ?? ????????? ?? ??????????? ?????? ????? ??? ???? ??? ?? ?????? ??? ???? ??????? ?? ???? ??? ??????? ??? ?? ???????? ???????? ??????? ?? ??? ?? ?????? ???????? ???? ??? ?? ???? ?? ?????? ??? ??????????? ?????????????, ??? ???????, ??????? ?????????? ?? ?????????? ?? ???? ???? ??? ???? ?????? ???????? ?????? ?? ??? ??? ??????? ??????, ?? ??? ?? ????????,?????? ??? ????????? ???????/ ?????? ?? ??????? ??? ???? ???? ???,?? ??? ?? ?????? ????? ?? ??? ? ?? ??????? ??? ?? ?? ????? ???????? ?? ????? ???? ??? ??? ????? ??????? ??? ???????? ?? ???? ?????? ??? ?????? ?? ???? ?? ??????? ??? ??????????? ???? ??? ???</span></p>', '2021-02-04 10:30:37', 0, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`id`, `Product_Id`, `photo`) VALUES
(11, 13, '1612632793.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Vendor_Id` int(11) NOT NULL,
  `Order_Id` varchar(150) NOT NULL,
  `Invoice_No` varchar(150) NOT NULL,
  `sales_date` date NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `Cancel_Reason` varchar(200) NOT NULL,
  `Return_Reason` varchar(150) NOT NULL,
  `Delivery_Date` varchar(200) NOT NULL,
  `Total_Amount_BeforeDiscount` int(11) NOT NULL,
  `Total_Payable_Amount` int(11) NOT NULL,
  `Shipping_Charge` int(11) NOT NULL,
  `Sub_Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charge`
--

CREATE TABLE `shipping_charge` (
  `id` int(11) NOT NULL,
  `Shipping_Charge` int(11) NOT NULL,
  `Free_Delivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_charge`
--

INSERT INTO `shipping_charge` (`id`, `Shipping_Charge`, `Free_Delivery`) VALUES
(1, 40, 500);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `State_Name` varchar(200) NOT NULL,
  `State_Code` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `State_Name`, `State_Code`) VALUES
(1, 'Jammu & Kashmir', '01'),
(2, 'Himachal Pradesh', '02'),
(3, 'Punjab', '03'),
(4, 'Chandigarh', '04'),
(5, 'Uttarakhand', '05'),
(6, 'Haryana', '06'),
(7, 'Delhi', '07'),
(8, 'Rajasthan', '08'),
(9, 'Uttar Pradesh', '09'),
(10, 'Bihar', '10'),
(11, 'Sikkim', '11'),
(12, 'Arunachal Pradesh', '12'),
(13, 'Nagaland', '13'),
(14, 'Manipur', '14'),
(15, 'Mizoram', '15'),
(16, 'Tripura', '16'),
(17, 'Meghalaya', '17'),
(18, 'Assam', '18'),
(19, 'West Bengal', '19'),
(20, 'Jharkhand', '20'),
(21, 'Orissa', '21'),
(22, 'Chhattisgarh', '22'),
(23, 'Madhya Pradesh', '23'),
(24, 'Gujarat', '24'),
(25, 'Daman & Diu', '25'),
(26, 'Dadra & Nagar Haveli', '26'),
(27, 'Maharashtra', '27'),
(28, 'Andhra Pradesh', '28'),
(29, 'Karnataka', '29'),
(30, 'Goa', '30'),
(31, 'Lakshadweep', '31'),
(32, 'Kerala', '32'),
(33, 'Tamil Nadu', '33'),
(34, 'Puducherry', '34'),
(35, 'Andaman & Nicobar Islands', '35'),
(36, 'Telengana', '36'),
(37, 'Andhra Pradesh', '37');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `lblcatid` int(11) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `photo` varchar(150) NOT NULL,
  `main_slider` int(11) NOT NULL DEFAULT '2',
  `Slider_Heading` varchar(256) NOT NULL,
  `Slider_Description` varchar(256) NOT NULL,
  `slider_photo` varchar(200) NOT NULL,
  `creationDate` date NOT NULL,
  `dom` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `lblcatid`, `subcategory`, `photo`, `main_slider`, `Slider_Heading`, `Slider_Description`, `slider_photo`, `creationDate`, `dom`) VALUES
(21, 12, 20, 'Entrance Exams', '', 2, '', '', '', '0000-00-00', 2),
(22, 12, 20, 'Academics', '', 2, '', '', '', '0000-00-00', 2),
(23, 12, 20, 'competitive books', '', 2, '', '', '', '0000-00-00', 2),
(24, 12, 20, 'Degree Books', '', 2, '', '', '', '0000-00-00', 2),
(25, 12, 20, 'Books', '', 2, '', '', '', '0000-00-00', 2),
(27, 12, 20, 'General Books', '', 2, '', '', '', '0000-00-00', 2),
(28, 12, 20, 'Agriculture books', '', 2, '', '', '', '0000-00-00', 2),
(29, 12, 20, 'Civil services', '', 2, '', '', '', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

CREATE TABLE `temp_cart` (
  `sl` bigint(20) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `Total_Amount_BeforeDiscount` int(11) NOT NULL,
  `Total_Old_Amount` float NOT NULL,
  `Total_Payable_Amount` int(11) NOT NULL,
  `Shipping_Charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_cart`
--

INSERT INTO `temp_cart` (`sl`, `product_id`, `customer_id`, `qty`, `product_name`, `product_img`, `price`, `Total_Amount_BeforeDiscount`, `Total_Old_Amount`, `Total_Payable_Amount`, `Shipping_Charge`) VALUES
(1, '13', '5', '4', 'BHU (CHS)', '1611761650.jpg', '218', 339, 1356, 872, 0),
(2, '', '', '', '', '', '', 0, 0, 0, 0),
(3, '13', '1', '1', 'BHU (CHS)', '1611761650.jpg', '218', 339, 339, 218, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `Pin_Code` float NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Show_Password` varchar(200) NOT NULL,
  `Wallet` int(11) NOT NULL,
  `Active` int(1) NOT NULL DEFAULT '1',
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `Pin_Code`, `City`, `State`, `Show_Password`, `Wallet`, `Active`, `created_on`) VALUES
(1, 'shubhamc5200@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'BPL', 'Ecommerse', 'PANDEYPUR', '8181886137', 221001, '2', '9', 'Koala.jpg', 5, 1, '2018-05-01'),
(5, '', 'e10adc3949ba59abbe56e057f20f883e', 3, 'SHUBHAM', 'CHAUBEY', 'pandeypur', '9919646671', 221002, '3', '9', '', 608, 1, '0000-00-00'),
(6, '', 'e10adc3949ba59abbe56e057f20f883e', 2, 'GOPAL VERMA', '', '', '1234567890', 0, '', '', '', 0, 1, '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `Vendor_Name` varchar(100) NOT NULL,
  `Firm_Name` varchar(100) NOT NULL,
  `Contact_No` varchar(100) NOT NULL,
  `State_Id` int(11) NOT NULL,
  `City_Id` int(11) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Product` varchar(250) NOT NULL,
  `RecTimeStamp` date NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_advert`
--
ALTER TABLE `company_advert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lblcategory`
--
ALTER TABLE `lblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charge`
--
ALTER TABLE `shipping_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_advert`
--
ALTER TABLE `company_advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lblcategory`
--
ALTER TABLE `lblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `sl` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_charge`
--
ALTER TABLE `shipping_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `temp_cart`
--
ALTER TABLE `temp_cart`
  MODIFY `sl` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
