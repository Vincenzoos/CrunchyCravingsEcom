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
                        `clicks` INT(11) NOT NULL DEFAULT 0, -- New column to track clicks
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
                                                                        (5, 'How long does shipping take?', 'Shipping typically takes 3-5 business days within Australia. For international orders, delivery times may vary depending on the destination.', NOW(), NOW()),
                                                                        (6, 'Can I track my order?', 'Yes, once your order is shipped, you will receive a tracking number via email. Use this number to track your package on our shipping partners website.', NOW(), NOW()),
                                                                        (7, 'What is your return policy?', 'If you are not satisfied with your purchase, you can return unopened items within 14 days for a full refund. Please contact our support team for assistance.', NOW(), NOW()),
                                                                        (8, 'Do you offer gift hampers?', 'Yes, we offer a variety of gift hampers that include our finest lavosh crackers, flatbreads, and gourmet accompaniments. Perfect for any occasion!', NOW(), NOW()),
                                                                        (9, 'How can I contact customer support?', 'You can reach our customer support team via the "Contact Us" page on our website or email us at support@crunchycravings.com. We aim to respond within 24 hours.', NOW(), NOW()),
                                                                        (10, 'Do you have a loyalty program?', 'Yes, we offer a loyalty program where you can earn points for every purchase. Points can be redeemed for discounts on future orders. Sign up for an account to start earning points today!', NOW(), NOW());

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `status` ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
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
INSERT INTO `orders` (`id`, `user_id`, `status`, `origin_address`, `destination_address`, `shipped_date`, `estimated_delivery_date`, `created`, `modified`) VALUES
    (1, 5, 'completed', '380 Collins St, Melbourne VIC 3000', 'Wellington Rd, Clayton VIC 3800', '2025-04-01 10:00:00', '2025-04-05 18:00:00', NOW(), NOW()),
    (2, 3, 'pending', '380 Collins St, Melbourne VIC 3000', '900 Dandenong Rd, Caulfield East VIC 3145', NULL, '2025-04-10 18:00:00', NOW(), NOW()),
    (3, 2, 'completed', '380 Collins St, Melbourne VIC 3000', '381 Royal Parade, Parkville VIC 3052', '2025-03-25 09:00:00', '2025-03-30 17:00:00', NOW(), NOW()),
    (4, 5, 'cancelled', '380 Collins St, Melbourne VIC 3000', 'Moorooduc Hwy, Frankston VIC 3199', NULL, NULL, NOW(), NOW()),
    (5, 4, 'pending', '380 Collins St, Melbourne VIC 3000', 'Wellington Rd, Clayton VIC 3800', NULL, '2025-04-15 18:00:00', NOW(), NOW());

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
                                                                           (9, 5, 10, 1);

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
  ADD KEY `fk_orders_user` (`user_id`);

-- Foreign key constraints for table `orders`
ALTER TABLE `orders`
    ADD CONSTRAINT `fk_orders_user`
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
            ON DELETE CASCADE;

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
