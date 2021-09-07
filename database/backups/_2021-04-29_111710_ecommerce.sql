/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ ecommerce /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE ecommerce;

DROP TABLE IF EXISTS admins;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS cart;
CREATE TABLE `cart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_customer_id` int DEFAULT NULL,
  `cart_customer_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS cart_items;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `cart_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS categories;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_top` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS customers;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `cpf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_cpf_unique` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS customers_addresses;
CREATE TABLE `customers_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `complement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighbourhood` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_addresses_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS failed_jobs;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE `manufacturers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `manufacturer_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer_top` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS migrations;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS password_resets;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS products;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_category_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `manufacturer_id` bigint unsigned NOT NULL,
  `product_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_seo_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image1` text COLLATE utf8mb4_unicode_ci,
  `product_image2` text COLLATE utf8mb4_unicode_ci,
  `product_image3` text COLLATE utf8mb4_unicode_ci,
  `product_price` decimal(10,2) NOT NULL,
  `product_sale_price` decimal(10,2) NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_features` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_video` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_label` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_weight` decimal(10,2) NOT NULL,
  `product_width` int NOT NULL,
  `product_height` int NOT NULL,
  `product_lenght` int NOT NULL,
  `product_views` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_vendor_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_customer_id_foreign` (`customer_id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_manufacturer_id_foreign` (`manufacturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS products_categories;
CREATE TABLE `products_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_category_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_top` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS products_stock;
CREATE TABLE `products_stock` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `stock_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_enabled` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_quantity` int NOT NULL,
  `allow_backorders` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_stock_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




INSERT INTO admins(id,name,email,email_verified_at,password,remember_token,created_at,updated_at) VALUES(1,'Wilson','wilson@email.com','0000-00-00 00:00:00','$2y$10$bvFTcZu7eVQOumHBbtwegO6A12i.99kpdeDaUI8HmIQGg2kvSezNG',NULL,NULL,NULL),(2,'Wilson Castro da Paixão','wcastroteste@email.com',NULL,'$2y$10$AjxoHRFFkGiJxApaHOdC1ulU0yIKmDP6q6PQRhKEke38idC840ie2',NULL,'2021-04-23 15:34:54','2021-04-23 15:34:54'),(3,'wilson','castro@email.com',NULL,'$2y$10$fp.MKggsREEfpwZSYljLJObAi3SaS9nfZWxkGc5kPF/hG8waUPkqm',NULL,'2021-04-23 18:07:21','2021-04-23 18:07:21');

INSERT INTO cart(id,cart_customer_id,cart_customer_ip,created_at,updated_at) VALUES(2,NULL,'::1','2021-04-21 16:17:23','2021-04-21 16:17:23');

INSERT INTO cart_items(id,product_id,cart_id,quantity,created_at,updated_at) VALUES(5,27,3,2,'2021-04-26 17:02:19','2021-04-26 17:02:19'),(2,26,2,5,'2021-04-21 16:18:03','2021-04-25 15:31:58'),(4,25,4,2,'2021-04-21 17:19:01','2021-04-23 14:51:16');

INSERT INTO categories(id,category_title,category_top,category_image,created_at,updated_at) VALUES(23,X'46757465626f6c',X'796573',X'7075626c69632f696d6167656e732f63617465676f726961732f66757465626f6c5f313631383934323639322e6a7067','2021-04-20 18:18:12','2021-04-20 18:18:12'),(22,X'61736466',X'6e6f',X'7075626c69632f696d6167656e732f63617465676f726961732f617364665f313631383630353832322e6a7067','2021-04-16 20:43:42','2021-04-16 20:43:42'),(21,X'57696c736f6e',X'796573',X'7075626c69632f696d616765732f77696c736f6e5f313631383630353733332e6a7067','2021-04-16 20:42:13','2021-04-16 20:42:13'),(19,X'627663626e',X'796573',X'7075626c69632f6e65775f696d616765732f627663626e5f313631383630343434392e6a7067','2021-04-16 20:20:49','2021-04-16 20:20:49'),(20,X'66676864666768',X'796573',X'7075626c69632f696d6167652f666768646667685f313631383630343439322e6a7067','2021-04-16 20:21:32','2021-04-16 20:21:32');

INSERT INTO customers(id,name,email,password,remember_token,birthday,cpf,phone,ip,created_at,updated_at) VALUES(1,'Wilson Castro da Paixão','teste1@email.com','$2y$10$GdIqRIMl1.ZCI6DZcdbYEu7HjuucMYg94G494TfzE71XvvV4q8v/u',NULL,'1991-01-01','33984882858','(11) 56764-038','::1','2021-04-28 20:40:46','2021-04-28 20:40:46'),(2,'Wilson Castro da Paixão','teste2@email.com','$2y$10$ktQr1EAGMeYRkrHflgDxnO730/FykEfaZ.bP1gKBFfiIwYxyX.exG',NULL,'1991-01-01','1321321','121321321','::1','2021-04-28 20:41:56','2021-04-28 20:41:56'),(3,'Wilson Castro da Paixão','teste3@email.com','$2y$10$KejlLrEqAJOettYPjvAeEO8ZlA5LR1qoFFw9pAq.UrEZPs0A7PDFy',NULL,'1991-01-01','1321321123','121321321','::1','2021-04-28 20:42:22','2021-04-28 20:42:22'),(4,'Wilson Castro da Paixão','teste31@email.com','$2y$10$nFc79eL9VLrwhkj/OaA/fu.MRwt99Hz6DXDPeLys4so8Eoz.iaJy.',NULL,'1991-01-01','13213211231','121321321','::1','2021-04-28 20:43:29','2021-04-28 20:43:29'),(5,'Wilson Castro da Paixão','teste311@email.com','$2y$10$Eo4bEtqWGaGATGbSc8qjFuYcnB8T4yHH7glxKtuAtVCMZ6Bsi4ZLe',NULL,'1991-01-01','132132112311','121321321','::1','2021-04-28 21:00:11','2021-04-28 21:00:11'),(6,'Wilson Castro da Paixão','teste3121@email.com','$2y$10$T0vIE6HNZDylelIPRlI/0Oy0lZQ1fkrYpA9qLRlAzc5dk9U9FwB.y',NULL,'1991-01-01','1321321123112','121321321','::1','2021-04-28 21:03:58','2021-04-28 21:03:58'),(7,'Wilson Castro da Paixão','teste3121@email.com','$2y$10$KHuk7aURa3eMYEEUqPlLI.LIa2QYPbC928nnw5SXiQ2MQseajgW0y',NULL,'1991-01-01','13213211231121','121321321','::1','2021-04-28 21:04:20','2021-04-28 21:04:20'),(8,'Wilson Castro da Paixão','teste@email.com','$2y$10$gLruMJZovZgNPWvAfQbSi.b5Zt2b2HF2p8ASBxoRjEYlhoQpxw7.G',NULL,'1991-01-01','12313213131','(11) 56764-038','::1','2021-04-28 21:19:11','2021-04-28 21:19:11');

INSERT INTO customers_addresses(id,customer_id,zipcode,address,number,complement,neighbourhood,city,state,reference,created_at,updated_at) VALUES(1,1,'04476210','Rua Giusepe de Luca',152,'Casa 2','Jd. Laranjeiras','São Paulo','SP','Rua paralela com Av. Alda',NULL,NULL),(2,7,'04476-210','asdfasdfdfs',123,'Casa','Casdfsad','asdfsadf','asdf','sadfasdfsdfa','2021-04-28 21:04:20','2021-04-28 21:04:20'),(3,8,'04476-210','asdfasdfdfs',123,'Casa','Casdfsad','asdfsadf','asdf','sadfasdfsdfa','2021-04-28 21:19:11','2021-04-28 21:19:11');


INSERT INTO manufacturers(id,manufacturer_title,manufacturer_top,manufacturer_image,created_at,updated_at) VALUES(1,X'7763617374726f',X'61736466',X'61736466',NULL,NULL),(2,X'6170706c65',X'6170706c65',X'6170706c65',NULL,NULL),(3,X'57696c736f6e',X'796573',X'7075626c69632f696d6167656e732f666162726963616e7465732f77696c736f6e5f313631383737343135322e6a7067','2021-04-18 19:29:12','2021-04-18 19:29:12'),(4,X'7364666773646667',X'796573',X'7075626c69632f696d6167656e732f666162726963616e7465732f73646667736466675f313631383737373630392e6a7067','2021-04-18 20:26:49','2021-04-18 20:26:49');

INSERT INTO migrations(id,migration,batch) VALUES(13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_resets_table',1),(15,'2019_08_19_000000_create_failed_jobs_table',1),(16,'2021_04_11_173601_create_products_table',1),(44,'2021_04_12_130610_create_customers_table',11),(18,'2021_04_12_131907_create_products_categories_table',2),(19,'2021_04_12_132525_create_categories_table',3),(20,'2021_04_12_132934_create_manufacturers_table',4),(21,'2021_04_19_171625_create_products_stock',5),(26,'2021_04_20_211510_create_cart_table',6),(27,'2021_04_20_220823_create_cart_items_table',6),(32,'2021_04_22_182732_create_admins_table',7),(35,'2021_04_26_163655_add_dimensions_to_products_table',8),(40,'2021_04_28_170244_create_customers_addresses_table',10);


INSERT INTO products(id,customer_id,product_category_id,category_id,manufacturer_id,product_title,product_seo_description,product_url,product_image1,product_image2,product_image3,product_price,product_sale_price,product_description,product_features,product_video,product_keywords,product_label,product_weight,product_width,product_height,product_lenght,product_views,product_vendor_status,product_status,created_at,updated_at) VALUES(25,1,2,23,3,X'54c3aa6e697320416469646173',X'4e756c6c61206173706572696f72657320697073',X'74656e69732d616469646173',X'7075626c69632f696d6167656e732f70726f6475746f732f646f6c6f72656d2d647569732d717569732d6e75305f313631383934373137372e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f646f6c6f72656d2d647569732d717569732d6e75315f313631383934373137372e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f646f6c6f72656d2d647569732d717569732d6e75325f313631383934373137372e6a7067',604.00,162.00,X'4573736520696e2073656420647563696d7573',X'43756c7061206465736572756e7420657374206f',X'617364666173646661736466',X'5574207265637573616e646165204e656d6f',X'517561657261742063756c7061207365717569',0.30,16,16,16,X'31',X'616374697665',X'616374697665','2021-04-20 19:32:57','2021-04-20 19:32:57'),(26,1,2,23,2,X'54c3aa6e6973204e696b65',X'4e6968696c207369742073617069656e74652076',X'74656e6973',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e305f313631383934373935362e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e315f313631383934373935362e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e325f313631383934373935362e6a7067',622.00,828.00,X'5365642065756d20697275726520737573636970',X'446f6c6f72206c61626f72697320646f20617574',X'617364666173646661736466',X'53696d696c697175652063756d71756520696e76',X'4574206c61626f72652073757363697069742065',0.30,16,16,16,X'31',X'616374697665',X'616374697665','2021-04-20 19:45:56','2021-04-20 19:45:56'),(27,1,2,23,2,X'416469646173',X'4e6968696c207369742073617069656e74652076',X'616469646173',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e305f313631393435363434312e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e315f313631393435363434312e6a7067',X'7075626c69632f696d6167656e732f70726f6475746f732f6d696e75732d76656c69742d6f6469742d636f6e325f313631393435363434312e6a7067',622.00,828.00,X'5365642065756d20697275726520737573636970',X'446f6c6f72206c61626f72697320646f20617574',X'617364666173646661736466',X'53696d696c697175652063756d71756520696e76',X'4574206c61626f72652073757363697069742065',0.30,16,16,16,X'31',X'616374697665',X'616374697665','2021-04-26 17:00:41','2021-04-26 17:00:41');

INSERT INTO products_categories(id,product_category_title,product_category_top,product_category_image,created_at,updated_at) VALUES(1,X'426f6c61732064652046757465626f6c',X'61736466617364666166',X'6173646673616466',NULL,NULL),(2,X'6173646661736466',X'6e6f',X'7075626c69632f696d6167656e732f63617465676f726961732f61736466617364665f313631383630363439372e6a7067','2021-04-16 20:54:57','2021-04-16 20:54:57'),(3,X'617364666173646661736466',X'6e6f',X'7075626c69632f696d6167656e732f63617465676f726961732f6173646661736466617364665f313631383630363534382e6a7067','2021-04-16 20:55:48','2021-04-16 20:55:48'),(4,X'6473616661736466',X'6e6f',X'7075626c69632f696d6167656e732f63617465676f726961732f64736166617364665f313631383630363539392e6a7067','2021-04-16 20:56:39','2021-04-16 20:56:39');

INSERT INTO products_stock(id,product_id,stock_status,stock_enabled,stock_quantity,allow_backorders,created_at,updated_at) VALUES(1,1,'OK','OK',20,'OK',NULL,NULL),(2,2,'OK','OK',12,'1',NULL,NULL),(3,9,'in_stock','no',0,'no','2021-04-20 17:18:18','2021-04-20 17:18:18'),(4,10,'in_stock','yes',337,'yes','2021-04-20 17:57:46','2021-04-20 17:57:46'),(5,11,'in_stock','yes',337,'no','2021-04-20 17:58:03','2021-04-20 17:58:03'),(6,12,'in_stock','yes',337,'notify','2021-04-20 17:58:08','2021-04-20 17:58:08'),(7,13,'in_stock','yes',0,'yes','2021-04-20 17:58:32','2021-04-20 17:58:32'),(8,14,'in_stock','yes',337,'yes','2021-04-20 17:59:11','2021-04-20 17:59:11'),(9,15,'in_stock','yes',0,'yes','2021-04-20 17:59:35','2021-04-20 17:59:35'),(10,18,'in_stock','yes',0,'yes','2021-04-20 18:00:49','2021-04-20 18:00:49'),(11,19,'in_stock','on_backorder',0,'yes','2021-04-20 18:01:45','2021-04-20 18:01:45'),(12,20,'in_stock','yes',337,'yes','2021-04-20 18:06:40','2021-04-20 18:06:40'),(13,21,'on_backorder','yes',0,'yes','2021-04-20 18:07:04','2021-04-20 18:07:04'),(14,22,'out_stock','yes',0,'no','2021-04-20 18:07:18','2021-04-20 18:07:18'),(15,23,'in_stock','no',0,'no','2021-04-20 18:07:39','2021-04-20 18:07:39'),(16,24,'in_stock','yes',337,'yes','2021-04-20 18:19:25','2021-04-20 18:19:25'),(17,25,'out_stock','no',10,'no','2021-04-20 19:32:57','2021-04-20 19:32:57'),(18,26,'in_stock','yes',2,'no','2021-04-20 19:45:56','2021-04-20 19:45:56'),(19,27,'in_stock','yes',951,'no','2021-04-26 17:00:41','2021-04-26 17:00:41');
INSERT INTO users(id,name,email,email_verified_at,password,remember_token,created_at,updated_at) VALUES(1,'wilson','wcastro@email.com',NULL,'$2y$10$bvFTcZu7eVQOumHBbtwegO6A12i.99kpdeDaUI8HmIQGg2kvSezNG','wCqxnPqxG7wkSYcwvCqcFGe1fYhNwADOIrTR1jKhhWKkd7cQl5pSJQLPpviu','2021-04-22 16:22:27','2021-04-22 16:22:27'),(2,'Wilson','willian@maildrop',NULL,'$2y$10$4r5dka4V9wioNvxQ3F5k5e7D4CreSdMvFlXBcVefaEDWJDZaxiKJq',NULL,'2021-04-23 19:21:13','2021-04-23 19:21:13'),(3,'wilson','teste@email.com',NULL,'$2y$10$xQdjgX0.MAr7yN0blaWTyuouYNJ7qp4bk29U.YGrASJ4Oaq70jyBu','M2CnToo5YEIValdtpcs0dzStiGmlCqZVTW8DBC6nkgixlH8xFfCjYc6vaUjX','2021-04-25 17:17:48','2021-04-25 17:17:48');







/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
