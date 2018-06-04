-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2018 at 12:52 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_order` int(11) NOT NULL,
  `id_menu` varchar(6) NOT NULL,
  `kuantitas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_order`, `id_menu`, `kuantitas`) VALUES
(20, 'pizza1', 2),
(21, 'pizza1', 1),
(21, 'pizza2', 2),
(22, 'pizza1', 1),
(22, 'pasta1', 1),
(22, 'start1', 1),
(23, 'pizza1', 2),
(23, 'pasta3', 2),
(23, 'start4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` varchar(7) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `keterangan_menu` varchar(150) NOT NULL,
  `harga` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `keterangan_menu`, `harga`) VALUES
('pasta1', 'Lasagna', 'Special sauce, mozzarella, parmesan, ground beef', 190000),
('pasta2', 'Ravioli', 'Ravioli filled with cheese', 205000),
('pasta3', 'Spaghetti Classica', 'Fresh tomatoes, onions, ground beef', 155500),
('pasta4', 'Seafood Pasta', 'Salmon, shrimp, lobster, garlic', 360000),
('pizza1', 'Margherita', 'Fresh tomatoes, fresh mozzarella, fresh basil', 175000),
('pizza2', 'Formaggio', 'Four cheeses (mozzarella, parmesan, pecorino, jarlsberg)', 210000),
('pizza3', 'Chicken', 'Fresh tomatoes, mozzarella, chicken, onions', 235000),
('pizza4', 'Pineapple\'o\'clock', 'Fresh tomatoes, mozzarella, fresh pineapple, bacon, fresh basil', 232000),
('pizza5', 'Meat Town', 'Fresh tomatoes, mozzarella, hot pepporoni, hot sausage, beef, chicken', 280000),
('pizza6', 'Parma', 'Fresh tomatoes, mozzarella, parma, bacon, fresh arugula', 300000),
('start1', 'Today\'s Soup', 'Ask the waiter', 77500),
('start2', 'Bruschetta', 'Bread with pesto, tomatoes, onion, garlic', 120000),
('start3', 'Garlic bread', 'Grilled ciabatta, garlic butter, onions', 133000),
('start4', 'Tomozzarella', 'Tomatoes and mozzarella', 148000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_order` int(11) NOT NULL,
  `nama_pemesan` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_order`, `nama_pemesan`, `telepon`, `email`, `alamat_pengiriman`) VALUES
(1, 'a', '123', 'adas', 'asdasa'),
(2, 'a', '1231', 'a@gmail.com', 'untar'),
(3, 'b', '123123', 'asd@gmail.com', 'untar'),
(4, 'asd', '0192301230', 'qwe@gmail.com', 'jakut'),
(5, 'qwe', '2131241', 'qwe@gmail.com', 'zczc'),
(6, 'qwe', '123123', 'qwe@gmail.com', 'zxcsa'),
(7, 'qwe', '123', 'qwe@gmail.com', 'qwe'),
(8, 'qwe', '123', 'qwe@gmail.com', 'vv'),
(9, 'qwe', '123', 'qwe@gmail.com', 'g'),
(10, 'qwe', '123', 'qwe@gmail.com', 'L'),
(11, 'qwe', '123', 'qwe@gmail.com', 'h'),
(12, 'qwe', '123', 'qwe@gmail.com', 'h'),
(13, 'qwe', '123', 'qwe@gmail.com', 'P'),
(14, 'qwe', '123', 'qwe@gmail.com', 'g'),
(15, 'q', 'q', 'qwe@gmail.com', 'q'),
(20, 'ytr', '123', 'ewqe', 'asdad'),
(21, 'fonda', '153534', 'fon@gmail.com', 'danau'),
(22, 'GH', '013023190', 'GH@YAHOO.COM', 'BELGIA'),
(23, 'DENDI', '012312425', 'dondothesupamida@yahoo.com', 'ukraine');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `nama_pemesan` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email_pemesan` varchar(30) NOT NULL,
  `jumlah_orang` int(2) NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `pesan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'chef1', '$2y$10$.OdF3z3Yx1ksITPmuFnvWOVudmRhsRiToDtFP1tGan1cA2m/4J9MK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `pesanan` (`id_order`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
