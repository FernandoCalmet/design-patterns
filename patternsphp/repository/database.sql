-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.26 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sales_db
CREATE DATABASE IF NOT EXISTS `sales_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `sales_db`;

-- Volcando estructura para tabla sales_db.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_users` (`user_id`),
  KEY `FK_orders_users_2` (`creater_id`),
  CONSTRAINT `FK_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_orders_users_2` FOREIGN KEY (`creater_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla sales_db.orders: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `total`, `creater_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 6500.00, 1, '2019-08-30 01:58:41', '2019-08-30 01:58:43'),
	(44, 1, 5021.00, 2, '2019-09-17 02:04:47', '2019-09-17 02:04:47');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Volcando estructura para tabla sales_db.order_detail
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_detail_orders` (`order_id`),
  KEY `FK_order_detail_products` (`product_id`),
  CONSTRAINT `FK_order_detail_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_order_detail_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla sales_db.order_detail: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 2500.00, 5000.00, '2019-08-30 02:00:42', '2019-08-30 02:00:42'),
	(45, 44, 1, 2, 2500.00, 5000.00, '2019-09-17 02:04:47', '2019-09-17 02:04:47'),
	(46, 44, 4, 3, 7.00, 21.00, '2019-09-17 02:04:47', '2019-09-17 02:04:47');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;

-- Volcando estructura para tabla sales_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla sales_db.products: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'Guitarra eléctrica Fender', 2500.00, '2019-08-30 01:58:41', '2019-08-30 01:58:41'),
	(2, 'Amplificador Laney', 1500.00, '2019-08-30 01:58:41', '2019-08-30 01:58:41'),
	(3, 'Pedal Tube Screamer', 250.00, '2019-08-30 01:58:41', '2019-08-30 01:58:41'),
	(4, 'Cuerdas Addario XL', 7.00, '2019-08-30 01:58:41', '2019-08-30 01:58:41'),
	(5, 'Funda para guitarra x', 16.00, '2019-08-30 01:58:41', '2019-09-17 00:29:52'),
	(6, 'Case para guitarra eléctrica', 100.00, '2019-08-30 01:58:41', '2019-08-30 01:58:41');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla sales_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla sales_db.users: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'Eduardo', 'Rodríguez', 'erodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 15:57:30', '2019-08-29 15:57:30'),
	(2, 'Sandro', 'Rodriguez', 'srodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(3, 'Carla', 'Rodriguez', 'crodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(4, 'Maria', 'Rodriguez', 'mrodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(5, 'Jose', 'Rodriguez', 'jrodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(6, 'Raul', 'Rodriguez', 'rrodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(7, 'Alonso', 'Rodriguez', 'arodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(8, 'Miguel', 'Rodriguez', 'mrodriguez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(9, 'Alan', 'Garcia', 'agarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(10, 'Jose', 'Garcia', 'jgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(11, 'Karen', 'Garcia', 'kgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(12, 'Laura', 'Garcia', 'lgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(13, 'Susana', 'Garcia', 'sgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(14, 'Fabiola', 'Garcia', 'fgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(15, 'Pamela', 'Garcia', 'pgarcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
	(16, 'Lucia', 'Fernandez', 'lfernandez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-29 21:51:06', '2019-08-29 21:51:06'),
	(18, 'Alejandro', 'Perez', 'aperez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-30 01:48:22', '2019-08-30 01:48:22'),
	(20, 'Juan', 'Perez', 'jperez', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-30 02:50:31', '2019-08-30 02:50:31'),
	(37, 'Rocío', 'Tsumi', 'rtsumi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-08-30 05:06:07', '2019-08-30 05:06:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;