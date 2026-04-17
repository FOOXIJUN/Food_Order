-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2026-03-31 17:36:03
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `food`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `status`) VALUES
(1, 'gg@gmail.com', 'Gg@123456', 0);

-- --------------------------------------------------------

--
-- 表的结构 `burger`
--

CREATE TABLE `burger` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `burger`
--

INSERT INTO `burger` (`id`, `name`, `image`, `ingredient`, `price`, `product_code`, `product_qty`, `blocked`) VALUES
(1, 'Burger Bacon&Beef(additional)', 'menu/burger/bba.jpg', 'bacon,beef,tomato,vegetable,cheese', 18.00, 'B01', 1, 1),
(2, 'Burger Bacon&Beef', 'menu/burger/bb.jpg', 'bacon,beef,tomato,vegetable,cheese', 15.00, 'B02', 1, 0),
(3, 'Burger Beef', 'menu/burger/b.jpg', 'beef,tomato,vegetable,cheese', 13.00, 'B03', 1, 0),
(4, 'Burger ChickenDeluxe', 'menu/burger/cd.jpg', 'fried chicken,tomato,vegetable,cheese', 13.00, 'B04', 1, 0),
(5, 'Burger Egg&Bacon', 'menu/burger/eb.jpg', 'bacon,egg,cheese', 10.00, 'B05', 1, 0),
(6, 'Burger Fish&Chip(additional)', 'menu/burger/fca.jpg', 'fish,cheese,tomato,vegetable', 15.00, 'B06', 1, 0),
(7, 'Burger Fish&Chip', 'menu/burger/fc.jpg', 'fish,cheese,tomato,vegetable', 13.00, 'B07', 1, 0),
(8, 'Burger Grillchicken', 'menu/burger/gc.jpg', 'grill chicken,cheese,tomato,vegetable', 13.00, 'B08', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone_number`, `message`) VALUES
(7, 'ming', 'ericfoo@gmail.com', '0112333471', 'your food no good');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomobile` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `poscode` varchar(5) DEFAULT NULL,
  `country` text DEFAULT NULL,
  `hero` text DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `nomobile`, `address`, `poscode`, `country`, `hero`, `blocked`, `code`, `status`) VALUES
