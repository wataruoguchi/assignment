-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 22, 2015 at 07:46 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jukebox`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `notes`, `created`, `modified`, `active`) VALUES
(10, 'Hello world', 'This should be the oldest', '2015-09-22 12:32:08', '0000-00-00 00:00:00', 1),
(11, 'Create business cards', 'ask quote', '2015-09-22 12:37:10', '0000-00-00 00:00:00', 1),
(12, 'Wake up at 7', 'Don''t be late.\nBe punctual.', '2015-09-22 12:38:04', '0000-00-00 00:00:00', 1),
(13, 'Delete', 'This will be deleted', '2015-09-22 12:39:54', '0000-00-00 00:00:00', 0),
(14, 'Edit', 'Edit!', '2015-09-22 12:40:22', '2015-09-22 05:41:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
