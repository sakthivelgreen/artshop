-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 08:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arts_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(12) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`) VALUES
('Admin', 'Admin'),
('Lakshmi', '123');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` varchar(20) NOT NULL,
  `artist_name` varchar(20) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(8) NOT NULL,
  `artist_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `email_id`, `mobile_no`, `address`, `password`, `artist_pic`) VALUES
('Banksy', 'Banksy', 'artist@artshop.com', 1234567890, 'England', '123456', 'people.png'),
('CezannePaul', 'Paul Cézanne', 'artist@artshop.com', 1234567890, 'France', '1234', 'people.png'),
('Claude', 'Claude Monet ', 'artist@artshop.com', 1234567890, 'French', '1234', 'people.png'),
('DegasEdgar', 'Edgar degas', 'artist@artshop.com', 1234567890, 'France', '1234', 'people.png'),
('Delacroix', 'Eugène Delacroix', 'artist@artshop.com', 1234567890, 'France', '1234', 'people.png'),
('Diego', 'Diego Rivera', 'artist@artshop.com', 1234567890, 'Mexico', '1234', 'diego.jpg'),
('DuererAlbrec', 'Albrecht Dürer', 'artist@artshop.com', 1234567890, 'Germany', '1234', 'people.png'),
('GauguinPaul', 'Paul Gauguin', 'artist@artshop.com', 1234567890, 'France', '1234', 'people.png'),
('GoyaFrancisc', 'Franciso Goya', 'artist@artshop.com', 1234567890, 'Spain', '1234', 'people.png'),
('Harmenszoon', 'Rembrandt Harmenszoo', 'artist@artshop.com', 1234567890, 'Dutch', '1234', 'people.png'),
('KlimtGustav', 'Gustav Klimt', 'artist@artshop.com', 1234567890, 'Australia', '1234', 'klimt.jpg'),
('Lakshmi', 'Lakshmi Ganesan', 'lakshmi123@gmail.com', 9551716100, 'Coimbatore', '1234', 'people.png'),
('Manet', 'Édouard Manet', 'artist@artshop.com', 1234567890, 'France', '1234', 'people.png'),
('MunchEdvard', 'Edvard Muncn', 'artist@artshop.com', 1234567890, ' Norwey', '1234', 'people.png'),
('Raphael', 'Raffaello Sanzio da ', 'artist@artshop.com', 1234567890, 'Italy', '1234', 'people.png'),
('sakthivelgreen', 'sakthivel', 'sakthivelgreen.sk@gmail.com', 1234567890, 'Tiruvannamalai', '123', 'people.png'),
('VincentVan', 'Vincent van Gogh ', 'artist@artshop.com', 1234567890, 'Dutch', '1234', 'people.png');

-- --------------------------------------------------------

--
-- Table structure for table `art_categories`
--

CREATE TABLE `art_categories` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL,
  `catimage` varchar(100) NOT NULL,
  `categorydes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `art_categories`
--

