-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 01:58 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aanradio`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `link`) VALUES
(31, 'Radio 434', 'https://icecast01.mycloudserver.info/lsl-rocks'),
(32, 'dodatok metal', 'https://rockradioua.online:8433/metal_dodatok_256'),
(35, 'thrashking', 'https://thrashking.stream.laut.fm/thrashking'),
(36, 'Metal Zone', 'https://stream-162.zeno.fm/vmwdkkmva13uv?zs=P6zV6aBLTmmYvdzvyTOdkw'),
(37, 'The Extreme Metal', 'https://rdst.win:59870/autodj'),
(38, 'Swedish Chainsaw', 'https://stream-156.zeno.fm/amo4rddvbkhvv?zs=6Hbmi2bbT9O936nEgIpo4Q'),
(39, 'Loaded ', 'https://us2.internet-radio.com/proxy/loadedradio?mp=/stream;'),
(40, 'Bali Headbanger', 'https://stream-151.zeno.fm/vbyq86vnsp8uv?zs=KTqTWN4NRc-3x-XMlC0acA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
