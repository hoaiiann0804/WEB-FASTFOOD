-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2024 at 02:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercise18`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `firstname`, `lastname`, `address`, `city`, `country`, `zip`, `telephone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nguyen', 'An Nguyen', 'Thu duc city moi', 'HCM city', 'VietNam', '4000', '123456789', '2024-06-12 04:35:38', '2024-06-12 04:35:38'),
(2, 3, 'Loi', 'Nguyen', 'đông hòa, dĩ an, bình dương', 'Bình Dương', 'Việt', '2000', '0987654321', '2024-06-12 05:27:59', '2024-06-12 05:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gà rán', '2024-06-12 04:35:03', '2024-06-12 04:35:03'),
(2, 'Mì Ý', '2024-06-12 04:35:03', '2024-06-12 04:35:03'),
(3, 'Cơm', '2024-06-12 04:35:03', '2024-06-12 04:35:03'),
(4, 'Món ăn phụ', '2024-06-12 04:35:03', '2024-06-12 04:35:03'),
(5, 'Tráng miệng', '2024-06-12 04:35:03', '2024-06-12 04:35:03'),
(6, 'Nước uống', '2024-06-12 04:35:03', '2024-06-12 04:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2024_06_11_152426_create_addresses_table', 1),
(18, '2024_06_11_152737_create_categories_table', 1),
(19, '2024_06_11_152930_create_products_table', 1),
(20, '2024_06_11_153444_create_orders_table', 1),
(21, '2024_06_11_153711_create_reviews_table', 1),
(22, '2024_06_11_154251_create_shopping_carts_table', 1),
(23, '2024_06_11_154516_create_stocks_table', 1),
(24, '2024_06_11_155112_create_wishlists_table', 1),
(25, '2014_10_12_100000_create_password_resets_table', 2),
(26, '2024_06_12_051818_create_addresses_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `stock_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `stock_id`, `quantity`, `note`, `status`, `created_at`, `updated_at`, `amount`) VALUES
(1, 1, 1, 1, NULL, 'completed', '2024-06-12 04:35:03', NULL, 0),
(2, 21, 1, 2, NULL, 'completed', '2024-06-12 04:35:03', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '1700.00', '2024-10-01 11:16:25', '2024-10-01 11:16:25'),
(28, 1, 1, 2, '1400.00', '2024-10-08 06:01:07', '2024-10-08 06:01:07'),
(29, 1, 4, 1, '1700.00', '2024-10-08 06:10:51', '2024-10-08 06:10:51'),
(30, 1, 4, 1, '1700.00', '2024-10-08 06:10:51', '2024-10-08 06:10:51'),
(42, 1, 2, 4, '6800.00', '2024-10-08 14:16:29', '2024-10-08 14:16:29'),
(43, 1, 4, 1, '1700.00', '2024-10-08 14:18:33', '2024-10-08 14:18:33'),
(44, 1, 4, 1, '1700.00', '2024-10-11 01:03:39', '2024-10-11 01:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `deal_id` int UNSIGNED DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `deal_id`, `photo`, `brand`, `name`, `description`, `details`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'anh1.png', 'Gà', 'Gà rán', 'This is the product description!', 'These are the product details', 700, '2024-06-12 04:35:03', NULL),
(2, 1, 1, NULL, 'anh2.png', 'Gà', 'Gà rán', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(4, 1, 1, NULL, 'anh5.png', 'Gà', 'Gà sốt cay', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(5, 1, 1, NULL, 'anh21.png', 'Gà', 'Gà sốt cay', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(6, 1, 2, NULL, 'anh3.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(12, 1, 2, NULL, 'anh4.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(13, 1, 2, NULL, 'anh23.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(14, 1, 2, NULL, 'anh4.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(15, 1, 3, NULL, 'anh6.png', 'Cơm', 'Cơm gà', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(16, 1, 3, NULL, 'anh18.png', 'Cơm', 'Cơm gà', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(17, 1, 3, NULL, 'anh19.png', 'Cơm', 'Cơm gà', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(18, 1, 3, NULL, 'anh20.png', 'Cơm', 'Cơm gà', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(19, 1, 4, NULL, 'anh7.jpg', 'HB', 'Hamberger', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(20, 1, 3, NULL, 'anh27.png', 'Cơm', 'Cơm', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(21, 1, 4, NULL, 'anh8.png', 'HB', 'Khoai tây chiên', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(22, 1, 4, NULL, 'anh8.png', 'HB', 'Khoai tây chiên', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(23, 1, 4, NULL, 'anh24.png', 'HB', 'Hotdog', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(24, 1, 4, NULL, 'anh25.jpg', 'HB', 'Hamberger\r\n', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(25, 1, 4, NULL, 'anh26.png', 'HB', 'Hamberger', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(26, 1, 5, NULL, 'anh10.png', 'Kem', 'Kem', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(27, 1, 5, NULL, 'anh11.png', 'Kem', 'Kem', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(28, 1, 5, NULL, 'anh12.png', 'Kem', 'Kem', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(29, 1, 5, NULL, 'anh11.png', 'Kem', 'Kem', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(30, 1, 5, NULL, 'anh10.png', 'Kem', 'Kem', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(31, 1, 6, NULL, 'anh13.png', 'Nước', 'Nước', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(36, 1, 6, NULL, 'anh14.png', 'Nước', 'Nước', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(37, 1, 6, NULL, 'anh15.png', 'Nước', 'Nước', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(38, 1, 6, NULL, 'anh16.png', 'Nước', 'Nước', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(39, 1, 6, NULL, 'anh17.png', 'Nước', 'Nước', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(40, 1, 1, NULL, 'anh1.png', 'Gà', 'Gà rán', 'This is the product description!', 'These are the product details', 700, '2024-06-12 04:35:03', NULL),
(41, 1, 1, NULL, 'anh21.png', 'Gà', 'Gà sốt cay', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(42, 1, 2, NULL, 'anh4.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL),
(43, 1, 2, NULL, 'anh4.png', 'Mì', 'Mì Ý', 'This is the product description!', 'These are the product details', 1700, '2024-06-12 04:35:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `email`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 'rrrrrrrrrrrrr', 'lii@gmail.com', '123', 3, '2024-09-22 07:33:13', '2024-09-22 07:33:13'),
(2, 1, 'q', 'a@gmail.com', 'à', 5, '2024-09-28 04:26:08', '2024-09-28 04:26:08'),
(3, 1, 'tins', 'a@gmail.com', 'ad', 5, '2024-10-10 18:09:50', '2024-10-10 18:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `stock_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `user_id`, `stock_id`, `quantity`, `created_at`, `updated_at`) VALUES
(6, 10, 1, 2, '2024-06-26 01:34:23', '2024-06-26 01:34:23'),
(7, 5, 4, 1, '2024-06-26 02:13:40', '2024-06-26 02:13:40'),
(8, 5, 1, 1, '2024-06-26 02:14:33', '2024-06-26 02:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `size` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `size`, `color`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, '15.6\"', 'Black', 100, '2024-06-12 04:35:04', NULL),
(2, 2, '14\"', 'Silver', 100, '2024-06-12 04:35:04', NULL),
(3, 6, '15.6\"', 'Black', 100, '2024-06-12 04:35:04', NULL),
(5, 4, '14.7 inch', 'màu đen', 100, '2024-06-26 08:01:09', '2024-06-26 08:01:09'),
(9, 4, '14.7 inch', 'màu đen', 100, '2024-06-26 08:01:09', '2024-06-26 08:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `role_id` int DEFAULT NULL,
  `address_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `address_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, NULL, '2', 'Loi Nguyen', 'loi123@gmail.com', '$2y$12$qSQiqj80ZwdOLQ/GEXKlPeikp9sqFNR9gZKg0oJfYkdvBL8VtDFNK', NULL, '2024-06-12 05:27:59', '2024-06-12 05:27:59'),
(11, NULL, NULL, 'loi', 'loi@gmail.com', '$2y$10$oTSAwwp/qUfO5DRYZDThP.sLiL53vFKPithejG6WG9.PVXXRlxxOa', NULL, '2024-06-30 06:54:35', '2024-06-30 06:54:35'),
(12, NULL, NULL, 'loi123', 'loi1@gmail.com', '$2y$10$LQOe91Mr22xFSuKueNub3O.No5D7cO12z1FWC9wdQKR0uQwuftBmu', NULL, '2024-09-22 02:25:49', '2024-09-22 02:25:49'),
(13, NULL, NULL, 'dhdhd', 'loi3@gmail.com', '$2y$10$7USDHgYH6feuTBPJGjyXZe5vGi89ZAimnEMnRq8Vi4rYBUAAexOn6', NULL, '2024-09-27 19:42:29', '2024-09-27 19:42:29'),
(14, NULL, NULL, 'ad', 'ad@gmail.com', '$2y$10$PlkkO7uuR5WAFhDFxD./RuNeXUJe8fYykfCuQPrxLMXryhtb0ib62', NULL, '2024-10-03 07:18:50', '2024-10-03 07:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `vnpay`
--

CREATE TABLE `vnpay` (
  `id` int NOT NULL,
  `vnp_Amount` varchar(50) NOT NULL,
  `vnp_BankCode` varchar(50) NOT NULL,
  `vnp_BankTranNo` varchar(50) NOT NULL,
  `vnp_CardType` varchar(50) NOT NULL,
  `vnp_OrderInfo` varchar(50) NOT NULL,
  `vnp_PayDate` varchar(50) NOT NULL,
  `vnp_ResponseCode` varchar(50) NOT NULL,
  `vnp_TmnCode` varchar(50) NOT NULL,
  `vnp_TransactionNo` varchar(50) NOT NULL,
  `vnp_TransactionStatus` varchar(50) NOT NULL,
  `vnp_TxnRef` varchar(50) NOT NULL,
  `vnp_SecureHash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 8, 9, '2024-06-25 04:45:11', '2024-06-25 04:45:11'),
(4, 9, 1, '2024-06-25 05:22:40', '2024-06-25 05:22:40'),
(5, 9, 4, '2024-06-25 05:22:42', '2024-06-25 05:22:42'),
(6, 9, 7, '2024-06-25 05:22:44', '2024-06-25 05:22:44'),
(7, 9, 6, '2024-06-25 05:27:17', '2024-06-25 05:27:17'),
(8, 9, 8, '2024-06-25 05:27:19', '2024-06-25 05:27:19'),
(16, 5, 6, '2024-06-25 23:54:37', '2024-06-25 23:54:37'),
(17, 5, 8, '2024-06-25 23:54:40', '2024-06-25 23:54:40'),
(28, 12, 4, '2024-10-08 01:40:15', '2024-10-08 01:40:15'),
(29, 13, 1, '2024-10-08 07:17:04', '2024-10-08 07:17:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_index` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_stock_id_index` (`stock_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`order_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_index` (`user_id`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_deal_id_index` (`deal_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_index` (`product_id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_user_id_index` (`user_id`),
  ADD KEY `shopping_carts_stock_id_index` (`stock_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_index` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- Indexes for table `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_index` (`user_id`),
  ADD KEY `wishlists_product_id_index` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
