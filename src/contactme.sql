-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 05:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contactme`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `photo_location` longtext DEFAULT 'uploads/48724i2bsakfnsaoidjfoqijwr82104182jdsaf;oj31u4.jpeg',
  `group_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupid`, `title`, `description`, `created_by`, `photo_location`, `group_password`) VALUES
(1, 'Activities fair', 'At the RPI activities fair, students will get to visit all the clubs provided by RPI and have the opportunity to join them.', 1, 'uploads/48724i2bsakfnsaoidjfoqijwr82104182jdsaf;oj31u4.jpeg', 'nasd;fnjnslfjnlfnjsdljf'),
(2, 'Monkey Club', 'Some primate species are recognized for their tree-swinging leaps that moved being acrobats to shame! Some monkey species take this “ arm at arm ” technique you may have seen children practicing on that “ monkey bars ” in the yard! Colobus monkeys, unlike other primate species, have hind legs that are much further than their forelimbs, creating for unbelievable leaping power with good velocity. In other words, monkeys are cool so come to our club interest meeting', 2, '/src/img/monkey.jpg', 'nlkfnslkfnlsf;snfkdnfjnsdf');

-- --------------------------------------------------------

--
-- Table structure for table `pairing`
--

CREATE TABLE `pairing` (
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pairing`
--

INSERT INTO `pairing` (`groupid`, `userid`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `links` longtext DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `photo_location` longtext DEFAULT 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `pass`, `fname`, `lname`, `email`, `links`, `is_admin`, `photo_location`) VALUES
(1, 'coolguy', '$2y$10$mkn/jjp8Vgpcua3EfkHT1e/7202YGbjDmTHiPNJixem9dn0h.SG8G', 'Connor', 'Silloway', 'silloc@rpi.edu', '{\"Instagram\":\"@connorsilloway\",\"LinkedIn\":\"www.linkedin.com\\/in\\/connor-silloway\"}', 1, 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg'),
(2, 'bobbert', '$2y$10$jkw/3yQW7hXpidVM1uqmkuaKloFeu00oW6Xc96wWGje9cuUZv6MAq', 'bad guy', 'dumby', 'bad@gmail.com', NULL, 1, NULL),
(4, 'g', '$2y$10$XiUJJBJgEb51ZzRKLjZAXuPsjra.tpb1qP.qeExXhiRu9ELFjLdpK', 'g', 'g', 'g', NULL, 0, NULL),
(5, 'smitha4', '$2y$10$4pTBzgnMgFUMt29m6V04KOLaeXq2Em3JZoaDZ9utQQZOnknX43K5i', 'John', 'Smith', 'smitha4@rpi.edu', NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupid`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `pairing`
--
ALTER TABLE `pairing`
  ADD PRIMARY KEY (`groupid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`userid`);

--
-- Constraints for table `pairing`
--
ALTER TABLE `pairing`
  ADD CONSTRAINT `pairing_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `pairing_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
