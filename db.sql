-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 01:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(5) NOT NULL,
  `session_id` int(5) NOT NULL,
  `session` varchar(10) DEFAULT NULL,
  `university` varchar(5) DEFAULT NULL,
  `course` varchar(10) DEFAULT NULL,
  `id_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `session_id`, `session`, `university`, `course`, `id_array`) VALUES
(1, 1, NULL, NULL, NULL, 'a:1:{i:0;s:1:\"1\";}'),
(2, 2, NULL, NULL, NULL, 'a:1:{i:0;s:4:\"9452\";}'),
(3, 3, NULL, NULL, NULL, 'a:2:{i:0;s:2:\"11\";i:1;s:2:\"12\";}'),
(4, 4, NULL, NULL, NULL, 'a:3:{i:0;s:1:\"6\";i:1;s:2:\"11\";i:2;s:4:\"3267\";}'),
(5, 5, NULL, NULL, NULL, 'a:6:{i:0;s:2:\"12\";i:1;s:2:\"23\";i:2;s:4:\"1212\";i:3;s:4:\"3267\";i:4;s:4:\"9815\";i:5;s:4:\"9818\";}'),
(6, 6, NULL, NULL, NULL, 'a:7:{i:0;s:1:\"0\";i:1;s:2:\"11\";i:2;s:2:\"12\";i:3;s:2:\"23\";i:4;s:4:\"1212\";i:5;s:4:\"9815\";i:6;s:4:\"9818\";}'),
(8, 7, NULL, NULL, NULL, 'a:1:{i:0;s:4:\"4324\";}'),
(9, 10, '2019', 'AKU', 'BCA', 'a:1:{i:0;s:4:\"4324\";}'),
(10, 10, '2019', 'AKU', 'BBA', 'a:1:{i:0;s:4:\"9052\";}'),
(11, 11, '2019', 'AKU', 'BCA', 'a:3:{i:0;s:4:\"8747\";i:1;s:4:\"9328\";i:2;s:4:\"9596\";}'),
(12, 12, '2019', 'AKU', 'BCA', 'a:3:{i:0;s:4:\"8787\";i:1;s:4:\"9328\";i:2;s:4:\"9364\";}');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `postTitle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `auther` varchar(25) NOT NULL,
  `catinfo` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `postTitle`, `description`, `content`, `post_date`, `auther`, `catinfo`) VALUES
(7, 'hello india', 'this is just a demo post', '<p><b>this is just a demo post posted by rahul / admin / president.</b><br></p>', '2022-07-06 17:56:53', 'admin', 'Lifestyle'),
(8, 'this is important', 'ggggg', '<p>gggg</p>', '2023-08-09 21:36:38', 'admin123@gmail.com', 'News'),
(9, 'ggg', 'ggg', '<p>gg</p>', '2023-08-09 21:37:30', 'sachinrajok333@gmail.com', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `filepath` text NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `description`, `filepath`, `uploaded_date`) VALUES
(2, 'Beach', 'Hot summer day at the beach.', 'images/beach.jpg', '2019-07-16 20:10:05'),
(6, 'Stars', 'A wonderful view of the night sky.', 'images/stars.jpg', '2019-07-16 20:12:39'),
(25, '', '', 'images/IMG20211220101737.jpg', '2022-07-11 06:26:35'),
(26, '', '', 'images/IMG20211220120719.jpg', '2022-07-11 06:26:43'),
(27, '', '', 'images/IMG20211220152142.jpg', '2022-07-11 06:26:50'),
(28, '', '', 'images/IMG20211220191613.jpg', '2022-07-11 06:27:04'),
(29, '', '', 'images/DSC01543.JPG', '2022-07-12 23:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(5) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `title`, `description`, `date`) VALUES
(2, 'This is Sample Notice Title', 'Description of notice in 250 characters. Explain All notice details in this section. ', '08-09-2016 16:51'),
(4, 'ffasf', 'sgag', '2022-07-30T01:51'),
(5, 'Sachin Raj', 'this is important notice', '2023-08-21T03:06');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(5) NOT NULL,
  `session_name` varchar(150) NOT NULL,
  `session_details` varchar(250) NOT NULL,
  `session_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_name`, `session_details`, `session_date`) VALUES
