-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 06:02 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hall_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_info`
--

CREATE TABLE `admin_login_info` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login_info`
--

INSERT INTO `admin_login_info` (`id`, `username`, `password`) VALUES
(1, 'jkkniu', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `daily_account_common_date`
--

CREATE TABLE `daily_account_common_date` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_account_common_date`
--

INSERT INTO `daily_account_common_date` (`id`, `date`) VALUES
(1, '2020-11-06'),
(5, '2020-11-07'),
(7, '2020-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `department_information`
--

CREATE TABLE `department_information` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_information`
--

INSERT INTO `department_information` (`id`, `department_name`) VALUES
(1, 'Computer Science and Engineering'),
(2, 'Electrical and Electronic Engineering'),
(3, 'Environmental Science and Engineering'),
(5, 'Accounting & Information System'),
(6, 'Bangla Language & Literature'),
(7, 'English Language & Literature'),
(8, 'Music'),
(9, 'Theatre & Performance Studies'),
(10, 'Film & Media'),
(12, 'Fine Arts'),
(13, 'Statistics'),
(14, 'Economics'),
(15, 'Public Administration & Governance Studies'),
(16, 'Folklore'),
(17, 'Anthropology'),
(18, 'Population Science'),
(19, 'Local Goverment & Urban Development'),
(20, 'Sociology'),
(21, 'Law & Justice'),
(22, 'Finance & Banking'),
(23, 'Human Resource Management'),
(24, 'Management'),
(25, 'Philosophy');

-- --------------------------------------------------------

--
-- Table structure for table `donation_information`
--

CREATE TABLE `donation_information` (
  `id` int(255) NOT NULL,
  `source_name` varchar(100) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_information`
--

INSERT INTO `donation_information` (`id`, `source_name`, `amount`, `month`, `year`, `entry_date`) VALUES
(25, 'Sports', '50000', '11', '2020', '2020-11-06'),
(26, 'Puja', '2000', '11', '2020', '2020-11-06'),
(27, 'Development Fee', '2000', '11', '2020', '2020-11-06'),
(28, 'Blood Donation', '5000', '11', '2020', '2020-11-07'),
(29, 'web', '5000', '11', '2020', '2020-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `employee_information`
--

CREATE TABLE `employee_information` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hall_designation` varchar(100) NOT NULL,
  `university_designation` varchar(50) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `personal_page_link` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_information`
--

INSERT INTO `employee_information` (`id`, `name`, `hall_designation`, `university_designation`, `image`, `contact_no`, `personal_page_link`, `facebook_link`) VALUES
(3, 'supty', 'tutor', 'Assistant Professor', 'no_image.JPG', '01686247327', '', ''),
(4, 'akhi', 'Tutor', 'Lecturer', 'no_image.JPG', '01681234567', '', ''),
(5, 'Jannatul Ferdous', 'Provost', 'Professor', 'no_image.JPG', '01681234565', 'https://www.facebook.com/profile.php?id=1211157427', 'https://www.youtube.com/'),
(6, 'Habiba Sultana', 'House Tutor', 'Assistant Professor', 'no_image.JPG', '01612345675', '', ''),
(8, 'Indrani', 'Provost', 'Assistant Professor', 'no_image.JPG', '01649876248', '', ''),
(26, 'Isha', 'Tutor', 'Professor', '1604826698.JPG', '01612345695', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense_information`
--

CREATE TABLE `expense_information` (
  `id` int(255) NOT NULL,
  `expense_name` varchar(200) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `expense_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_information`
--

INSERT INTO `expense_information` (`id`, `expense_name`, `amount`, `month`, `year`, `expense_date`) VALUES
(6, 'puja', '1000', '11', '2020', '2020-11-06'),
(8, 'football', '1000', '11', '2020', '2020-11-07'),
(10, 'hudai', '20', '11', '2020', '2020-11-07'),
(11, 'asd', '50', '11', '2020', '2020-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_resource`
--

CREATE TABLE `incoming_resource` (
  `id` int(255) NOT NULL,
  `resource_id` int(255) NOT NULL,
  `number_of_resources` varchar(100) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incoming_resource`
--

INSERT INTO `incoming_resource` (`id`, `resource_id`, `number_of_resources`, `month`, `year`, `entry_date`) VALUES
(24, 27, '0', '10', '2020', '2020-10-21'),
(25, 28, '0', '10', '2020', '2020-10-21'),
(26, 29, '0', '10', '2020', '2020-10-21'),
(27, 27, '30', '10', '2020', '2020-10-06'),
(28, 28, '50', '10', '2020', '2020-10-13'),
(29, 29, '80', '10', '2020', '2020-10-20'),
(30, 27, '50', '10', '2020', '2020-10-13'),
(31, 30, '0', '10', '2020', '2020-10-21'),
(32, 30, '100', '10', '2020', '2020-10-14'),
(33, 29, '30', '11', '2020', '2020-11-01'),
(34, 31, '0', '11', '2020', '2020-11-02'),
(35, 31, '30', '10', '2019', '2019-10-01'),
(36, 30, '10', '3', '2019', '2019-03-14'),
(37, 31, '10', '3', '2019', '2019-03-03'),
(38, 32, '0', '11', '2020', '2020-11-03'),
(40, 32, '30', '6', '2019', '2019-06-14'),
(41, 32, '40', '12', '2020', '2020-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `outgoing_resource`
--

CREATE TABLE `outgoing_resource` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `number_of_resources` varchar(100) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `departure_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outgoing_resource`
--

INSERT INTO `outgoing_resource` (`id`, `resource_id`, `number_of_resources`, `month`, `year`, `departure_date`) VALUES
(14, 27, '0', '10', '2020', '2020-10-21'),
(15, 28, '0', '10', '2020', '2020-10-21'),
(16, 29, '0', '10', '2020', '2020-10-21'),
(17, 28, '5', '10', '2019', '2019-10-21'),
(18, 29, '25', '8', '2020', '2020-08-02'),
(19, 29, '40', '10', '2020', '2020-10-14'),
(20, 30, '0', '10', '2020', '2020-10-21'),
(21, 31, '0', '11', '2020', '2020-11-02'),
(22, 31, '10', '11', '2020', '2020-11-03'),
(23, 32, '0', '11', '2020', '2020-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `resource_name`
--

CREATE TABLE `resource_name` (
  `id` int(11) NOT NULL,
  `resource_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource_name`
--

INSERT INTO `resource_name` (`id`, `resource_name`) VALUES
(27, 'Fan'),
(28, 'table'),
(29, 'bed'),
(30, 'chair'),
(31, 'Pen'),
(32, 'light');

-- --------------------------------------------------------

--
-- Table structure for table `room_information`
--

CREATE TABLE `room_information` (
  `id` int(11) NOT NULL,
  `floor_no` varchar(10) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `total_seat` varchar(10) NOT NULL,
  `reserved_seat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_information`
--

INSERT INTO `room_information` (`id`, `floor_no`, `room_no`, `total_seat`, `reserved_seat`) VALUES
(2, '1', '101', '4', '2'),
(11, '1', '105', '4', '1'),
(14, '1', '104', '4', '0'),
(17, '1', '102', '4', '4'),
(19, '1', '106', '4', '1'),
(20, '1', '103', '4', '0'),
(21, '1', '107', '4', '0'),
(22, '1', '108', '4', '0'),
(23, '1', '109', '4', '0'),
(24, '1', '110', '4', '0'),
(25, '2', '201', '4', '0'),
(26, '2', '202', '4', '0'),
(27, '2', '203', '4', '0'),
(28, '2', '204', '4', '0'),
(29, '2', '205', '4', '0'),
(30, '2', '206', '4', '0'),
(31, '2', '207', '4', '0'),
(32, '2', '208', '4', '1'),
(33, '2', '209', '4', '0'),
(34, '2', '210', '4', '0'),
(35, '3', '301', '4', '0'),
(36, '3', '302', '4', '0'),
(37, '3', '303', '4', '0'),
(38, '3', '304', '4', '0'),
(39, '3', '305', '4', '0'),
(40, '3', '306', '4', '0'),
(41, '3', '307', '4', '0'),
(42, '3', '308', '4', '0'),
(43, '3', '309', '4', '0'),
(44, '3', '310', '4', '0'),
(45, '4', '401', '4', '1'),
(46, '4', '402', '4', '0'),
(47, '4', '403', '4', '0'),
(48, '4', '404', '4', '0'),
(49, '4', '405', '4', '0'),
(50, '4', '406', '4', '0'),
(51, '4', '407', '4', '0'),
(52, '4', '408', '4', '0'),
(53, '4', '409', '4', '0'),
(55, '5', '501', '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_information`
--

CREATE TABLE `student_information` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `date_of_birth` date NOT NULL,
  `district` varchar(50) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `department_id_number` varchar(100) NOT NULL,
  `session` varchar(50) NOT NULL,
  `roll_number` int(50) NOT NULL,
  `room_id_number` int(50) NOT NULL,
  `entry_date` date NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_information`
--

INSERT INTO `student_information` (`id`, `name`, `father_name`, `mother_name`, `image`, `date_of_birth`, `district`, `contact_number`, `department_id_number`, `session`, `roll_number`, `room_id_number`, `entry_date`, `status`) VALUES
(18, 'Sumaiya Sharmin', 'Sohrab', 'jani n', '', '1996-08-19', 'Kishorganj', '01686247327', '1', '2015-2016', 16102023, 17, '2020-10-23', '0'),
(20, 'isha', 'ismail', 'jani na', '1604832378.JPG', '1996-03-14', 'Sherpur', '01686247328', '1', '2015-2016', 16102013, 17, '2020-10-23', '1'),
(23, 'Shanta', 'Jani na', 'Jani na', '', '1996-03-14', 'Jamalpur', '01647895641', '2', '2016-2017', 17102021, 17, '2020-01-01', '1'),
(24, 'Esty', 'Jani na', 'Jani n', '', '1997-05-14', 'Kishorganj', '01689756412', '3', '2015-2016', 16102002, 17, '2019-11-19', '1'),
(25, 'Mitu', 'Jani na', 'jani na', '', '1997-03-14', 'Kishorganj', '01645678932', '1', '2015-2016', 16102001, 2, '2020-09-18', '1'),
(26, 'Zidne', 'Jani na', 'jani na', '', '1996-09-19', 'Narshingdi', '01765498712', '2', '2015-2016', 16102029, 11, '2020-07-08', '0'),
(27, 'Mity', 'Jani na', 'jani na', '', '1999-09-15', 'Mymensingh', '01546987568', '2', '2017-2018', 18102026, 11, '2020-11-17', '1'),
(28, 'Mumu', 'Jani na', 'jani na', '', '1997-06-14', 'Mymensingh', '01652319761', '1', '2015-2016', 16102010, 19, '2020-11-03', '1'),
(29, 'Basbi', 'Jani na', 'jani na', '', '1997-09-20', 'Mymensingh', '01645987321', '1', '2015-2016', 16102009, 32, '2019-06-15', '1'),
(30, 'Muna', 'Kuddus', 'Sokhina', '', '1998-03-19', 'Mymensingh', '01623798164', '1', '2015-2016', 16102017, 55, '2020-06-25', '1'),
(31, 'Mim', 'Jani na', 'jani na', '', '1998-03-06', 'Jamalpur', '01711246578', '1', '2016-2017', 17102006, 45, '2019-09-16', '1'),
(32, 'Shorna', 'Jani na', 'jani na', '', '1997-08-19', 'Mymensingh', '01598756421', '3', '2015-2016', 16102065, 17, '2020-08-15', '1'),
(33, 'HUDai', 'asdkl', 'asdkl', '1604831394.JPG', '1997-03-14', 'Kishorganj', '01686247329', '13', '2017-2018', 161020034, 2, '2020-11-08', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_payment_information`
--

CREATE TABLE `student_payment_information` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `amount` int(255) NOT NULL,
  `payment_status` int(2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_payment_information`
--

INSERT INTO `student_payment_information` (`id`, `student_id`, `month`, `year`, `amount`, `payment_status`, `payment_date`) VALUES
(80, 18, '10', '2020', 200, 1, '2020-11-06'),
(81, 18, '11', '2020', 200, 1, '2020-11-06'),
(83, 20, '11', '2020', 200, 1, '2020-11-07'),
(87, 23, '4', '2020', 200, 1, '2020-11-08'),
(88, 23, '5', '2020', 200, 1, '2020-11-08'),
(89, 23, '6', '2020', 200, 1, '2020-11-08'),
(91, 23, '7', '2020', 200, 1, '2020-11-08'),
(92, 23, '8', '2020', 200, 1, '2020-11-08'),
(93, 23, '1', '2020', 200, 1, '2020-11-08'),
(94, 23, '2', '2020', 200, 1, '2020-11-08'),
(95, 20, '10', '2020', 200, 1, '2020-11-08'),
(96, 23, '3', '2020', 200, 1, '2020-11-08'),
(97, 23, '9', '2020', 200, 1, '2020-11-08'),
(98, 23, '10', '2020', 200, 1, '2020-11-08'),
(99, 23, '11', '2020', 200, 1, '2020-11-08'),
(100, 29, '6', '2019', 200, 1, '2020-11-08'),
(101, 29, '7', '2019', 200, 1, '2020-11-08'),
(102, 29, '8', '2019', 200, 1, '2020-11-08'),
(103, 29, '9', '2019', 200, 1, '2020-11-08'),
(104, 29, '10', '2019', 200, 1, '2020-11-08'),
(105, 29, '1', '2020', 200, 1, '2020-11-08'),
(106, 29, '2', '2020', 200, 1, '2020-11-08'),
(107, 29, '3', '2020', 200, 1, '2020-11-08'),
(108, 29, '4', '2020', 200, 1, '2020-11-08'),
(109, 29, '7', '2020', 200, 1, '2020-11-08'),
(111, 29, '11', '2019', 200, 1, '2020-11-08'),
(112, 29, '12', '2019', 200, 1, '2020-11-08'),
(113, 29, '5', '2020', 200, 1, '2020-11-08'),
(114, 29, '6', '2020', 200, 1, '2020-11-08'),
(115, 29, '8', '2020', 200, 1, '2020-11-08'),
(116, 29, '9', '2020', 200, 1, '2020-11-08'),
(117, 29, '10', '2020', 200, 1, '2020-11-08'),
(118, 29, '11', '2020', 200, 1, '2020-11-08');

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_incoming_resource`
-- (See below for the actual view)
--
CREATE TABLE `total_incoming_resource` (
`id` int(11)
,`resource_name` varchar(200)
,`number_of_resources` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_outgoing_resource`
-- (See below for the actual view)
--
CREATE TABLE `total_outgoing_resource` (
`id` int(11)
,`resource_name` varchar(200)
,`number_of_resources` double
);

-- --------------------------------------------------------

--
-- Structure for view `total_incoming_resource`
--
DROP TABLE IF EXISTS `total_incoming_resource`;
	
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `total_incoming_resource`  AS  select `r`.`id` AS `id`,`r`.`resource_name` AS `resource_name`,sum(`i`.`number_of_resources`) AS `number_of_resources` from (`resource_name` `r` join `incoming_resource` `i` on(`r`.`id` = `i`.`resource_id`)) group by `i`.`resource_id` order by `r`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `total_outgoing_resource`
--
DROP TABLE IF EXISTS `total_outgoing_resource`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `total_outgoing_resource`  AS  select `r`.`id` AS `id`,`r`.`resource_name` AS `resource_name`,sum(`o`.`number_of_resources`) AS `number_of_resources` from (`resource_name` `r` join `outgoing_resource` `o` on(`r`.`id` = `o`.`resource_id`)) group by `o`.`resource_id` order by `r`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login_info`
--
ALTER TABLE `admin_login_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_account_common_date`
--
ALTER TABLE `daily_account_common_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_information`
--
ALTER TABLE `department_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_information`
--
ALTER TABLE `donation_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_information`
--
ALTER TABLE `employee_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- Indexes for table `expense_information`
--
ALTER TABLE `expense_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_resource`
--
ALTER TABLE `incoming_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoing_resource`
--
ALTER TABLE `outgoing_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_name`
--
ALTER TABLE `resource_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_information`
--
ALTER TABLE `room_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_no` (`room_no`);

--
-- Indexes for table `student_information`
--
ALTER TABLE `student_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_number` (`contact_number`);

--
-- Indexes for table `student_payment_information`
--
ALTER TABLE `student_payment_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login_info`
--
ALTER TABLE `admin_login_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_account_common_date`
--
ALTER TABLE `daily_account_common_date`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department_information`
--
ALTER TABLE `department_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `donation_information`
--
ALTER TABLE `donation_information`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee_information`
--
ALTER TABLE `employee_information`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `expense_information`
--
ALTER TABLE `expense_information`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `incoming_resource`
--
ALTER TABLE `incoming_resource`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `outgoing_resource`
--
ALTER TABLE `outgoing_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `resource_name`
--
ALTER TABLE `resource_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `room_information`
--
ALTER TABLE `room_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `student_information`
--
ALTER TABLE `student_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `student_payment_information`
--
ALTER TABLE `student_payment_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
