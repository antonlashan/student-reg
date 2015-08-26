-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table membership.pmp_migration
CREATE TABLE IF NOT EXISTS `pmp_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_migration: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmp_migration` DISABLE KEYS */;
INSERT INTO `pmp_migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1440563509),
	('m130524_201442_init', 1440563516);
/*!40000 ALTER TABLE `pmp_migration` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_qualification
CREATE TABLE IF NOT EXISTS `pmp_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_qualification: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmp_qualification` DISABLE KEYS */;
INSERT INTO `pmp_qualification` (`id`, `name`, `status`) VALUES
	(1, 'BSc', 1),
	(2, 'BSc (Sp)', 1);
/*!40000 ALTER TABLE `pmp_qualification` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_specialization
CREATE TABLE IF NOT EXISTS `pmp_specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_specialization: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmp_specialization` DISABLE KEYS */;
INSERT INTO `pmp_specialization` (`id`, `name`, `status`) VALUES
	(1, 'Applied Physics', 1),
	(2, 'Astronomy and Astrophysics', 1);
/*!40000 ALTER TABLE `pmp_specialization` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_user
CREATE TABLE IF NOT EXISTS `pmp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` tinyint(4) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(4) DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table membership.pmp_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmp_user` DISABLE KEYS */;
INSERT INTO `pmp_user` (`id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `title`, `full_name`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'dWHUCqDn7xLrY3bZ2wAAza_tDK4xh6SJ', '$2y$13$b9m1ttNPAKl3qRpEkE6gGu73dVx9LA7xPamxQxzlwV6PXQOOPX..a', NULL, 'antonlashan@gmail.com', 1, 'Lashan Fernando', 1, 1, '2015-08-26 12:22:27', '2015-08-26 19:54:58'),
	(2, 'hbPzX0qU2zfECI_LNZ8NqDUaC9oo5mjj', '$2y$13$b9m1ttNPAKl3qRpEkE6gGu73dVx9LA7xPamxQxzlwV6PXQOOPX..a', NULL, 'antonlashan2@gmail.com', 1, 'Lashan Kraken', 0, 1, '2015-08-26 13:45:47', '2015-08-26 14:37:37');
/*!40000 ALTER TABLE `pmp_user` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_user_category
CREATE TABLE IF NOT EXISTS `pmp_user_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_user_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmp_user_category` DISABLE KEYS */;
INSERT INTO `pmp_user_category` (`id`, `name`, `status`) VALUES
	(1, 'Category1', 1),
	(2, 'Category2', 1);
/*!40000 ALTER TABLE `pmp_user_category` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_user_detail
CREATE TABLE IF NOT EXISTS `pmp_user_detail` (
  `user_id` int(11) NOT NULL,
  `membership_number` varchar(50) NOT NULL,
  `member_category_id` int(11) NOT NULL,
  `present_position` varchar(50) NOT NULL,
  `affiliation` varchar(200) DEFAULT NULL,
  `official_address` varchar(200),
  `permanent_address` varchar(200) NOT NULL,
  `phone_office` varchar(15) NOT NULL,
  `phone_residence` varchar(15) DEFAULT NULL,
  `phone_mobile` varchar(15) NOT NULL,
  `professional_qualifications` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_pmp_user_detail_pmp_user_category` (`member_category_id`),
  CONSTRAINT `FK_pmp_user_detail_pmp_user` FOREIGN KEY (`user_id`) REFERENCES `pmp_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pmp_user_detail_pmp_user_category` FOREIGN KEY (`member_category_id`) REFERENCES `pmp_user_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_user_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmp_user_detail` DISABLE KEYS */;
INSERT INTO `pmp_user_detail` (`user_id`, `membership_number`, `member_category_id`, `present_position`, `affiliation`, `official_address`, `permanent_address`, `phone_office`, `phone_residence`, `phone_mobile`, `professional_qualifications`) VALUES
	(1, 'sfgsdgs343234', 1, 'Senior Engineer', '', '7789', '79789', '12345654', '453453453', '345345', '78978978');
/*!40000 ALTER TABLE `pmp_user_detail` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_user_qualifications
CREATE TABLE IF NOT EXISTS `pmp_user_qualifications` (
  `user_id` int(11) DEFAULT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_id_qualification_id` (`user_id`,`qualification_id`),
  KEY `FK_pmp_user_qualifications_pmp_qualification` (`qualification_id`),
  CONSTRAINT `FK_pmp_user_qualifications_pmp_user` FOREIGN KEY (`user_id`) REFERENCES `pmp_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pmp_user_qualifications_pmp_qualification` FOREIGN KEY (`qualification_id`) REFERENCES `pmp_qualification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_user_qualifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmp_user_qualifications` DISABLE KEYS */;
INSERT INTO `pmp_user_qualifications` (`user_id`, `qualification_id`) VALUES
	(1, 2);
/*!40000 ALTER TABLE `pmp_user_qualifications` ENABLE KEYS */;


-- Dumping structure for table membership.pmp_user_specializations
CREATE TABLE IF NOT EXISTS `pmp_user_specializations` (
  `user_id` int(11) DEFAULT NULL,
  `specialization_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_id_specialization_id` (`user_id`,`specialization_id`),
  KEY `FK_pmp_user_specializations_pmp_specialization` (`specialization_id`),
  CONSTRAINT `FK_pmp_user_specializations_pmp_specialization` FOREIGN KEY (`specialization_id`) REFERENCES `pmp_specialization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pmp_user_specializations_pmp_user` FOREIGN KEY (`user_id`) REFERENCES `pmp_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table membership.pmp_user_specializations: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmp_user_specializations` DISABLE KEYS */;
INSERT INTO `pmp_user_specializations` (`user_id`, `specialization_id`) VALUES
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `pmp_user_specializations` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
