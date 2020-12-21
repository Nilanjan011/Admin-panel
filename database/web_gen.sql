-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 06:53 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_gen`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `is_available` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `pname`, `price`, `is_available`, `product_image`, `create_date`) VALUES
(22, 'iphone', '60000', '10', 'images.jpeg', '2020-12-21'),
(23, 'Nokia', '10000', '20', 'nokia.jpeg', '2020-12-21'),
(24, 'Cemara', '50000', '40', 'pexels-alex-azabache-3907507.jpg', '2020-12-20'),
(25, 'TV', '452', '5', 'pexels-andre-moura-3151392.jpg', '2020-12-20'),
(26, 'Head phone', '1000', '25', 'pexels-burst-373945.jpg', '2020-12-21'),
(27, 'calo', '10000', '10', 'pexels-caio-1279107.jpg', '2020-12-21'),
(28, 'camera 12', '10000', '10', 'pexels-demeter-attila-50924.jpg', '2020-12-21'),
(29, 'Laptop', '30000', '10', 'pexels-junior-teixeira-2047905.jpg', '2020-12-21'),
(30, 'Camera pro ', '10000', '10', 'pexels-math-90946.jpg', '2020-12-21'),
(31, 'Memory Card 128GB', '9000', '10', 'pexels-luis-quintero-1738641.jpg', '2020-12-21'),
(32, 'Cold Cream', '200', '100', 'pexels-kristina-paukshtite-3270223.jpg', '2020-12-21'),
(33, 'Jug', '200', '100', 'pexels-pixabay-248412.jpg', '2020-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Fname`, `Lname`, `email`, `password`) VALUES
(1, 'Nilanjan', 'Chakraborty', 'nilanjan@gmail.com', '123456'),
(4, 'Rana', 'das', 'rana@gmail.com', '1234566'),
(6, 'Rana', 'kumar', 'abcd@gmail.com', '46454555555'),
(7, 'john', 'cena', 'john@gmail.com', '4542635656'),
(8, 'ram', 'dey', 'ram@gmail.com', 'ram123456'),
(9, 'sham', 'sharma', 'sham@yehoo.com', 'ram12345601');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `myuniqueconstraint` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