INSERT INTO `art_categories` (`categoryid`, `categoryname`, `catimage`, `categorydes`) VALUES
(26, 'Oil Paintings', 'Oil Paintings.jpg', ''),
(27, 'Pencil Paintings', 'colored-pencil-drawingst-28.jpg', ''),
(28, 'Painterly Painting', 'gettyimages-154006186-612x612.jpg', ''),
(29, 'Abstract', 'gettyimages-478065559-612x612.jpg', ''),
(30, 'Impression Paintings', 'gettyimages-463991731-612x612.jpg', ''),
(31, 'Realism', 'gettyimages-3326376-612x612.jpg', ''),
(32, 'Potrait Paintings', 'OIP.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `art_details`
--

CREATE TABLE `art_details` (
  `art_id` int(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `art_name` varchar(30) NOT NULL,
  `art_image` varchar(100) NOT NULL,
  `price` int(8) NOT NULL,
  `artist_id` varchar(20) NOT NULL,
  `date_posted` date NOT NULL,
  `due_date` datetime NOT NULL,
  `starting_bid` int(8) NOT NULL,
  `art_status` varchar(6) NOT NULL,
  `art_description` varchar(300) NOT NULL,
  `bidding_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art_details`
--

INSERT INTO `art_details` (`art_id`, `category_id`, `art_name`, `art_image`, `price`, `artist_id`, `date_posted`, `due_date`, `starting_bid`, `art_status`, `art_description`, `bidding_status`) VALUES
(5, 27, 'Pencil Painting -1', 'colored-pencil-drawingst-28.jpg', 250, 'Banksy', '2024-03-17', '2024-04-08 13:47:00', 2, 'sold', 'Pencil Paintings', 'closed'),
(7, 29, 'Abstract image - 1', 'gettyimages-478065559-612x612.jpg', 1800, 'lakshi01', '2024-03-18', '2024-03-22 10:12:00', 2500, 'sold', 'This is a Abstract Painting contain an women abstract painted', 'closed'),
(8, 31, 'Realism Painting - 1', 'gettyimages-3326376-612x612.jpg', 5, 'Banksy', '2024-03-18', '2024-04-05 09:44:00', 1, 'sold', 'This Painting contains a group of old peoples, In 18th century.', 'closed'),
(9, 28, 'Painterly - 1', 'painterly.jpg', 10, 'Banksy', '2024-03-18', '2024-03-28 16:04:00', 6, 'sold', 'Beautiful view', 'closed'),
(16, 27, 'Pencil Painting - 2', 'pencil.jpg', 5000, 'sakthi11', '2024-03-21', '2024-03-23 11:50:00', 1000, 'sold', 'pencil art', 'closed'),
(17, 28, 'Women of Algiers - The Metropo', 'Women of Algiers - The Metropolitan Museum of Art.jpg', 400, 'Delacroix', '2024-03-23', '2024-04-12 10:00:00', 0, 'onSale', 'Title: Women of Algiers\r\nCreator: Eugène Delacroix\r\nDate created: 1833\r\nPhysical Dimensions: Sheet: 7 15/16 × 11 1/8 in. (20.2 × 28.3 cm) Image: 6 5/16 × 8 11/16 in. (16 × 22 cm)\r\nType: Print\r\nExternal Link: http://www.metmuseum.org/art/collection/search/337330\r\nMedium: Lithograph; second state of t', 'open'),
(18, 30, 'Ovid among the Scythians - The', 'Ovid among the Scythians - The Metropolitan Museum of Art.jpg', 100, 'Delacroix', '2024-03-23', '2024-04-12 10:00:00', 0, 'onSale', 'Title: Ovid among the Scythians\r\nCreator: Eugène Delacroix\r\nDate created: 1862\r\nPhysical Dimensions: 12 5/8 x 19 3/4 in. (32.1 x 50.2 cm)\r\nType: Painting\r\nExternal Link: http://www.metmuseum.org/art/collection/search/439631\r\nMedium: Oil on paper, laid down on wood\r\nRepository: Metropolitan Museum of', 'open'),
(19, 26, 'The Natchez', 'The Natchez - The Metropolitan Museum of Art.jpg', 100, 'Delacroix', '2024-03-23', '2024-03-28 15:57:00', 0, 'sold', 'Creator: Eugène Delacroix\r\nDate created: 1823–24 and 1835\r\nPhysical Dimensions: 35 1/2 x 46 in. (90.2 x 116.8 cm)\r\nType: Painting\r\nExternal Link: http://www.metmuseum.org/art/collection/search/436180\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(20, 27, 'Faust', 'Faust - The Metropolitan Museum of Art.jpg', 100, 'Delacroix', '2024-03-23', '2024-04-02 00:00:00', 0, 'onSale', 'Creator: Eugène Delacroix|Philipp Albert Stapfer|Johann Wolfgang von Goethe|Charles Motte\r\nDate created: 1828\r\nPhysical Dimensions: Overall: 16 3/16 x 10 5/8 x 1 5/16 in. (41.1 x 27 x 3.3 cm)\r\nMedium: Lithograph; second state\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(21, 26, 'Tigre Royal', 'Tigre Royal - The Cleveland Museum of Art.jpg', 100, 'Delacroix', '2024-03-23', '2024-04-06 22:03:00', 0, 'sold', 'Creator: Eugène Delacroix (French, 1798-1863)\r\nDate created: 1829\r\nType: Print\r\nRights: CC0\r\nMedium: lithograph\r\nState of work: III/IV\r\nDepartment: Prints\r\nCulture: France, 19th century\r\nCredit Line: Gift of The Print Club of Cleveland\r\nCollection: PR - Lithograph\r\nAccession Number: 1938.2', 'closed'),
(22, 26, 'Christ Asleep during the Tempe', 'Christ Asleep during the Tempest - The Metropolitan Museum of Art.jpg', 100, 'Delacroix', '2024-03-23', '2024-04-05 00:00:00', 0, 'onSale', 'Date created: ca. 1853\r\nPhysical Dimensions: 20 x 24 in. (50.8 x 61 cm)\r\nType: Painting\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(23, 26, 'Cypresses', 'Cypresses - The Metropolitan Museum of Art.jpg', 100, 'VincentVan', '2024-03-23', '2024-03-28 19:42:00', 0, 'sold', 'Date created: 1889\r\nPhysical Dimensions: 36 3/4 x 29 1/8 in. (93.4 x 74 cm)\r\nType: Painting\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(24, 26, 'Sunflowers', 'Sunflowers - The Metropolitan Museum of Art.jpg', 100, 'VincentVan', '2024-03-23', '2024-03-28 16:19:00', 0, 'sold', 'Vincent van Gogh\r\nDate created: 1887\r\nPhysical Dimensions: 17 x 24 in. (43.2 x 61 cm)\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(25, 26, 'First Steps, after Millet', 'First Steps, after Millet - The Metropolitan Museum of Art.jpg', 100, 'VincentVan', '2024-03-23', '2024-04-07 11:33:00', 0, 'onSale', 'Creator: Vincent van Gogh\r\nDate created: 1890\r\nPhysical Dimensions: 28 1/2 x 35 7/8 in. (72.4 x 91.1 cm)\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'closed'),
(26, 26, 'Woman Rocking a Cradle', 'Woman Rocking a Cradle; Augustine-Alix Pellicot.jpg', 100, 'VincentVan', '2024-03-23', '2024-04-07 00:00:00', 0, 'onSale', 'Title: La Berceuse (Woman Rocking a Cradle; Augustine-Alix Pellicot Roulin, 1851–1930)\r\nCreator: Vincent van Gogh\r\nDate created: 1889\r\nPhysical Dimensions: 36 1/2 x 29 in. (92.7 x 73.7 cm)\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'open'),
(27, 26, 'Bouquet of Flowers in a Vase', 'Bouquet of Flowers in a Vase - The Metropolitan Museum of Art.jpg', 100, 'VincentVan', '2024-03-23', '2024-04-07 00:00:00', 0, 'onSale', 'Date created: 1890\r\nPhysical Dimensions: 25 5/8 x 21 1/4 in. (65.1 x 54 cm)\r\nMedium: Oil on canvas\r\nRepository: Metropolitan Museum of Art, New York, NY', 'open'),
(28, 27, 'The Descent from the Cross by ', 'the descent.png', 100, 'Harmenszoon', '2024-03-23', '2024-04-10 00:00:00', 0, 'onSale', 'Date created: 1654\r\nLocation: Holland\r\nPhysical Dimensions: Sheet: 8 1/2 x 6 5/8 in. (21.59 x 16.83 cm)\r\nMedium: Etching\r\nObject Classification: Prints\r\nFull Title: The Descent from the Cross by Torchlight\r\nCuratorial Area: Prints and Drawings\r\nCredit Line: Gift of Mrs. Mary B. Regan\r\nChronology: 17', 'open'),
(29, 27, 'The Three Trees', 'the three trees.png', 100, 'Harmenszoon', '2024-03-23', '2024-04-30 00:00:00', 0, 'onSale', 'Date created: 1643\r\nLocation: Holland\r\nPhysical Dimensions: Sheet: 8 7/16 x 11 1/16 in. (21.43 x 28.1 cm)\r\nMedium: Etching, drypoint, and burin\r\nObject Classification: Prints\r\nFull Title: The Three Trees\r\nCuratorial Area: Prints and Drawings\r\nCredit Line: Los Angeles County Fund\r\nChronology: 17th ce', 'open'),
(30, 27, 'Christ Presented to the People', 'Christ Presented to the People - The Metropolitan Museum of Art.jpg', 100, 'Harmenszoon', '2024-03-23', '2024-04-10 00:00:00', 0, 'onSale', 'Date created: 1655\r\nPhysical Dimensions: Plate: 15 1/8 x 17 11/16 in. (38.4 x 44.9 cm) Frame: 24 1/2 × 30 1/2 in. (62.2 × 77.5 cm)\r\nMedium: Drypoint on japan paper; second state of eight\r\nRepository: Metropolitan Museum of Art, New York, NY', 'open'),
(31, 32, 'Self-Portrait with a Friend', 'Potrait with a friend.png', 100, 'Raphael', '2024-03-23', '2024-03-28 20:53:00', 0, 'sold', 'Date created: 1518/1519\r\nLocation created: Italie\r\nPhysical Dimensions: 99 x 83 cm\r\nOriginal Language: French\r\nPublisher: Rmn-Grand Palais\r\nOriginal Source: Paris, musée du Louvre', 'closed'),
(32, 30, 'Eight Apostles', 'Eight Apostles.png', 100, 'Raphael', '2024-03-23', '2024-04-04 00:00:00', 0, 'onSale', 'Date created: c. 1514\r\nPhysical Dimensions: sheet: 8.1 x 23.2 cm (3 3/16 x 9 1/8 in.) support: 9.4 x 24.8 cm (3 11/16 x 9 3/4 in.)\r\nMedium: red chalk over stylus underdrawing and traces of leadpoint on laid paper, cut in two pieces and rejoined; laid down', 'open'),
(33, 30, 'The Judgment of Paris', 'The Judgment of Paris.png', 100, 'Raphael', '2024-03-23', '2024-04-03 00:00:00', 0, 'onSale', 'Date created: c. 1510/1520\r\nPhysical Dimensions: sheet: 29.1 x 43.2 cm (11 7/16 x 17 in.)\r\nMedium: engraving', 'open'),
(34, 30, 'Massacre of the Innocents', 'Massacre of the Innocents.png', 100, 'Raphael', '2024-03-23', '2024-04-02 00:00:00', 0, 'onSale', 'Date created: 1511\r\nPrint State: Second of three states\r\nObject Type: Prints, works of art\r\nMaterials & Techniques: Engraving on laid paper. Watermark: Anchor, briquet 438, dated 1511', 'open'),
(36, 29, 'sample 2', 'gettyimages-1128634707-612x612.jpg', 50, 'Raphael', '2024-03-29', '2024-03-29 10:35:00', 0, 'sold', 'sample', 'closed'),
(43, 29, 'sample', 'R.jpeg', 10, 'Banksy', '2024-04-05', '2024-04-12 10:00:00', 1, 'onSale', 'sample description', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `bidreport`
--

CREATE TABLE `bidreport` (
  `bidid` int(10) NOT NULL,
  `art_id` int(10) NOT NULL,
  `customer_id` varchar(12) NOT NULL,
  `biddatetime` datetime NOT NULL,
  `bidamount` int(11) NOT NULL,
  `art_status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidreport`
--

INSERT INTO `bidreport` (`bidid`, `art_id`, `customer_id`, `biddatetime`, `bidamount`, `art_status`) VALUES
(5, 7, '5', '2024-03-20 15:17:08', 1700, 'sold'),
(7, 16, '1', '2024-03-23 11:44:36', 1200, 'sold'),
(9, 19, '1', '2024-03-28 15:55:17', 2, 'sold'),
(10, 9, '1', '2024-03-28 16:01:48', 7, 'sold'),
(12, 24, '1', '2024-03-28 16:16:51', 1, 'sold'),
(14, 23, '1', '2024-03-28 19:39:14', 2, 'sold'),
(15, 23, '5', '2024-03-28 19:40:01', 4, 'sold'),
(16, 23, '4', '2024-03-28 19:40:52', 5, 'sold'),
(22, 31, '4', '2024-03-28 20:50:39', 4, 'sold'),
(23, 31, '5', '2024-03-28 20:51:26', 5, 'sold'),
(24, 36, '5', '2024-03-29 10:27:42', 2, 'sold'),
(25, 36, '1', '2024-03-29 10:28:12', 4, 'sold'),
(26, 36, '6', '2024-03-29 10:29:38', 5, 'sold'),
(27, 8, '1', '2024-04-05 09:40:08', 5, 'sold'),
(28, 8, '4', '2024-04-05 09:41:03', 6, 'sold'),
(29, 21, '6', '2024-04-06 22:00:24', 1, 'sold'),
(30, 25, '6', '2024-04-07 11:31:34', 1, 'onSale'),
(31, 17, '6', '2024-04-07 12:22:18', 5, 'onSale'),
(32, 43, '6', '2024-04-07 12:32:18', 3, 'onSale'),
(33, 17, '1', '2024-04-08 10:24:10', 7, 'onSale'),
(34, 5, '1', '2024-04-08 13:45:10', 3, 'sold');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(12) NOT NULL,
  `customer_firstName` varchar(20) NOT NULL,
  `customer_lastName` varchar(20) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `customer_img` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `verification` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstName`, `customer_lastName`, `contact_no`, `email`, `address`, `userid`, `password`, `customer_img`, `gender`, `verification`) VALUES
(1, 'Lakshmi', 'G', 987654321, 'laksmi2k19@gmail.com', 'Tiruvannamalai', 'lakshmig', '123456', 'people.png', 'Female', 'yes'),
(4, 'navi', 'navanitha', 8090705423, 'navanitha@gmail.com', 'coimbatore', 'navi', '1234567', 'people.png', 'Female', 'yes'),
(5, 'pavi', 'pavithra', 9098765432, 'pavi123@gmial.com', 'tvm', 'pavi', '123456', 'people.png', 'Female', 'yes'),
(6, 'Sakthivel', 'J', 9080508077, 'sakthivelgreen.sk@gmail.com', 'Tiruvannamalai', 'sakthivelgreen', '123456', 'people.png', 'Male', 'yes'),
(7, 'dharshini', 'devi', 9876543210, 'dharshu@gmail.com', 'cbe', 'dharshini', '123456', 'people.png', 'Female', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `art_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `art_id`, `customer_name`, `price`, `payment_id`, `payment_status`, `date_added`) VALUES
(1, 16, 'Lakshmi G', 1200, 'pay_NphXYj6SlnQXJQ', 'paid', '2024-03-23 12:11:17'),
(2, 24, 'Lakshmi G', 1, 'pay_NrkSa6NFxNJooj', 'paid', '2024-03-28 16:20:43'),
(3, 23, 'pavi pavithra', 4, 'pay_Nro1npC3cBtUY6', 'paid', '2024-03-28 19:50:13'),
(4, 31, 'pavi pavithra', 5, 'pay_NrqM7itmjYv2De', 'paid', '2024-03-28 22:06:47'),
(5, 36, 'Sakthivel J', 5, 'pay_Ns3FBPFBWuRYF3', 'paid', '2024-03-29 10:43:31'),
(6, 8, 'navi navanitha', 6, 'pay_NuoJqwdcNtXVXb', 'paid', '2024-04-05 10:04:19'),
(7, 21, 'Sakthivel J', 1, 'pay_Nvcak1k71CMp5m', 'paid', '2024-04-07 11:14:55'),
(8, 5, 'Lakshmi G', 3, 'pay_Nw3lgzF2qMTqCJ', 'paid', '2024-04-08 13:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `win_id` int(10) NOT NULL,
  `bid_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `art_id` int(10) NOT NULL,
  `payment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`win_id`, `bid_id`, `customer_id`, `price`, `art_id`, `payment`) VALUES
(2, 5, 5, 1700, 7, 'sold'),
(3, 7, 1, 1200, 16, 'sold'),
(5, 9, 1, 2, 19, 'sold'),
(6, 10, 1, 7, 9, 'sold'),
(7, 12, 1, 1, 24, 'sold'),
(8, 15, 5, 4, 23, 'sold'),
(14, 23, 5, 5, 31, 'sold'),
(15, 26, 6, 5, 36, 'sold'),
(16, 28, 4, 6, 8, 'sold'),
(17, 29, 6, 1, 21, 'paid'),
(18, 30, 6, 1, 25, 'pending'),
(19, 34, 1, 3, 5, 'paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `art_categories`
--
ALTER TABLE `art_categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `art_details`
--
ALTER TABLE `art_details`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `bidreport`
--
ALTER TABLE `bidreport`
  ADD PRIMARY KEY (`bidid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`win_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art_categories`
--
ALTER TABLE `art_categories`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `art_details`
--
ALTER TABLE `art_details`
  MODIFY `art_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `bidreport`
--
ALTER TABLE `bidreport`
  MODIFY `bidid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `win_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
