-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 04:38 AM
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
  `photo_location` longtext NOT NULL DEFAULT 'uploads/48724i2bsakfnsaoidjfoqijwr82104182jdsaf;oj31u4.jpeg',
  `group_password` varchar(255) NOT NULL,
  `whitelist` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupid`, `title`, `description`, `created_by`, `photo_location`, `group_password`, `whitelist`) VALUES
(29, '2021 Schenectady Festival of Trees', 'Celebrate the season as we fill our galleries with lighted fir trees! Decorated from classic to kooky Christmas styles, the Festival of Trees glows with the enchantment of the holidays. Join us throughout December for a shimmering, festive season.\r\n\r\nThe Festival of Trees is a fundraiser for, and a partnership between, the Schenectady County Historical Society and the YWCA NorthEastern NY. Admission is $6 for adults 12+.', 13, './uploads/1639183418.jpg', 'IaFc6BPwD3SK6pQdUzcx', '[\"snapchat\"]'),
(30, 'The Nutcracker Albany Berkshire Ballet', 'The story of the Albany Berkshire Ballet stretches back to the mid 1950s with the foundation of the Cantarella School of Dance in Pittsfield, Mass, by Artistic Director Madeline Cantarella Culpo. The Albany Berkshire Ballet is nationally recognized for its versatility in performing both classical and contemporary dance works. The company’s classical repertory rivals that of any large company performing today.', 13, './uploads/1639183701.jpg', 'LP7oAUmfXsM2SOO7G3rm', '[\"facebook\",\"instagram\",\"twitter\"]'),
(31, 'BSA Fashion Show', 'The annual fashion show put on by the Black Students Alliance dazzled audiences with creative looks and models who walked with attitude and elegance. This walk, titled “Ice Me Out,” expressed two sides of luxe: opulent, glittery fabrics mixed with edgy streetwear looks and silhouettes. Cami tank dresses of velvet and sequined fabric were accessorized with oversized fur jackets and cross necklaces, and the menswear looks included brilliantly embroidered shirts in both modern and traditional African styles.', 13, './uploads/1639183960.png', 'f2aCkINBfCxKhwOZYbk9', '[\"linkedin\"]'),
(32, 'Stress Relief Days at The Mueller Center', 'Stop by The Mueller Center Monday, December 13 and Tuesday, December 14 for our end of the semester Stress Relief Days. De-stress with our free spa services*, chair massages, fitness classes*, cookie decorating class (12/13 at 5pm only)*, art therapy activities, hydration station and healthy snacks provided by Rensselaer Dining.n*Limited spots for these services. Sign up at imleagues.com/rpi', 13, './uploads/1639184186.jpg', 'kj6x5WTzdVjPRqIS5mdU', '[\"twitter\",\"instagram\"]'),
(33, 'Weird Al Yankovic: Unfortunate Return of the Ill-Advised Vanity Tour', 'Almost four years after his first foray into unfamiliar concert territory with his highly-acclaimed Ridiculously Self-Indulgent, Ill-Advised Vanity Tour, &quot;Weird Al&quot; Yankovic is pressing his luck again, this time with The Unfortunate Return of the Ridiculously Self-Indulgent, Ill-Advised Vanity Tour. The tour marks Weird Al\'s long-anticipated return to the concert stage after his hugely successful Strings Attached Tour in 2019 where he performed each night alongside a full symphony orchestra. Once again drawing from his back catalogue of 14 studio albums, Weird Al promises to deliver a different set list every night, with no two shows the same. As before, rather than focusing on the hits from his career, the show will feature Yankovic\'s non-parody material - the somewhat more obscure pastiches and original songs that have largely escaped the pop culture radar but are adored by his long-time fans.', 13, './uploads/1639184379.jpg', 'tDtaTXqHFfgfOCfg6Zsv', '[\"instagram\",\"facebook\"]');

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
(29, 13),
(29, 14),
(29, 15),
(30, 13),
(30, 14),
(30, 15),
(31, 13),
(31, 14),
(31, 15),
(32, 13),
(32, 14),
(32, 15),
(33, 13),
(33, 14),
(33, 15);

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
  `photo_location` longtext NOT NULL DEFAULT 'uploads/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg',
  `sec_question` int(11) NOT NULL,
  `sec_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `pass`, `fname`, `lname`, `email`, `links`, `is_admin`, `photo_location`, `sec_question`, `sec_answer`) VALUES
(13, 'jfilawo', '$2y$10$oAQIO8jbQY4Q7ousogGYyOQfSg1zBBycbSrF9vXca6VuVhqcMIDb6', 'Jasmine', 'Filawo', 'jfilawo24@yahoo.com', '{\"facebook\":\"@jasmine\",\"twitter\":\"@jfila\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/in\\/jasmine-filawo\\/\",\"snapchat\":\"@jasmine123\"}', 1, './uploads/1639193266.jpg', 1, '$2y$10$/gOQwRBT4fkMJC9LRcwsRearSjxcAJUlATl/whjMq1PDRev6ilJaW'),
(14, 'silloc', '$2y$10$SMLxD1PMv41MjiFfuJrKx.vouNzYs9SxNanTNeFZvzGIKyKDqzhRa', 'Connor', 'Silloway', 'silloc@rpi.edu', '{\"facebook\":\"@connor\",\"twitter\":\"@connorsilloway\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/in\\/connor-silloway\\/\",\"snapchat\":\"@consil\"}', 0, './uploads/1639192737.jpg', 1, '$2y$10$EoAtrUoq1RgIyF0sXQxpOeiRKukfRBozDVqAEe6EhryxR2Tgca/Gy'),
(15, 'bartha', '$2y$10$gsUzuiytmKYWLbRjR9WlrOffY/G3o52iTR/StQ7EkvqCblX.QFILa', 'Alana', 'Barth', 'bartha4@rpi.edu', '{\"facebook\":\"@Alanab\",\"twitter\":\"@barthalana\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/in\\/alana-barth-59a369190\\/\",\"snapchat\":\"@alana12\"}', 0, './uploads/1639193442.jpg', 2, '$2y$10$7N1./tCaGhGNOlQKD6qqdOwFbOOTn2nuGco7l4Giwu9Uo74OJo0C6');

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
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
