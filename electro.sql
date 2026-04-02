-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2026 at 02:28 PM
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
-- Database: `electro`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `name`, `unique_identifier`, `version`, `status`, `description`, `created_at`, `updated_at`) VALUES
(23, 'PayPal Payment Gateway', 'paypal', '1.0', 1, 'Enable PayPal for your checkout.', '2026-02-04 04:20:46', '2026-02-04 04:20:46'),
(24, 'PhonePe Payment Gateway', 'phonepe', '1.0', 1, 'Enable PhonePe for your checkout.', '2026-02-04 04:20:46', '2026-02-04 04:20:46'),
(25, 'Paytm Payment Gateway', 'paytm', '1.0', 1, 'Enable Paytm for your checkout.', '2026-02-04 04:20:46', '2026-02-04 04:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `offer_text` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `offer_text`, `image`, `link`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Smart Camera', '40% Off', 'assets/img/product-1.png', NULL, 'product-offer-left', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(2, 'Smart Watch', '20% Off', 'assets/img/product-2.png', NULL, 'product-offer-right', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(3, 'EOS Rebel T7i Kit', '$899.99', 'assets/img/product-banner.jpg', NULL, 'bottom-left', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(4, 'SALE', 'Get UP To 50% Off', 'assets/img/product-banner-2.jpg', NULL, 'bottom-right', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@admin.com|127.0.0.1', 'i:1;', 1775130601),
('laravel-cache-admin@admin.com|127.0.0.1:timer', 'i:1775130601;', 1775130601),
('laravel-cache-admin@example.com|127.0.0.1', 'i:1;', 1769756034),
('laravel-cache-admin@example.com|127.0.0.1:timer', 'i:1769756034;', 1769756034),
('laravel-cache-saurabh.xntrova@gmail.com|127.0.0.1', 'i:1;', 1766936930),
('laravel-cache-saurabh.xntrova@gmail.com|127.0.0.1:timer', 'i:1766936930;', 1766936930);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `product_count_mock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `product_count_mock`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Led Bulb', 'accessories', NULL, 3, '2025-12-27 23:07:21', '2026-04-02 10:05:16', NULL, NULL, NULL),
(2, 'Led Outdoor Fan', 'electronics-computer', NULL, 5, '2025-12-27 23:07:21', '2026-04-02 10:05:41', NULL, NULL, NULL),
(3, 'Room Heater', 'laptops-desktops', NULL, 2, '2025-12-27 23:07:21', '2026-04-02 10:05:57', NULL, NULL, NULL),
(4, 'Electric Stove', 'mobiles-tablets', NULL, 8, '2025-12-27 23:07:21', '2026-04-02 10:06:18', NULL, NULL, NULL),
(5, 'cooler', 'smartphone-tv', NULL, 5, '2025-12-27 23:07:21', '2026-04-02 10:06:29', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `target_type` enum('total_order','product','category','welcome') NOT NULL DEFAULT 'total_order',
  `target_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`target_ids`)),
  `value` decimal(10,2) NOT NULL,
  `min_spend` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `expiry_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `target_type`, `target_ids`, `value`, `min_spend`, `usage_limit`, `used_count`, `expiry_date`, `start_date`, `status`, `created_at`, `updated_at`) VALUES
(3, '653017', 'percent', 'category', '[\"1\"]', 10.00, NULL, NULL, 0, '2026-02-04', '2026-02-03', 1, '2026-02-03 00:10:21', '2026-02-03 00:10:21'),
(4, '659888', 'percent', 'product', '[\"1\"]', 10.00, NULL, NULL, 0, '2026-02-04', '2026-02-03', 1, '2026-02-03 00:11:57', '2026-02-03 00:11:57'),
(5, 'Saurabh', 'percent', 'total_order', NULL, 20.00, 500.00, NULL, 0, '2026-02-04', '2026-02-03', 1, '2026-02-03 00:13:35', '2026-02-03 00:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `exchange_rate` decimal(10,4) NOT NULL DEFAULT 1.0000,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `exchange_rate`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(2, 'USD', '$', '$', 86.0000, 0, 1, '2026-02-04 02:39:13', '2026-02-04 02:51:52'),
(3, 'INR', 'RS', 'RS', 1.0000, 1, 1, '2026-02-04 02:51:50', '2026-02-04 02:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '#',
  `order` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT 'header',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `url`, `order`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 1, 'header', 1, '2025-12-27 23:07:23', '2025-12-28 09:31:04'),
(2, 'Products', '/products', 2, 'header', 1, '2025-12-27 23:07:23', '2026-02-06 07:29:10'),
(5, 'Contact', '#', 4, 'header', 1, '2025-12-27 23:07:23', '2025-12-27 23:07:23'),
(6, 'Home', '/', 1, 'footer', 1, '2025-12-28 09:53:24', '2025-12-28 09:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '0001_01_01_000000_create_users_table', 1),
(40, '0001_01_01_000001_create_cache_table', 1),
(41, '0001_01_01_000002_create_jobs_table', 1),
(42, '2025_12_26_143000_create_sliders_table', 1),
(43, '2025_12_26_143001_create_banners_table', 1),
(44, '2025_12_26_143001_create_services_table', 1),
(45, '2025_12_26_143002_create_categories_table', 1),
(46, '2025_12_26_143002_create_products_table', 1),
(47, '2025_12_26_144908_add_is_admin_to_users_table', 1),
(48, '2025_12_26_151922_create_site_settings_table', 1),
(49, '2025_12_26_153029_create_menus_table', 1),
(50, '2025_12_26_153834_add_slug_to_products_table', 1),
(51, '2025_12_26_161905_create_brands_table', 1),
(52, '2025_12_26_162004_add_brand_id_to_products_table', 1),
(53, '2025_12_26_162448_create_orders_table', 1),
(54, '2025_12_26_162449_create_order_items_table', 1),
(55, '2025_12_26_163345_create_payment_gateways_table', 1),
(56, '2025_12_27_181038_add_payment_fields_to_orders_table', 1),
(57, '2025_12_27_181622_add_logo_to_site_settings_table', 1),
(58, '2025_12_28_150601_create_wishlists_table', 2),
(59, '2025_12_31_170946_add_shiprocket_fields_to_orders_table', 3),
(60, '2025_12_31_171315_add_shiprocket_credentials_to_site_settings_table', 3),
(61, '2025_12_31_172219_add_return_refund_fields_to_orders_table', 3),
(62, '2026_01_30_065958_add_favicon_to_site_settings_table', 3),
(63, '2026_01_30_070300_add_colors_to_site_settings_table', 4),
(64, '2026_01_30_070607_add_seo_fields_to_site_settings_table', 5),
(65, '2026_01_30_070730_add_meta_image_to_site_settings_table', 6),
(66, '2026_01_30_070906_add_seo_to_categories_table', 7),
(67, '2026_01_30_070911_add_seo_to_brands_table', 7),
(68, '2026_01_30_070915_add_seo_to_products_table', 7),
(69, '2026_01_30_074243_create_addons_table', 8),
(70, '2026_02_02_113550_create_wholesale_products_table', 9),
(71, '2026_02_02_120813_create_coupons_table', 10),
(72, '2026_02_02_121638_add_currency_to_site_settings_table', 11),
(73, '2026_02_02_130948_create_currencies_table', 12),
(74, '2026_02_03_051636_add_options_to_coupons_table', 13),
(75, '2026_02_03_053655_add_site_name_to_site_settings_table', 14),
(76, '2026_02_03_102551_add_max_quantity_to_wholesale_products_table', 15),
(77, '2026_04_02_121025_add_status_to_products_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `shiprocket_order_id` varchar(255) DEFAULT NULL,
  `shiprocket_shipment_id` varchar(255) DEFAULT NULL,
  `return_status` varchar(255) DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `refund_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `settings` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `code`, `settings`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', 'cod', NULL, 1, '2025-12-27 23:07:23', '2025-12-27 23:07:23'),
(2, 'Stripe', 'stripe', '[]', 0, '2025-12-27 23:07:23', '2026-02-04 04:04:16'),
(3, 'PayPal', 'paypal', '[]', 0, '2025-12-27 23:07:23', '2026-02-04 04:04:16'),
(4, 'Razorpay', 'razorpay', '{\"key_id\":\"rzp_live_Uollv5svmOJVYb\",\"key_secret\":\"yWjK5MxOprBAky00OLWTL1sf\"}', 1, '2025-12-28 10:07:16', '2025-12-28 10:08:45'),
(5, 'PhonePe', 'phonepe', '[]', 0, '2026-02-04 04:05:47', '2026-02-04 04:05:47'),
(6, 'Paytm', 'paytm', '[]', 0, '2026-02-04 04:05:47', '2026-02-04 04:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `is_best_selling` tinyint(1) NOT NULL DEFAULT 0,
  `label` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `old_price`, `description`, `image`, `is_featured`, `is_new_arrival`, `is_best_selling`, `label`, `rating`, `category_id`, `created_at`, `updated_at`, `brand_id`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Premium 9W LED Bulb', 'premium-9w-led-bulb', 120.00, 150.00, 'Bright cool white light, perfect for home use.', 'uploads/products/led_bulb.png', 0, 0, 1, 'LED', 5, 1, '2026-04-02 10:33:41', '2026-04-02 06:51:46', NULL, 'Premium 9W LED Bulb', 'Bright cool white light, perfect for home use.', NULL),
(2, 'Eco 12W LED Bulb', 'eco-12w-led-bulb', 180.00, 220.00, 'Energy-efficient warm white glow.', 'uploads/products/led_bulb.png', 1, 0, 0, 'LED', 5, 1, '2026-04-02 10:33:41', '2026-04-02 06:48:08', NULL, 'Eco 12W LED Bulb', 'Energy-efficient warm white glow.', NULL),
(3, 'Smart RGB LED Bulb', 'smart-rgb-led-bulb', 450.00, 599.00, 'Smartphone controlled RGB lighting.', 'uploads/products/led_bulb.png', 0, 1, 0, 'LED', 5, 1, '2026-04-02 10:33:41', '2026-04-02 06:48:09', NULL, 'Smart RGB LED Bulb', 'Smartphone controlled RGB lighting.', NULL),
(4, 'Industrial 20W LED Bulb', 'industrial-20w-led-bulb', 350.00, 425.00, 'Robust design for large spaces.', 'uploads/products/led_bulb.png', 0, 0, 1, 'LED', 5, 1, '2026-04-02 10:33:41', '2026-04-02 06:51:48', NULL, 'Industrial 20W LED Bulb', 'Robust design for large spaces.', NULL),
(5, 'Mini 7W LED Bulb', 'mini-7w-led-bulb', 90.00, 120.00, 'Compact size for small lamps.', 'uploads/products/led_bulb.png', 1, 0, 0, 'LED', 5, 1, '2026-04-02 10:33:41', '2026-04-02 06:48:11', NULL, 'Mini 7W LED Bulb', 'Compact size for small lamps.', NULL),
(6, 'Classic LED Outdoor Fan - 52 inch', 'classic-led-outdoor-fan-52-inch', 4500.00, 5200.00, 'A stylish 52-inch outdoor fan with integrated LED lighting, perfect for patios and porches.', 'uploads/products/outdoor_fan.png', 1, 0, 0, 'FEATURED', 5, 2, '2026-04-02 10:36:23', '2026-04-02 06:47:54', NULL, 'Classic LED Outdoor Fan - 52 inch', 'A stylish 52-inch outdoor fan with integrated LED lighting, perfect for patios and porches.', NULL),
(7, 'High-Speed Waterproof Outdoor Fan', 'high-speed-waterproof-outdoor-fan', 5800.00, 6500.00, 'Durable and waterproof high-speed fan designed for extreme outdoor conditions.', 'uploads/products/outdoor_fan.png', 0, 1, 0, 'FEATURED', 5, 2, '2026-04-02 10:36:23', '2026-04-02 06:47:55', NULL, 'High-Speed Waterproof Outdoor Fan', 'Durable and waterproof high-speed fan designed for extreme outdoor conditions.', NULL),
(8, 'Remote Control LED Patio Fan', 'remote-control-led-patio-fan', 7200.00, 8500.00, 'Features multi-speed settings and dimmable LED light with a dedicated remote control.', 'uploads/products/outdoor_fan.png', 0, 0, 1, 'FEATURED', 5, 2, '2026-04-02 10:36:23', '2026-04-02 06:51:43', NULL, 'Remote Control LED Patio Fan', 'Features multi-speed settings and dimmable LED light with a dedicated remote control.', NULL),
(9, 'Industrial Grade Mist Outdoor Fan', 'industrial-grade-mist-outdoor-fan', 9500.00, 11000.00, 'Heavy-duty fan with misting capability for superior cooling in large outdoor spaces.', 'uploads/products/outdoor_fan.png', 1, 0, 0, 'FEATURED', 5, 2, '2026-04-02 10:36:23', '2026-04-02 06:47:58', NULL, 'Industrial Grade Mist Outdoor Fan', 'Heavy-duty fan with misting capability for superior cooling in large outdoor spaces.', NULL),
(10, 'Solar Powered LED Outdoor Fan', 'solar-powered-led-outdoor-fan', 8900.00, 10500.00, 'Environmentally friendly solar-powered fan with backup battery and LED light.', 'uploads/products/outdoor_fan.png', 0, 1, 0, 'FEATURED', 5, 2, '2026-04-02 10:36:23', '2026-04-02 06:48:03', NULL, 'Solar Powered LED Outdoor Fan', 'Environmentally friendly solar-powered fan with backup battery and LED light.', NULL),
(11, 'Compact 1500W Ceramic Room Heater', 'compact-1500w-ceramic-room-heater', 1800.00, 2200.00, 'Fast-heating ceramic room heater with 1500W power and adjustable thermostat.', 'uploads/products/room_heater.png', 0, 1, 0, 'WINTER', 5, 3, '2026-04-02 10:51:40', '2026-04-02 06:47:50', NULL, 'Compact 1500W Ceramic Room Heater', 'Fast-heating ceramic room heater with 1500W power and adjustable thermostat.', NULL),
(12, 'Oil Filled Radiator Heater - 11 Fins', 'oil-filled-radiator-heater-11-fins', 5500.00, 6800.00, 'Silent and efficient 11-fin radiator for consistent room temperature.', 'uploads/products/room_heater.png', 0, 0, 1, 'WINTER', 5, 3, '2026-04-02 10:51:40', '2026-04-02 06:51:40', NULL, 'Oil Filled Radiator Heater - 11 Fins', 'Silent and efficient 11-fin radiator for consistent room temperature.', NULL),
(13, 'Portable Electric Fan Heater', 'portable-electric-fan-heater', 1200.00, 1500.00, 'Lightweight and portable electric fan heater for quick spot heating.', 'uploads/products/room_heater.png', 1, 0, 0, 'WINTER', 5, 3, '2026-04-02 10:51:40', '2026-04-02 06:47:52', NULL, 'Portable Electric Fan Heater', 'Lightweight and portable electric fan heater for quick spot heating.', NULL),
(14, 'Smart Wi-Fi Tower Room Heater', 'smart-wi-fi-tower-room-heater', 4200.00, 5200.00, 'Smartphone-controlled tower heater with oscillation and timer settings.', 'uploads/products/room_heater.png', 0, 1, 0, 'WINTER', 5, 3, '2026-04-02 10:51:40', '2026-04-02 06:47:53', NULL, 'Smart Wi-Fi Tower Room Heater', 'Smartphone-controlled tower heater with oscillation and timer settings.', NULL),
(15, 'Halogen Room Heater - 3 Heat Settings', 'halogen-room-heater-3-heat-settings', 2100.00, 2800.00, 'Energy-efficient halogen heater with 3 power levels and safety tip-over switch.', 'uploads/products/room_heater.png', 0, 0, 1, 'WINTER', 5, 3, '2026-04-02 10:51:40', '2026-04-02 06:51:41', NULL, 'Halogen Room Heater - 3 Heat Settings', 'Energy-efficient halogen heater with 3 power levels and safety tip-over switch.', NULL),
(16, 'Premium Single Induction Cooktop', 'premium-single-induction-cooktop', 2500.00, 3200.00, 'Fast and energy-efficient induction cooktop with touch controls and multiple heat settings.', 'uploads/products/induction_cooktop.png', 0, 0, 1, 'PREMIUM', 5, 4, '2026-04-02 10:55:53', '2026-04-02 06:51:35', NULL, 'Premium Single Induction Cooktop', 'Fast and energy-efficient induction cooktop with touch controls and multiple heat settings.', NULL),
(17, 'Double Hot Plate Stove - 2500W', 'double-hot-plate-stove-2500w', 4800.00, 5500.00, 'Double burner electric stove with adjustable temperature controls for versatile cooking.', 'uploads/products/induction_cooktop.png', 1, 0, 0, 'PREMIUM', 5, 4, '2026-04-02 10:55:53', '2026-04-02 06:47:43', NULL, 'Double Hot Plate Stove - 2500W', 'Double burner electric stove with adjustable temperature controls for versatile cooking.', NULL),
(18, 'Glass Top Infrared Cooker', 'glass-top-infrared-cooker', 3900.00, 4500.00, 'Sleek infrared cooker compatible with all types of cookware. Features a crystal glass top.', 'uploads/products/induction_cooktop.png', 0, 1, 0, 'PREMIUM', 5, 4, '2026-04-02 10:55:53', '2026-04-02 06:47:44', NULL, 'Glass Top Infrared Cooker', 'Sleek infrared cooker compatible with all types of cookware. Features a crystal glass top.', NULL),
(19, 'Portable Electric Grill Stove', 'portable-electric-grill-stove', 5200.00, 6000.00, 'Perfect for indoor and outdoor grilling. Easy to clean non-stick surface.', 'uploads/products/induction_cooktop.png', 0, 0, 1, 'PREMIUM', 5, 4, '2026-04-02 10:55:53', '2026-04-02 06:51:37', NULL, 'Portable Electric Grill Stove', 'Perfect for indoor and outdoor grilling. Easy to clean non-stick surface.', NULL),
(20, 'Commercial Heavy Duty Induction Stove', 'commercial-heavy-duty-induction-stove', 9500.00, 12000.00, 'Powerful induction stove designed for intensive commercial kitchens.', 'uploads/products/induction_cooktop.png', 1, 0, 0, 'PREMIUM', 5, 4, '2026-04-02 10:55:53', '2026-04-02 06:47:46', NULL, 'Commercial Heavy Duty Induction Stove', 'Powerful induction stove designed for intensive commercial kitchens.', NULL),
(21, 'Tower Air Cooler - 35L Tank', 'tower-air-cooler-35l-tank', 6500.00, 7500.00, 'Sleek tower air cooler with 35L tank capacity and powerful air throw.', 'uploads/products/air_cooler.png', 1, 0, 0, 'COOL', 5, 5, '2026-04-02 10:58:25', '2026-04-02 06:46:15', NULL, 'Tower Air Cooler - 35L Tank', 'Sleek tower air cooler with 35L tank capacity and powerful air throw.', NULL),
(22, 'Desert Air Cooler - 75L Honeycomb', 'desert-air-cooler-75l-honeycomb', 9800.00, 11000.00, 'Heavy duty desert cooler with 75L tank and high-efficiency honeycomb pads.', 'uploads/products/air_cooler.png', 0, 1, 0, 'COOL', 5, 5, '2026-04-02 10:58:25', '2026-04-02 06:46:23', NULL, 'Desert Air Cooler - 75L Honeycomb', 'Heavy duty desert cooler with 75L tank and high-efficiency honeycomb pads.', NULL),
(23, 'Personal Mini Air Cooler - USB Powered', 'personal-mini-air-cooler-usb-powered', 950.00, 1250.00, 'Portable mini air cooler, perfect for office desks or bedside tables.', 'uploads/products/air_cooler.png', 0, 0, 1, 'COOL', 5, 5, '2026-04-02 10:58:25', '2026-04-02 06:51:34', NULL, 'Personal Mini Air Cooler - USB Powered', 'Portable mini air cooler, perfect for office desks or bedside tables.', NULL),
(24, 'Window Air Cooler - High Flow', 'window-air-cooler-high-flow', 7200.00, 8500.00, 'High air flow window cooler designed for effective cooling in medium rooms.', 'uploads/products/air_cooler.png', 1, 0, 0, 'COOL', 5, 5, '2026-04-02 10:58:25', '2026-04-02 06:47:39', NULL, 'Window Air Cooler - High Flow', 'High air flow window cooler designed for effective cooling in medium rooms.', NULL),
(25, 'Smart Bluetooth Air Cooler', 'smart-bluetooth-air-cooler', 11500.00, 13000.00, 'Next-gen smart cooler with Bluetooth connectivity and mobile app control.', 'uploads/products/air_cooler.png', 0, 1, 0, 'COOL', 5, 5, '2026-04-02 10:58:25', '2026-04-02 06:47:40', NULL, 'Smart Bluetooth Air Cooler', 'Next-gen smart cooler with Bluetooth connectivity and mobile app control.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free Return', '30 days money back guarantee!', 'fa fa-sync-alt', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(2, 'Free Shipping', 'Free shipping on all order', 'fab fa-telegram-plane', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(3, 'Support 24/7', 'We support online 24 hrs a day', 'fas fa-life-ring', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(4, 'Receive Gift Card', 'Recieve gift all over oder $50', 'fas fa-credit-card', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(5, 'Secure Payment', 'We Value Your Security', 'fas fa-lock', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21'),
(6, 'Online Service', 'Free return products in 30 days', 'fas fa-blog', 1, '2025-12-27 23:07:21', '2025-12-27 23:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('161Fm84oXL9UArNv8m5SgC9CWguMaHYfR9jsIMmr', NULL, '2401:4900:1c74:8b93:5c08:6a74:aad6:4bed', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWZDZ2R2Rk5qallWWHY2Vks3dlRZelgzSlBmSWNINGhpRVdMMG00NSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vc3ByaW5nZ3JlZW4tc2hyZXctNDcxOTYyLmhvc3RpbmdlcnNpdGUuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775127874),
('6pguiyRQYWkZCDeUOrMIln6hfaRJUhXzDWe5H1IC', NULL, '2401:4900:1c74:8b93:5c08:6a74:aad6:4bed', 'curl/8.13.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEVtRzdwdTBuTzVUSDZzNkFkNndwaFdKZDVNaThNY1FIU09TaXhDdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vc3ByaW5nZ3JlZW4tc2hyZXctNDcxOTYyLmhvc3RpbmdlcnNpdGUuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775125710),
('6ZyOZ8dOB7Ye1N6CoeIbUCIPeGxriIWxKhswCEQ6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVgwNUc5dVFkNERZT0dpU2E4UGFLaVNXV1o2aEVId3gwTWZiN0NrVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775128853),
('bNyJ5EpWzM1RdXYYQ5DpgGGE7xOUz089ThMBEcvv', NULL, '2401:4900:1c74:8b93:5c08:6a74:aad6:4bed', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXhCdzBQNGtBYWhGYU42cUtybzQycHpmd0Y2YmNMc1c4UXJOdDVUNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vc3ByaW5nZ3JlZW4tc2hyZXctNDcxOTYyLmhvc3RpbmdlcnNpdGUuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjY1OiJodHRwczovL3NwcmluZ2dyZWVuLXNocmV3LTQ3MTk2Mi5ob3N0aW5nZXJzaXRlLmNvbS9hZG1pbi9wcm9kdWN0cyI7fX0=', 1775128581),
('FeTd22aTJgYulDUqPLzhi4Cmabjfsf16a088brLM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1FWTlJWNncxaHlYRUhkUkJYWkE5dktGdG9pMVY4bXI2RVF2VU9wMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775128855),
('gkqqFVTs7L5WL72ERWzE6NGBxf93C694Yt3NEEjl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZW01OXY5WTNGT0RrdFJFZHFUanhTQ0Z0R0xTN28xVzdDc0JvWVZ5UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1775129570),
('nSpnoaIUgBxqfTsjfvf8T6DZauLKFJtaXdsG73WD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieU5IQTY0TElaWnNhanBEUmtFWEk1cDhRWnp5bE80anFWWEw4enRsNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImNhcnQiO2E6MTp7aToyNTthOjU6e3M6NDoibmFtZSI7czoyNjoiU21hcnQgQmx1ZXRvb3RoIEFpciBDb29sZXIiO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtzOjg6IjExNTAwLjAwIjtzOjU6ImltYWdlIjtzOjMxOiJ1cGxvYWRzL3Byb2R1Y3RzL2Fpcl9jb29sZXIucG5nIjtzOjQ6InNsdWciO3M6MjY6InNtYXJ0LWJsdWV0b290aC1haXItY29vbGVyIjt9fX0=', 1775132850),
('S8k7OuuyBvEIFPqFdc9V46zQOdeJitLEpF0SqCHE', 1, '2401:4900:1c74:8b93:5c08:6a74:aad6:4bed', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVnFxekVld2pqZVB6SGtaMW8yQ1BXVENuSktFb0RSWGgwV1ZjWjhJRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vc3ByaW5nZ3JlZW4tc2hyZXctNDcxOTYyLmhvc3RpbmdlcnNpdGUuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1775128656);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'Electro',
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `home_meta_title` varchar(255) DEFAULT NULL,
  `home_meta_description` text DEFAULT NULL,
  `home_meta_keywords` text DEFAULT NULL,
  `home_meta_image` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `whatsapp_link` varchar(255) DEFAULT NULL,
  `shiprocket_email` varchar(255) DEFAULT NULL,
  `shiprocket_password` varchar(255) DEFAULT NULL,
  `footer_phone` varchar(255) DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT '₹'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `phone`, `email`, `address`, `logo`, `favicon`, `primary_color`, `secondary_color`, `home_meta_title`, `home_meta_description`, `home_meta_keywords`, `home_meta_image`, `facebook_link`, `twitter_link`, `linkedin_link`, `instagram_link`, `youtube_link`, `whatsapp_link`, `shiprocket_email`, `shiprocket_password`, `footer_phone`, `footer_description`, `copyright_text`, `created_at`, `updated_at`, `currency`) VALUES
(1, 'Ecommerce', '+91 8448569297', 'saurabh@gmail.com', 'Dwarka Mor', 'uploads/media/1775125836_logo.png', 'uploads/media/1775125953_favicon.png', '#f00004', '#0d0d0d', 'Ecommerce', 'Ecommerce', 'Ecommerce', 'uploads/meta/1770096201_meta_xntrova_favicon_dark.jpg', 'www.facebook.com', 'www.facebook.com', 'www.facebook.com', 'www.facebook.com', 'www.facebook.com', NULL, NULL, NULL, '+91 8448569297', 'Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.', 'Reef Technologies, All right reserved.', '2025-12-27 23:07:23', '2026-04-02 06:55:10', 'RS');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_small` varchar(255) DEFAULT NULL,
  `title_big` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title_small`, `title_big`, `description`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, 'Energy efficient LED lighting solutions for every room in your house.', 'uploads/sliders/slider_1.png', 'http://localhost/shop', 1, '2026-04-02 06:17:45', '2026-04-02 06:17:45'),
(4, NULL, NULL, 'Experience the perfect breeze with our wide range of designer ceiling fans.', 'uploads/sliders/slider_2.png', 'http://localhost/shop', 1, '2026-04-02 06:17:45', '2026-04-02 06:17:45'),
(5, NULL, NULL, 'Advanced induction cooktops and stoves designed for perfect results.', 'uploads/sliders/slider_3.png', 'http://localhost/shop', 1, '2026-04-02 06:17:45', '2026-04-02 06:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Admin User', 'admin@gmail.com', '2025-12-27 23:07:22', '$2y$12$hO.tgPGh59ySWRzd21iMceckRR9YD8jVOTEV1nt0GWybyvUO.l4jO', '73TWsaukZS', '2025-12-27 23:07:23', '2026-01-30 01:23:54', 1),
(2, 'Saurabh Singh', 'saurabh@gmail.com', NULL, '$2y$12$Y/jBAl31jd90KdZGm5sBLO0LsvwXIN5CWslBcSI.tRzBq5p0xhTQy', NULL, '2025-12-28 10:14:46', '2025-12-28 10:14:46', 0),
(3, 'saurabh', 'saurabh.xntrova@gmail.com', NULL, '$2y$12$6GFjZcUmcBf.e.c8C7Y.COsKrvV3ioD9mdqG4LMcwfW6olwR5WWiG', NULL, '2025-12-28 10:18:15', '2025-12-28 10:18:15', 0),
(4, 'Sangram Singh', 'sangram@gmail.com', NULL, '$2y$12$5QUBxZg3i7EN34y1eaknluO.mw/t23he2Rs1MCef5Zn7RTh9St.Yi', NULL, '2025-12-28 10:21:10', '2025-12-28 10:21:10', 0),
(5, 'Ashish', 'ashish@gmail.com', NULL, '$2y$12$kFNBHe1WHuvsP//N9stdU.jphUO3gbOIb.r2JBdE3.R.twPiu1k/.', NULL, '2025-12-28 10:25:41', '2025-12-28 10:25:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wholesale_products`
--

CREATE TABLE `wholesale_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `min_quantity` int(11) NOT NULL DEFAULT 10,
  `max_quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `addons_unique_identifier_unique` (`unique_identifier`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_gateways_code_unique` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wholesale_products`
--
ALTER TABLE `wholesale_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wholesale_products_product_id_min_quantity_unique` (`product_id`,`min_quantity`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wholesale_products`
--
ALTER TABLE `wholesale_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wholesale_products`
--
ALTER TABLE `wholesale_products`
  ADD CONSTRAINT `wholesale_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
