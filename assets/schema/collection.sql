-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 12:36 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `pin` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `user_id`, `name`, `address`, `email`, `website`, `phone`, `pin`, `location`, `created_at`) VALUES
(18, 1, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'kjhkjhkjhK@Kjhksdcvsdc.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(19, 1, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'hkjhkjhK@Kjhksdcvsdc.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(20, 1, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'hkjhkjhK@ksdcvsdc.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(21, 13, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'kjhkjhkjhK@Kjhksdcvc.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(22, 1, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'hkjhkjhK@hksdcvsdc.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(23, 1, 'paru', 'jhgjhgjhgjhg\r\nfgh\r\ndfg\r\ndfg\r\ndfg', 'kjhkjhkjhK@Kjhksdcv.sdcf', 'ghhgfhgf.dsgf', 6767576576, 67546, 'ghjgjhgj', '2015-12-03 06:20:35'),
(24, 1, 'asdfasdf', 'dfasdfasdf', 'kjhkjhkjhK@Kjhdcvsdc.sdcf', 'ghhgfasdfhgf.dsgf', 6767576576, 67546, 'ghjgjhgasdfasdf\r\nj', '2015-12-03 06:20:35'),
(25, 1, 'asdfasdf', 'dfasdfasdf', 'kjhkjhkjhK@cvsdc.sdcf', 'ghhgfasdfhgf.dsgf', 6767576576, 67546, 'ghjgjhgasdfasdf\r\nj', '2015-12-03 06:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(100) NOT NULL,
  `password_reset_code` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `profile_image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `activated`, `activation_code`, `password_reset_code`, `status`, `created_at`, `activated_at`, `profile_image`) VALUES
(1, 'Vineeth', 'Krishnan', 'vineeth', 'vineeth@soarmorrow.com', 'fcea920f7412b5da7be0cf42b8c93759', 1, '', '56595afac3e4f', 1, '2015-11-27 11:13:10', '0000-00-00 00:00:00', ''),
(13, 'swetha', 'babuttan', 'swetha', 'swethk275@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '56617cefc532e', '', 1, '2015-12-04 11:45:51', '0000-00-00 00:00:00', 'uploads/profile_pic/13/Indian-Flag1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
