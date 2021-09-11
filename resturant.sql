-- Adminer 4.8.0 MySQL 5.5.5-10.4.18-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1,	'nishan',	'12345');

DROP TABLE IF EXISTS `chef`;
CREATE TABLE `chef` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `chef` (`id`, `name`, `image`, `qualification`) VALUES
(1,	'Zahidul Islam',	'../images/zahid.jpg',	'Head chef'),
(2,	'Towhid Rahman',	'../images/',	'Pizza master'),
(4,	'Tarek Aziz',	'../images/',	'Fast Food'),
(5,	'abcd',	'../images/',	'ff'),
(6,	'abcd',	'../images/',	'ff');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `visits` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`id`, `fullname`, `username`, `password`, `address`, `contact`, `visits`) VALUES
(1,	'zahidul islam',	'zahid',	'1721883',	'Feni',	'01822092853',	4),
(8,	'towhid islam',	'towhid',	'1721883',	'kustia',	'01800000000',	1);

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `customerid` int(11) NOT NULL,
  `foodid` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`),
  KEY `foodid` (`foodid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`foodid`) REFERENCES `foodmenu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `feedback` (`id`, `comment`, `customerid`, `foodid`, `date`) VALUES
(12,	'very good',	1,	1,	'2021-09-03'),
(13,	'very nice',	8,	1,	'2021-09-03');

DROP TABLE IF EXISTS `foodmenu`;
CREATE TABLE `foodmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `foodimage` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  CONSTRAINT `foodmenu_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`type_name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `foodmenu` (`id`, `name`, `foodimage`, `ingredients`, `price`, `type`) VALUES
(1,	'Pizza',	'../images/pizza.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	50,	'Breakfast'),
(3,	'Burgers',	'../images/burger.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	100,	'Breakfast'),
(5,	'Chicken Grill',	'../images/images.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	400,	'Dinner'),
(6,	'Noodles',	'../images/nodles.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	300,	'Breakfast'),
(7,	'Nugget',	'../images/front-3-1008x500.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	130,	'Breakfast'),
(8,	'Fried Rice',	'../images/friedricechikcken.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	160,	'Lunch'),
(9,	'Faluda',	'../images/faluda.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	60,	'Snacks'),
(10,	'Donats',	'../images/donats.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	30,	'Snacks'),
(11,	'Custard',	'../images/fruit-custard.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	55,	'Lunch'),
(12,	'Icecream',	'../images/icecream.jpeg',	'It is a delicious food made of sugar, salt, butter,chicken',	70,	'Dinner'),
(13,	'Sandwitch',	'../images/sandwitch.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	25,	'Lunch'),
(14,	'Saslik',	'../images/saslik.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	35,	'Lunch'),
(15,	'Chicken Biriany',	'../images/chettinad-chicken-biryani1.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	150,	'Dinner'),
(17,	'Eggs',	'../images/EggCurry.jpg',	'It is a delicious food made of sugar, salt, butter,chicken',	34,	'Breakfast'),
(18,	'Paratha',	'../images/Paratha.jpg',	'It is a delicious food.',	15,	'Breakfast');

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customerId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerId` (`customerId`),
  CONSTRAINT `history_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `history` (`id`, `date`, `customerId`) VALUES
(11,	'2021-08-01',	1),
(17,	'2021-09-03',	1),
(18,	'2021-09-03',	1),
(19,	'2021-09-03',	8),
(20,	'2021-09-09',	1);

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foodid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foodid` (`foodid`),
  KEY `orderid` (`orderid`),
  CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`foodid`) REFERENCES `foodmenu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `orderitem` (`id`, `foodid`, `amount`, `orderid`) VALUES
(32,	7,	1,	21),
(33,	18,	1,	21),
(34,	1,	1,	22),
(35,	6,	1,	22);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderdate` date NOT NULL,
  `delivarydate` date NOT NULL,
  `delivarytime` time(6) NOT NULL,
  `phoneno` int(11) NOT NULL,
  `delivaryaddress` text NOT NULL,
  `confirmation` tinyint(1) NOT NULL DEFAULT 0,
  `validity` tinyint(1) DEFAULT 0,
  `served` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT '',
  `customerid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `orders` (`id`, `orderdate`, `delivarydate`, `delivarytime`, `phoneno`, `delivaryaddress`, `confirmation`, `validity`, `served`, `status`, `customerid`) VALUES
(21,	'2021-09-03',	'2021-09-04',	'12:46:00.000000',	1800000000,	'kustia',	0,	0,	0,	'',	8),
(22,	'2021-09-09',	'2021-09-10',	'15:40:00.000000',	18888888,	'abddn',	0,	0,	0,	'',	1);

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `type` (`type_name`) VALUES
('Breakfast'),
('Dinner'),
('Lunch'),
('Snacks');

-- 2021-09-09 09:44:29
