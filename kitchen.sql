-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 11:07 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customerName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numGuests` int(2) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customerName`, `contact`, `numGuests`, `dateTime`, `processed`) VALUES
(1, 'Kim Seonho', '9843516222', 1, '2021-06-05 00:29:00', 0),
(2, 'Jamie Miller', '9851142681', 4, '2021-06-25 00:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Starters'),
(2, 'Mains'),
(3, 'Deserts'),
(4, 'Vegan');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `title`, `description`, `date`, `image`) VALUES
(4, 'Buy 1 Get 1 Free offer on ice cream', 'Buy One Get One Free offer on ice cream of any flavour of your choice. Hurry up, offer valid until July 2021 only.', '2021-06-05', '56772884260ba53294bb06.jpg'),
(5, 'New Addition to the menu! Cupcakes', 'Try our cupcakes that are freshly baked everday. First 10 orders of the day receive special gifts! ', '2021-06-01', '183444536260ba63659c0e0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `categoryId`, `name`, `price`, `description`, `image`, `hidden`) VALUES
(1, 2, 'Burger and chips', '8.99', 'This pub classic is made fresh in house with your choice of chunky chips or curly fries', NULL, 0),
(2, 1, 'Nachos', '3.99', 'A big bowl of nachos with guacamole, salsa, sour cream and plenty of melted cheese.', NULL, 0),
(3, 3, 'Chocolate sundae', '2.99', 'Three scoops of ice cream dripping in chocolate sauce and topped with a wafer', NULL, 0),
(4, 1, 'Soup of the day', '4.99', 'Ask one of our team what the soup of the day is. They are all home made fresh each day!', NULL, 0),
(5, 2, 'Fish and chips', '8.99', 'Battered cod with plenty of chips, served with mushy peas', NULL, 0),
(6, 2, 'Vegetable stir fry', '7.99', 'Noodles, beansprouts and plenty of vegetables. Topped with crushed peanuts and chilies (Ve)', NULL, 0),
(10, 3, 'Ice cream', '0.99', 'One scoop ice cream of your chosen flavour', NULL, 1),
(13, 3, 'Cupcakes', '0.99', 'Our cupcakes are freshly baked everday. ', 'cupcakes.jpg,cupcakes2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `reviewerName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(1) NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `menuId`, `reviewerName`, `rating`, `description`, `approval`) VALUES
(1, 2, 'Tom Buchanan', 5, 'Best Nachos in town! ', 1),
(2, 2, 'Daisy Gatsby', 4, 'The guacamole tastes amazing!', 1),
(13, 2, 'Lily Singh', 2, 'I expected the nachos to be crispier.', 1),
(14, 2, 'David Byers', 4, 'Will recommend these nachos to all my friends.', 1),
(15, 13, 'Nalini Gupta', 3, 'Liked it! ', 0),
(16, 3, 'Adhya Rana', 5, 'Amazing combination! ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mainAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mainAdmin`) VALUES
(1, 'kate2021', '535511bb0be408e9e56d768cbabc162311507b69', 1),
(2, 'bobMelon', '56380d0972585a5211b0b8a2b44569a473e252b0', 0),
(3, 'ashleyChoi', '7f8aa23a567964e554a41b3d123b05c1d7636d13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
