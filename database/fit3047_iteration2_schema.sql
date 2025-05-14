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
DROP TABLE IF EXISTS faqs;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS order_items;


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
    (1, 'Sophia', 'Lee', 'sophia.lee@example.com', '0412 345 678', 'Interested in bulk orders for Lavosh crackers.', 0, '2025-04-30'),
    (2, 'Liam', 'Anderson', 'liam.anderson@example.com', '0421 567 890', 'Looking to distribute your premium flatbread.', 0, '2025-04-25'),
    (3, 'Emma', 'Brown', 'emma.brown@example.com', '0433 890 123', 'Could I get a sample of your Lavosh crackers for a review?', 0, '2025-04-20'),
    (4, 'Noah', 'Taylor', 'noah.taylor@example.com', '0455 234 567', 'Interested in stocking your gift hampers.', 0, '2025-04-15'),
    (5, 'Isabella', 'Wilson', 'isabella.wilson@example.com', '0400 567 890', 'Do you offer gluten-free Lavosh crackers?', 0, '2025-04-10'),
    (6, 'James', 'Martin', 'james.martin@example.com', '0422 789 012', 'Looking for a luxury hamper for corporate gifts.', 0, '2025-04-05'),
    (7, 'Ava', 'White', 'ava.white@example.com', '0444 678 901', 'What are the best pairings for your flatbread?', 0, '2025-03-31'),
    (8, 'William', 'Harris', 'william.harris@example.com', '0415 234 678', 'Can I get details on your Lavosh crackers packaging?', 0, '2025-03-27'),
    (9, 'Olivia', 'Moore', 'olivia.moore@example.com', '0439 123 567', 'Are your gift hampers customizable?', 0, '2025-03-22'),
    (10, 'Benjamin', 'Clark', 'benjamin.clark@example.com', '0450 567 234', 'Do you ship your Lavosh crackers internationally?', 0, '2025-03-18'),
    (11, 'Charlotte', 'Evans', 'charlotte.evans@example.com', '0412 987 654', 'I’d love to order your Lavosh crackers for a wine-tasting event.', 0, '2025-03-15'),
    (12, 'Jack', 'Robinson', 'jack.robinson@example.com', '0421 678 432', 'Are your flatbreads available in bulk for catering?', 0, '2025-03-10'),
    (13, 'Mia', 'Hall', 'mia.hall@example.com', '0433 765 321', 'Could I get a Lavosh hamper shipped for a birthday gift?', 0, '2025-03-05'),
    (14, 'Ethan', 'Walker', 'ethan.walker@example.com', '0455 876 210', 'I am a retailer interested in selling your crackers. Can we discuss wholesale pricing?', 0, '2025-02-28'),
    (15, 'Amelia', 'Scott', 'amelia.scott@example.com', '0400 321 678', 'Do you offer sample packs of your flatbreads?', 0, '2025-02-22'),
    (16, 'Lucas', 'King', 'lucas.king@example.com', '0422 543 219', 'Would love to feature your Lavosh in a seasonal menu at my restaurant.', 0, '2025-02-15'),
    (17, 'Harper', 'Lewis', 'harper.lewis@example.com', '0444 765 890', 'Are your hampers available for corporate gifting?', 0, '2025-02-10'),
    (18, 'Henry', 'Baker', 'henry.baker@example.com', '0415 678 432', 'Can I preorder the next batch of Lavosh crackers?', 0, '2025-02-05'),
    (19, 'Grace', 'Wright', 'grace.wright@example.com', '0439 210 654', 'What’s the best way to store your flatbread for freshness?', 0, '2025-01-30'),
    (20, 'Daniel', 'Adams', 'daniel.adams@example.com', '0450 123 678', 'Can I arrange a tasting session for your product line?', 0, '2025-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
    `id` int(11) NOT NULL,
    `name` varchar(75) NOT NULL,
    `description` varchar(255) NULL,
    `ingredients` varchar(255) NULL,
    `price` decimal(10,2) NOT NULL,
    `image` varchar(500) DEFAULT NULL,
    `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO products (id, name, description, price, image, quantity, ingredients) VALUES
    (1, 'Lavosh Signature Crackers', 'Crunchy and savory, perfect alone or with wine.', 9.99, "Signature_Crackers.png", 0, 'Wheat flour (70%), Olive oil (10%), Sea salt (5%), Sesame seeds (5%), Yeast, Sugar'),
    (2, 'Lavosh Artisan Flatbread', 'Delicate taste, ideal for gourmet breakfasts.', 7.49, "Artisan_Flatbread.png", 10, 'Wheat flour (65%), Honey (8%), Sunflower seeds (10%), Rosemary (3%), Sea salt, Yeast'),
    (3, 'Lavosh Deluxe Hamper', 'A curated selection including premium lavosh products.', 49.99, "Deluxe_Hamper.png", 20, 'Contains various lavosh crackers, Artisanal cheeses, Fine wine, Mixed nuts'),
    (4, 'Lavosh Mini Crackers', 'Bite-sized, perfect for dipping or snacking.', 4.99, "Mini_Crackers.png", 15, 'Wheat flour (72%), Butter (12%), Black pepper (3%), Garlic powder (2%), Yeast, Sugar'),
    (5, 'Lavosh Gluten-Free Flatbread', 'Same great taste, now gluten-free.', 8.99, "Gluten_Free_Flatbread.png", 8, 'Almond flour (50%), Flax seeds (20%), Tapioca starch (15%), Sea salt (5%), Xanthan gum'),
    (6, 'Lavosh Party Hamper', 'A party-ready hamper with crackers, flatbread, and dips.', 59.99, "Party_Hamper.png", 5, 'Assorted lavosh (50%), Hummus (15%), Guacamole (15%), Artisanal dips (20%)'),
    (7, 'Lavosh Spicy Crackers', 'Seasoned with a bold blend of spices.', 10.99, "Spicy_Crackers.png", 12, 'Wheat flour (68%), Chili flakes (6%), Smoked paprika (5%), Black pepper (4%), Yeast, Salt'),
    (8, 'Lavosh Sweet Flatbread', 'A sweet twist for desserts or breakfast.', 6.99, "Sweet_Flatbread.png", 18, 'Wheat flour (65%), Honey (10%), Cinnamon (5%), Dried fruits (10%), Butter, Sugar'),
    (9, 'Lavosh Premium Hamper', 'An exclusive hamper featuring premium accompaniments.', 79.99, "Premium_Hamper.png", 3, 'Premium lavosh selection, Dried fruits, Nuts, Fine wine'),
    (10, 'Lavosh Herb Crackers', 'Infused with a blend of fresh herbs.', 9.49, "Herb_Crackers.png", 20, 'Wheat flour (65%), Basil (5%), Oregano (5%), Thyme (5%), Parsley (5%), Olive oil (10%), Yeast, Salt');

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
    (1, 'test@example.com', '$2y$10$Nqe5/YAQ2vNLPcFeVrP8iefcu7SHwMWqtfLe0hkw0qvQsVcSej3tG', 'customer'),
    (2, 'asd@gmail.com', '$2y$10$7wxwv.poWhcCGgNefskCzeMzitBi3er7HEog7pA9h96U8enNDlUVq', 'admin'),
    (3, 'customer@gmail.com', '$2y$10$08QZ71hbWixjGsGTH2wZ.uZt8YO/4nXq1ZYvx/Ks2klg5VKGqzafu', 'customer'),
    (4, 'admin@gmail.com', '$2y$10$ScL2SU6TnMHcuntwsJ2meOaMSIq3zjlAicMQJxQWFfFvvLtgh5Wmq', 'admin'),
    (5, 'vtod0001@student.monash.edu', '$2y$10$bRiyYWnTCIJGEn3ZhamHHe5pkTiUxdU3A6GGHVBbKqMYttyE1lcgC', 'admin'); -- Password 1234$You

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
    `id` INT(11) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `answer` TEXT NULL,
    `clicks` INT(11) NOT NULL DEFAULT 0,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `answer`, `created`, `modified`) VALUES
    (1, 'What is CrunchyCravings?', 'CrunchyCravings is an online store specializing in artisan lavosh crackers, flatbreads, and gourmet hampers. We offer high-quality, handcrafted products perfect for snacks, meals, or gifts.', NOW(), NOW()),
    (2, 'How can I place an order?', 'To place an order, browse our product catalog, add items to your cart, and proceed to checkout. You can create an account or check out as a guest.', NOW(), NOW()),
    (3, 'What payment methods do you accept?', 'We accept major credit cards (Visa, MasterCard, American Express), PayPal, and other secure payment options.', NOW(), NOW()),
    (4, 'Do you offer gluten-free products?', 'Yes, we offer a selection of gluten-free products, including our popular Lavosh Gluten-Free Flatbread. Check the product descriptions for more details.', NOW(), NOW()),
    (5, 'How long does shipping take?', 'Shipping typically takes up to 14 business days within Australia. For international orders, delivery times may vary depending on the destination.', NOW(), NOW()),
    (6, 'Can I track my order?', 'Yes, once your order is shipped, you will receive a tracking number along with your order confirmation email. Use this number in \"Order lookup\" to track your package our website.', NOW(), NOW()),
    (7, 'What is your return policy?', 'If you are not satisfied with your purchase, you can return unopened items within 14 days for a full refund. Please contact our support team for assistance.', NOW(), NOW()),
    (8, 'Do you offer gift hampers?', 'Yes, we offer a variety of gift hampers that include our finest lavosh crackers, flatbreads, and gourmet accompaniments. Perfect for any occasion!', NOW(), NOW()),
    (9, 'How can I contact customer support?', 'You can reach our customer support team via the "Contact Us" page on our website or email us at support@crunchycravings.com. We aim to respond within 24 hours.', NOW(), NOW());

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `id` INT(11) NOT NULL,                  -- Primary key
    `tracking_number` VARCHAR(36) NOT NULL, -- For secure tracking
    `user_email` VARCHAR(255) NOT NULL,     -- Email used at checkout
    `status` ENUM('pending', 'shipped', 'completed', 'cancelled') DEFAULT 'pending',
    `return_status` ENUM('not_returned', 'returned') DEFAULT 'not_returned',
    `origin_address` VARCHAR(255) DEFAULT NULL,
    `destination_address` VARCHAR(255) DEFAULT NULL,
    `shipped_date` DATETIME DEFAULT NULL,
    `estimated_delivery_date` DATETIME DEFAULT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_number`, `user_email`, `status`, `origin_address`, `destination_address`, `shipped_date`, `estimated_delivery_date`, `created`, `modified`) VALUES
    (1,  'TRK1234567901oiasjdfpos', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', 'Wellington Rd, Clayton VIC 3800', '2025-04-02 10:00:00', '2025-04-06 18:00:00', '2025-04-01 09:00:00', '2025-04-01 09:30:00'),
    (2,  'TRK1234567902aythregrte', 'customer@gmail.com', 'pending', '380 Collins St, Melbourne VIC 3000', '900 Dandenong Rd, Caulfield East VIC 3145', NULL, '2025-04-11 18:00:00', '2025-04-10 08:00:00', '2025-04-10 08:15:00'),
    (3,  'TRK1234567903asye5rhgtg', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '381 Royal Parade, Parkville VIC 3052', '2025-03-26 09:00:00', '2025-03-31 17:00:00', '2025-03-25 08:00:00', '2025-03-25 08:30:00'),
    (4,  'TRK1234567904dporekdfgp', 'vtod0001@student.monash.edu', 'cancelled', '380 Collins St, Melbourne VIC 3000', 'Moorooduc Hwy, Frankston VIC 3199', NULL, NULL, '2025-03-15 10:00:00', '2025-03-15 10:30:00'),
    (5,  'TRK1234567905oprgwpeofk', 'admin@gmail.com', 'pending', '380 Collins St, Melbourne VIC 3000', 'Wellington Rd, Clayton VIC 3800', NULL, '2025-04-16 18:00:00', '2025-04-15 09:00:00', '2025-04-15 09:15:00'),
    (6,  'TRK1234567906lmrfposdpf', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '456 Bourke St, Melbourne VIC 3000', '2025-05-02 10:00:00', '2025-05-06 18:00:00', '2025-05-01 08:00:00', '2025-05-01 08:30:00'),
    (7,  'TRK1234567907rgposfkpsd', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '101 Lygon St, Carlton VIC 3053', '2025-05-03 12:00:00', '2025-05-07 18:00:00', '2025-05-02 09:00:00', '2025-05-02 09:15:00'),
    (8,  'TRK1234567908propsdkdpo', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '222 Flinders St, Melbourne VIC 3000', '2025-05-04 14:00:00', '2025-05-08 18:00:00', '2025-05-03 10:00:00', '2025-05-03 10:30:00'),
    (9,  'TRK1234567909sdfsdfsdff', 'admin@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '444 La Trobe St, Melbourne VIC 3000', '2025-05-05 16:00:00', '2025-05-09 18:00:00', '2025-05-04 11:00:00', '2025-05-04 11:15:00'),
    (10, 'TRK1234567910dgfhdfgfgf', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', '666 King St, West Melbourne VIC 3003', '2025-05-06 18:00:00', '2025-04-10 18:00:00', '2025-05-05 12:00:00', '2025-05-05 12:30:00'),
    (11, 'TRK1234567911hgkcghncgf', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '123 Queen St, Melbourne VIC 3000', '2025-01-06 10:00:00', '2025-01-11 18:00:00', '2025-01-05 09:00:00', '2025-01-05 09:15:00'),
    (12, 'TRK1234567912sdacsdhfgh', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '789 Swanston St, Carlton VIC 3053', '2025-02-16 12:00:00', '2025-02-21 18:00:00', '2025-02-15 08:00:00', '2025-02-15 08:30:00'),
    (13, 'TRK1234567913ghjfghfghg', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Spencer St, West Melbourne VIC 3003', '2025-03-11 14:00:00', '2025-03-16 18:00:00', '2025-03-10 07:00:00', '2025-03-10 07:15:00'),
    (14, 'TRK1234567914ouyjesdrfr', 'admin@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '777 Exhibition St, Melbourne VIC 3000', '2025-04-26 16:00:00', '2025-05-01 18:00:00', '2025-04-25 09:00:00', '2025-04-25 09:30:00'),
    (15, 'TRK1234567915sdgujtjutf', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', '999 St Kilda Rd, Melbourne VIC 3004', '2025-05-11 18:00:00', '2025-05-16 18:00:00', '2025-04-10 10:00:00', '2025-04-10 10:30:00'),
    (16, 'TRK1234567916kgkiorjgkf', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '888 Collins St, Docklands VIC 3008', '2024-12-02 10:00:00', '2024-12-06 18:00:00', '2024-12-01 08:00:00', '2024-12-01 08:15:00'),
    (17, 'TRK1234567917adepsofkpo', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '222 Bourke St, Melbourne VIC 3000', '2024-11-16 12:00:00', '2024-11-21 18:00:00', '2024-11-15 07:00:00', '2024-11-15 07:30:00'),
    (18, 'TRK1234567918osdifjsdoi', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '333 Elizabeth St, Melbourne VIC 3000', '2024-10-11 14:00:00', '2024-10-16 18:00:00', '2024-10-10 06:00:00', '2024-10-10 06:15:00'),
    (19, 'TRK1234567919oijasodjio', 'admin@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '444 Swanston St, Melbourne VIC 3000', '2024-09-26 16:00:00', '2024-10-01 18:00:00', '2024-09-25 05:00:00', '2024-09-25 05:30:00'),
    (20, 'TRK1234567920cmpoeijdps', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Flinders St, Melbourne VIC 3000', '2024-08-11 18:00:00', '2024-08-16 18:00:00', '2024-08-10 04:00:00', '2024-08-10 04:15:00'),
    (21, 'TRK1234567921oeijxofijf', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '123 Queen St, Melbourne VIC 3000', '2025-04-07 10:00:00', '2025-04-11 18:00:00', '2025-04-06 09:00:00', '2025-04-06 09:30:00'),
    (22, 'TRK1234567922progspdofk', 'asd@gmail.com', 'pending', '380 Collins St, Melbourne VIC 3000', '789 Swanston St, Carlton VIC 3053', NULL, '2025-04-12 18:00:00', '2025-04-07 08:00:00', '2025-04-07 08:15:00'),
    (23, 'TRK1234567923ccgdsfeijs', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Spencer St, West Melbourne VIC 3003', '2025-04-08 09:00:00', '2025-04-13 17:00:00', '2025-04-08 08:00:00', '2025-04-08 08:30:00'),
    (24, 'TRK1234567924gpsodfpoes', 'admin@gmail.com', 'shipped', '380 Collins St, Melbourne VIC 3000', '777 Exhibition St, Melbourne VIC 3000', '2025-04-11 10:00:00', '2025-04-16 10:00:00', '2025-04-09 10:00:00', '2025-04-09 10:30:00'),
    (25, 'TRK1234567925dfsdkpoask', 'vtod0001@student.monash.edu', 'pending', '380 Collins St, Melbourne VIC 3000', '999 St Kilda Rd, Melbourne VIC 3004', NULL, '2025-04-14 18:00:00', '2025-04-10 09:00:00', '2025-04-10 09:15:00'),
    (26, 'TRK1234567926ggksdpokex', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '888 Collins St, Docklands VIC 3008', '2025-04-11 10:00:00', '2025-04-15 18:00:00', '2025-04-11 08:00:00', '2025-04-11 08:30:00'),
    (27, 'TRK1234567927fgpdfkolke', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '222 Bourke St, Melbourne VIC 3000', '2025-04-12 12:00:00', '2025-04-16 18:00:00', '2025-04-12 09:00:00', '2025-04-12 09:15:00'),
    (28, 'TRK1234567928kfgjpsdofk', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '333 Elizabeth St, Melbourne VIC 3000', '2025-04-13 14:00:00', '2025-04-17 18:00:00', '2025-04-13 10:00:00', '2025-04-13 10:30:00'),
    (29, 'TRK1234567929gpokdsfpok', 'admin@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '444 Swanston St, Melbourne VIC 3000', '2025-04-14 16:00:00', '2025-04-18 18:00:00', '2025-04-14 11:00:00', '2025-04-14 11:15:00'),
    (30, 'TRK1234567930dfjmspdjkp', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Flinders St, Melbourne VIC 3000', '2025-04-15 18:00:00', '2025-04-19 18:00:00', '2025-04-15 12:00:00', '2025-04-15 12:30:00'),
    (31, 'TRK1234567931opisdjfosd', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '123 Queen St, Melbourne VIC 3000', '2025-04-16 10:00:00', '2025-04-20 18:00:00', '2025-04-16 09:00:00', '2025-04-16 09:30:00'),
    (32, 'TRK1234567932spdofpsdok', 'asd@gmail.com', 'pending', '380 Collins St, Melbourne VIC 3000', '789 Swanston St, Carlton VIC 3053', NULL, '2025-04-21 18:00:00', '2025-04-17 08:00:00', '2025-04-17 08:15:00'),
    (33, 'TRK1234567933opfkposdko', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Spencer St, West Melbourne VIC 3003', '2025-04-18 09:00:00', '2025-04-22 17:00:00', '2025-04-18 08:00:00', '2025-04-18 08:30:00'),
    (34, 'TRK1234567934ksokfoksks', 'admin@gmail.com', 'cancelled', '380 Collins St, Melbourne VIC 3000', '777 Exhibition St, Melbourne VIC 3000', NULL, NULL, '2025-04-19 10:00:00', '2025-04-19 10:30:00'),
    (35, 'TRK1234567935asddkmpokd', 'vtod0001@student.monash.edu', 'pending', '380 Collins St, Melbourne VIC 3000', '999 St Kilda Rd, Melbourne VIC 3004', NULL, '2025-04-23 18:00:00', '2025-04-20 09:00:00', '2025-04-20 09:15:00'),
    (36, 'TRK1234567936poskposkdp', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '888 Collins St, Docklands VIC 3008', '2025-04-21 10:00:00', '2025-04-25 18:00:00', '2025-04-21 08:00:00', '2025-04-21 08:30:00'),
    (37, 'TRK1234567937poksdpokpo', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '222 Bourke St, Melbourne VIC 3000', '2025-04-22 12:00:00', '2025-04-26 18:00:00', '2025-04-22 09:00:00', '2025-04-22 09:15:00'),
    (38, 'TRK1234567938epoaisjdij', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '333 Elizabeth St, Melbourne VIC 3000', '2025-04-23 14:00:00', '2025-04-27 18:00:00', '2025-04-23 10:00:00', '2025-04-23 10:30:00'),
    (39, 'TRK1234567939pokasdkpot', 'admin@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '444 Swanston St, Melbourne VIC 3000', '2025-04-24 16:00:00', '2025-04-28 18:00:00', '2025-04-24 11:00:00', '2025-04-24 11:15:00'),
    (40, 'TRK1234567940jhosidjdoi', 'vtod0001@student.monash.edu', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Flinders St, Melbourne VIC 3000', '2025-04-25 18:00:00', '2025-04-29 18:00:00', '2025-04-25 12:00:00', '2025-04-25 12:30:00'),
    (41, 'TRK1234567941kdjspijpoj', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '123 Queen St, Melbourne VIC 3000', '2025-04-26 10:00:00', '2025-04-30 18:00:00', '2025-04-26 09:00:00', '2025-04-26 09:30:00'),
    (42, 'TRK1234567942podkdfpoks', 'asd@gmail.com', 'pending', '380 Collins St, Melbourne VIC 3000', '789 Swanston St, Carlton VIC 3053', NULL, '2025-05-01 18:00:00', '2025-04-27 08:00:00', '2025-04-27 08:15:00'),
    (43, 'TRK1234567943fpoaskdpok', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '555 Spencer St, West Melbourne VIC 3003', '2025-04-28 09:00:00', '2025-05-02 17:00:00', '2025-04-28 08:00:00', '2025-04-28 08:30:00'),
    (44, 'TRK1234567944fopsdkpokd', 'admin@gmail.com', 'cancelled', '380 Collins St, Melbourne VIC 3000', '777 Exhibition St, Melbourne VIC 3000', NULL, NULL, '2025-04-29 10:00:00', '2025-04-29 10:30:00'),
    (45, 'TRK1234567945okdposakdk', 'vtod0001@student.monash.edu', 'pending', '380 Collins St, Melbourne VIC 3000', '999 St Kilda Rd, Melbourne VIC 3004', NULL, '2025-05-03 18:00:00', '2025-04-30 09:00:00', '2025-04-30 09:15:00'),
    (46, 'TRK1234567946opsdkpoksd', 'test@example.com', 'completed', '380 Collins St, Melbourne VIC 3000', '888 Collins St, Docklands VIC 3008', '2025-05-01 10:00:00', '2025-05-05 18:00:00', '2025-05-01 08:00:00', '2025-05-01 08:30:00'),
    (47, 'TRK1234567947osidjfoijk', 'asd@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '222 Bourke St, Melbourne VIC 3000', '2025-05-02 12:00:00', '2025-05-06 18:00:00', '2025-05-02 09:00:00', '2025-05-02 09:15:00'),
    (48, 'TRK1234567948posdkpokdp', 'customer@gmail.com', 'completed', '380 Collins St, Melbourne VIC 3000', '333 Elizabeth St, Melbourne VIC 3000', '2025-05-03 14:00:00', '2025-05-07 18:00:00', '2025-05-03 10:00:00', '2025-05-03 10:30:00'),
    (49, 'TRK1234567949posdkjfpok', 'admin@gmail.com', 'shipped', '380 Collins St, Melbourne VIC 3000', '444 Swanston St, Melbourne VIC 3000', '2025-05-04 16:00:00', '2025-05-08 18:00:00', '2025-05-04 11:00:00', '2025-05-04 11:15:00'),
    (50, 'TRK1234567950pedaskdpok', 'vtod0001@student.monash.edu', 'shipped', '380 Collins St, Melbourne VIC 3000', '555 Flinders St, Melbourne VIC 3000', '2025-05-05 18:00:00', '2025-05-09 18:00:00', '2025-05-05 12:00:00', '2025-05-05 12:30:00');

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
    `id` INT(11) NOT NULL,
    `order_id` INT(11) NOT NULL,
    `product_id` INT(11) NOT NULL,
    `quantity` INT(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
   (1, 1, 2, 2),
   (2, 1, 1, 1),
   (3, 2, 3, 1),
   (4, 3, 9, 1),
   (5, 3, 7, 2),
   (6, 4, 4, 3),
   (7, 5, 6, 1),
   (8, 5, 8, 2),
   (9, 5, 10, 1),
   (10, 6, 1, 2),
   (11, 6, 2, 1),
   (12, 7, 3, 3),
   (13, 7, 4, 2),
   (14, 8, 5, 1),
   (15, 8, 6, 4),
   (16, 9, 7, 2),
   (17, 9, 8, 3),
   (18, 10, 9, 5),
   (19, 10, 10, 1),
   (20, 11, 1, 3),
   (21, 11, 2, 2),
   (22, 12, 3, 1),
   (23, 12, 4, 4),
   (24, 13, 5, 2),
   (25, 13, 6, 3),
   (26, 14, 7, 1),
   (27, 14, 8, 5),
   (28, 15, 9, 4),
   (29, 15, 10, 2),
   (30, 16, 1, 1),
   (31, 16, 2, 3),
   (32, 17, 3, 2),
   (33, 17, 4, 1),
   (34, 18, 5, 4),
   (35, 18, 6, 2),
   (36, 19, 7, 3),
   (37, 19, 8, 1),
   (38, 20, 9, 5),
   (39, 20, 10, 3),
   (40, 21, 1, 2),
   (41, 21, 3, 1),
   (42, 22, 2, 3),
   (43, 22, 4, 1),
   (44, 23, 5, 2),
   (45, 23, 1, 1),
   (46, 24, 3, 4),
   (47, 24, 2, 2),
   (48, 25, 4, 1),
   (49, 26, 5, 3),
   (50, 26, 1, 2),
   (51, 27, 2, 1),
   (52, 27, 3, 2),
   (53, 28, 4, 3),
   (54, 28, 5, 1),
   (55, 29, 1, 4),
   (56, 29, 2, 2),
   (57, 30, 3, 1),
   (58, 30, 5, 3),
   (59, 31, 4, 2),
   (60, 31, 1, 1),
   (61, 32, 2, 3),
   (62, 32, 4, 1),
   (63, 33, 5, 2),
   (64, 33, 1, 1),
   (65, 34, 3, 4),
   (66, 34, 2, 2),
   (67, 35, 4, 1),
   (68, 36, 5, 3),
   (69, 36, 1, 2),
   (70, 37, 2, 1),
   (71, 37, 3, 2),
   (72, 38, 4, 3),
   (73, 38, 5, 1),
   (74, 39, 1, 4),
   (75, 39, 2, 2),
   (76, 40, 3, 1),
   (77, 40, 5, 3),
   (78, 41, 4, 2),
   (79, 41, 1, 1),
   (80, 42, 2, 3),
   (81, 42, 4, 1),
   (82, 43, 5, 2),
   (83, 43, 1, 1),
   (84, 44, 3, 4),
   (85, 44, 2, 2),
   (86, 45, 4, 1),
   (87, 46, 5, 3),
   (88, 46, 1, 2),
   (89, 47, 2, 1),
   (90, 47, 3, 2),
   (91, 48, 4, 3),
   (92, 48, 5, 1),
   (93, 49, 1, 4),
   (94, 49, 2, 2),
   (95, 50, 3, 1),
   (96, 50, 5, 3);

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

ALTER TABLE `faqs`
    ADD PRIMARY KEY (`id`);

-- Indexes for table `orders`
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_email`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_order` (`order_id`),
  ADD KEY `fk_order_items_product` (`product_id`);

-- Foreign key constraints for table `order_items`
ALTER TABLE `order_items`
    ADD CONSTRAINT `fk_order_items_order`
        FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`)
            ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_items_product`
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
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

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
