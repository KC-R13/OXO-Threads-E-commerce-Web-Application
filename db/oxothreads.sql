-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2024 at 04:04 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oxothreads`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `confirm_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `phone`, `password`, `confirm_password`, `status`) VALUES
(1, 'meow', 'meow@gmail.com', '0705938158', '123', '123', 1),
(34, 'marklee', 'marksrealgf@gmail.com', '6485127854', '1', '1', 1),
(36, 'leetaeyong', 'bubu@gmail.com', '4534532245', 'bubu', 'bubu', 1),
(37, 'choisan', 'mountainchoi@gmail.com', '1234323432', 'choi', 'choi', 1),
(38, 'futurecanoe', 'futurecanoe@gmail.com', '5641654345', '3', '3', 1),
(39, 'admin', 'admin@gmail.com', '0123456789', '1', '1', 1),
(40, 'admin2', 'admin2@gmail.com', '1231231231', '123', '123', 1),
(41, 'marksrealgf', 'marksrealestgf@gmail.com', '1271271271', '1', '1', 1),
(42, 'johnny', 'johnny@gmail.com', '1234564321', '1', '1', 1),
(43, 'yourmom', 'yourmom@gmail.com', '1111111111', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE IF NOT EXISTS `checkouts` (
  `checkout_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `checkout_datetime` datetime DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`checkout_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `customer_id`, `checkout_datetime`, `total_price`) VALUES
(89, 7, '2024-01-11 19:52:38', '16800.00'),
(84, 1, '2024-01-11 19:07:18', '191400.00'),
(90, 8, '2024-01-12 03:25:49', '242000.00'),
(77, 7, '2024-01-11 16:52:43', '78300.00'),
(86, 7, '2024-01-11 19:41:07', '133000.00'),
(87, 7, '2024-01-11 19:46:44', '9900.00'),
(74, 7, '2024-01-11 16:50:31', '435600.00'),
(73, 7, '2024-01-11 16:42:02', '26400.00'),
(72, 7, '2024-01-11 16:38:01', '456500.00');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_items`
--

DROP TABLE IF EXISTS `checkout_items`;
CREATE TABLE IF NOT EXISTS `checkout_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `checkout_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `quantitys` int NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `checkout_id` (`checkout_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_items`
--

INSERT INTO `checkout_items` (`item_id`, `checkout_id`, `product_id`, `size`, `quantitys`, `product_price`, `product_image`) VALUES
(95, 73, 24, 'S', 6, '4400.00', 'uploads/85320711_050_b.webp'),
(96, 73, 25, 'XL', 8, '5500.00', 'uploads/88072541_047_b.png'),
(97, 73, 37, 'S', 10, '8900.00', 'uploads/04545bfb208f7748a989f91e29e16ccf.jpg'),
(98, 74, 24, 'S', 99, '4400.00', 'uploads/85320711_050_b.webp'),
(99, 77, 21, 'XL', 27, '2900.00', 'uploads/1.webp'),
(100, 84, 37, 'XL', 1, '8900.00', 'uploads/04545bfb208f7748a989f91e29e16ccf.jpg'),
(101, 84, 24, 'L', 1, '4400.00', 'uploads/85320711_050_b.webp'),
(102, 84, 21, 'M', 1, '2900.00', 'uploads/1.webp'),
(103, 84, 25, 'XS', 1, '5500.00', 'uploads/88072541_047_b.png'),
(104, 84, 20, 'M', 1, '5700.00', 'uploads/84682434_029_b.png'),
(112, 89, 25, 'S', 2, '5500.00', 'uploads/88072541_047_b.png'),
(111, 87, 24, 'S', 1, '4400.00', 'uploads/85320711_050_b.webp'),
(110, 87, 25, 'S', 1, '5500.00', 'uploads/88072541_047_b.png'),
(108, 86, 24, 'S', 10, '4400.00', 'uploads/85320711_050_b.webp'),
(109, 86, 37, 'M', 10, '8900.00', 'uploads/04545bfb208f7748a989f91e29e16ccf.jpg'),
(113, 89, 21, 'S', 2, '2900.00', 'uploads/1.webp'),
(114, 90, 66, 'S', 10, '8800.00', 'uploads/image_2024-01-12_063435381.png'),
(115, 90, 68, 'XL', 10, '7600.00', 'uploads/image_2024-01-12_064129652.png'),
(116, 90, 67, 'L', 10, '7800.00', 'uploads/image_2024-01-12_063648147.png'),
(94, 84, 37, 'S', 66, '8900.00', 'uploads/04545bfb208f7748a989f91e29e16ccf.jpg'),
(92, 72, 24, 'S', 55, '4400.00', 'uploads/85320711_050_b.webp'),
(93, 72, 25, 'XL', 83, '5500.00', 'uploads/88072541_047_b.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

DROP TABLE IF EXISTS `contact_submissions`;
CREATE TABLE IF NOT EXISTS `contact_submissions` (
  `submission_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`submission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`submission_id`, `first_name`, `last_name`, `email`, `subject`, `message`, `submission_date`) VALUES
(1, 'bubu', 'lee', 'kiwistylik@gmail.com', 'hehe', 'hehehehe', '2024-01-12 02:20:16'),
(2, 'it\'s me', 'meeee', 'me@gmail.com', 'me again', 'me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again me again ', '2024-01-12 02:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` int NOT NULL,
  `userimage` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirmpassword` varchar(50) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `telephone`, `userimage`, `password`, `confirmpassword`, `status`) VALUES
(1, 'markie', 'lee', 'marklee@gmail.com', 705938158, 'uploads/MARK LEE MUSTACHEEEE.jpg', '123', '123', 1),
(4, 'choi', 'san', 'choisan@gmail.com', 726962309, 'uploads/customers/mew.jpg', '1', '1', 1),
(7, 'demo', 'cust', 'cust@gmail.com', 1231231231, 'uploads/customers/maxresdefault.jpg', '1', '1', 1),
(8, 'marcus', 'leecus', 'marcus@gmail.com', 2147483647, 'uploads/customers/mew.jpg', '1', '1', 1),
(9, 'san', 'shine', 'sanshine@gmail.com', 1212121212, 'uploads/customers/user2.png', '1', '1', 1),
(10, 'bubu', 'yong', 'bubu@gmail.com', 705938158, 'uploads/customers/user5.png', '1', '1', 1),
(11, 'captain', 'joong', 'capjoong@gmail.com', 1271271271, 'uploads/customers/user6.png', '1', '1', 1),
(12, 'lee', 'taeyong', 'taeyong@gmail.com', 1271271272, 'uploads/customers/user7.png', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
CREATE TABLE IF NOT EXISTS `order_history` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `productname` varchar(350) NOT NULL,
  `product_details` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_content` varchar(300) NOT NULL,
  `product_features` varchar(350) NOT NULL,
  `product_size` varchar(300) NOT NULL,
  `productcategory` varchar(50) NOT NULL,
  `productimage` varchar(300) NOT NULL,
  `product_displayimage` varchar(300) NOT NULL,
  `productprice` varchar(20) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `productname`, `product_details`, `product_content`, `product_features`, `product_size`, `productcategory`, `productimage`, `product_displayimage`, `productprice`, `status`) VALUES
