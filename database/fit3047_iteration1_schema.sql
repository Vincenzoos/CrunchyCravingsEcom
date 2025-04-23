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
DROP TABLE IF EXISTS inventories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS cart_items;


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO categories (id, name, description) VALUES
(1, 'Crackers', 'Indulge in the delicate crunch of our artisan lavosh crackers, crafted to perfection with the finest ingredients. With a variety of recipes from traditional to seasonal, these crackers are an ideal companion for gourmet cheeses, dips, and charcuterie boards.'),
(2, 'Flatbread', 'Savor the authentic taste of our artisan lavosh flatbread, a versatile and delicious addition to any meal. Crafted with care, these flatbreads are perfect as a base for your favorite toppings.'),
(3, 'Hampers', 'Discover the ultimate gourmet experience with our selection of hampers. These carefully curated selections includes a variety of our finest lavosh crackers, flatbread, and accompanying food and drinks.');


-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE `categories_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_products`
--
INSERT INTO categories_products (id, category_id, product_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 1, 4),
(5, 2, 5),
(6, 3, 6),
(7, 1, 7),
(8, 2, 8),
(9, 3, 9),
(10, 1, 10);


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
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
  `name` varchar(75) NOT NULL,
  `description` varchar(255) NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO products (id, name, description, price, image, quantity) VALUES
(1, 'Lavosh Signature Crackers', 'Crunchy and savory, our Lavosh Signature Crackers are perfect as a standalone snack or paired with your favorite wine.', 9.99, "default-product.jpg", 0),
(2, 'Lavosh Artisan Flatbread', 'Experience the delicate taste of our Lavosh Artisan Flatbread, ideal for creating a gourmet morning meal.', 7.49, "default-product.jpg", 10),
(3, 'Lavosh Deluxe Hamper', 'Our Lavosh Deluxe Hamper offers a curated selection including premium lavosh crackers, flatbread, fine wine, and gourmet treats – the perfect gift of choice.', 49.99, "default-product.jpg", 20),
(4, 'Lavosh Mini Crackers', 'Bite-sized Lavosh Mini Crackers, perfect for dipping or as a light snack.', 4.99, "default-product.jpg", 15),
(5, 'Lavosh Gluten-Free Flatbread', 'Enjoy the same great taste of Lavosh Flatbread, now in a gluten-free option.', 8.99, "default-product.jpg", 8),
(6, 'Lavosh Party Hamper', 'A party-ready hamper featuring a variety of Lavosh crackers, flatbread, and gourmet dips.', 59.99, "default-product.jpg", 5),
(7, 'Lavosh Spicy Crackers', 'Add a kick to your snack time with our Lavosh Spicy Crackers, seasoned with a blend of spices.', 10.99, "default-product.jpg", 12),
(8, 'Lavosh Sweet Flatbread', 'A sweet twist on our classic flatbread, perfect for desserts or breakfast.', 6.99, "default-product.jpg", 18),
(9, 'Lavosh Premium Hamper', 'An exclusive hamper featuring our finest Lavosh products and premium accompaniments.', 79.99, "default-product.jpg", 3),
(10, 'Lavosh Herb Crackers', 'Infused with a blend of fresh herbs, these crackers are a flavorful snack.', 9.49, "default-product.jpg", 20);

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
  `role` ENUM('admin', 'customer') DEFAULT 'customer',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'test@example.com', '$2y$10$fAyHLsidzEmziQNmbxLEh.75.nyw7MAR4CUn1rrzDTb0nVWf29ik6', 'customer'),
(2, 'asd@gmail.com', '$2y$10$9IYSSmJtwhq/ixYrolnXW.fqx0CzwaGsoVoWeFm/Xgh2J/OADDB8u', 'admin'),
(3, 'customer@gmail.com', '$2y$10$zXUJ7nuZrzYHdZ5GJdVX3uBtJH8YNaYrK.0HObTF13dK.bIhr3Zbi', 'customer'), -- password is yes (bcrypt, cost 10)
(4, 'admin@gmail.com', '$2y$10$zXUJ7nuZrzYHdZ5GJdVX3uBtJH8YNaYrK.0HObTF13dK.bIhr3Zbi', 'admin'); -- password is yes (bcrypt, cost 10)

--
-- Table structure for table `cart_items`
--
CREATE TABLE `cart_items` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--
INSERT INTO `cart_items` (id, user_id, product_id, quantity) VALUES
    (1, 1, 2, 2);


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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_users_email` (`email`);



--
-- Indexes for table `categories_products`
--
ALTER TABLE categories_products
    ADD PRIMARY KEY (`id`);

ALTER TABLE categories_products
    ADD CONSTRAINT fk_categories_products_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
            ON DELETE CASCADE;

ALTER TABLE categories_products
    ADD CONSTRAINT fk_categories_products_product
        FOREIGN KEY (product_id) REFERENCES products(id)
            ON DELETE CASCADE;


--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `cart_items`
    ADD UNIQUE KEY `unq_user_product` (`user_id`, `product_id`);

-- Restrict delete users if they currently have item in cart
ALTER TABLE `cart_items`
    ADD CONSTRAINT `fk_cart_items_user`
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

-- Restrict delete products if they currently in cart
ALTER TABLE `cart_items`
    ADD CONSTRAINT `fk_cart_items_product`
        FOREIGN KEY (`product_id`) REFERENCES `products`(`id`);


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
-- AUTO_INCREMENT for table `categories_products`
--
ALTER TABLE `categories_products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
