-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 01:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit3047_iteration1`
--

-- Used here for quick schema import, to be removed when finalized
DROP TABLE IF EXISTS categories_products;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS users;


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO categories (id, name) VALUES
(1, 'Crackers'),
(2, 'Flatbread'),
(3, 'Hampers');


-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE `categories_products` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_products`
--
INSERT INTO categories_products (category_id, product_id) VALUES
(1, 1),
(2, 2),
(3, 3);


-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` char(12) NOT NULL,
  `message` text NOT NULL,
  `replied` tinyint(1) NOT NULL DEFAULT 0,
  `date_sent` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `message`, `replied`, `date_sent`) VALUES
(3, 'Lynn', 'Miller', 'xxxxx@example.com', '0411 222 333', 'Well do!', 0, '2025-03-24'),
(4, 'Kane', 'Tran', 'asd@gmail.com', '0222 123 231', 'avc', 0, '2025-03-24'),
(5, 'Kane', 'Tran', 'asd@gmail.com', '0222 123 231', 'avc', 0, '2025-03-24'),
(6, 'Kane', 'wake', 'edvs@gmai.com', '0222 123 231', 'asd', 0, '2025-03-24'),
(7, 'alan', 'asd', 'asd@gmail.com', '0322 322 332', 'asd', 0, '2025-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO products (id, name, description, price) VALUES
(1, 'Lavosh Signature Crackers', 'Crunchy and savory, our Lavosh Signature Crackers are perfect as a standalone snack or paired with your favorite wine.', 9.99),
(2, 'Lavosh Artisan Flatbread', 'Experience the delicate taste of our Lavosh Artisan Flatbread, ideal for creating a gourmet morning meal.', 7.49),
(3, 'Lavosh Deluxe Hamper', 'Our Lavosh Deluxe Hamper offers a curated selection including premium lavosh crackers, flatbread, fine wine, and gourmet treats – the perfect gift of choice.', 49.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `nonce_expiry` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nonce`, `nonce_expiry`, `created`, `modified`) VALUES
(1, 'test@example.com', '$2y$10$myP46BKNV9W74tK7agrLJOnNa23qPmBHcz2Hp6T660T3e1iwZPLZy', '0844e844210a7aa62e312c70ba4a50253be4951a01c50352cb84de4c811e490d26140f8908ca31d857ce7ab00e03833287e5ee9d5cb6beb330aaf8aa406098d2', '2025-04-15 13:14:44', '2025-03-25 10:37:11', '2025-04-08 13:14:44'),
(2, 'asd@gmail.com', '$2y$10$9IYSSmJtwhq/ixYrolnXW.fqx0CzwaGsoVoWeFm/Xgh2J/OADDB8u', 'be92a448194aaed429dd46abdecabe28b381cce2062da911daebb1892ba3a24237e3bbc037c97647960900d96ef6a7ce45d83c223f06d29019c5b592dc08247e', '2025-04-15 12:23:15', '2025-04-08 11:27:02', '2025-04-08 15:17:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_category_name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_product_name` (`name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `categories_products`
--
ALTER TABLE categories_products
    ADD CONSTRAINT pk_categories_products PRIMARY KEY (category_id, product_id);

ALTER TABLE categories_products
    ADD CONSTRAINT fk_categories_products_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
            ON DELETE CASCADE;

ALTER TABLE categories_products
    ADD CONSTRAINT fk_categories_products_product
        FOREIGN KEY (product_id) REFERENCES products(id)
            ON DELETE CASCADE;


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