(11, 'Shubharambh', 'A grand function for new joiners in Cimage.', '2022-07-08T14:35'),
(12, 'project expo', 'i am the winner of project expo', '2023-08-12T03:04');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `course` varchar(10) DEFAULT NULL,
  `session` varchar(5) DEFAULT NULL,
  `university` varchar(5) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `dob` varchar(25) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `currunt_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `otp` varchar(10) NOT NULL,
  `pic` text DEFAULT 'imgs/user.png',
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `name`, `course`, `session`, `university`, `email`, `dob`, `mobile`, `password`, `role`, `last_login`, `currunt_login`, `otp`, `pic`, `token`, `status`) VALUES
(10, 'Admin', '', '', '', 'admin123@gmail.com', '2022-07-08', '9054012685', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '2023-08-10 03:04:05', '2023-08-09 21:34:23', '389531', 'imgs/17241-200.png', '', 'active'),
(11, 'Dir Neeraj Agarwal', '', '', '', 'neerajA@gmail.com', '1987-03-06', '9041856325', '6a04ea730825548a2e1ed2687241e8fd', 'Admin', '0000-00-00 00:00:00', '2022-07-16 11:32:06', '', 'imgs/user.png', '', ''),
(12, 'Dir Megha Agarwal', '', '', '', 'megha@gmail.com', '1988-08-18', '9062417851', '489877ec5b7a26bcc731272882ab08e4', 'Admin', '0000-00-00 00:00:00', '2022-07-16 11:33:29', '', 'imgs/user.png', '', ''),
(13, 'Prof Neeraj Poddar', '', '', '', 'neeraj@gmail.com', '1989-03-10', '9801562485', 'cfffcb27b571a181a1ff30f23037d7c5', 'Admin', '0000-00-00 00:00:00', '2022-07-16 11:30:12', '', 'imgs/user.png', '', ''),
(51, 'Aman Ranjan', '', '', '', 'aman@gmail.com', '1991-09-11', '9150638412', '73b25522615dac9cfd289ee35faef4ef', 'Technical', '2022-07-16 17:05:06', '2022-07-16 21:12:10', '', 'imgs/user.png', '', ''),
(52, 'Khursid ', '', '', '', 'khursid@gmail.com', '1990-10-24', '9041928543', '9b509e46630d46c5cdab6546247b7eff', 'Technical', '0000-00-00 00:00:00', '2022-07-16 11:41:42', '', 'imgs/user.png', '', ''),
(78, 'Sachin Raj', 'BCA', '2019', 'AKU', 'sachinrajok333@gmail.com', '2023-08-09', '7700852614', '0887b15881a28fa9baabdebbc102b5ac', 'Student', '2023-08-10 03:19:24', '2023-08-09 21:50:09', '', 'imgs/user.png', '8b11364428dcd5bc20d9b958552090', 'active'),
(101, 'Amit Shukla', '', '', '', 'amit@gmail.com', '1985-10-18', '9405631872', 'f039eb446cc0bd7c5ad12b7a0e2a1dae', 'Teacher', '0000-00-00 00:00:00', '2022-07-16 11:47:08', '', 'imgs/user.png', '', ''),
(102, 'Ravi Kumar Soni', '', '', '', 'ravisoni@gmail.com', '1990-03-21', '9084601574', 'c41b5995de34c88e81f315cfe55ca68b', 'Teacher', '2022-07-17 02:36:39', '2022-07-16 21:15:41', '', 'imgs/user.png', '', ''),
(103, 'Neeraj Kumar Singh', '', '', '', 'neerajS@gmail.com', '1989-05-24', '9405874153', 'a17357868e60e14a733cf376588774ef', 'Teacher', '0000-00-00 00:00:00', '2022-07-16 12:12:20', '', 'imgs/user.png', '', ''),
(117, 'raj', 'BBA', '2024', 'AKU', 'ioio@gmail.com', '2023-08-07', '7700852614', '1455494c9f58563769b601366047c030', 'Student', '0000-00-00 00:00:00', '2023-08-09 18:47:53', '', 'imgs/user.png', '6a81315dd38076102d5e64fb4628f5', 'inactive'),
(8622, 'Abhimanyu Kumar', 'BBA', '2019', 'AKU', 'abhimanyu@gmail.com', '2000-10-11', '9648510253', '2a319ec4139c1c8c76fb9e5609b20049', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:33:54', '', 'imgs/user.png', '', ''),
(8652, 'Pratik Singh Nag', 'BBA', '2019', 'AKU', 'pratiknag@gmail.com', '1999-11-10', '8521063479', '0c1a3d8c3554192ff8aed1ce47cec074', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:35:17', '', 'imgs/user.png', '', ''),
(8715, 'Saurav Anand Pandey', 'BBA', '2019', 'AKU', 'saurav@gmail.com', '2000-02-14', '9506230147', 'b0051bc1f3d78e81eb3d169af478dc8e', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:36:33', '', 'imgs/user.png', '', ''),
(8724, 'Shubham Raj', 'BCA', '2019', 'PPU', 'shubham@gmail.com', '2001-07-14', '9637419620', '5559e198d7a24841cae9cf5bf1f1d89e', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:38:09', '', 'imgs/user.png', '', ''),
(8729, 'Ashish Kumar', 'BCA', '2019', 'PPU', 'ashish@gmail.com', '1996-12-01', '8451620314', '6abc9eba853ea08dd0e97810f68194e7', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:39:35', '', 'imgs/user.png', '', ''),
(8746, 'Priyanshu Singh', 'BCA', '2019', 'PPU', 'priyanshu@gmail.com', '2000-10-11', '9620325896', '081a311f4fd497a5c42c6ac1dd8ca296', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:40:59', '', 'imgs/user.png', '', ''),
(8758, 'Raushan Pandey', 'BBA', '2019', 'PPU', 'raushan@gmail.com', '2000-03-23', '9087452142', '6dc27b8603081289ca4f7dab15a5e6e4', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:42:24', '', 'imgs/user.png', '', ''),
(9058, 'Shweta Kumari', 'BBA', '2019', 'PPU', 'shweta@gmail.com', '1998-10-23', '8459674850', 'bd2d7d2550a43b30c87629311ffb93f7', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:43:32', '', 'imgs/user.png', '', ''),
(9155, 'Divya Kumari', 'BBA', '2019', 'PPU', 'divya@gmail.com', '2001-09-26', '8490632519', '4cde13613afe0defc203ffa547f55431', 'Student', '0000-00-00 00:00:00', '2022-07-16 14:45:56', '', 'imgs/user.png', '', ''),
(9328, 'Rahul Raj', 'BCA', '2019', 'AKU', 'rahulR@gmail.com', '2000-06-27', '9036974185', '6f657b78fb0ab7db412b7a8d7205b507', 'Student', '0000-00-00 00:00:00', '2022-07-16 13:20:30', '', 'imgs/user.png', '', ''),
(9364, 'Rahul Kumar', 'BCA', '2019', 'AKU', 'rahulK@gmail.com', '2001-09-20', '9630147852', '83ac0c5b095a1d75ec21bbc5695c20f8', 'Student', '0000-00-00 00:00:00', '2022-07-16 13:38:48', '', 'imgs/user.png', '', ''),
(9543, 'Priyanka Kumari', 'BCA', '2019', 'AKU', 'priyanka@gmail.com', '1999-09-04', '9584601257', 'e3c16bbf71a1bdc44ad03f18a8a63bc5', 'Student', '0000-00-00 00:00:00', '2022-07-16 13:30:36', '', 'imgs/user.png', '', ''),
(9596, 'Rahul Kumar Barnwal', 'BCA', '2019', 'AKU', 'rahulB@gmail.com', '2001-06-03', '9504176074', 'd55210ee24beced7041feb06b27d5c4b', 'Student', '2022-07-17 02:30:40', '2022-07-16 21:07:30', '', 'imgs/user.png', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