(20, 'XLARGE Twill Easy Cargo Pant', 'Color Code: 127\r\n\r\nTwill easy cargo pants by XLARGE. Durable cotton twill with an allover pattern. Easy relaxed fit with an elastic paneled waistband.', '- 100% Cotton\r\n- Machine wash\r\n- Imported', '- Twill easy cargo pants from XLARGE\r\n- Allover pattern\r\n- Relaxed fit\r\n- Elastic paneled waistband', '- Model is 6’1\" and wearing size Medium\r\n- Measurements taken from size Medium\r\n- Rise: 11\"\r\n- Inseam: 28\"\r\n- Leg opening: 10\"', 'bottomwear', 'uploads/BeFunky-collage (1).png', 'uploads/84682434_029_b.png', '5700.00', 1),
(21, 'Blink Oversized Tee Shirt Dress ', 'Fleece sweatshirt with Blink 127 graphics printed at the front and back. Cut in a relaxed + oversized fit with a crew neckline and dropped shoulders. Find it only at OXO Threads.', '- 50% Cotton, 50% polyester\r\n- Machine wash\r\n- Imported', '- Pullover Blink 182 sweatshirt\r\n- Oversized fit\r\n- Crew neckline\r\n- OXO exclusive', '- Model in Pink is 5’8\" and wearing size Small/Medium\r\n- Measurements taken from size Small/Medium\r\n- Chest: 53\"\r\n- Length: 19\"', 'tees', 'uploads/BeFunky-collage.png', 'uploads/1.webp', '2900.00', 1),
(24, 'Teddy Fresh Graphic Sweatpant ', 'Classic look sweatpants by Teddy Fresh with a bleached graphic look. Tapered silhouette with gathered ankle cuffs. Fitted with pockets and a stretch waistband.\n\n', '- Bleach graphic sweatpants from Teddy Fresh\n- Classic fit with gathered ankle cuffs\n- Stretch elastic waistband', '- 100% Cotton\n- Machine wash\n- Imported', '- Model in Black is 5\'8\" and wearing size Small\n- Measurements taken from size Small\n- Rise: 13\"\n- Inseam: 30\"\n- Leg opening: 12\"', 'bottomwear', 'uploads/jfhwkdn.png', 'uploads/85320711_050_b.webp', '4400.00', 1),
(25, 'BDG Denim Zip-Up Mini Dress ', 'Color Code: 091\n\nMini dress crafted from BDG denim in a ‘90s-inspired overall silhouette. Designed with wide straps, a straight-across neckline and an a-line silhouette through the skirt. Finished with pleats towards the hem. ', '- 80% Cotton, 19% polyester, 1% spandex\n- Machine wash\n- Imported', '- Denim overall mini dress from BDG\n- Crafted from signature BDG denim with a hint of stretch for comfort and fit\n- A-line silhouette\n- OXO exclusive', '- Model in Indigo is 5’9\" and wearing size Small\n- Measurements taken from size Small\n- Length: 31', 'dresses', 'uploads/dress1.png', 'uploads/88072541_047_b.png', '5500.00', 1),
(37, 'YSL Sequined Dress Jersey Unisex', 'Sparkly + shiny midi dress from YSL with sequins all around. Cut in a slim-fitting silhouette with a turtle neckline and finished with an adjustable tie at the high-cut turtleneck.\r\n\r\n', '- 100% Polyester\r\n- Machine wash\r\n- Imported', '- Sequin YSL midi dress\r\n- Fitted style\r\n- Turtle neckline\r\n- Stretchy at the back\r\n\r\n', '- Model in Red is 5’9\" and wearing size 4\r\n- Measurements taken from size 4\r\n- Length: 48\"', 'dresses', 'uploads/dress2.png', 'uploads/04545bfb208f7748a989f91e29e16ccf.jpg', '8900.00', 1),
(62, 'OXO Tibby Strappy-Back Mini Dress', 'Color Code: 040\r\n\r\nMini dress from OXO cut short in a fitted silhouette with a straight-across halter neckline and a subtle a-line silhouette through the skirt. Finished with strappy detailing at the back. Exclusively at OXO.', '- 76% Polyester, 20% viscose, 4% spandex\r\n- Machine wash\r\n- Imported', '- OXO strappy-back mini dress\r\n- Short + fitted style\r\n- Halter neckline\r\n- UO exclusive', '- Model in Black is 5’9\" and wearing size Small\r\n- Measurements taken from size Small\r\n- Length: 33\"', 'dresses', 'uploads/dress5.jpg', 'uploads/88035761_040_b.webp', '3127.00', 1),
(63, 'Out From Under Jayden Lace-Inset Sweatpant', 'Super soft + cozy lounge pants by Out From Under. Cut in a relaxed silhouette with a low-rise, a wide-leg and a puddled hem. Complete with semi-sheer lace-insets at the sides. Only at OXO', '- 58% Cotton, 42% polyester\r\n- Machine wash\r\n- Imported', '- Out From Under sweatpants with lace detailing\r\n- Low-rise\r\n- Puddled hem\r\n- Pull-on construction\r\n- Side pockets\r\n- OXO exclusive', '- Model in Ivory is 5’10\" and wearing size Small', 'loungewear', 'uploads/lounge1.jpg', 'uploads/image_2024-01-12_062203117.png', '3300.00', 1),
(64, 'Shirting Sleeve Crew Neck Sweatshirt', 'color code : GREY', '- Wash with care', '- OXO Exclusive sleepwear', '- Model wears XL\r\n- Height 6\"', 'loungewear', 'uploads/lounge2.jpg', 'uploads/image_2024-01-12_062524823.png', '3400.00', 1),
(65, 'Death Row Records Doberman Tee', 'Tee with a Death Row Records graphic printed at the front. Cotton jersey t-shirt in a standard fit with short sleeves & a ribbed knit crew neck.', '- 100% Cotton\r\n- Machine wash\r\n- Imported', '- Death Row Records tee\r\n- Front graphic\r\n- Regular fit', '- Measurements taken from size Large\r\n- Chest: 22\"\r\n- Length: 31\"', 'tees', 'uploads/tee1.jpg', 'uploads/image_2024-01-12_063042810.png', '3000.00', 1),
(66, 'Vintage Full Zip Multi Pocket Fitted Waist Leather Jacket', 'Color Code: 020', '- No Size Tag\r\n\r\n- Pit to Pit: 20\"\r\n\r\n- Top To Bottom: 30\"\r\n\r\n- Sleeve Length: 22\"\r\n\r\n', '- Loose threading on the inside\r\n\r\n- Wash in cold water, hang dry\r\n\r\n- Imported from Canada\r\n\r\n', 'Authentic vintage piece, handpicked from around the world. One-of-a-Kind Vintage styles are singularly circular, extending the lifecycle of clothing one collectible piece at a time.', 'vintage', 'uploads/vintage1.jpg', 'uploads/image_2024-01-12_063435381.png', '8800.00', 1),
(67, 'Urban Renewal Remade Sweatshirt Sleeve Denim Jacket', 'Color Code: 021\r\n\r\nWater resistant flight jacket by Alpha Industries and made in collaboration with Standard Cloth. Classic satin look with a contrast side for a reversible style. Zip closure front with ribbing trims and hand pockets at the sides.', '- 100% Nylon\r\n- Machine wash\r\n- Imported\r\n', '- Reversible bomber jacket from Alpha Industries\r\n- Made with Standard Cloth\r\n- Zippered front\r\n- Ribbed knit trims', '- Model is 6’2.5\" and wearing size Large', 'vintage', 'uploads/vintage2.jpg', 'uploads/image_2024-01-12_063648147.png', '7800.00', 1),
(68, 'Renewal Remade Boxy Raw Cropped Long Sleeve Shirt', 'Water resistant flight jacket by Alpha Industries and made in collaboration with Standard Cloth. Classic satin look with a contrast side for a reversible style. Zip closure front with ribbing trims and hand pockets at the sides. OXO exclusive.\r\n', '- 100% Nylon\r\n- Machine wash\r\n- Imported', '- Reversible bomber jacket from Alpha Industries\r\n- Made with Standard Cloth\r\n- Zippered front\r\n- Ribbed knit trims', '- Model is 6’2.5\" and wearing size Larg', 'vintage', 'uploads/vintage4.jpg', 'uploads/image_2024-01-12_064129652.png', '7600.00', 1),
(69, 'Whimsy + Row Logan Organic Cotton Jumpsuit', 'Color Code: 091\n\nMini dress crafted from BDG denim in a ‘90s-inspired overall silhouette. Designed with wide straps, a straight-across neckline and an a-line silhouette through the skirt. Finished with pleats towards the hem. ', 'dsa- 80% Cotton, 19% polyester, 1% spandex\n- Machine wash\n- Imported', 'dsa- Denim overall mini dress from BDG\n- Crafted from signature BDG denim with a hint of stretch for comfort and fit\n- A-line silhouette\n- OXO exclusive', 'sa- Model in Indigo is 5’9\" and wearing size Small\n- Measurements taken from size Small\n- Length: 31', 'jumpsuits', 'uploads/jumpsuits2.jpg', 'uploads/jump2.webp', '6800.00', 1),
(70, 'Whimsy + Row Logan Organic Cotton Jumpsuit', 'Color Code: 091\n\nMini dress crafted from BDG denim in a ‘90s-inspired overall silhouette. Designed with wide straps, a straight-across neckline and an a-line silhouette through the skirt. Finished with pleats towards the hem. ', 'jhkj- 80% Cotton, 19% polyester, 1% spandex\n- Machine wash\n- Imported', 'hj- Denim overall mini dress from BDG\n- Crafted from signature BDG denim with a hint of stretch for comfort and fit\n- A-line silhouette\n- OXO exclusive', '- Model in Indigo is 5’9\" and wearing size Small\n- Measurements taken from size Small\n- Length: 31', 'jumpsuits', 'uploads/jumpsuits2.jpg', 'uploads/jump1.webp', '8900.00', 1),
(73, 'Dr. Martens Jorge Clog', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'footwear', 'uploads/footwear1.jpg', 'uploads/image_2024-01-12_091544881.png', '24000.00', 1),
(74, 'ASICS Gel-NYC Sportstyle Sneakers', 'The GEL-NYC™ sneaker sources inspiration from heritage and modern performance running styles.​Its upper construction references the GEL-NIMBUS® 3 shoe from the early 2000s and blends it with various embellishments from the GEL-MC PLUS™ V design.​The tooling contrasts the upper\'s retro influences by using the GEL-CUMULUS® 16 shoe\'s tooling system. Through a combination of lightweight foams and GEL™ technology inserts, this midsole formation helps create advanced underfoot comfort.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'footwear', 'uploads/footwear3.jpg', 'uploads/image_2024-01-12_092007565.png', '20000.00', 1),
(75, 'BDG All-State Tank Top', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 'tees', 'uploads/tee4.jpg', 'uploads/image_2024-01-12_092156937.png', '3400.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewid` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `stars` varchar(50) NOT NULL,
  `productname` varchar(300) NOT NULL,
  `status` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`reviewid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewid`, `customer_id`, `fname`, `lname`, `description`, `stars`, `productname`, `status`, `date`) VALUES
(1, 7, 'demo', 'cust', 'i fucking can\'t do this fr aaaaaaaaaaaaaaaaaaaa', '4', 'YSL Sequined Dress Jersey Unisex', 1, '2024-01-11'),
(7, 4, 'choi', 'san', 'this is the best thing ever happened in my life', '5', 'YSL Sequined Dress Jersey Unisex', 1, '2024-01-12'),
(8, 8, 'marcus', 'leecus', 'This like?? soo?? good? omg??? i cant even', '5', 'Urban Renewal Remade Sweatshirt Sleeve Denim Jacket', 1, '2024-01-12'),
(9, 8, 'marcus', 'leecus', 'idk what to reviewwww i\'m just writing whtv my sleep deprived brain is coming up w', '4', 'YSL Sequined Dress Jersey Unisex', 1, '2024-01-12'),
(10, 10, 'bubu', 'yong', 'i am so sleeeeeepy i am so sleeeeeee pyyyyyyyyyyyyyy this is a review', '4', 'BDG All-State Tank Top\n', 1, '2024-01-12'),
(11, 11, 'captain', 'joong', 'i\'m writing a reeeeevieeewww test check neo got my back culture tings tech tech', '5', 'YSL Sequined Dress Jersey Unisex', 1, '2024-01-12'),
(12, 12, 'lee', 'taeyong', 'THESE ARE THE BEST DAMN SHOES A MAN CAN GET LIKE?? THEYRE SO?? COMFORTABLE?? I CAAAAAANT', '5', 'Dr. Martens Jorge Clog', 1, '2024-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `productimage` varchar(300) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  KEY `product_name` (`product_name`),
  KEY `product_price` (`price`) USING BTREE,
  KEY `productimage` (`productimage`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `customer_id`, `product_id`, `product_name`, `quantity`, `size`, `price`, `productimage`) VALUES
(12, 4, 37, 'YSL Sequined Dress Jersey Unisex ', 1, 'XL', '8900.00', 'uploads/dress2.png'),
(13, 4, 20, 'XLARGE Twill Easy Cargo Pant', 1, 'S', '5700.00', 'uploads/BeFunky-collage (1).png'),
(88, 0, 25, 'BDG Denim Zip-Up Mini Dress ', 1, 'S', '5500.00', 'uploads/88072541_047_b.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
