-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2019 at 07:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organicfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$12$XVX30HjKXfcbLhvH88QH5urBZE0qYBTJtAGVJnUGw8QKTISMjpNh.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_products`
--

INSERT INTO `cart_products` (`id`, `ip`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '::1', 11, 1, '2019-10-01 05:45:44', '2019-10-01 05:45:44'),
(2, '::1', 11, 1, '2019-10-01 05:45:46', '2019-10-01 05:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_token` longtext COLLATE utf8mb4_unicode_ci,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image_path`, `original_path`, `created_at`, `updated_at`, `session_token`, `is_verified`, `slug`) VALUES
(1, 'Herbs', NULL, '', NULL, NULL, NULL, 0, ''),
(2, 'Fruits', NULL, '', NULL, NULL, NULL, 0, ''),
(3, 'vegetables', NULL, '', NULL, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('farmer','product') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2018_09_02_222002_create_users_table', 1),
(7, '2018_12_23_120000_create_shoppingcart_table', 1),
(8, '2019_05_03_000001_create_customer_columns', 1),
(9, '2019_05_03_000002_create_subscriptions_table', 1),
(10, '2019_09_02_221137_create_password_resets_table', 1),
(11, '2019_09_02_221844_create_categories_table', 1),
(12, '2019_09_02_221931_create_units_table', 1),
(13, '2019_09_02_222511_create_products_table', 1),
(14, '2019_09_02_222533_create_product_images_table', 1),
(15, '2019_09_02_222820_create_attributes_table', 1),
(16, '2019_09_02_222859_create_ratings_table', 1),
(17, '2019_09_02_224158_create_admins_table', 1),
(18, '2019_09_04_185538_alter_table_users', 1),
(19, '2019_09_05_053326_create_tags_table', 1),
(20, '2019_09_05_092212_alter_categories_table', 1),
(21, '2019_09_11_211733_alter_product_images_table', 1),
(22, '2019_09_11_232535_create_orders_table', 1),
(23, '2019_09_11_232605_create_order_products_table', 1),
(24, '2019_09_12_103956_alter_table_user_add_social_photo_column', 1),
(25, '2019_09_12_195331_create_user_details_table', 1),
(26, '2019_09_12_195652_create_user_locations_table', 1),
(27, '2019_09_13_191114_create_favourite_table', 1),
(28, '2019_09_16_094451_alter_category_table_add_slug_column', 1),
(29, '2019_09_17_092553_alter_product_table_add_slug_column', 1),
(30, '2019_09_20_065454_alter_table_favourite_add_type_user_id_type_id', 1),
(31, '2019_09_23_111707_alter_orders_table', 1),
(32, '2019_09_23_120346_alter_orders_add_column_table', 1),
(33, '2019_09_23_133014_create_orders_farm_table', 1),
(34, '2019_09_23_135322_alter_order_products_table', 1),
(36, '2019_09_25_054731_alter_orders_farm_table', 2),
(37, '2019_09_24_091852_create_cart_products_table', 3),
(38, '2019_09_25_071251_alter_category_table_add_original_path', 3),
(39, '2019_09_25_111629_alter_order_table', 3),
(40, '2019_09_26_091756_alter_product_add_location_id', 4),
(41, '2019_09_26_092904_alter_product_add_draft', 5),
(42, '2019_09_26_104838_alter_products_add_deleted_at', 6),
(43, '2019_09_30_113958_alter_table_tags_add_user_id', 7);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_charge_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('hold','cash') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hold',
  `group_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('onhold','processing','completed','cancelled','trash') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `stripe_charge_id`, `price`, `quantity`, `user_id`, `type`, `group_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sadfsadfdsa', NULL, 50, 5, 2, 'hold', 'dsfsfsffsd', 'processing', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_farm`
--

CREATE TABLE `orders_farm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('onhold','processing','completed','cancelled','trash') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_farm`
--

