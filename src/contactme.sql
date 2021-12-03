-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 05:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

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
  `photo_location` longtext DEFAULT NULL,
  `group_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupid`, `title`, `description`, `created_by`, `photo_location`, `group_password`) VALUES
(1, 'Activities fair', 'At the RPI activities fair, students will get to visit all the clubs provided by RPI and have the opportunity to join them.', 1, '/src/img/activities_fair.jpg', 'nasd;fnjnslfjnlfnjsdljf'),
(2, 'BSA Fashion Show', 'The annual fashion show put on by the Black Students Alliance dazzled audiences with creative looks and models who walked with attitude and elegance. This walk, titled “Ice Me Out,” expressed two sides of luxe: opulent, glittery fabrics mixed with edgy streetwear looks and silhouettes. Cami tank dresses of velvet and sequined fabric were accessorized with oversized fur jackets and cross necklaces, and the menswear looks included brilliantly embroidered shirts in both modern and traditional African styles.', 2, '/src/img/monkey.jpg', 'nlkfnslkfnlsf;snfkdnfjnsdf'),
(13, 'Mayors Cup Alumni and Fan Reception', 'Mark your calendar and plan to join other RPI hockey fans for a reception at the MVP Arena in Albany (formerly the Albany Times Union Center) prior to the RPI vs. Union Mayor\'s Cup games. Complimentary snacks and a cash bar will be available. Watch the alumni website and your email for registration information for the reception.\r\n\r\nAttendees of this event must agree to comply with all health and safety protocols required by the event sponsors, the venue, and New York State.', 1, NULL, 'CNJkz0G6rXQ3OgVr7tjZ'),
(20, 'Denver | Social Gathering at The Novel Strand Brewing Company', 'Every year in Albany begins with a celebration of the region\'s evolving culinary scene. As flowers begin to bloom, Albany honors the city\'s treasured tulips & Dutch roots. During the summer, live music and festivals fill the weekends. As the leaves begin to change, Albany gets in on the hocus pocus with spooky stories and nightmarish thrills. The end of the year is capped off with merriment and holiday celebrations. Explore a small selection of Albany\'s annual events and festivals! ', 1, NULL, ''),
(21, 'PearlPalooza', 'Downtown Albany\'s biggest all-day FREE music festival back! The all-ages festival,  featuring a diverse lineup of locally-and internationally-acclaimed performers, returns to North Pearl Street for its 12th year. Jam to live music, find your zen at Yogapalooza and grab a bite to eat from local vendors in the heart of downtown Albany!  The event is presented by SEFCU, in association with WEQX, Downtown Albany BID and Sugar Productions.', 1, NULL, 'W7NwgKS0RyhhrWF0Wxkg'),
(22, 'Albany Tulip Fesitval', 'The City of Albany\'s Virtual Tulip Festival will be held throughout the month of May. Tune in virtually for performances by local musicians in unique locations, tours of the tulip beds with the City of Albany gardeners, kid-friendly videos and more! Watch on Albany Events YouTube, Albany Events Facebook or Public Access Channel Albany 1302. The 2021 Albany Tulip Queen and Court and Capital Region Mother of the Year will be presented at a later date with their own celebrations.', 1, NULL, '5Al0bLqFMGtb6hGWQJqm');

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
(2, 2),
(13, 1),
(21, 1),
(22, 1);

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
  `photo_location` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `pass`, `fname`, `lname`, `email`, `links`, `is_admin`, `photo_location`) VALUES
(1, 'coolguy', '$2y$10$mkn/jjp8Vgpcua3EfkHT1e/7202YGbjDmTHiPNJixem9dn0h.SG8G', 'Connor', 'Silloway', 'silloc@rpi.edu', '{\"Instagram\":\"@connorsilloway\",\"LinkedIn\":\"www.linkedin.com\\/in\\/connor-silloway\"}', 1, NULL),
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
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
