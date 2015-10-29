-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2015 at 08:12 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ekart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(10) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `userid`, `name`, `mobile`, `address`) VALUES
(1, 1, 'College', '9790995811', 'L - 414, VIT Hostels, VIT University, Vellore'),
(2, 1, 'Home', '9790995811', 'Flat No: 102, Sai Nikitha Residency, Madhura Nagar, Khadi Colony, Tirupati'),
(3, 3, 'Home', '9866177925', 'Flat no: 352, Venkat Apartments, Gandhi Nagar, Hyderabad');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`userid`, `productid`, `qty`) VALUES
(1, 8, 1),
(1, 19, 1),
(2, 5, 1),
(2, 16, 1),
(3, 33, 1),
(4, 3, 1),
(5, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Mobiles'),
(2, 'Laptops'),
(3, 'Clothing'),
(4, 'Beauty'),
(5, 'TVs'),
(6, 'Furnitures'),
(7, 'Books'),
(8, 'Movies');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(25) NOT NULL,
  `instock` int(2) NOT NULL DEFAULT '1',
  `description` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catid`, `name`, `price`, `instock`, `description`, `timestamp`) VALUES
(1, 1, 'Asus Zenfone 2 Laser ZE550KL', 9999, 1, 'Key Features of Asus Zenfone 2 Laser ZE550KL\nAndroid v5 (Lollipop) OS\n13 MP Primary Camera\n5 MP Secondary Camera\nDual Sim (LTE + LTE)\n5.5 inch Capacitive Touchscreen\n1.2 GHz Qualcomm Snapdragon 410 MSM8916 Quad Core Processor\nExpandable Storage Capacity of 128 GB', '2015-10-17 18:07:48'),
(2, 1, 'Moto X Play', 19999, 1, 'Key Features of Moto X Play\nAndroid v5.1.1 (Lollipop) OS\n21 MP Primary Camera\n5 MP Secondary Camera\n5.5 inch Touchscreen\n1.7 GHz Qualcomm Snapdragon 615 Octa Core Processor\n3630 mAh Li-Ion Battery\nExpandable Storage Capacity of 128 GB', '2015-10-17 18:07:48'),
(3, 1, 'Moto G (3rd Generation)', 12999, 1, 'Key Features of Moto G (3rd Generation)\r\nIPX7 Water Resistance\r\n13 MP Primary Camera\r\n5 MP Secondary Camera\r\n2470 mAh Long Lasting Battery\r\nQualcomm Snapdragon 410 (MSM8916) Processor with 1.4 GHz Quad Core CPU, Adreno 306 with 400 MHz GPU\r\n4G LTE\r\n5 inch, 720p HD (1280 x 720), Corning Gorilla Glass 3\r\nAndroid v5.1.1 (Lollipop) OS\r\nDual Sim (GSM + LTE)\r\nExpandable Storage Capacity of 32 GB', '2015-10-17 18:15:46'),
(4, 1, 'Lenovo K3 Note', 9999, 1, 'Key Features of Lenovo K3 Note\r\nAndroid v5 (Lollipop) OS\r\n5.5 inch Capacitive Touchscreen\r\nDual Standby Sim (LTE + LTE)\r\n1.7 GHz Cortex-A53 (MediaTek MT6752 64-bit 4G LTE) Octa Core Processor\r\nWi-Fi Enabled\r\n13 MP Primary Camera\r\n5 MP Secondary Camera\r\nExpandable Storage Capacity of 32 GB', '2015-10-17 18:16:26'),
(5, 1, 'Micromax Canvas Xpress 2', 5999, 1, 'Key Features of Micromax Canvas Xpress 2\r\nAndroid v4.4.2 (KitKat) OS\r\n13 MP Primary Camera\r\n2 MP Secondary Camera\r\nDual Sim (GSM + WCDMA)\r\n5 inch Touchscreen\r\n1.4 GHz MTK6592M Octa Core Processor\r\nWi-Fi Enabled\r\nExpandable Storage Capacity of 32 GB', '2015-10-17 18:17:24'),
(6, 1, 'Mi 4i', 12999, 1, 'Key Features of Mi 4i\r\nUnibody Design, Ultra-compact Frame\r\n2nd-gen Snapdragon 615 Processor, 2GB RAM, 16GB Flash\r\n5 inch Sharp/JDI 1080p Display\r\nAll-new Sunlight Display, Corning OGS Glass\r\n13MP Sony /Samsung Camera f/2.0 aperture, Two-tone Flash\r\n5MP Front Camera with Beautify\r\n4.4V 3030 mAh Battery, 4G Dual SIM\r\nMIUI 6 on Android L', '2015-10-17 18:18:16'),
(7, 1, 'Samsung Galaxy J5', 12390, 1, 'Key Features of Samsung Galaxy J5\r\nAndroid v5.1 (Lollipop) OS\r\n13 MP Primary Camera\r\n5 MP Secondary Camera with Front Flash\r\n5 inch Super AMOLED Capacitive Touchscreen\r\n1.2 GHz Qualcomm MSM8916 Quad Core Processor\r\nDual Standby Sim (LTE + GSM)\r\nExpandable Storage Capacity of 128 GB\r\n4G (LTE) - Cat 4', '2015-10-17 18:19:07'),
(8, 1, 'Apple iPhone 6', 42480, 1, 'Key Features of Apple iPhone 6\r\n1.2 MP Secondary Camera\r\niOS 8\r\nBluetooth Support\r\n8 MP Primary Camera\r\n4.7 inch Touchscreen\r\nFull HD Recording\r\nWi-Fi Enabled', '2015-10-17 18:19:54'),
(9, 1, 'Apple iPhone 4S', 13999, 0, 'Key Features of Apple iPhone 4S\r\n3.5 inch Capacitive Touchscreen\r\nFull HD Recording\r\n8 MP Primary Camera\r\n0.3 MP Secondary Camera\r\nWi-Fi Enabled\r\n8 GB Internal Memory\r\nBluetooth Support', '2015-10-17 18:20:42'),
(10, 1, 'Honor 4C', 8999, 1, 'Key Features of Honor 4C\r\nAndroid v4.4 (KitKat) OS\r\n13 MP Primary Camera\r\n5 MP Secondary Camera\r\n5 inch Capacitive LCD Touchscreen\r\n1.2 GHz Kirin 620 Octa Core Processor\r\nWi-Fi Enabled\r\nFull HD Recording\r\nExpandable Storage Capacity of 32 GB', '2015-10-17 18:21:27'),
(11, 2, 'Acer Aspire E5-551G (Notebook) (APU Quad Core A10/ 8GB/ 1TB/ Linux/ 2GB Graph) (NX.MLESI.001)', 32490, 1, 'Key Features of Acer Aspire E5-551G (Notebook) (APU Quad Core A10/ 8GB/ 1TB/ Linux/ 2GB Graph) (NX.MLESI.001)\r\nAPU Quad Core A10\r\n8 GB DDR3 RAM\r\n1 TB HDD\r\nLinux', '2015-10-17 18:26:33'),
(12, 2, 'Asus EeeBook X205TA Notebook (4th Gen Atom Quad Core/ 2GB/ 32GB EMMC/ Win 8.1/Office 365)', 15490, 1, 'Key Features of Asus EeeBook X205TA Notebook (4th Gen Atom Quad Core/ 2GB/ 32GB EMMC/ Win 8.1/Office 365)\r\nIntel Atom\r\n2 GB DDR3 RAM\r\n32 GB EMMC HDD', '2015-10-17 18:27:25'),
(13, 2, 'HP 15-ac052TX (Notebook) (Core i5 5th Gen/ 8GB/ 1TB/ Win8.1/ 2GB Graph) (M9V69PA)', 43490, 1, 'Key Features of HP 15-ac052TX (Notebook) (Core i5 5th Gen/ 8GB/ 1TB/ Win8.1/ 2GB Graph) (M9V69PA)\r\nIntel Core i5\r\n8 GB DDR3 RAM\r\n1 TB HDD\r\nWindows 8.1\r\n2 GB Grphics', '2015-10-17 18:28:46'),
(14, 2, 'Micromax Canvas Laptab LT666 (2 in 1 Laptop) ( Intel Atom Quad Core 4th Gen/ 2GB/ 32 GB eMMC/ Win8.1 with Office 365)', 14999, 1, 'Key Features of Micromax Canvas Laptab LT666 (2 in 1 Laptop) ( Intel Atom Quad Core 4th Gen/ 2GB/ 32 GB eMMC/ Win8.1 with Office 365)\r\nIntel Atom Quad Core\r\n2 GB DDR3 RAM\r\n32 GB HDD\r\nWindows 8.1 with Bing', '2015-10-17 18:29:54'),
(15, 2, 'Dell Inspiron 3551 Notebook (PQC/ 4GB/ 500GB/ Ubuntu) (X560139IN9)', 19990, 0, 'Key Features of Dell Inspiron 3551 Notebook (PQC/ 4GB/ 500GB/ Ubuntu) (X560139IN9)\r\nPentium Quad Core\r\n4 GB DDR3 RAM\r\n500 GB HDD', '2015-10-17 18:31:29'),
(16, 2, 'Asus EeeBook X205TA Notebook (4th Gen Atom Quad Core/ 2GB/ 32GB EMMC/ Win 8.1/Office 365)', 15490, 0, 'Key Features of Asus EeeBook X205TA Notebook (4th Gen Atom Quad Core/ 2GB/ 32GB EMMC/ Win 8.1/Office 365)\r\n2 GB DDR3 RAM', '2015-10-17 18:33:19'),
(17, 2, 'HP 15-ac098TU Notebook (Core i3 5th Gen/ 4GB/ 1TB/ Free DOS) (N4F84PA)', 28490, 1, 'Key Features of HP 15-ac098TU Notebook (Core i3 5th Gen/ 4GB/ 1TB/ Free DOS) (N4F84PA)\r\nCore i3 (5th Gen)\r\n4 GB DDR3 RAM\r\n1 TB HDD', '2015-10-17 18:34:13'),
(18, 2, 'Dell Inspiron 3148 (Intel 2-in-1 Laptop) (4th Gen Ci3/ 4GB/ 500GB/ Win8.1/ Touch) (314834500iST)', 36197, 1, 'Key Features of Dell Inspiron 3148 (Intel 2-in-1 Laptop) (4th Gen Ci3/ 4GB/ 500GB/ Win8.1/ Touch) (314834500iST)\r\nIntel Core i3 (4th Gen)\r\n4 GB DDR3 RAM\r\n500 GB HDD\r\nWindows 8.1', '2015-10-17 18:35:02'),
(19, 2, 'Apple MD101HN/A Macbook Pro MD101HN/A Intel Core i5 - (4 GB DDR3/500 GB HDD/Mac OS)', 55990, 1, 'Key Features of Apple MD101HN/A Macbook Pro MD101HN/A Intel Core i5 - (4 GB DDR3/500 GB HDD/Mac OS)\r\nIntel Core i5\r\n4 GB DDR3 RAM\r\n500 GB HDD\r\nOS X Mavericks', '2015-10-17 18:35:56'),
(20, 2, 'Apple MJVE2HN/A Ultrabook (Core i5 5th Gen/ 4GB/ 128GB/ Mac OS X Yosemite)', 59990, 1, 'Key Features of Apple MJVE2HN/A Ultrabook (Core i5 5th Gen/ 4GB/ 128GB/ Mac OS X Yosemite)\r\nIntel Core i5\r\n4 GB DDR3 RAM\r\n128 GB SSD\r\nMac OS X Yosemite', '2015-10-17 18:36:41'),
(21, 3, 'Suspense Men''s Solid Casual Shirt', 449, 1, 'GENERAL DETAILS\nPattern	        Solid\nOccasion	Casual\nIdeal For         Men''s', '2015-10-17 18:43:30'),
(22, 3, 'Suspense Men''s Solid Casual Shirt', 449, 1, 'GENERAL DETAILS\nPattern	        Solid\nIdeal For         Men''s\nOccasion	Casual', '2015-10-17 18:44:54'),
(23, 3, 'Suspense Men''s Solid Casual Shirt', 449, 1, 'GENERAL DETAILS\nPattern	        Solid\nIdeal For         Men''s\nOccasion	Casual', '2015-10-17 18:50:07'),
(24, 3, 'Top Notch Solid Men''s Henley T-Shirt', 669, 0, 'Top Notch Solid Men''s Henley T-Shirt (Pack of 2) Price: Rs. 669\r\nBasics never wear out of fashion. You can team your basics with literally everything. They can carry any look with ease. Pair it with a blazer and a jean to give it that not-so-formal yet casual look, with a pair of 3/4ths or chinos and uber cool loafer it gives you fun outing look. The premium knits T-shirts from Top Notch are made of 100% combed cotton. Pre-shrunk to let you worry less about shrinkage. They are highly comfortable and smooth on skin. Top Notch makes it easy on your pocket by letting you buy 2 for the price of 1.', '2015-10-17 18:51:00'),
(25, 3, 'Ben Carter Slim Fit Men''s Jeans', 525, 1, 'Key Features of Ben Carter Slim Fit Men''s Jeans\r\nInseam: 33.5 inch\r\nRise: Mid Rise\r\nColor: Black\r\nFit: Slim', '2015-10-17 18:51:41'),
(26, 3, 'Ishin Printed Fashion Georgette Sari', 429, 0, 'Key Features of Ishin Printed Fashion Georgette Sari\r\nWith Blouse Piece\r\nFashion Sari\r\nGeorgette\r\nPink', '2015-10-17 18:52:14'),
(27, 3, 'Ishin Printed Fashion Art Silk Sari', 449, 1, 'Key Features of Ishin Printed Fashion Art Silk Sari\r\nWith Blouse Piece\r\nFashion Sari\r\nArt Silk\r\nMulticolor', '2015-10-17 18:52:41'),
(28, 3, 'Ten On Ten Women''s Shrug', 349, 1, 'Ten On Ten Women''s Shrug Price: Rs. 349\r\nThis is cotton jersey shrug in free size & can fit anyone of chest 26" to chest 36" only. our model is wearing free size. length of the shrug may vary as per customer height.', '2015-10-17 18:53:08'),
(29, 3, 'Reya Cotton Printed Dress/Top Material', 580, 1, 'Reya Cotton Printed Dress/Top Material (Unstitched) Price: Rs. 580\r\nCelebrate this season with an apparel that rejuvenates your outer structure with its rich embellishment. A lovely ready to stitch set that is absolutely feminine and subtle. Kurta material comprises of abstract cotton printed through out. Tonal printed contrast bottom and printed dupatta with makes the entire set truly elegant. Design as per your preference, wear a delicate pendant and peeptoes for a gorgeous desi look.', '2015-10-17 18:53:44'),
(30, 3, 'Ganga Slim Fit Women''s Jeans', 479, 0, 'Ganga Slim Fit Women''s Jeans Price: Rs. 479\r\nDazzle your way through the crowd by slipping into this Jeans by Ganga. Featuring excellent fit and finish, this jeans will complement all your tops and casual shirts. Made from skin-friendly fabric, these regular-fit jeans will keep you at ease all day long.', '2015-10-17 18:54:20'),
(31, 4, 'Gillette Fusion Cartridges', 728, 1, 'Key Features of Gillette Fusion Cartridges\r\nLubrastrip delivers Incredible Glide\r\n5 Blades Help to Supply a Closer and more Comfortable Shave\r\nSoft Microfins Help to Stretch Skin\r\nPrecision Trimmer allows to Shave Tricky Places', '2015-10-17 18:59:30'),
(32, 4, 'VLCC Shape Up Shaping Kit', 510, 0, 'VLCC Shape Up Shaping Kit (100 ml) Price: Rs. 510\r\nA beautifully toned body is a style statement in itself. But if your hectic work schedule doesn’t let you spare any time on gym or workout, then this Shape Up Shaping Kit from VLCC will come in handy.\r\n\r\nAnti-cellulite Formula\r\n\r\nEnriched with skin-firming qualities of various vegetable and herbal extracts, the shaping oil in this kit will firm up your skin and provide it with elasticity. Moreover, the non-greasy, anti-cellulite formula of the shaping gel will tone down your muscles to give you shapely arms and legs in just a few weeks.', '2015-10-17 19:00:08'),
(33, 4, 'Barever Natural Hair Inhibitor', 869, 1, 'Key Features of Barever Natural Hair Inhibitor\r\n100% Natural\r\nFor Men & Women\r\nDelays hair growth\r\nFor legs, Hands, Face', '2015-10-17 19:00:37'),
(34, 4, 'Schwarzkopf Professional OSIS + FLEXWAX Texture 4 Ultra Strong Control Cream Wax Hair Styler', 699, 1, 'Schwarzkopf Professional OSIS + FLEXWAX Texture 4 Ultra Strong Control Cream Wax Hair Styler Price: Rs. 699\r\nIn the midst of your busy life, you have no choice but to make an effort to impress your loved one. Birthdays are really important and a huge investment when you are in a relationship. So you thought you will throw a party for your loved one. You choose the perfect attire and wanted to get a new hairdo to look stunning. Schwarzkopf Professional comes with an OSIS + FLEXWAX Texture 4 Ultra Strong Control Cream Wax Hair Styler to help you get that perfect hairdo. For all those men and women longing to style their hair to create that lasting impression, this Strong Control Cream Wax Hair Styler will be their apt choice. The Schwarzkopf Professional OSIS + FLEXWAX Texture 4 Ultra Strong Control Cream Wax Hair Styler has a strong wax texture and separation performance which will effortlessly glide on your hair.', '2015-10-17 19:01:09'),
(35, 4, 'Schwarzkopf Professional BC Repair Rescue Treatment', 754, 1, 'Key Features of Schwarzkopf Professional BC Repair Rescue Treatment\r\n100% Hair Replenishment and Resilience\r\nFor Damaged, Distressed Hair\r\nReconstructing Treatment', '2015-10-17 19:01:41'),
(36, 4, 'TRESemme Keratin Smooth Shampoo', 370, 1, 'Key Features of TRESemme Keratin Smooth Shampoo\r\nFrizz-free, Manageable Hair\r\nInfused with Natural Keratin Protein\r\nMoisturizes and Rejuvenates Hair\r\nTransform Hair to be Smoother and Easier to Style', '2015-10-17 19:02:11'),
(37, 4, 'Schwarzkopf Professional BC Repair Rescue Conditioner', 637, 1, 'Key Features of Schwarzkopf Professional BC Repair Rescue Conditioner\r\nFor Damaged, Distressed Hair\r\nIntensive Creamy Conditioner for Damaged Hair\r\n100% Hair Replenishment and Resilience', '2015-10-17 19:02:37'),
(38, 4, 'Davidoff Cool Water Sea Rose EDT', 2095, 0, 'Davidoff Cool Water Sea Rose EDT - 100 ml (For Women) Price: Rs. 2,095\r\nDavidoff launches a new edition of the women''s Cool Water perfume from 1996. After Cool Water Sensual Essence edition that was presented in 2012, Cool Water Sea Rose launches in 2013 as a new chapter in the saga of love between a woman and the sea.Perfumer Aurelien Guichard created this composite of notes that represents freshness, spontaneity and purity. Initial accords include delicate and juicy Japanese Nashi pear, which wraps itself around the heart made of sweet floral notes of pink peony and laid on the sensual base of musk.The face of the new fragrance is model Diana Moldovan, shot by Enrique Badulescu.', '2015-10-17 19:03:25'),
(39, 4, 'Calvin Klein One EDT - 200 ml', 2599, 1, 'Key Features of Calvin Klein One EDT - 200 ml\r\nLight and Relaxed Scent\r\nAromatic and Powdery\r\nCitrus Aromatic Fragrance\r\nBlend of Woody, Floral and Green Tea Scent', '2015-10-17 19:03:59'),
(40, 4, 'Davidoff Cool Water EDT - 100 ml', 1842, 1, 'Key Features of Davidoff Cool Water EDT - 100 ml\r\nSharp and Flowery Fragrance\r\nEssence of Freshness, Sensuality and Natural Beauty\r\nBlend of Citrus, Pineapple and Woody Notes\r\nScent of Pure Ocean Air', '2015-10-17 19:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `addressid` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `userid`, `addressid`, `timestamp`) VALUES
(10, 1, 1, '2015-10-22 22:29:55'),
(11, 1, 2, '2015-10-22 22:31:03'),
(12, 3, 3, '2015-10-22 23:07:25'),
(13, 1, 1, '2015-10-29 02:31:48'),
(14, 1, 1, '2015-10-29 02:32:52'),
(15, 1, 1, '2015-10-29 02:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `userid`, `productid`, `rating`, `comment`) VALUES
(11, 1, 2, 4, 'Really worth for the price!!'),
(3, 1, 4, 4, 'Very fast delivery..Love it'),
(2, 1, 8, 5, 'Excellent Product !!'),
(7, 1, 15, 3, 'Disappointed. Product is not as expected'),
(9, 1, 16, 5, 'Great product!'),
(4, 1, 19, 4, 'Love Apple products.'),
(1, 1, 26, 3, 'Good product'),
(5, 2, 8, 4, 'Love this phone!!'),
(6, 3, 8, 3, 'Not bad. doesn''t worth for price\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `solditems`
--

CREATE TABLE IF NOT EXISTS `solditems` (
  `purchaseid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `qty` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solditems`
--

INSERT INTO `solditems` (`purchaseid`, `productid`, `qty`) VALUES
(10, 8, 1),
(10, 19, 1),
(11, 12, 1),
(12, 15, 1),
(12, 24, 1),
(12, 30, 3),
(13, 8, 1),
(13, 19, 1),
(14, 21, 1),
(15, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `mobile`, `dob`) VALUES
(1, 'Harish', 'Kandala', 'kandalaharish95@gmail.com', '$2y$10$IU1VAAMnUKQ0zicYNmw00uqJknyGNHuT/4W4nehnkBeJwiFXldgYG', 9790995811, '1995-07-21'),
(2, 'Goutham', 'Reddy', 'goutamkreddy@gmail.com', '$2y$10$IU1VAAMnUKQ0zicYNmw00uqJknyGNHuT/4W4nehnkBeJwiFXldgYG', 9908862490, '1995-08-25'),
(3, 'Chandra Prakash', 'Reddy', 'cpreddy@gmail.com', '$2y$10$IU1VAAMnUKQ0zicYNmw00uqJknyGNHuT/4W4nehnkBeJwiFXldgYG', 9866177925, '1995-03-05'),
(4, 'Suhas', 'Tejaskanda', 'suhastejas@gmail.com', '$2y$10$IU1VAAMnUKQ0zicYNmw00uqJknyGNHuT/4W4nehnkBeJwiFXldgYG', 9866175683, '1995-10-30'),
(5, 'Dhanushik', 'Macharla', 'dhanushikmacharla@gmail.com', '$2y$10$IU1VAAMnUKQ0zicYNmw00uqJknyGNHuT/4W4nehnkBeJwiFXldgYG', 9793758552, '1996-01-07'),
(6, 'Manoj', 'Kumar', 'kmkmanoj1991@gmail.com', '$2y$10$Fac8mGrZqshwM4dsJQMIme6toMwCnwhzhww.Gyi1IwBK0KsEeJ5rC', 9989833608, '1991-10-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `userid_2` (`userid`,`name`), ADD UNIQUE KEY `userid_3` (`userid`,`name`), ADD KEY `userid` (`userid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`userid`,`productid`), ADD KEY `productid` (`productid`), ADD KEY `userid` (`userid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`), ADD KEY `catid` (`catid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`), ADD KEY `userid` (`userid`), ADD KEY `addressid` (`addressid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`userid`,`productid`), ADD UNIQUE KEY `id` (`id`), ADD KEY `userid` (`userid`), ADD KEY `productid` (`productid`);

--
-- Indexes for table `solditems`
--
ALTER TABLE `solditems`
  ADD PRIMARY KEY (`purchaseid`,`productid`), ADD KEY `purchaseid` (`purchaseid`), ADD KEY `productid` (`productid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
ADD CONSTRAINT `address_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `cart_productid` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `cart_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_catid` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
ADD CONSTRAINT `purchase_addressid` FOREIGN KEY (`addressid`) REFERENCES `address` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `purchase_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `review_productid` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `review_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `solditems`
--
ALTER TABLE `solditems`
ADD CONSTRAINT `solditems_productid` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `solditems_purchaseid` FOREIGN KEY (`purchaseid`) REFERENCES `purchase` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
