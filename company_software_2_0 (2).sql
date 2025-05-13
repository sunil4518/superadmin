-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 09:53 AM
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
-- Database: `company_software_2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branchname` varchar(255) DEFAULT NULL,
  `branchcode` varchar(255) DEFAULT NULL,
  `branchaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branchname`, `branchcode`, `branchaddress`) VALUES
(1, 'Haryana Branch ', 'HR72VK', 'Haryana'),
(2, 'Civil Lines Branch', 'CL72VK', 'Rajasthan'),
(3, 'Murlipura Branch', 'MP72VK', 'Rajasthan');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_amount` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `token_amount` decimal(10,2) DEFAULT 0.00,
  `gst_amount` decimal(10,2) DEFAULT 0.00,
  `payable_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Phone_Number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Sales','Support','Operations','Accounts') NOT NULL,
  `city` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Zip_Code` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`id`, `name`, `Phone_Number`, `email`, `password`, `role`, `city`, `Country`, `Zip_Code`, `profile`, `status`, `date_created`) VALUES
(1, 'Satender Saini', '9828124053', 'satendersaini11@gmail.com', '$2y$10$s6.2qmbKZJqCnglkBh/xd.4rNQfHWx8DDs7XAkgcydTuD4MQFl8Lu', 'Admin', 'Jaipur', 'India', '302039', 'qwert.jpg', 'Active', '2025-04-18'),
(2, 'Ashok Chouhan', '', 'account@gmail.com', '$2y$10$s6.2qmbKZJqCnglkBh/xd.4rNQfHWx8DDs7XAkgcydTuD4MQFl8Lu', 'Accounts', '', '', '', '', 'Active', '2025-04-18'),
(3, 'Abhishek', '', '', 'Abhi@123', 'Support', '', '', '', '', 'Active', '2025-04-18'),
(4, 'Meena Kumari', '', '', 'Meena@123', 'Operations', '', '', '', '', 'Active', '2025-04-18'),
(5, 'Parmendra Meena', '', '', 'Param@123', 'Sales', '', '', '', '', 'Active', '2025-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `coupan`
--

CREATE TABLE `coupan` (
  `id` int(11) NOT NULL,
  `coupan` varchar(100) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupan`
--

INSERT INTO `coupan` (`id`, `coupan`, `service`, `amount`, `status`) VALUES
(3, 'VK7072NK', 'Ngo King', 3000.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `departmentname` varchar(255) DEFAULT NULL,
  `branchname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `departmentname`, `branchname`) VALUES
(2, 'dfd', 'Civil Lines Branch'),
(4, 'SALES', 'Civil Lines Branch');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designationname` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designationname`, `department`) VALUES
(1, 'g', 'f'),
(2, 'sasa', 'dfd'),
(3, 'sasadd', 'dfd'),
(4, 'Sales Manager', 'SALES'),
(5, 'Sales Manager', 'SALES');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `addressline` text DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `work_experience` varchar(50) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `emergency_number` varchar(15) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL,
  `User_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fullname`, `number`, `email`, `password`, `addressline`, `pincode`, `city`, `state`, `aadhar_number`, `pan_number`, `qualification`, `work_experience`, `bank_name`, `account_number`, `ifsc_code`, `emergency_number`, `join_date`, `branch`, `department`, `designation`, `created_at`, `status`, `User_status`) VALUES
(4, 'Sunil Kumar Gavariya', '8890440369', 'sunil@gmail.com', '', 'Panchayat Samiti Ke Peeche', '302012', 'Jaipur', 'Rajasthan', '562511745789', 'PZYPS8086N', 'B.Com', '2 Years', 'BOB', '295780100000251', 'BARB0JHOTWA', '7220095320', '2025-05-01', 'Civil Lines Branch', 'SALES', 'Sales Manager', '2025-05-08 07:54:23', 'Active', 'InActive');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `service` varchar(100) DEFAULT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `combo_detail` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `gstrate` decimal(5,2) DEFAULT NULL,
  `status` enum('Active','InActive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `service`, `service_type`, `combo_detail`, `amount`, `description`, `state`, `gstrate`, `status`) VALUES
(1, 'Ngo King', 'Individual', NULL, 12000.00, 'Ngo KIng Software Free', 'Rajasthan', 18.00, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupan`
--
ALTER TABLE `coupan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupan`
--
ALTER TABLE `coupan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