(42, 'ff', 'ff@123456', 'Ming@123456', '01959093699', '12,jalan', '88663', 'Kedah', 'ming', 0, 0, ''),
(43, 'ming', 'aa@gmail.com', 'Aa@123456', '0123654789', '33,jalan', '88888', 'Kelantan', 'pokemon', 0, 0, ''),
(44, 'FOO XI JUN', 'xijunfoo@gmail.com', '030708Fxj*@', '01111492408', '34，Jalan Padi 10, BANDAR BARU UDA', '81200', 'Johor', 'USA', 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `drink`
--

CREATE TABLE `drink` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `drink`
--

INSERT INTO `drink` (`id`, `name`, `image`, `price`, `product_code`, `product_qty`, `blocked`) VALUES
(1, '7up', 'menu/drink/7up.jpg', 3.00, 'D01', 1, 0),
(2, 'Cola', 'menu/drink/Cola.jpg', 3.00, 'D02', 1, 0),
(3, 'Lipton', 'menu/drink/Lipton.jpg', 3.00, 'D03', 1, 0),
(4, 'MountainDew', 'menu/drink/MountainDew.jpg', 3.00, 'D04', 1, 0),
(5, 'Pepsi', 'menu/drink/Pepsi.jpg', 3.00, 'D05', 1, 0),
(6, 'Twister', 'menu/drink/Twister.jpg', 3.00, 'D06', 1, 0),
(7, 'Water', 'menu/drink/Water.jpg', 1.50, 'D07', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` text NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `tracking_no` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `pmode`, `products`, `amount_paid`, `tracking_no`, `user_id`, `pay_date`, `status`) VALUES
(1, 'ERIC FOO XI JUN', 'xijunfoo@gmail.com', '01111492408', '34，Jalan Padi 10, BANDAR BARU UDA', 'cards', 'Pizza Hawaii(1), Cola(1), Lipton(1), 7up(3)', 33.00, '3YWMLIWVK1', 44, '2026-03-31 13:40:26', 'delivering'),
(2, 'ERIC FOO XI JUN', 'xijunfoo@gmail.com', '01111492408', '34，Jalan Padi 10, BANDAR BARU UDA', 'cards', 'Pizza Mix(1), Pizza Mix(1)', 40.00, '2LZQC7PCYV', 44, '2026-03-31 15:17:29', 'success');

-- --------------------------------------------------------

--
-- 表的结构 `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `otp`
--

INSERT INTO `otp` (`id`, `email`, `otp`) VALUES
(1, '121204752@student.mmu.edu.my', '649537'),
(2, 'ming08165@gmail.com', '499894'),
(3, 'ming08165@gmail.com', '740537'),
(4, 'ming08165@gmail.com', '513462'),
(5, 'ming08165@gmail.coma', '558219'),
(6, 'ming08165@gmail.com', '577624'),
(7, 'ming08165@gmail.com', '999085'),
(8, 'ming08165@gmail.com', '149607');

-- --------------------------------------------------------

--
-- 表的结构 `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `image`, `ingredient`, `price`, `product_code`, `product_qty`, `blocked`) VALUES
(1, 'Pizza Hawaii', 'menu/pizza/h.jpg', 'green pepper,sausage,mushroom,cheese,tomato sauce', 18.00, 'P01', 1, 0),
(2, 'Pizza Mix', 'menu/pizza/m4.jpg', 'green pepper,sausage,mushroom,pineapple,cheese,tomato sauce', 20.00, 'P02', 1, 0),
(3, 'Pizza Mix', 'menu/pizza/m.jpg', 'green pepper,sausage,mushroom,pineapple,cheese,tomato sauce', 20.00, 'P03', 1, 0),
(4, 'Pizza Mushroom', 'menu/pizza/mu.jpg', 'mushroom,cheese,tomato sauce', 15.00, 'P04', 1, 0),
(5, 'Pizza Prawn(Spicy)', 'menu/pizza/ps.jpg', 'prawn,chilli,cheese,tomato sauce', 20.00, 'P05', 1, 0),
(6, 'Pizza Prawn', 'menu/pizza/p.jpg', 'prawn,cheese,tomato sauce', 18.00, 'P06', 1, 0),
(7, 'Pizza Sausage & Mushroom', 'menu/pizza/sm.jpg', 'sausage,mushroom,cheese,tomato sauce', 22.00, 'P07', 1, 0),
(8, 'Pizza Sausage(Spicy)', 'menu/pizza/ss.jpg', 'sausage,chilli,cheese,tomato sauce', 20.00, 'P08', 1, 0),
(9, 'Pizza Sausage', 'menu/pizza/s.jpg', 'sausage,cheese,tomato sauce', 18.00, 'P09', 1, 0),
(10, 'Pizza Yellow Pear & Mushroom', 'menu/pizza/ypm.jpg', 'yellow pear,mushroom,cheese,tomato sauce', 20.00, 'P10', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`) VALUES
(1, 'Burger max++', '9', 1, 'menu/burger/b.jpg', 'p1000'),
(2, 'Burger 1', '7.5', 1, 'menu/burger/bb.jpg', 'p1001'),
(3, 'Burger 2', '6', 1, 'menu/burger/cd.jpg', 'p1002'),
(4, 'Burger 3', '15', 1, 'menu/burger/gc.jpg', 'p1003'),
(5, 'Burger 4', '25', 1, 'menu/burger/burger 7.jpg', 'p1004'),
(7, 'Burger 7', '15000', 1, 'menu/burger/b.jpg', 'p1006'),
(9, 'Burger 8', '25000', 1, 'menu/burger/b.jpg', 'p1007'),
(11, 'Burger 8', '25000', 1, 'menu/burger/b.jpg', 'p1008');

-- --------------------------------------------------------

--
-- 表的结构 `snack`
--

CREATE TABLE `snack` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `snack`
--

INSERT INTO `snack` (`id`, `name`, `image`, `price`, `product_code`, `product_qty`, `blocked`) VALUES
(1, 'Cheese Bread', 'menu/snack/cb.jpg', 10.00, 'S01', 1, 0),
(2, 'Chocolate Cake', 'menu/snack/c.jpg', 8.00, 'S02', 1, 0),
(3, 'French Fries', 'menu/snack/ff.jpg', 7.00, 'S03', 1, 0),
(4, 'Fried Chicken', 'menu/snack/fc.jpg', 10.00, 'S04', 1, 0),
(5, 'Garlic Bread(BBQ)', 'menu/snack/gbb.jpg', 8.00, 'S05', 1, 0),
(6, 'Garlic Bread(Mayonaise)', 'menu/snack/gbm.jpg', 8.00, 'S06', 1, 0),
(7, 'Garlic Bread', 'menu/snack/gb.jpg', 7.00, 'S07', 1, 0),
(8, 'Roll Bread(BBQ)', 'menu/snack/rbb.jpg', 8.00, 'S08', 1, 0),
(9, 'Roll Bread(Mayonaise)', 'menu/snack/rbm.jpg', 8.00, 'S09', 1, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 表的索引 `burger`
--
ALTER TABLE `burger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- 表的索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_no` (`tracking_no`);

--
-- 表的索引 `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- 表的索引 `snack`
--
ALTER TABLE `snack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `burger`
--
ALTER TABLE `burger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `drink`
--
ALTER TABLE `drink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `snack`
--
ALTER TABLE `snack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
