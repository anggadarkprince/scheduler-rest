-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2015 at 06:09 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `label`, `note`, `created_at`) VALUES
(3, 1, 'Memo for my assistant', 'Important', 'bibendum auctor nisi elit consequat lorem quis bibendum \nauctor nisi elit consequat', '2015-10-07 03:02:18'),
(4, 1, 'Dinner With Myta', 'Home', 'auctor nisi elit consequat orem quis bibendum auctor nisi elit consequat. lorem quis \nbibendum auctor nisi elit consequat lorem quis bibendum \nauctor nisi elit consequat', '2015-10-07 03:02:18'),
(6, 1, 'Makan Siang', 'Daily', 'auctor nisi elit consequat orem quis bibendum ', '2015-10-10 08:33:53'),
(7, 1, 'District 9', 'Work', 'Transferring credit, refreshments are available (bagels, coffee, tea) ', '2015-10-07 03:02:18'),
(8, 1, 'My Finance Status', 'Daily', 'auctor nisi elit consequat orem quis bibendum ', '2015-10-10 08:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `event`, `date`, `time`, `location`, `description`, `created_at`) VALUES
(1, 1, 'Buy a lot of fruit', '2015-10-15', '08:00:00', 'Lobby Hotel', 'Special Interest Sessions (Dinning, financial aid and more)', '2015-10-07 02:57:08'),
(2, 1, 'Vacation On Sunday', '2015-10-11', '06:00:00', 'South Beach 1989', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(3, 1, 'Re Organize Room', '2015-10-12', '09:12:00', 'Home Sweet Home', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(4, 1, 'Meeting With Client', '2015-10-13', '12:22:00', 'Sketch Project Office', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(5, 1, 'Launching New Product', '2015-10-13', '04:30:00', 'Shangrilla Hotel', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(12, 1, 'Welcome Session', '2015-10-14', '08:00:00', 'Jakarta Beach', 'sbdx fgh dh', '2015-10-10 05:02:14'),
(13, 1, 'Orientation Leader Meeting', '2015-10-13', '12:22:00', 'Sketch Project Office', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(14, 1, 'Lunch And Resource Fair', '2015-10-13', '04:30:00', 'Shangrilla Hotel', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08'),
(15, 1, 'Registration Meeting', '2015-10-13', '12:22:00', 'My Residence', 'lorem quis bibendum auctor nisi elit consequat. lorem quis \r\nbibendum auctor nisi elit consequat lorem quis bibendum \r\nauctor nisi elit consequat...', '2015-10-07 02:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(50) NOT NULL,
  `work` varchar(45) DEFAULT NULL,
  `about` text,
  `reminder` enum('1','2','3','4') DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `token`, `work`, `about`, `reminder`, `created_at`) VALUES
(1, 'Angga Ari Wijaya', 'anggari', 'ac43724f16e9241d990427ab7c8f4228', 'giuyw9eiu394', 'UI/UX Designer', 'Proin gravida nibh vel velit auctor aliquet. Aenean icitudin lorem quis bibendum aucto', '1', '2015-10-07 02:53:27'),
(2, 'Sekjen Anwar', 'kemendesa', 'fd2a239fe44b59e90a8feba7bffb9ba8', 'hsgoit9384df', 'Sekretaris Jendral', 'Proin gravida nibh vel velit auctor aliquet. Aenean icitudin lorem quis bibendum auctor nisi elit consequat', '1', '2015-10-07 02:55:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_notes_users_idx` (`user_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_schedules_users1_idx` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_schedules_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