INSERT INTO `orders_farm` (`id`, `price`, `quantity`, `farm_id`, `order_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 2, 1, 1, 'processing', NULL, '2019-09-27 08:00:12', NULL),
(2, 33, 2, 1, 1, 'onhold', '2019-09-11 19:00:00', '2019-09-27 07:58:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_farm_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `price`, `quantity`, `product_id`, `order_farm_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 55, 5, 11, 2, '2019-10-09 19:00:00', NULL, NULL),
(2, 55, 55, 6, 1, '2019-10-22 19:00:00', NULL, NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `quantity`, `is_draft`, `user_id`, `location_id`, `unit_id`, `cat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Grapes', 'sdsadas', 'Fresh farm grapes', 56, 45, 0, 1, 1, 2, 2, '2019-09-22 19:00:00', NULL, NULL),
(7, 'Avocados from farm fresh', 'avocados-from-farm-fresh', 'Fresh farm fruits', 50, 5, 0, 1, 1, 2, 2, '2019-09-30 06:51:13', '2019-09-30 06:51:13', NULL),
(8, 'Bread', 'bread', 'dsafdsafdsa', 343, 3, 0, 1, 1, 2, 1, '2019-09-30 06:55:02', '2019-09-30 06:55:02', NULL),
(9, 'Grapes', 'grapes', 'Fresh Farm Grapes', 8, 5, 0, 1, 2, 2, 2, '2019-09-30 08:04:11', '2019-09-30 08:04:11', NULL),
(10, 'Strawberry from farm fresh', 'strawberry-from-farm-fresh', 'Farm fresh Strawberries', 525, 55, 1, 1, 2, 2, 2, '2019-09-30 08:06:34', '2019-09-30 08:06:34', NULL),
(11, 'Avacados from mexico hess', 'avacados-from-mexico-hess', 'Farm fresh avocados on cheap price', 10, 6, 1, 1, 1, 2, 2, '2019-10-01 01:24:28', '2019-10-01 05:45:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `name`, `path`, `original_path`, `product_id`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, NULL, 'public/images/product_images/image_7I7OLKjXiMnFeqQ.png', 'public/images/product_images/image_7I7OLKjXiMnFeqQ.png', 7, 1, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(2, NULL, 'public/images/product_images/image_wpkFyi2iFklxAjm.jpg', 'public/images/product_images/image_wpkFyi2iFklxAjm.jpg', 7, 0, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(3, NULL, 'public/images/product_images/image_bYPwuULhT2rYnYD.png', 'public/images/product_images/image_bYPwuULhT2rYnYD.png', 7, 0, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(4, NULL, 'public/images/product_images/image_z1DipfepJWNjCFd.png', 'public/images/product_images/image_z1DipfepJWNjCFd.png', 8, 1, '2019-09-30 06:55:02', '2019-09-30 06:55:02'),
(5, NULL, 'public/images/product_images/image_QcK09X8qkwdNRmA.jpg', 'public/images/product_images/image_QcK09X8qkwdNRmA.jpg', 8, 0, '2019-09-30 06:55:02', '2019-09-30 06:55:02'),
(6, NULL, 'public/images/product_images/image_On0IDHld7FrikY3.png', 'public/images/product_images/image_On0IDHld7FrikY3.png', 9, 1, '2019-09-30 08:04:11', '2019-09-30 08:04:11'),
(7, NULL, 'public/images/product_images/image_jaXiQ0UYMxIZuaz.png', 'public/images/product_images/image_jaXiQ0UYMxIZuaz.png', 9, 0, '2019-09-30 08:04:11', '2019-09-30 08:04:11'),
(8, NULL, 'public/images/product_images/image_xAOFMZI56dYQ37U.jpg', 'public/images/product_images/image_xAOFMZI56dYQ37U.jpg', 9, 0, '2019-09-30 08:04:11', '2019-09-30 08:04:11'),
(9, NULL, 'public/images/product_images/image_RnZaXbzqI5WQjs3.png', 'public/images/product_images/image_RnZaXbzqI5WQjs3.png', 10, 1, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(10, NULL, 'public/images/product_images/image_3o4Gs9WIUQIT04X.png', 'public/images/product_images/image_3o4Gs9WIUQIT04X.png', 10, 0, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(11, NULL, 'public/images/product_images/image_N1GbgJi2xZBFWks.png', 'public/images/product_images/image_N1GbgJi2xZBFWks.png', 10, 0, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(12, NULL, 'public/images/product_images/image_V1O7ZYoPKWi0ADO.png', 'public/images/product_images/image_V1O7ZYoPKWi0ADO.png', 10, 0, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(13, NULL, 'public/images/product_images/image_6dKPbgBG9qsidfy.png', 'public/images/product_images/image_6dKPbgBG9qsidfy.png', 11, 1, '2019-10-01 01:24:29', '2019-10-01 01:24:29'),
(14, NULL, 'public/images/product_images/image_MD7kqZnWmV44oxr.png', 'public/images/product_images/image_MD7kqZnWmV44oxr.png', 11, 0, '2019-10-01 01:24:29', '2019-10-01 01:24:29'),
(15, NULL, 'public/images/product_images/image_rFz5Ovy2wmahs3n.png', 'public/images/product_images/image_rFz5Ovy2wmahs3n.png', 11, 0, '2019-10-01 01:24:29', '2019-10-01 01:24:29'),
(16, NULL, 'public/images/product_images/image_PbNo1uqiGkKoMWq.png', 'public/images/product_images/image_PbNo1uqiGkKoMWq.png', 11, 0, '2019-10-01 01:24:29', '2019-10-01 01:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` double NOT NULL DEFAULT '0',
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'fruits', 7, 1, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(2, 'pear', 7, 1, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(3, 'fresh', 7, 1, '2019-09-30 06:51:14', '2019-09-30 06:51:14'),
(4, 'bread', 8, 1, '2019-09-30 06:55:02', '2019-09-30 06:55:02'),
(5, 'Grapes', 9, 1, '2019-09-30 08:04:11', '2019-09-30 08:04:11'),
(6, 'Fresh', 9, 1, '2019-09-30 08:04:11', '2019-09-30 08:04:11'),
(7, 'Strawberry', 10, 1, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(8, 'fresh', 10, 1, '2019-09-30 08:06:34', '2019-09-30 08:06:34'),
(9, 'avocados', 11, 1, '2019-10-01 01:24:29', '2019-10-01 01:24:29'),
(10, 'mexico', 11, 1, '2019-10-01 01:24:30', '2019-10-01 01:24:30'),
(11, 'fruits', 11, 1, '2019-10-01 01:24:30', '2019-10-01 01:24:30'),
(12, 'fresh', 11, 1, '2019-10-01 01:24:30', '2019-10-01 01:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'oz', NULL, NULL),
(2, 'kg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `fb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `since` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_web` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('user','farmer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payout_account_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payout_account_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payout_account_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payout_account_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_bank_account_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_online` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `social_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `profile_photo`, `cover_photo`, `description`, `country`, `city`, `address`, `zip_code`, `phone`, `timezone`, `last_login`, `fb_id`, `google_id`, `since`, `is_web`, `type`, `lat`, `lng`, `language`, `account_status`, `stripe_payout_account_id`, `stripe_payout_account_public_key`, `stripe_payout_account_secret_key`, `stripe_payout_account_info`, `exp_month`, `exp_year`, `card_id`, `is_bank_account_verified`, `is_online`, `is_active`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `social_photo`) VALUES
(1, 'farmer', 'farmer@demo.com', '2019-09-16 19:00:00', '$2y$10$vVRin066qeGx22wbOl8v9u.rPEa0ZXNWsnPJFgVvHTnn8NnApRpdC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-25 05:30:51', NULL, NULL, NULL, 1, 'farmer', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, '2019-09-25 00:30:51', '2019-09-25 00:30:51', NULL, NULL, NULL, NULL, NULL),
(2, 'user', 'user@demo.com', '2019-09-10 19:00:00', '$2y$10$vVRin066qeGx22wbOl8v9u.rPEa0ZXNWsnPJFgVvHTnn8NnApRpdC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('about','delivery','returns','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `address`, `city`, `state`, `country`, `zip_code`, `user_id`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 'USA', 'Pennysylvania', 'Houston', 'USA', '5400', 1, 0, NULL, NULL),
(2, 'India', 'Delhi', 'Maharashtra', 'Dog', '55555', 1, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_user_id_foreign` (`user_id`),
  ADD KEY `favourite_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders_farm`
--
ALTER TABLE `orders_farm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_farm_farm_id_foreign` (`farm_id`),
  ADD KEY `orders_farm_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`),
  ADD KEY `order_products_order_farm_id_foreign` (`order_farm_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_location_id_foreign` (`location_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`),
  ADD KEY `ratings_rated_by_foreign` (`rated_by`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_user_id_foreign` (`user_id`),
  ADD KEY `tags_product_id_foreign` (`product_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_locations_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders_farm`
--
ALTER TABLE `orders_farm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders_farm`
--
ALTER TABLE `orders_farm`
  ADD CONSTRAINT `orders_farm_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_farm_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_farm_id_foreign` FOREIGN KEY (`order_farm_id`) REFERENCES `orders_farm` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `user_locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_rated_by_foreign` FOREIGN KEY (`rated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
