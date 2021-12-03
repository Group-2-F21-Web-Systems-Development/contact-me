-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 06:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
(1, 'Activities fair', 'At the RPI activities fair, students will get to visit all the clubs provided by RPI and have the opportunity to join them.', 1, './uploads/1638552150.jpg', 'nasd;fnjnslfjnlfnjsdljf'),
(11, 'BSA Fashion Show', 'The annual fashion show put on by the Black Students Alliance dazzled audiences with creative looks and models who walked with attitude and elegance. This walk, titled “Ice Me Out,” expressed two sides of luxe: opulent, glittery fabrics mixed with edgy streetwear looks and silhouettes. Cami tank dresses of velvet and sequined fabric were accessorized with oversized fur jackets and cross necklaces, and the menswear looks included brilliantly embroidered shirts in both modern and traditional African styles.', 1, './uploads/1638552224.jpg', 'xfbe8LIJFSkVkaTc8KWP'),
(12, 'Mayors Cup Alumni and Fan Reception', 'Mark your calendar and plan to join other RPI hockey fans for a reception at the MVP Arena in Albany (formerly the Albany Times Union Center) prior to the RPI vs. Union Mayor\'s Cup games. Complimentary snacks and a cash bar will be available. Watch the alumni website and your email for registration information for the reception. Attendees of this event must agree to comply with all health and safety protocols required by the event sponsors, the venue, and New York State.', 1, './uploads/1638552375.jpg', 'h0Rl6iul4IPIoE9xdHfc'),
(13, 'Albany Tulip Fesitval', 'The City of Albany\'s Virtual Tulip Festival will be held throughout the month of May. Tune in virtually for performances by local musicians in unique locations, tours of the tulip beds with the City of Albany gardeners, kid-friendly videos and more! Watch on Albany Events YouTube, Albany Events Facebook or Public Access Channel Albany 1302. The 2021 Albany Tulip Queen and Court and Capital Region Mother of the Year will be presented at a later date with their own celebrations.', 1, './uploads/1638552421.jpg', 'ATlic8J0AI1KIg62rAWF'),
(14, 'Denver | Social Gathering at The Novel Strand Brewing Company', 'Every year in Albany begins with a celebration of the region\'s evolving culinary scene. As flowers begin to bloom, Albany honors the city\'s treasured tulips &amp; Dutch roots. During the summer, live music and festivals fill the weekends. As the leaves begin to change, Albany gets in on the hocus pocus with spooky stories and nightmarish thrills. The end of the year is capped off with merriment and holiday celebrations. Explore a small selection of Albany\'s annual events and festivals!', 1, './uploads/1638552474.jpg', 'hoKXpytL02pIK3UiFrqs');

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
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(11, 1),
(11, 8),
(11, 9),
(12, 1),
(12, 8),
(12, 9),
(12, 10),
(12, 11),
(13, 1),
(13, 8),
(13, 9),
(13, 10),
(13, 11),
(14, 1),
(14, 8),
(14, 9);

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
(1, 'coolguy', '$2y$10$mkn/jjp8Vgpcua3EfkHT1e/7202YGbjDmTHiPNJixem9dn0h.SG8G', 'Connor', 'Silloway', 'silloc@rpi.edu', '{\"Instagram\":\"@connorsilloway\",\"LinkedIn\":\"www.linkedin.com\\/in\\/connor-silloway\"}', 1, './uploads/1638552108.jpg'),
(8, 'JakeyJake', '$2y$10$bWKPEmSLx8reBEmjjlM/Ae6NReQSSPAqPAm482s9DDOuRZBETybSq', 'Jacob', 'De\'Marco', 'Jacob@gmail.com', NULL, 0, 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg'),
(9, 'JTP_leader', '$2y$10$0iwjzSv0Q4JyyiVeVKo0fO/rmnra2WwDzyHWxEEuh5/ulPIfkWTBG', 'Barry', 'Goldberg', 'BigTasty@gmail.com', '{\"Twitter\":\"@Barry_speaks\"}', 0, './uploads/1638552976.jpeg'),
(10, 'Mason-cool', '$2y$10$WdxIqTrd8KzAiOa395hCLulPcL7h2zY9JRrghwIjSA94fQS86ecHW', 'Mason', 'Carroll', 'Carroll@outlook.com', NULL, 0, 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg'),
(11, 'Davis-fun', '$2y$10$6NTJhSzPanfyI.YzXNwtkOqFRdHU6I2bQiUuzuLt4mD2oC2iOMpLi', 'James', 'Davis', 'Davis7@gmail.com', '[]', 0, 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg');

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
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
