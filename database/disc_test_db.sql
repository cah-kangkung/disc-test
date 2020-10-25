-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 01:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disc_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_test`
--

CREATE TABLE `active_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0=expired; 1=waiting-payment; 2=payment-confirmed; 3=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `active_test`
--

INSERT INTO `active_test` (`id`, `user_id`, `payment_id`, `time_start`, `time_end`, `status`) VALUES
(1, 1, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `test_name` varchar(128) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `destination_bank` varchar(128) NOT NULL,
  `destination_acc_number` varchar(128) NOT NULL,
  `destination_acc_name` varchar(128) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `bank_account_name` varchar(128) NOT NULL,
  `bank_account_number` varchar(128) NOT NULL,
  `receipt` varchar(128) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0=cancel; 1=waiting; 2=receipt-upload; 3=confirmed; 4=finished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_destination`
--

CREATE TABLE `payment_destination` (
  `id` int(11) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `bank_account_name` varchar(128) NOT NULL,
  `bank_account_number` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_destination`
--

INSERT INTO `payment_destination` (`id`, `bank`, `bank_account_name`, `bank_account_number`) VALUES
(1, 'Mandiri', 'CAH KANGKUNG', '1234567890123');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` varchar(128) NOT NULL COMMENT 'influenc, dominance, compliance, steadiness',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` varchar(128) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `name`, `price`, `duration`) VALUES
(1, 'DISC', '50000', 30);

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `question_id` int(11) NOT NULL,
  `influence` varchar(256) NOT NULL,
  `dominance` varchar(256) NOT NULL,
  `compliance` varchar(256) NOT NULL,
  `steadiness` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`question_id`, `influence`, `dominance`, `compliance`, `steadiness`) VALUES
(2, 'Memberi semangat', 'Petualang', 'Teliti', 'Mudah menyesuaikan diri'),
(3, 'Suka menggoda', 'Berpendirian teguh', 'Senang membujuk', 'Suka kedamaian'),
(4, 'Pandai bergaul', 'Berkemauan kuat', 'Suka berkorban', 'Suka mengalah'),
(5, 'Suka meyakinkan', 'Suka bersaing', 'Penuh pertimbangan', 'Senang dibimbing'),
(6, 'Periang', 'Dihormati/disegani', 'Senang menangani masalah', 'Cenderung menahan diri'),
(7, 'Bersemangat', 'Percaya Diri', 'Peka / Perasa', 'Cepat Puas'),
(8, 'Suka memuji', 'Berpikir positif', 'Perencana', 'Sabar'),
(9, 'Spontan', 'Praktis', 'Ketat pada waktu', 'Pemalu'),
(10, 'Optimis', 'Suka berbicara terus terang', 'Rapi / teratur', 'Sopan / hormat'),
(11, 'Suka senda gurau', 'Tegar / kuat hati', 'Jujur', 'Ramah tamah'),
(12, 'Menyukai Kenikmatan', 'Berani / tidak penakut', 'Rinci / terperinci', 'Diplomatis / berhati-hati'),
(13, 'Penggembira', 'Percara diri', 'Berbudaya / terpelajar', 'Konsisten / tidak mudah berubah'),
(14, 'Suka memberi inspirasi', 'Mandiri', 'Idealis', 'Tidak suka menantang'),
(15, 'Lincah / suka membuka diri', 'Mampu memutuskan', 'Tekun / ulet', 'Sedikit Humor'),
(16, 'Mudah bergaul', 'Cepat bertindak', 'Gemar musik lembut', 'Perantara / penengah'),
(17, 'Senang bicara', 'Suka ngotot / kuat bertahan', 'Senang berfikir', 'Bersikap toleran'),
(18, 'Lincah bersemangat', 'Senang membimbing', 'Pendengar yang baik', 'Setia'),
(19, 'Lucu / humoris', 'Suka memimpin', 'Berfikir matematis', 'Mudah menerima saran'),
(20, 'Terkenal luas / populer', 'Produktif / menghasilkan', 'Perfeksionis', 'Suka mengijinkan / memperbolehkan'),
(21, 'Bersemangat gembira', 'Berani / tidak gampang takut', 'Berkelakuan tenang / kalem', 'Berpendirian tetap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `no_hp` varchar(128) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `sex` varchar(128) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(4) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_completed` int(1) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `no_hp`, `birth`, `sex`, `image`, `role_id`, `is_active`, `is_completed`, `date_created`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$JraWPdmJEJGv4.v.fG2XZO4pfBQ9TbcUwDUjR3C6LA.8TE5ukRagK', '+6281232457645', '2020-07-13', 'laki-laki', 'default.jpg', 1101, 1, 1, '2020-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(4) NOT NULL,
  `role` varchar(128) NOT NULL,
  `description` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`, `description`) VALUES
(1101, 'ADMIN', NULL),
(1102, 'USER', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `token_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_test`
--
ALTER TABLE `active_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_destination`
--
ALTER TABLE `payment_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`token_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_test`
--
ALTER TABLE `active_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_destination`
--
ALTER TABLE `payment_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
