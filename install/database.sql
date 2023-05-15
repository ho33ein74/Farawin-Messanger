-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table reservation.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `admin_role_id` int NOT NULL DEFAULT '0',
  `a_name` varchar(100) NOT NULL,
  `a_username` varchar(100) NOT NULL,
  `a_email` varchar(100) DEFAULT NULL,
  `a_password` varchar(250) NOT NULL,
  `a_selected_dashboard_id` varchar(50) NOT NULL DEFAULT 'dashboard-main',
  `telegram_id` varchar(100) DEFAULT NULL,
  `a_image` varchar(1000) DEFAULT NULL,
  `a_desc` varchar(4000) DEFAULT NULL,
  `google_secret_code` varchar(250) DEFAULT NULL,
  `google_auth_status` tinyint NOT NULL DEFAULT '0',
  `registery_date` varchar(50) NOT NULL,
  `a_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_admin: ~1 rows (approximately)
DELETE FROM `tbl_admin`;
INSERT INTO `tbl_admin` (`a_id`, `admin_role_id`, `a_name`, `a_username`, `a_email`, `a_password`, `a_selected_dashboard_id`, `telegram_id`, `a_image`, `a_desc`, `google_secret_code`, `google_auth_status`, `registery_date`, `a_status`) VALUES
	(1, 1, 'admin_name', 'admin_username', 'admin_email', 'admin_password', 'dashboard-main', NULL, NULL, NULL, 'google_secret_code_gen', 0, 'admin_created_at', 1);

-- Dumping structure for table reservation.tbl_admin_activity
CREATE TABLE IF NOT EXISTS `tbl_admin_activity` (
  `idusr_activity` int NOT NULL AUTO_INCREMENT,
  `admin_id` int unsigned DEFAULT NULL,
  `data_changed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `ip` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `platform` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `browser` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `activity` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusr_activity`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- Dumping data for table reservation.tbl_admin_activity: ~0 rows (approximately)
DELETE FROM `tbl_admin_activity`;

-- Dumping structure for table reservation.tbl_admin_role
CREATE TABLE IF NOT EXISTS `tbl_admin_role` (
  `ar_id` int NOT NULL AUTO_INCREMENT,
  `ar_title` varchar(250) NOT NULL,
  `ar_removable` tinyint NOT NULL DEFAULT '1',
  `ar_create_date` varchar(50) DEFAULT NULL,
  `ar_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`ar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_admin_role: 1 rows
DELETE FROM `tbl_admin_role`;
/*!40000 ALTER TABLE `tbl_admin_role` DISABLE KEYS */;
INSERT INTO `tbl_admin_role` (`ar_id`, `ar_title`, `ar_removable`, `ar_create_date`, `ar_status`) VALUES
	(1, 'مدیر سیستم', 0, '1401/01/01', 1);
/*!40000 ALTER TABLE `tbl_admin_role` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_admin_role_access
CREATE TABLE IF NOT EXISTS `tbl_admin_role_access` (
  `aa_id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`aa_id`),
  UNIQUE KEY `aa_id` (`aa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_admin_role_access: 0 rows
DELETE FROM `tbl_admin_role_access`;
/*!40000 ALTER TABLE `tbl_admin_role_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_admin_role_access` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_api_keys
CREATE TABLE IF NOT EXISTS `tbl_api_keys` (
  `idapi_keys` int unsigned NOT NULL,
  `name` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `key` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table reservation.tbl_api_keys: ~2 rows (approximately)
DELETE FROM `tbl_api_keys`;
INSERT INTO `tbl_api_keys` (`idapi_keys`, `name`, `key`, `log_time`) VALUES
	(1, 'app', 'KRxn7ThW8XsBTMa3CZ0dPFUU6NFpmuC4dvb54gEFk2kNnZ5ftxNRlA4b9EFFDf9a4kT6Jv46z586vMU2gZGSaEYjRdHDRW6GuMGh', '2019-01-27 01:19:02'),
	(2, 'test', 'ghfghfbfgbfhgfhgfhgfh546gf46f5g4f45g6gf45gfghfghfbfgbfhgfhgfhgfh546gf46f5g4f45g6gf45gfghfghfbfgbfhgf', '2022-01-12 19:45:10');

-- Dumping structure for table reservation.tbl_app_versions
CREATE TABLE IF NOT EXISTS `tbl_app_versions` (
  `idsys_versions` int unsigned NOT NULL,
  `update_state` enum('force','recommend','normal') DEFAULT 'normal',
  `version_number` int DEFAULT NULL,
  `version_name` varchar(45) DEFAULT NULL,
  `os` enum('android','ios','web') DEFAULT NULL,
  `download_link_vas` varchar(500) DEFAULT NULL,
  `download_link_bazar` varchar(500) DEFAULT NULL COMMENT 'bazaar intent call',
  `change_log` text,
  `public_desc` text,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_app_versions: ~0 rows (approximately)
DELETE FROM `tbl_app_versions`;

-- Dumping structure for table reservation.tbl_banks
CREATE TABLE IF NOT EXISTS `tbl_banks` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `bank_vids_id` varchar(100) NOT NULL,
  `b_name` varchar(200) NOT NULL,
  `b_logo` varchar(20) NOT NULL DEFAULT 'bank',
  `b_branch` varchar(200) NOT NULL,
  `b_current_balance` varchar(1000) DEFAULT NULL,
  `b_account_opening_date` varchar(30) DEFAULT NULL,
  `b_account_type` varchar(30) DEFAULT NULL,
  `b_account_number` varchar(50) NOT NULL,
  `b_sheba_number` varchar(50) DEFAULT NULL,
  `b_cart_number` varchar(50) DEFAULT NULL,
  `b_currency` int NOT NULL,
  `b_default` tinyint NOT NULL DEFAULT '0',
  `b_description` varchar(1000) DEFAULT NULL,
  `b_date` varchar(20) NOT NULL,
  `b_removable` enum('0','1') NOT NULL DEFAULT '1',
  `b_status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_banks: 1 rows
DELETE FROM `tbl_banks`;
/*!40000 ALTER TABLE `tbl_banks` DISABLE KEYS */;
INSERT INTO `tbl_banks` (`b_id`, `bank_vids_id`, `b_name`, `b_logo`, `b_branch`, `b_current_balance`, `b_account_opening_date`, `b_account_type`, `b_account_number`, `b_sheba_number`, `b_cart_number`, `b_currency`, `b_default`, `b_description`, `b_date`, `b_removable`, `b_status`) VALUES
	(1, '1000', 'پیش فرض', 'bank', 'پیش فرض', '0', '1401/01/01', 'سایر', '-', '', '', 1, 1, '', '1401/01/1', '0', 1);
/*!40000 ALTER TABLE `tbl_banks` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_banner
CREATE TABLE IF NOT EXISTS `tbl_banner` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `b_title` varchar(250) NOT NULL,
  `b_type` int NOT NULL,
  `b_create_date` varchar(30) NOT NULL,
  `b_status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_banner: 0 rows
DELETE FROM `tbl_banner`;
/*!40000 ALTER TABLE `tbl_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_banner` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_banner_image
CREATE TABLE IF NOT EXISTS `tbl_banner_image` (
  `bi_id` int NOT NULL AUTO_INCREMENT,
  `banner_id` int NOT NULL,
  `bi_image` varchar(100) NOT NULL,
  `bi_description` varchar(250) DEFAULT NULL,
  `bi_link` varchar(250) DEFAULT NULL,
  `bi_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`bi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_banner_image: 0 rows
DELETE FROM `tbl_banner_image`;
/*!40000 ALTER TABLE `tbl_banner_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_banner_image` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_blog
CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `cat_id` int NOT NULL,
  `slug` varchar(1000) NOT NULL,
  `seo_title` varchar(250) NOT NULL,
  `seo_desc` varchar(1000) DEFAULT NULL,
  `writer` int NOT NULL DEFAULT '1',
  `suggestion` tinyint NOT NULL DEFAULT '0',
  `title` varchar(1000) NOT NULL,
  `main_tag` varchar(1000) DEFAULT NULL,
  `subtitle` varchar(2000) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `description` longtext,
  `source` int NOT NULL,
  `link` text,
  `view` int NOT NULL DEFAULT '0',
  `date_created` varchar(200) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `b_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_blog: ~0 rows (approximately)
DELETE FROM `tbl_blog`;

-- Dumping structure for table reservation.tbl_blog_related
CREATE TABLE IF NOT EXISTS `tbl_blog_related` (
  `br_id` int NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `br_related_id` int NOT NULL,
  PRIMARY KEY (`br_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_blog_related: 0 rows
DELETE FROM `tbl_blog_related`;
/*!40000 ALTER TABLE `tbl_blog_related` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_blog_related` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_blog_tag
CREATE TABLE IF NOT EXISTS `tbl_blog_tag` (
  `pt_id` int NOT NULL AUTO_INCREMENT,
  `pt_post_id` int NOT NULL,
  `pt_tag_id` int NOT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_blog_tag: 0 rows
DELETE FROM `tbl_blog_tag`;
/*!40000 ALTER TABLE `tbl_blog_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_blog_tag` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_bookmarks
CREATE TABLE IF NOT EXISTS `tbl_bookmarks` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `b_type` varchar(20) NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_bookmarks: 0 rows
DELETE FROM `tbl_bookmarks`;
/*!40000 ALTER TABLE `tbl_bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bookmarks` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_branches
CREATE TABLE IF NOT EXISTS `tbl_branches` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `branch_vids_id` varchar(100) NOT NULL,
  `b_name` varchar(200) NOT NULL,
  `b_manager` varchar(200) NOT NULL,
  `b_phone` varchar(30) DEFAULT NULL,
  `b_address` varchar(500) DEFAULT NULL,
  `province_id` int NOT NULL,
  `city_id` int NOT NULL,
  `b_date` varchar(50) DEFAULT NULL,
  `b_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_branches: 1 rows
DELETE FROM `tbl_branches`;
/*!40000 ALTER TABLE `tbl_branches` DISABLE KEYS */;
INSERT INTO `tbl_branches` (`b_id`, `branch_vids_id`, `b_name`, `b_manager`, `b_phone`, `b_address`, `province_id`, `city_id`, `b_date`, `b_status`) VALUES
	(1000, '1000', 'شعبه اصلی', 'مدیر اصلی', '', '', 11, 153, '1401/01/01', 1);
/*!40000 ALTER TABLE `tbl_branches` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_cash
CREATE TABLE IF NOT EXISTS `tbl_cash` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `cash_vids_id` varchar(100) NOT NULL,
  `c_name` varchar(1000) NOT NULL,
  `c_currency` int NOT NULL,
  `c_current_balance` varchar(200) NOT NULL DEFAULT '0',
  `c_desc` varchar(1000) DEFAULT NULL,
  `c_date` varchar(50) NOT NULL,
  `c_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_cash: 1 rows
DELETE FROM `tbl_cash`;
/*!40000 ALTER TABLE `tbl_cash` DISABLE KEYS */;
INSERT INTO `tbl_cash` (`c_id`, `cash_vids_id`, `c_name`, `c_currency`, `c_current_balance`, `c_desc`, `c_date`, `c_status`) VALUES
	(1, '1000', 'پیش فرض', 1, '0', '', '1401/01/01', 1);
/*!40000 ALTER TABLE `tbl_cash` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_category
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `c_removable` tinyint NOT NULL DEFAULT '1',
  `c_type` varchar(15) NOT NULL DEFAULT 'blog',
  `name` varchar(1000) NOT NULL,
  `parent_id` int DEFAULT '0',
  `description` varchar(4000) DEFAULT NULL,
  `menu_type` int DEFAULT NULL,
  `icon` varchar(1000) DEFAULT NULL,
  `banner_vertical` varchar(250) DEFAULT NULL,
  `banner_horizontal` varchar(250) DEFAULT NULL,
  `link` varchar(1000) NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_category: ~0 rows (approximately)
DELETE FROM `tbl_category`;
INSERT INTO `tbl_category` (`id`, `c_removable`, `c_type`, `name`, `parent_id`, `description`, `menu_type`, `icon`, `banner_vertical`, `banner_horizontal`, `link`, `count`, `status`) VALUES
	(1, 0, 'blog', 'بدون دسته', 0, NULL, NULL, '', NULL, NULL, 'no-category', 0, 1);

-- Dumping structure for table reservation.tbl_cities
CREATE TABLE IF NOT EXISTS `tbl_cities` (
  `ci_id` int unsigned NOT NULL AUTO_INCREMENT,
  `province_id` int unsigned NOT NULL,
  `ci_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ci_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`ci_id`),
  KEY `cities_province_id_foreign` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=441 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table reservation.tbl_cities: ~440 rows (approximately)
DELETE FROM `tbl_cities`;
INSERT INTO `tbl_cities` (`ci_id`, `province_id`, `ci_name`, `ci_status`) VALUES
	(1, 1, 'تبريز', 1),
	(2, 1, 'كندوان', 1),
	(3, 1, 'بندر شرفخانه', 1),
	(4, 1, 'مراغه', 1),
	(5, 1, 'ميانه', 1),
	(6, 1, 'شبستر', 1),
	(7, 1, 'مرند', 1),
	(8, 1, 'جلفا', 1),
	(9, 1, 'سراب', 1),
	(10, 1, 'هاديشهر', 1),
	(11, 1, 'بناب', 1),
	(12, 1, 'كليبر', 1),
	(13, 1, 'تسوج', 1),
	(14, 1, 'اهر', 1),
	(15, 1, 'هريس', 1),
	(16, 1, 'عجبشير', 1),
	(17, 1, 'هشترود', 1),
	(18, 1, 'ملكان', 1),
	(19, 1, 'بستان آباد', 1),
	(20, 1, 'ورزقان', 1),
	(21, 1, 'اسكو', 1),
	(22, 1, 'آذر شهر', 1),
	(23, 1, 'قره آغاج', 1),
	(24, 1, 'ممقان', 1),
	(25, 1, 'صوفیان', 1),
	(26, 1, 'ایلخچی', 1),
	(27, 1, 'خسروشهر', 1),
	(28, 1, 'باسمنج', 1),
	(29, 1, 'سهند', 1),
	(30, 2, 'اروميه', 1),
	(31, 2, 'نقده', 1),
	(32, 2, 'ماكو', 1),
	(33, 2, 'تكاب', 1),
	(34, 2, 'خوي', 1),
	(35, 2, 'مهاباد', 1),
	(36, 2, 'سر دشت', 1),
	(37, 2, 'چالدران', 1),
	(38, 2, 'بوكان', 1),
	(39, 2, 'مياندوآب', 1),
	(40, 2, 'سلماس', 1),
	(41, 2, 'شاهين دژ', 1),
	(42, 2, 'پيرانشهر', 1),
	(43, 2, 'سيه چشمه', 1),
	(44, 2, 'اشنويه', 1),
	(45, 2, 'چایپاره', 1),
	(46, 2, 'پلدشت', 1),
	(47, 2, 'شوط', 1),
	(48, 3, 'اردبيل', 1),
	(49, 3, 'سرعين', 1),
	(50, 3, 'بيله سوار', 1),
	(51, 3, 'پارس آباد', 1),
	(52, 3, 'خلخال', 1),
	(53, 3, 'مشگين شهر', 1),
	(54, 3, 'مغان', 1),
	(55, 3, 'نمين', 1),
	(56, 3, 'نير', 1),
	(57, 3, 'كوثر', 1),
	(58, 3, 'كيوي', 1),
	(59, 3, 'گرمي', 1),
	(60, 4, 'اصفهان', 1),
	(61, 4, 'فريدن', 1),
	(62, 4, 'فريدون شهر', 1),
	(63, 4, 'فلاورجان', 1),
	(64, 4, 'گلپايگان', 1),
	(65, 4, 'دهاقان', 1),
	(66, 4, 'نطنز', 1),
	(67, 4, 'نايين', 1),
	(68, 4, 'تيران', 1),
	(69, 4, 'كاشان', 1),
	(70, 4, 'فولاد شهر', 1),
	(71, 4, 'اردستان', 1),
	(72, 4, 'سميرم', 1),
	(73, 4, 'درچه', 1),
	(74, 4, 'کوهپایه', 1),
	(75, 4, 'مباركه', 1),
	(76, 4, 'شهرضا', 1),
	(77, 4, 'خميني شهر', 1),
	(78, 4, 'شاهين شهر', 1),
	(79, 4, 'نجف آباد', 1),
	(80, 4, 'دولت آباد', 1),
	(81, 4, 'زرين شهر', 1),
	(82, 4, 'آران و بيدگل', 1),
	(83, 4, 'باغ بهادران', 1),
	(84, 4, 'خوانسار', 1),
	(85, 4, 'مهردشت', 1),
	(86, 4, 'علويجه', 1),
	(87, 4, 'عسگران', 1),
	(88, 4, 'نهضت آباد', 1),
	(89, 4, 'حاجي آباد', 1),
	(90, 4, 'تودشک', 1),
	(91, 4, 'ورزنه', 1),
	(92, 6, 'ايلام', 1),
	(93, 6, 'مهران', 1),
	(94, 6, 'دهلران', 1),
	(95, 6, 'آبدانان', 1),
	(96, 6, 'شيروان چرداول', 1),
	(97, 6, 'دره شهر', 1),
	(98, 6, 'ايوان', 1),
	(99, 6, 'سرابله', 1),
	(100, 7, 'بوشهر', 1),
	(101, 7, 'تنگستان', 1),
	(102, 7, 'دشتستان', 1),
	(103, 7, 'دير', 1),
	(104, 7, 'ديلم', 1),
	(105, 7, 'كنگان', 1),
	(106, 7, 'گناوه', 1),
	(107, 7, 'ريشهر', 1),
	(108, 7, 'دشتي', 1),
	(109, 7, 'خورموج', 1),
	(110, 7, 'اهرم', 1),
	(111, 7, 'برازجان', 1),
	(112, 7, 'خارك', 1),
	(113, 7, 'جم', 1),
	(114, 7, 'کاکی', 1),
	(115, 7, 'عسلویه', 1),
	(116, 7, 'بردخون', 1),
	(117, 8, 'تهران', 1),
	(118, 8, 'ورامين', 1),
	(119, 8, 'فيروزكوه', 1),
	(120, 8, 'ري', 1),
	(121, 8, 'دماوند', 1),
	(122, 8, 'اسلامشهر', 1),
	(123, 8, 'رودهن', 1),
	(124, 8, 'لواسان', 1),
	(125, 8, 'بومهن', 1),
	(126, 8, 'تجريش', 1),
	(127, 8, 'فشم', 1),
	(128, 8, 'كهريزك', 1),
	(129, 8, 'پاكدشت', 1),
	(130, 8, 'چهاردانگه', 1),
	(131, 8, 'شريف آباد', 1),
	(132, 8, 'قرچك', 1),
	(133, 8, 'باقرشهر', 1),
	(134, 8, 'شهريار', 1),
	(135, 8, 'رباط كريم', 1),
	(136, 8, 'قدس', 1),
	(137, 8, 'ملارد', 1),
	(138, 9, 'شهركرد', 1),
	(139, 9, 'فارسان', 1),
	(140, 9, 'بروجن', 1),
	(141, 9, 'چلگرد', 1),
	(142, 9, 'اردل', 1),
	(143, 9, 'لردگان', 1),
	(144, 9, 'سامان', 1),
	(145, 10, 'قائن', 1),
	(146, 10, 'فردوس', 1),
	(147, 10, 'بيرجند', 1),
	(148, 10, 'نهبندان', 1),
	(149, 10, 'سربيشه', 1),
	(150, 10, 'طبس مسینا', 1),
	(151, 10, 'قهستان', 1),
	(152, 10, 'درمیان', 1),
	(153, 11, 'مشهد', 1),
	(154, 11, 'نيشابور', 1),
	(155, 11, 'سبزوار', 1),
	(156, 11, 'كاشمر', 1),
	(157, 11, 'گناباد', 1),
	(158, 11, 'طبس', 1),
	(159, 11, 'تربت حيدريه', 1),
	(160, 11, 'خواف', 1),
	(161, 11, 'تربت جام', 1),
	(162, 11, 'تايباد', 1),
	(163, 11, 'قوچان', 1),
	(164, 11, 'سرخس', 1),
	(165, 11, 'بردسكن', 1),
	(166, 11, 'فريمان', 1),
	(167, 11, 'چناران', 1),
	(168, 11, 'درگز', 1),
	(169, 11, 'كلات', 1),
	(170, 11, 'طرقبه', 1),
	(171, 11, 'سر ولایت', 1),
	(172, 12, 'بجنورد', 1),
	(173, 12, 'اسفراين', 1),
	(174, 12, 'جاجرم', 1),
	(175, 12, 'شيروان', 1),
	(176, 12, 'آشخانه', 1),
	(177, 12, 'گرمه', 1),
	(178, 12, 'ساروج', 1),
	(179, 13, 'اهواز', 1),
	(180, 13, 'ايرانشهر', 1),
	(181, 13, 'شوش', 1),
	(182, 13, 'آبادان', 1),
	(183, 13, 'خرمشهر', 1),
	(184, 13, 'مسجد سليمان', 1),
	(185, 13, 'ايذه', 1),
	(186, 13, 'شوشتر', 1),
	(187, 13, 'انديمشك', 1),
	(188, 13, 'سوسنگرد', 1),
	(189, 13, 'هويزه', 1),
	(190, 13, 'دزفول', 1),
	(191, 13, 'شادگان', 1),
	(192, 13, 'بندر ماهشهر', 1),
	(193, 13, 'بندر امام خميني', 1),
	(194, 13, 'اميديه', 1),
	(195, 13, 'بهبهان', 1),
	(196, 13, 'رامهرمز', 1),
	(197, 13, 'باغ ملك', 1),
	(198, 13, 'هنديجان', 1),
	(199, 13, 'لالي', 1),
	(200, 13, 'رامشیر', 1),
	(201, 13, 'حمیدیه', 1),
	(202, 13, 'دغاغله', 1),
	(203, 13, 'ملاثانی', 1),
	(204, 13, 'شادگان', 1),
	(205, 13, 'ویسی', 1),
	(206, 14, 'زنجان', 1),
	(207, 14, 'ابهر', 1),
	(208, 14, 'خدابنده', 1),
	(209, 14, 'كارم', 1),
	(210, 14, 'ماهنشان', 1),
	(211, 14, 'خرمدره', 1),
	(212, 14, 'ايجرود', 1),
	(213, 14, 'زرين آباد', 1),
	(214, 14, 'آب بر', 1),
	(215, 14, 'قيدار', 1),
	(216, 15, 'سمنان', 1),
	(217, 15, 'شاهرود', 1),
	(218, 15, 'گرمسار', 1),
	(219, 15, 'ايوانكي', 1),
	(220, 15, 'دامغان', 1),
	(221, 15, 'بسطام', 1),
	(222, 16, 'زاهدان', 1),
	(223, 16, 'چابهار', 1),
	(224, 16, 'خاش', 1),
	(225, 16, 'سراوان', 1),
	(226, 16, 'زابل', 1),
	(227, 16, 'سرباز', 1),
	(228, 16, 'نيكشهر', 1),
	(229, 16, 'ايرانشهر', 1),
	(230, 16, 'راسك', 1),
	(231, 16, 'ميرجاوه', 1),
	(232, 17, 'شيراز', 1),
	(233, 17, 'اقليد', 1),
	(234, 17, 'داراب', 1),
	(235, 17, 'فسا', 1),
	(236, 17, 'مرودشت', 1),
	(237, 17, 'خرم بيد', 1),
	(238, 17, 'آباده', 1),
	(239, 17, 'كازرون', 1),
	(240, 17, 'ممسني', 1),
	(241, 17, 'سپيدان', 1),
	(242, 17, 'لار', 1),
	(243, 17, 'فيروز آباد', 1),
	(244, 17, 'جهرم', 1),
	(245, 17, 'ني ريز', 1),
	(246, 17, 'استهبان', 1),
	(247, 17, 'لامرد', 1),
	(248, 17, 'مهر', 1),
	(249, 17, 'حاجي آباد', 1),
	(250, 17, 'نورآباد', 1),
	(251, 17, 'اردكان', 1),
	(252, 17, 'صفاشهر', 1),
	(253, 17, 'ارسنجان', 1),
	(254, 17, 'قيروكارزين', 1),
	(255, 17, 'سوريان', 1),
	(256, 17, 'فراشبند', 1),
	(257, 17, 'سروستان', 1),
	(258, 17, 'ارژن', 1),
	(259, 17, 'گويم', 1),
	(260, 17, 'داريون', 1),
	(261, 17, 'زرقان', 1),
	(262, 17, 'خان زنیان', 1),
	(263, 17, 'کوار', 1),
	(264, 17, 'ده بید', 1),
	(265, 17, 'باب انار/خفر', 1),
	(266, 17, 'بوانات', 1),
	(267, 17, 'خرامه', 1),
	(268, 17, 'خنج', 1),
	(269, 17, 'سیاخ دارنگون', 1),
	(270, 18, 'قزوين', 1),
	(271, 18, 'تاكستان', 1),
	(272, 18, 'آبيك', 1),
	(273, 18, 'بوئين زهرا', 1),
	(274, 19, 'قم', 1),
	(275, 5, 'طالقان', 1),
	(276, 5, 'نظرآباد', 1),
	(277, 5, 'اشتهارد', 1),
	(278, 5, 'هشتگرد', 1),
	(279, 5, 'كن', 1),
	(280, 5, 'آسارا', 1),
	(281, 5, 'شهرک گلستان', 1),
	(282, 5, 'اندیشه', 1),
	(283, 5, 'كرج', 1),
	(284, 5, 'نظر آباد', 1),
	(285, 5, 'گوهردشت', 1),
	(286, 5, 'ماهدشت', 1),
	(287, 5, 'مشکین دشت', 1),
	(288, 20, 'سنندج', 1),
	(289, 20, 'ديواندره', 1),
	(290, 20, 'بانه', 1),
	(291, 20, 'بيجار', 1),
	(292, 20, 'سقز', 1),
	(293, 20, 'كامياران', 1),
	(294, 20, 'قروه', 1),
	(295, 20, 'مريوان', 1),
	(296, 20, 'صلوات آباد', 1),
	(297, 20, 'حسن آباد', 1),
	(298, 21, 'كرمان', 1),
	(299, 21, 'راور', 1),
	(300, 21, 'بابك', 1),
	(301, 21, 'انار', 1),
	(302, 21, 'کوهبنان', 1),
	(303, 21, 'رفسنجان', 1),
	(304, 21, 'بافت', 1),
	(305, 21, 'سيرجان', 1),
	(306, 21, 'كهنوج', 1),
	(307, 21, 'زرند', 1),
	(308, 21, 'بم', 1),
	(309, 21, 'جيرفت', 1),
	(310, 21, 'بردسير', 1),
	(311, 22, 'كرمانشاه', 1),
	(312, 22, 'اسلام آباد غرب', 1),
	(313, 22, 'سر پل ذهاب', 1),
	(314, 22, 'كنگاور', 1),
	(315, 22, 'سنقر', 1),
	(316, 22, 'قصر شيرين', 1),
	(317, 22, 'گيلان غرب', 1),
	(318, 22, 'هرسين', 1),
	(319, 22, 'صحنه', 1),
	(320, 22, 'پاوه', 1),
	(321, 22, 'جوانرود', 1),
	(322, 22, 'شاهو', 1),
	(323, 23, 'ياسوج', 1),
	(324, 23, 'گچساران', 1),
	(325, 23, 'دنا', 1),
	(326, 23, 'دوگنبدان', 1),
	(327, 23, 'سي سخت', 1),
	(328, 23, 'دهدشت', 1),
	(329, 23, 'ليكك', 1),
	(330, 24, 'گرگان', 1),
	(331, 24, 'آق قلا', 1),
	(332, 24, 'گنبد كاووس', 1),
	(333, 24, 'علي آباد كتول', 1),
	(334, 24, 'مينو دشت', 1),
	(335, 24, 'تركمن', 1),
	(336, 24, 'كردكوي', 1),
	(337, 24, 'بندر گز', 1),
	(338, 24, 'كلاله', 1),
	(339, 24, 'آزاد شهر', 1),
	(340, 24, 'راميان', 1),
	(341, 25, 'رشت', 1),
	(342, 25, 'منجيل', 1),
	(343, 25, 'لنگرود', 1),
	(344, 25, 'رود سر', 1),
	(345, 25, 'تالش', 1),
	(346, 25, 'آستارا', 1),
	(347, 25, 'ماسوله', 1),
	(348, 25, 'آستانه اشرفيه', 1),
	(349, 25, 'رودبار', 1),
	(350, 25, 'فومن', 1),
	(351, 25, 'صومعه سرا', 1),
	(352, 25, 'بندرانزلي', 1),
	(353, 25, 'كلاچاي', 1),
	(354, 25, 'هشتپر', 1),
	(355, 25, 'رضوان شهر', 1),
	(356, 25, 'ماسال', 1),
	(357, 25, 'شفت', 1),
	(358, 25, 'سياهكل', 1),
	(359, 25, 'املش', 1),
	(360, 25, 'لاهیجان', 1),
	(361, 25, 'خشک بيجار', 1),
	(362, 25, 'خمام', 1),
	(363, 25, 'لشت نشا', 1),
	(364, 25, 'بندر کياشهر', 1),
	(365, 26, 'خرم آباد', 1),
	(366, 26, 'ماهشهر', 1),
	(367, 26, 'دزفول', 1),
	(368, 26, 'بروجرد', 1),
	(369, 26, 'دورود', 1),
	(370, 26, 'اليگودرز', 1),
	(371, 26, 'ازنا', 1),
	(372, 26, 'نور آباد', 1),
	(373, 26, 'كوهدشت', 1),
	(374, 26, 'الشتر', 1),
	(375, 26, 'پلدختر', 1),
	(376, 27, 'ساري', 1),
	(377, 27, 'آمل', 1),
	(378, 27, 'بابل', 1),
	(379, 27, 'بابلسر', 1),
	(380, 27, 'بهشهر', 1),
	(381, 27, 'تنكابن', 1),
	(382, 27, 'جويبار', 1),
	(383, 27, 'چالوس', 1),
	(384, 27, 'رامسر', 1),
	(385, 27, 'سواد كوه', 1),
	(386, 27, 'قائم شهر', 1),
	(387, 27, 'نكا', 1),
	(388, 27, 'نور', 1),
	(389, 27, 'بلده', 1),
	(390, 27, 'نوشهر', 1),
	(391, 27, 'پل سفيد', 1),
	(392, 27, 'محمود آباد', 1),
	(393, 27, 'فريدون كنار', 1),
	(394, 28, 'اراك', 1),
	(395, 28, 'آشتيان', 1),
	(396, 28, 'تفرش', 1),
	(397, 28, 'خمين', 1),
	(398, 28, 'دليجان', 1),
	(399, 28, 'ساوه', 1),
	(400, 28, 'سربند', 1),
	(401, 28, 'محلات', 1),
	(402, 28, 'شازند', 1),
	(403, 29, 'بندرعباس', 1),
	(404, 29, 'قشم', 1),
	(405, 29, 'كيش', 1),
	(406, 29, 'بندر لنگه', 1),
	(407, 29, 'بستك', 1),
	(408, 29, 'حاجي آباد', 1),
	(409, 29, 'دهبارز', 1),
	(410, 29, 'انگهران', 1),
	(411, 29, 'ميناب', 1),
	(412, 29, 'ابوموسي', 1),
	(413, 29, 'بندر جاسك', 1),
	(414, 29, 'تنب بزرگ', 1),
	(415, 29, 'بندر خمیر', 1),
	(416, 29, 'پارسیان', 1),
	(417, 29, 'قشم', 1),
	(418, 30, 'همدان', 1),
	(419, 30, 'ملاير', 1),
	(420, 30, 'تويسركان', 1),
	(421, 30, 'نهاوند', 1),
	(422, 30, 'كبودر اهنگ', 1),
	(423, 30, 'رزن', 1),
	(424, 30, 'اسدآباد', 1),
	(425, 30, 'بهار', 1),
	(426, 31, 'يزد', 1),
	(427, 31, 'تفت', 1),
	(428, 31, 'اردكان', 1),
	(429, 31, 'ابركوه', 1),
	(430, 31, 'ميبد', 1),
	(431, 31, 'طبس', 1),
	(432, 31, 'بافق', 1),
	(433, 31, 'مهريز', 1),
	(434, 31, 'اشكذر', 1),
	(435, 31, 'هرات', 1),
	(436, 31, 'خضرآباد', 1),
	(437, 31, 'شاهديه', 1),
	(438, 31, 'حمیدیه شهر', 1),
	(439, 31, 'سید میرزا', 1),
	(440, 31, 'زارچ', 1);

-- Dumping structure for table reservation.tbl_color
CREATE TABLE IF NOT EXISTS `tbl_color` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `color_name` varchar(100) NOT NULL,
  `color_code` varchar(50) NOT NULL,
  `color_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_color: 140 rows
DELETE FROM `tbl_color`;
/*!40000 ALTER TABLE `tbl_color` DISABLE KEYS */;
INSERT INTO `tbl_color` (`color_id`, `color_name`, `color_code`, `color_status`) VALUES
	(1, 'مشکی', '#000000', 1),
	(2, 'سفید', '#ffffff', 1),
	(3, 'قرمز', '#f44336', 1),
	(4, 'آبی', '#2196f3', 1),
	(5, 'زرد', '#ffeb3b', 1),
	(6, 'سبز', '#00e676', 1),
	(7, 'صورتی', '#ff80ab', 1),
	(8, 'بنفش', '#9c27b1', 1),
	(9, 'سرمه ای', '#002171', 1),
	(10, 'خاکستری', '#9e9e9e', 1),
	(11, 'نقره‌ای', '#dedede', 1),
	(12, 'نوک مدادی', '#424242', 1),
	(13, 'قهوه ای', '#562e1f', 1),
	(14, 'طلایی', '#c99212', 1),
	(15, 'زرشکی', '#6a1313', 1),
	(16, 'نارنجی', '#ff5722', 1),
	(17, 'فیروزه ای', '#4ddcd7', 1),
	(18, 'سبز فسفری', '#5ac104', 1),
	(19, 'یشمی', '#9e9d24', 1),
	(20, 'زیتونی', '#84831c', 1),
	(21, 'پوست پیازی', '#c48a89', 1),
	(22, 'زرد خردلی', '#d0a40a', 1),
	(23, 'یاسی', '#fce4ec', 1),
	(24, 'گل بهی', '#ff8a81', 1),
	(25, 'سبز آبی', '#00fff0', 1),
	(26, 'کرم', '#ffecca', 1),
	(27, 'نسکافه ای', '#a98274', 1),
	(28, 'سفید صدفی', '#f3f3f3', 1),
	(29, 'بژ', '#e6dab3', 1),
	(30, 'مسی', '#e65319', 1),
	(31, 'چند رنگ', '#c71585', 1),
	(32, 'نقره‌ای آبی', '#c2d3da', 1),
	(33, 'بی رنگ', '#fffffe', 1),
	(34, 'بی رنگ مات', '#e5e5e5', 1),
	(35, 'بی رنگ شفاف', '#f5fafd', 1),
	(36, 'ماهگونی', '#3f1e1f', 1),
	(37, 'طوسی', '#e0e0e0', 1),
	(38, 'بنفش تیره', '#24002b', 1),
	(39, 'شکلاتی', '#3d2217', 1),
	(40, 'آبی تیره', '#4c5e74', 1),
	(41, 'آبی روشن', '#40aaff', 1),
	(42, 'سبز روشن', '#4dff97', 1),
	(43, 'سبز تیره', '#007e33', 1),
	(44, 'سرخابی', '#f50057', 1),
	(45, 'صورتی تیره', '#a41147', 1),
	(46, 'قهوه ای تیره', '#392622', 1),
	(47, 'قهوه ای روشن', '#7b584c', 1),
	(48, 'رز گلد', '#ff9e80', 1),
	(49, 'مات', '#b0b0b0', 1),
	(50, 'براق', '#f1f1f1', 1),
	(51, 'زرد کم‌رنگ', '#f6f0bb', 1),
	(52, 'نارنجی کم‌رنگ', '#ffaf47', 1),
	(53, 'مشکی مات', '#443c3c', 1),
	(54, 'مشکی براق', '#000000', 1),
	(55, 'آفتابی', '#fdf9d6', 1),
	(56, 'مهتابی', '#f4fcff', 1),
	(57, 'سفید یخی', '#e1f5fe', 1),
	(58, 'سفید چرمی', '#fdf3d9', 1),
	(59, 'استیل', '#ebebeb', 1),
	(60, 'نقره‌ای چرمی', '#766f6f', 1),
	(61, 'لیمویی طلایی', '#f3ff70', 1),
	(62, 'برنز', '#c77b30', 1),
	(63, 'کالباسی', '#ffb1b9', 1),
	(64, 'صورتی خاکستری', '#b498a1', 1),
	(65, 'بنفش روشن', '#d05ce3', 1),
	(66, 'زغالی', '#2f2f2f', 1),
	(67, 'تیتانیومی', '#b2abb2', 1),
	(68, 'طلایی مات', '#8a6b1f', 1),
	(69, 'گیلاسی', '#b71c1c', 1),
	(70, 'کروم', '#dadada', 1),
	(71, 'آبی متالیک', '#6683cc', 1),
	(72, 'صورتی روشن', '#ff92b7', 1),
	(73, 'قرمز مات', '#790b16', 1),
	(74, 'نقره‌ای مات', '#bdbdbd', 1),
	(75, 'سبز کله غازی', '#01554b', 1),
	(76, 'زرد نباتی', '#fdeb4b', 1),
	(77, 'سبز سدری', '#606300', 1),
	(78, 'سرمه ای روشن', '#0048a5', 1),
	(79, 'سرمه ای تیره', '#010136', 1),
	(80, 'زرد لیمویی', '#d2ff00', 1),
	(81, 'قرمز آجری', '#de3f1a', 1),
	(82, 'شیری', '#ffe5bf', 1),
	(83, 'عسلی', '#ffc001', 1),
	(84, 'آبی نفتی', '#10265b', 1),
	(85, 'کرم تیره', '#c2a986', 1),
	(86, 'سبز یشمی', '#558000', 1),
	(87, 'آبی یخی', '#d5f2ff', 1),
	(88, 'هفت رنگ', '#479494', 1),
	(89, 'کردوبایی', '#893f45', 1),
	(90, 'برنجی', '#9f8256', 1),
	(91, 'ارغوانی', '#9966cc', 1),
	(92, 'طوسی روشن', '#c3c3c3', 1),
	(93, 'عنابی', '#51241f', 1),
	(94, 'قهوه‌ای شتری', '#b56e4a', 1),
	(95, 'قرمز روشن', '#ff6464', 1),
	(96, 'مرجانی', '#f95e48', 1),
	(97, 'آبی کدر', '#768e9e', 1),
	(98, 'زرد فسفری', '#b1d61d', 1),
	(99, 'خاکی', '#cec1b1', 1),
	(100, 'کروم مات', '#a39e9a', 1),
	(101, 'پلاتینیوم', '#e5e4e2', 1),
	(102, 'دودی', '#696969', 1),
	(103, 'طوسی فیلی', '#838287', 1),
	(104, 'مارون', '#800000', 1),
	(105, 'سبز کاهویی', '#d5df80', 1),
	(106, 'بژ براق', '#f5f5dc', 1),
	(107, 'قرمز شرابی', '#722f37', 1),
	(108, 'سبز مغز پسته ای', '#93c572', 1),
	(109, 'یاقوتی', '#e0115f', 1),
	(110, 'آلومینیومی', '#848789', 1),
	(111, 'گردویی', '#cd5c5c', 1),
	(112, 'ارغوانی روشن', '#bfbed4', 1),
	(113, 'آبی رویال', '#111e6c', 1),
	(114, 'طلایی براق', '#d4af37', 1),
	(115, 'استخوانی', '#fffff0', 1),
	(116, 'بادمجانی', '#341941', 1),
	(117, 'کهربایی', '#ffbf00', 1),
	(118, 'لاجوردی', '#00e1ff', 1),
	(119, 'جگری', '#821a1a', 1),
	(120, 'آبی کاربنی', '#191970', 1),
	(121, 'طوسی تیره', '#808080', 1),
	(122, 'اخرایی', '#cc7722', 1),
	(123, 'آبی نیلی', '#4682b4', 1),
	(124, 'هلویی', '#f4a460', 1),
	(125, 'آلبالویی', '#2f0909', 1),
	(126, 'وانیلی', '#efebdc', 1),
	(127, 'سبز دریایی', '#6accab', 1),
	(128, 'گوجه ای', '#ff6347', 1),
	(129, 'نارنجی فسفری', '#d93101', 1),
	(130, 'كروم', '#e7e5e6', 1),
	(131, 'آبی آسمانی', '#e0ffff', 1),
	(132, 'گندمی', '#f5deb3', 1),
	(133, 'کرم روشن', '#ffdead', 1),
	(134, 'بلوند روشن', '#ece6cc', 1),
	(135, 'نخودی', '#eee8aa', 1),
	(136, 'قهوه‌ای روشن مات', '#5f3e24', 1),
	(137, 'قهوه‌ای روشن براق', '#b37e2b', 1),
	(138, 'دودی متالیک', '#a8a9ad', 1),
	(139, 'قرمز تیره', '#8b0000', 1),
	(140, 'سبز لجنی', '#494c2d', 1);
/*!40000 ALTER TABLE `tbl_color` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_comments
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `cm_id` int NOT NULL AUTO_INCREMENT,
  `cm_answer_id` int NOT NULL,
  `p_id` int NOT NULL,
  `selected` tinyint NOT NULL DEFAULT '0',
  `cm_type` varchar(10) NOT NULL,
  `cm_user_id` int NOT NULL,
  `cm_reply_admin_id` int DEFAULT NULL,
  `cm_text` varchar(4000) NOT NULL,
  `cm_score` mediumtext,
  `cm_strengths` varchar(4000) DEFAULT NULL,
  `cm_weaknesses` varchar(4000) DEFAULT NULL,
  `cm_rating` mediumtext,
  `cm_date` varchar(500) NOT NULL,
  `cm_time` varchar(10) DEFAULT '',
  `cm_status` tinyint(1) NOT NULL DEFAULT '0',
  `reply` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`cm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- Dumping data for table reservation.tbl_comments: ~0 rows (approximately)
DELETE FROM `tbl_comments`;

-- Dumping structure for table reservation.tbl_comment_like
CREATE TABLE IF NOT EXISTS `tbl_comment_like` (
  `cl_id` int NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cl_type` varchar(10) NOT NULL DEFAULT 'like',
  PRIMARY KEY (`cl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_comment_like: 0 rows
DELETE FROM `tbl_comment_like`;
/*!40000 ALTER TABLE `tbl_comment_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_comment_like` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_contact
CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `co_id` int NOT NULL AUTO_INCREMENT,
  `co_title` varchar(500) NOT NULL,
  `co_user_name` varchar(50) NOT NULL,
  `co_user_email` varchar(500) DEFAULT NULL,
  `co_user_phone` varchar(20) DEFAULT NULL,
  `co_text` varchar(4000) NOT NULL,
  `co_date` varchar(500) NOT NULL,
  `co_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_contact: ~0 rows (approximately)
DELETE FROM `tbl_contact`;

-- Dumping structure for table reservation.tbl_contact_subject
CREATE TABLE IF NOT EXISTS `tbl_contact_subject` (
  `cs_id` int NOT NULL AUTO_INCREMENT,
  `cs_title` varchar(255) NOT NULL,
  `cs_removable` tinyint NOT NULL DEFAULT '1',
  `cs_create_date` varchar(50) NOT NULL,
  `cs_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`cs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_contact_subject: 3 rows
DELETE FROM `tbl_contact_subject`;
/*!40000 ALTER TABLE `tbl_contact_subject` DISABLE KEYS */;
INSERT INTO `tbl_contact_subject` (`cs_id`, `cs_title`, `cs_removable`, `cs_create_date`, `cs_status`) VALUES
	(1, 'پیشنهادات', 0, '1400/10/16', 1),
	(2, 'باگ', 0, '1400/10/16', 1),
	(3, 'انتقادات', 0, '1400/10/16', 1);
/*!40000 ALTER TABLE `tbl_contact_subject` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_cost
CREATE TABLE IF NOT EXISTS `tbl_cost` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `cost_vids_id` varchar(100) NOT NULL,
  `part_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=repair;2=shop;3=other',
  `cost_type` int NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'cash',
  `pay_to` varchar(255) DEFAULT '-',
  `description` text NOT NULL,
  `price` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `date` varchar(25) NOT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_cost: 0 rows
DELETE FROM `tbl_cost`;
/*!40000 ALTER TABLE `tbl_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cost` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_cost_type
CREATE TABLE IF NOT EXISTS `tbl_cost_type` (
  `ct_id` int NOT NULL AUTO_INCREMENT,
  `cost_category_vids_id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`ct_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_cost_type: 1 rows
DELETE FROM `tbl_cost_type`;
/*!40000 ALTER TABLE `tbl_cost_type` DISABLE KEYS */;
INSERT INTO `tbl_cost_type` (`ct_id`, `cost_category_vids_id`, `title`) VALUES
	(1, '1000', 'پیش فرض');
/*!40000 ALTER TABLE `tbl_cost_type` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_currency
CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(500) NOT NULL,
  `c_short_name` varchar(10) NOT NULL,
  `c_default` tinyint NOT NULL DEFAULT '0',
  `c_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_currency: 6 rows
DELETE FROM `tbl_currency`;
/*!40000 ALTER TABLE `tbl_currency` DISABLE KEYS */;
INSERT INTO `tbl_currency` (`c_id`, `c_name`, `c_short_name`, `c_default`, `c_status`) VALUES
	(1, 'ریال ایران', 'IRR', 1, 1),
	(2, 'درهم امارات متحدهٔ عربی', 'AED', 0, 1),
	(3, 'دلار کانادا', 'CAD', 0, 1),
	(4, 'یورو', 'EUR', 0, 1),
	(5, 'دلار امریکا', 'USD', 0, 1),
	(6, 'ریال عمان', 'OMR', 0, 1);
/*!40000 ALTER TABLE `tbl_currency` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `customer_vids_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `c_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_family` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_display_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_mobile_num` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `c_phone_num` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_cart_no` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT '-',
  `c_birthday` json DEFAULT NULL,
  `province_id` int NOT NULL DEFAULT '0',
  `city_id` int NOT NULL DEFAULT '0',
  `c_arithmetic` tinyint NOT NULL DEFAULT '1' COMMENT '1=good;2=bad',
  `c_image` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `c_about` varchar(4000) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `c_registery_date` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `c_verification_code` int DEFAULT NULL,
  `c_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- Dumping data for table reservation.tbl_customer: ~0 rows (approximately)
DELETE FROM `tbl_customer`;

-- Dumping structure for table reservation.tbl_customer_bot
CREATE TABLE IF NOT EXISTS `tbl_customer_bot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(1000) DEFAULT NULL,
  `first_name` varchar(1000) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `last_name` varchar(1000) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `last_query` varchar(1000) DEFAULT NULL,
  `last_request` varchar(1000) DEFAULT NULL,
  `last_id` int DEFAULT NULL,
  `team_leader_id` int NOT NULL DEFAULT '0',
  `subgroups` int NOT NULL DEFAULT '0',
  `score` int NOT NULL DEFAULT '0',
  `name` varchar(1000) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `reg_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_customer_bot: 0 rows
DELETE FROM `tbl_customer_bot`;
/*!40000 ALTER TABLE `tbl_customer_bot` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_customer_bot` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_customer_document
CREATE TABLE IF NOT EXISTS `tbl_customer_document` (
  `cd_id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cd_title` varchar(100) NOT NULL,
  `cd_document` varchar(500) NOT NULL,
  `cd_create_date` varchar(20) NOT NULL,
  `cd_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`cd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_customer_document: 0 rows
DELETE FROM `tbl_customer_document`;
/*!40000 ALTER TABLE `tbl_customer_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_customer_document` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_customer_level
CREATE TABLE IF NOT EXISTS `tbl_customer_level` (
  `cl_id` int NOT NULL AUTO_INCREMENT,
  `cl_title` varchar(200) NOT NULL,
  `cl_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`cl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_customer_level: 5 rows
DELETE FROM `tbl_customer_level`;
/*!40000 ALTER TABLE `tbl_customer_level` DISABLE KEYS */;
INSERT INTO `tbl_customer_level` (`cl_id`, `cl_title`, `cl_status`) VALUES
	(1, 'مدیر اصلی', 1),
	(2, 'کارمند', 1),
	(3, 'کاربر عادی', 1),
	(4, 'همکار', 0),
	(5, 'درخواست همکاری', 0);
/*!40000 ALTER TABLE `tbl_customer_level` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_customer_reservations
CREATE TABLE IF NOT EXISTS `tbl_customer_reservations` (
  `cr_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `cr_date` varchar(10) NOT NULL,
  `cr_time` varchar(10) NOT NULL,
  `customer_id` int NOT NULL,
  PRIMARY KEY (`cr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_customer_reservations: 0 rows
DELETE FROM `tbl_customer_reservations`;
/*!40000 ALTER TABLE `tbl_customer_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_customer_reservations` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_discounts
CREATE TABLE IF NOT EXISTS `tbl_discounts` (
  `dc_id` int NOT NULL AUTO_INCREMENT,
  `dc_title` varchar(500) NOT NULL,
  `dc_type` varchar(10) NOT NULL DEFAULT 'service',
  `dc_code` varchar(100) NOT NULL,
  `dc_number_of_use` int NOT NULL,
  `dc_create_date` varchar(20) NOT NULL,
  `dc_expire_date` varchar(20) NOT NULL,
  `dc_percent` varchar(5) NOT NULL,
  `dc_min_price_apply` varchar(20) NOT NULL,
  `dc_first_order` tinyint NOT NULL DEFAULT '0',
  `dc_discounted_products` tinyint NOT NULL DEFAULT '0',
  `dc_allowed_for_each_user` int NOT NULL DEFAULT '1',
  `dc_price` varchar(20) NOT NULL,
  `dc_for_all_service` tinyint DEFAULT '1',
  `dc_for_all_staff` tinyint DEFAULT '1',
  `dc_for_all_course` tinyint DEFAULT '1',
  `dc_description` varchar(1000) NOT NULL,
  `dc_status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active;2=used;0=deactive',
  PRIMARY KEY (`dc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_discounts: 0 rows
DELETE FROM `tbl_discounts`;
/*!40000 ALTER TABLE `tbl_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_discounts` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_discounts_service
CREATE TABLE IF NOT EXISTS `tbl_discounts_service` (
  `dcc_id` int NOT NULL AUTO_INCREMENT,
  `dc_id` int NOT NULL,
  `service_id` int NOT NULL,
  `dcc_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`dcc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_discounts_service: 0 rows
DELETE FROM `tbl_discounts_service`;
/*!40000 ALTER TABLE `tbl_discounts_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_discounts_service` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_discounts_staff
CREATE TABLE IF NOT EXISTS `tbl_discounts_staff` (
  `ds_id` int NOT NULL AUTO_INCREMENT,
  `dc_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `ds_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`ds_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_discounts_staff: 0 rows
DELETE FROM `tbl_discounts_staff`;
/*!40000 ALTER TABLE `tbl_discounts_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_discounts_staff` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_discounts_user_used
CREATE TABLE IF NOT EXISTS `tbl_discounts_user_used` (
  `du_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `dc_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `du_used_date` varchar(20) NOT NULL,
  `du_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`du_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_discounts_user_used: 0 rows
DELETE FROM `tbl_discounts_user_used`;
/*!40000 ALTER TABLE `tbl_discounts_user_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_discounts_user_used` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_domains
CREATE TABLE IF NOT EXISTS `tbl_domains` (
  `domain_id` int NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(250) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT 'کلید',
  `domain_title` varchar(250) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT 'عنوان',
  `domain_code` varchar(250) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT '' COMMENT 'مقدار',
  `domain_prority` int NOT NULL COMMENT 'ترتیب',
  `domain_date_created` varchar(10) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT 'تاریخ ثبت',
  `user_id_created` int NOT NULL COMMENT 'کاربر ثبت کننده',
  `domain_date_of_last_revision` varchar(10) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT 'تاریخ آخرین ویرایش',
  `user_id_last_revision` int NOT NULL COMMENT 'کاربر آخرین ویرایش',
  `domain_removed` tinyint DEFAULT '0',
  `domain_status` tinyint NOT NULL DEFAULT '1' COMMENT 'وضعیت',
  PRIMARY KEY (`domain_id`) USING BTREE,
  KEY `udt_id` (`domain_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf32 ROW_FORMAT=DYNAMIC;

-- Dumping data for table reservation.tbl_domains: ~31 rows (approximately)
DELETE FROM `tbl_domains`;
INSERT INTO `tbl_domains` (`domain_id`, `domain_name`, `domain_title`, `domain_code`, `domain_prority`, `domain_date_created`, `user_id_created`, `domain_date_of_last_revision`, `user_id_last_revision`, `domain_removed`, `domain_status`) VALUES
	(1, 'yes_no', 'بله', '1', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(2, 'yes_no', 'خیر', '0', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(3, 'status', 'فعال', '1', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(4, 'status', 'غیرفعال', '0', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(5, 'notification_text_position', 'راست چین', 'right', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(6, 'notification_text_position', 'چپ چین', 'left', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(7, 'notification_text_position', 'وسط چین', 'center', 3, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(10, 'float_contact_position', 'راست', 'right', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(11, 'float_contact_position', 'چپ', 'left', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(12, 'float_contact_size', 'کوچک', 'small', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(13, 'float_contact_size', 'متوسط', 'medium', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(14, 'float_contact_size', 'بزرگ', 'large', 3, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(15, 'float_contact_menu_size', 'پیش فرض', 'normal', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(16, 'float_contact_menu_size', 'کوچک', 'small', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(17, 'float_contact_menu_size', 'بزرگ', 'large', 3, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(18, 'float_contact_items_icon_type', 'آیکن گرد', 'rounded', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(19, 'float_contact_items_icon_type', 'بدون پس زمینه', 'non-rounded', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(20, 'float_contact_popup_animation', 'Scale', 'scale', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(21, 'float_contact_popup_animation', 'Scale out', 'scaleout', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(22, 'float_contact_popup_animation', 'Fade in down', 'fadeindown', 3, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(23, 'float_contact_popup_animation', 'Fade in up', 'fadeinup', 4, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(24, 'float_contact_menu_popup_style', 'پاپ اپ', 'popup', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(25, 'float_contact_menu_popup_style', 'منوی کشویی', 'sidebar', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(26, 'float_contact_sidebar_animation', 'Elastic', 'elastic', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(27, 'float_contact_sidebar_animation', 'Bubble', 'bubble', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(28, 'float_contact_menu_items_animation', 'Down to up', 'downtoup', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(29, 'float_contact_menu_items_animation', 'Up to down', 'uptodown', 2, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(30, 'float_contact_menu_items_animation', 'From aside', 'fromaside', 3, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(31, 'float_contact_mode_select_options', 'Menu', 'regular', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(32, 'float_contact_mode_select_options', 'Callback only', 'callback', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1),
	(33, 'float_contact_mode_select_options', 'Single menu item', 'single', 1, '1401/11/01', 1, '1401/11/01', 1, 0, 1);

-- Dumping structure for table reservation.tbl_faq
CREATE TABLE IF NOT EXISTS `tbl_faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL DEFAULT 'public',
  `question` varchar(1000) NOT NULL,
  `answer` varchar(4000) NOT NULL,
  `view` int DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_faq: ~0 rows (approximately)
DELETE FROM `tbl_faq`;

-- Dumping structure for table reservation.tbl_faq_related
CREATE TABLE IF NOT EXISTS `tbl_faq_related` (
  `fr_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL DEFAULT '',
  `faq_id` int NOT NULL,
  `item_id` int NOT NULL,
  `fr_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`fr_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf32 ROW_FORMAT=FIXED;

-- Dumping data for table reservation.tbl_faq_related: 0 rows
DELETE FROM `tbl_faq_related`;
/*!40000 ALTER TABLE `tbl_faq_related` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_faq_related` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_giftcart
CREATE TABLE IF NOT EXISTS `tbl_giftcart` (
  `g_id` int NOT NULL AUTO_INCREMENT,
  `g_code` varchar(100) NOT NULL,
  `g_title` varchar(255) NOT NULL,
  `g_amount` varchar(50) NOT NULL DEFAULT '0',
  `g_create_date` varchar(20) NOT NULL,
  `g_expire_date` varchar(20) DEFAULT NULL,
  `g_used_date` varchar(20) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `g_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_giftcart: 0 rows
DELETE FROM `tbl_giftcart`;
/*!40000 ALTER TABLE `tbl_giftcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_giftcart` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_holidays
CREATE TABLE IF NOT EXISTS `tbl_holidays` (
  `h_id` int NOT NULL AUTO_INCREMENT,
  `h_title` varchar(1000) NOT NULL,
  `h_date` varchar(10) NOT NULL,
  `h_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_holidays: 9 rows
DELETE FROM `tbl_holidays`;
/*!40000 ALTER TABLE `tbl_holidays` DISABLE KEYS */;
INSERT INTO `tbl_holidays` (`h_id`, `h_title`, `h_date`, `h_status`) VALUES
	(1, 'روز طبیعت', '01/13', 1),
	(2, 'تعطیلات رسمی', '01/01', 1),
	(3, 'تعطیلات رسمی	', '01/02', 1),
	(4, 'تعطیلات رسمی', '01/03', 1),
	(5, 'تعطیلات رسمی', '01/04', 1),
	(6, 'قیام 15 خرداد', '03/15', 1),
	(7, 'روز جمهوری اسلامی', '01/12', 1),
	(8, 'روز ملی صنعت نفت', '12/29', 1),
	(9, 'پیروزی انقلاب اسلامی', '11/22', 1);
/*!40000 ALTER TABLE `tbl_holidays` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_icons
CREATE TABLE IF NOT EXISTS `tbl_icons` (
  `i_id` int NOT NULL AUTO_INCREMENT,
  `i_title` varchar(1000) NOT NULL,
  `i_description` varchar(500) DEFAULT NULL,
  `i_icon` varchar(255) NOT NULL,
  `i_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_icons: 4 rows
DELETE FROM `tbl_icons`;
/*!40000 ALTER TABLE `tbl_icons` DISABLE KEYS */;
INSERT INTO `tbl_icons` (`i_id`, `i_title`, `i_description`, `i_icon`, `i_status`) VALUES
	(1, 'زیبایی مورد نظرت رو تصور کن', 'تجربه یک حس متفاوت', '1679576380_answer-1.png', 1),
	(2, 'آرایشگر مورد نظرت رو انتخاب کن', 'حس آرامش در کنار بهترین ها', '1679576388_eyeshadow-1-1.png', 1),
	(3, 'وقت رزرو کن', 'روز مورد نظرتو انتخاب کن', '1679576396_customer-service-1.png', 1),
	(4, 'در نهایت زیبایی رو به دست بیار', 'به همین راحتی!', '1679576404_bride-1.png', 1);
/*!40000 ALTER TABLE `tbl_icons` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_images
CREATE TABLE IF NOT EXISTS `tbl_images` (
  `i_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `i_type` varchar(20) DEFAULT NULL,
  `i_image` varchar(1000) NOT NULL,
  `i_alt` varchar(1000) DEFAULT NULL,
  `i_order` int NOT NULL DEFAULT '0',
  `i_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_images: ~0 rows (approximately)
DELETE FROM `tbl_images`;

-- Dumping structure for table reservation.tbl_like
CREATE TABLE IF NOT EXISTS `tbl_like` (
  `l_id` int NOT NULL AUTO_INCREMENT,
  `l_type` varchar(20) NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_like: 0 rows
DELETE FROM `tbl_like`;
/*!40000 ALTER TABLE `tbl_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_like` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_link
CREATE TABLE IF NOT EXISTS `tbl_link` (
  `l_id` int NOT NULL AUTO_INCREMENT,
  `l_name` varchar(250) NOT NULL,
  `l_link` varchar(1000) NOT NULL,
  `l_type` varchar(20) NOT NULL,
  `l_parent_id` int NOT NULL,
  `l_menu_type` tinyint DEFAULT NULL,
  `l_order` int NOT NULL,
  `l_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_link: 11 rows
DELETE FROM `tbl_link`;
/*!40000 ALTER TABLE `tbl_link` DISABLE KEYS */;
INSERT INTO `tbl_link` (`l_id`, `l_name`, `l_link`, `l_type`, `l_parent_id`, `l_menu_type`, `l_order`, `l_status`) VALUES
    (1, 'صفحه اصلی', 'root_path', 'header', 0, NULL, 1, 1),
    (2, 'خدمات', 'services', 'header', 0, NULL, 2, 1),
    (3, 'وبلاگ', 'blog', 'header', 0, NULL, 3, 1),
    (4, 'سوالات متداول', 'faq', 'header', 0, NULL, 4, 1),
	(5, 'درباره ما', 'about', 'header', 0, NULL, 5, 1),
	(6, 'قوانین و مقررات', 'terms', 'header', 0, NULL, 6, 1),
	(7, 'تماس با ما', 'contact', 'header', 0, NULL, 7, 1),
	(8, 'وبلاگ', 'blog', 'footer', 0, NULL, 1, 1),
	(9, 'درباره ما', 'about', 'footer', 0, NULL, 2, 1),
	(10, 'قوانین و مقررات', 'terms', 'footer', 0, NULL, 3, 1),
	(11, 'سوالات متداول', 'faq', 'footer', 0, NULL, 4, 1);
/*!40000 ALTER TABLE `tbl_link` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_message
CREATE TABLE IF NOT EXISTS `tbl_message` (
  `m_id` int NOT NULL,
  `text` varchar(4000) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_message: ~0 rows (approximately)
DELETE FROM `tbl_message`;

-- Dumping structure for table reservation.tbl_methods_contacting
CREATE TABLE IF NOT EXISTS `tbl_methods_contacting` (
  `mc_id` int NOT NULL AUTO_INCREMENT,
  `mc_key` varchar(250) NOT NULL,
  `mc_title` varchar(250) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT 'عنوان',
  `mc_link` varchar(250) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL COMMENT 'لینک',
  `mc_description` varchar(1000) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT '' COMMENT 'توضیحات',
  `mc_class` varchar(50) DEFAULT '',
  `mc_color` varchar(15) DEFAULT '',
  `mc_icon` longtext CHARACTER SET utf32 COLLATE utf32_general_ci,
  `mc_priority` int DEFAULT '1' COMMENT 'ترتیب',
  `mc_show_in_float_button` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در دکمه شناور',
  `mc_show_in_float_button_slider` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در اسلایدر دکمه شناور',
  `mc_show_in_footer` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در فوتر',
  `mc_show_in_login_page` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در صفحه لاگین',
  `mc_show_in_mobile` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در موبایل',
  `mc_show_in_desktop` tinyint NOT NULL DEFAULT '0' COMMENT 'نمایش در دسکتاپ',
  `mc_on_click` varchar(250) DEFAULT NULL,
  `mc_status` tinyint NOT NULL DEFAULT '1' COMMENT 'وضعیت',
  PRIMARY KEY (`mc_id`) USING BTREE,
  KEY `mc_id` (`mc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf32 ROW_FORMAT=DYNAMIC;

-- Dumping data for table reservation.tbl_methods_contacting: ~18 rows (approximately)
DELETE FROM `tbl_methods_contacting`;
INSERT INTO `tbl_methods_contacting` (`mc_id`, `mc_key`, `mc_title`, `mc_link`, `mc_description`, `mc_class`, `mc_color`, `mc_icon`, `mc_priority`, `mc_show_in_float_button`, `mc_show_in_float_button_slider`, `mc_show_in_footer`, `mc_show_in_login_page`, `mc_show_in_mobile`, `mc_show_in_desktop`, `mc_on_click`, `mc_status`) VALUES
	(1, 'phone', 'شماره تماس', '', '', 'msg-item-phone', '#4EB625', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>', 3, 1, 1, 1, 1, 1, 1, NULL, 0),
	(2, 'fax', 'فکس', '', '', 'msg-item-fax', '#19cac2', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>', 8, 1, 1, 0, 0, 0, 0, NULL, 0),
	(3, 'telegram', 'تلگرام', '', '', 'msg-item-telegram-plane', '#20AFDE', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path></svg>', 2, 1, 1, 1, 1, 1, 1, NULL, 0),
	(4, 'instagram', 'اینستاگرام', '', '', 'msg-item-Instagram', '#B83A92', '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"     width="512" height="512"     viewBox="0 0 26 26"    ><g id="surface1"><path fill="currentColor" style=" " d="M 7.546875 0 C 3.390625 0 0 3.390625 0 7.546875 L 0 18.453125 C 0 22.609375 3.390625 26 7.546875 26 L 18.453125 26 C 22.609375 26 26 22.609375 26 18.453125 L 26 7.546875 C 26 3.390625 22.609375 0 18.453125 0 Z M 7.546875 2 L 18.453125 2 C 21.527344 2 24 4.46875 24 7.546875 L 24 18.453125 C 24 21.527344 21.53125 24 18.453125 24 L 7.546875 24 C 4.472656 24 2 21.53125 2 18.453125 L 2 7.546875 C 2 4.472656 4.46875 2 7.546875 2 Z M 20.5 4 C 19.671875 4 19 4.671875 19 5.5 C 19 6.328125 19.671875 7 20.5 7 C 21.328125 7 22 6.328125 22 5.5 C 22 4.671875 21.328125 4 20.5 4 Z M 13 6 C 9.144531 6 6 9.144531 6 13 C 6 16.855469 9.144531 20 13 20 C 16.855469 20 20 16.855469 20 13 C 20 9.144531 16.855469 6 13 6 Z M 13 8 C 15.773438 8 18 10.226563 18 13 C 18 15.773438 15.773438 18 13 18 C 10.226563 18 8 15.773438 8 13 C 8 10.226563 10.226563 8 13 8 Z "></path></g></svg>', 1, 1, 1, 1, 1, 1, 1, NULL, 0),
	(5, 'aparat', 'آپارات', '', '', 'msg-item-Aparat', '#ED145B', '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none"> <path d="M1410 4961 c-232 -62 -429 -236 -514 -452 -14 -35 -50 -157 -80 -271 -31 -113 -59 -214 -63 -223 -12 -32 12 -11 95 82 324 363 808 629 1305 718 53 10 97 20 97 24 0 4 -21 12 -47 17 -27 6 -146 36 -266 67 -209 55 -223 57 -340 56 -83 0 -143 -6 -187 -18z"/> <path d="M2418 4659 c-432 -35 -834 -193 -1168 -459 -97 -77 -283 -266 -351 -355 -289 -379 -439 -816 -439 -1280 0 -464 150 -901 439 -1280 68 -89 254 -278 351 -355 763 -607 1841 -621 2620 -32 102 77 299 270 375 367 301 385 455 825 455 1300 0 464 -148 897 -438 1280 -107 141 -336 354 -497 462 -387 260 -887 390 -1347 352z m-299 -584 c207 -49 383 -222 436 -430 19 -76 19 -214 0 -290 -40 -151 -160 -304 -292 -373 -179 -94 -399 -93 -576 0 -86 46 -194 155 -240 244 -88 170 -90 368 -4 543 66 135 233 269 383 305 78 19 214 19 293 1z m1520 -290 c245 -58 432 -281 448 -536 30 -458 -452 -770 -867 -562 -288 144 -407 503 -261 791 79 157 234 274 416 315 47 11 205 6 264 -8z m-953 -1003 c156 -79 191 -283 70 -410 -53 -57 -101 -77 -186 -77 -64 0 -82 4 -128 29 -88 49 -132 124 -132 225 0 120 60 203 179 248 49 18 146 11 197 -15z m-872 -292 c370 -94 557 -501 387 -838 -66 -130 -194 -243 -332 -292 -88 -30 -248 -38 -343 -16 -364 86 -559 492 -397 831 80 170 237 285 446 329 54 11 168 4 239 -14z m1520 -290 c109 -28 190 -74 272 -155 183 -182 226 -448 111 -684 -44 -90 -158 -204 -253 -254 -342 -177 -765 9 -859 378 -19 76 -19 214 0 290 40 151 160 304 292 373 134 70 293 89 437 52z"/> <path d="M3970 4383 c1 -4 27 -28 60 -52 83 -62 276 -258 364 -371 231 -297 396 -674 449 -1032 18 -117 16 -120 103 202 62 225 67 255 72 369 5 142 -6 213 -49 318 -75 179 -232 337 -407 408 -34 14 -173 54 -309 90 -137 36 -256 68 -265 71 -10 3 -18 2 -18 -3z"/> <path d="M265 2188 c-2 -7 -30 -107 -61 -223 -51 -189 -57 -223 -61 -334 -6 -142 5 -213 48 -318 75 -179 232 -337 407 -408 35 -14 163 -52 285 -84 122 -33 230 -62 240 -66 34 -14 16 11 -35 50 -86 65 -277 262 -363 375 -138 181 -251 384 -330 595 -41 110 -105 350 -105 396 0 29 -17 40 -25 17z"/> <path d="M4403 1179 c-338 -416 -725 -677 -1208 -813 -113 -32 -227 -56 -266 -56 -52 0 -27 -21 46 -40 39 -10 159 -41 268 -69 183 -47 206 -51 315 -51 132 0 210 15 306 59 175 79 320 225 394 394 12 27 51 160 87 295 36 136 70 258 76 271 13 32 4 38 -18 10z"/> </g> </svg>', 10, 1, 1, 0, 0, 0, 0, NULL, 0),
	(6, 'youtube', 'یوتیوب', '', '', 'msg-item-youtube', '#ffffff', '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 461.001 461.001" xml:space="preserve"><g><path style="fill:#F61C0D;" d="M365.257,67.393H95.744C42.866,67.393,0,110.259,0,163.137v134.728   c0,52.878,42.866,95.744,95.744,95.744h269.513c52.878,0,95.744-42.866,95.744-95.744V163.137   C461.001,110.259,418.135,67.393,365.257,67.393z M300.506,237.056l-126.06,60.123c-3.359,1.602-7.239-0.847-7.239-4.568V168.607   c0-3.774,3.982-6.22,7.348-4.514l126.06,63.881C304.363,229.873,304.298,235.248,300.506,237.056z"/></g></svg>', 7, 1, 1, 0, 0, 0, 0, NULL, 0),
	(7, 'twitter', 'توئیتر', '', '', 'msg-item-twitter', '#1da1f2', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>', 11, 1, 1, 0, 0, 0, 0, NULL, 0),
	(8, 'facebook', 'فیسبوک', '', '', 'msg-item-facebook-messenger', '#567AFF', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 32C15.9 32-77.5 278 84.6 400.6V480l75.7-42c142.2 39.8 285.4-59.9 285.4-198.7C445.8 124.8 346.5 32 224 32zm23.4 278.1L190 250.5 79.6 311.6l121.1-128.5 57.4 59.6 110.4-61.1-121.1 128.5z"></path></svg>', 12, 1, 1, 0, 0, 0, 0, NULL, 0),
	(9, 'email', 'ایمیل', '', '', 'msg-item-envelope', '#FF643A', '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path></svg>', 9, 1, 1, 0, 0, 0, 0, NULL, 0),
	(10, 'whatsapp', 'واتس اپ', '', '', 'msg-item-whatsapp', '#1EBEA5', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>', 13, 1, 1, 0, 0, 0, 0, NULL, 0),
	(11, 'eitaa', 'ایتا', '', '', 'msg-item-Eitaa', '#F07C00', '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none"> <path d="M2415 4860 c-176 -44 -245 -70 -415 -152 -296 -143 -612 -381 -851 -643 -50 -54 -103 -115 -118 -134 -14 -20 -37 -48 -51 -64 -27 -31 -191 -268 -255 -369 -62 -97 -206 -392 -244 -498 -19 -52 -42 -113 -52 -135 -28 -66 -67 -213 -94 -356 -14 -74 -30 -155 -36 -181 -6 -26 -8 -52 -4 -58 3 -5 1 -10 -4 -10 -12 0 -16 -572 -4 -583 3 -4 7 -17 8 -30 2 -12 12 -69 24 -127 66 -315 202 -562 432 -785 128 -124 265 -216 447 -300 166 -77 295 -116 507 -155 137 -26 184 -30 330 -30 146 0 193 4 330 30 230 42 331 74 515 163 336 162 668 451 1041 907 47 58 109 137 138 175 28 39 66 90 84 114 131 177 315 431 329 453 82 126 359 438 438 493 l40 28 0 198 c0 110 -4 199 -8 199 -14 0 -105 -61 -182 -123 -41 -33 -183 -170 -315 -306 -715 -734 -882 -882 -1181 -1045 -150 -82 -217 -109 -352 -144 -59 -15 -112 -31 -117 -34 -28 -17 -246 -29 -350 -18 -60 6 -113 14 -118 17 -4 3 -52 16 -105 29 -103 25 -98 27 -127 -28 -35 -64 -114 -415 -99 -439 3 -5 0 -9 -6 -9 -8 0 -11 -15 -8 -44 l3 -45 -30 6 c-175 33 -331 126 -479 285 -70 76 -96 113 -140 203 -78 157 -97 221 -104 345 l-5 105 -73 68 c-41 38 -91 92 -111 121 -21 28 -41 52 -45 54 -5 2 -8 8 -8 14 0 5 -6 16 -14 23 -23 24 -73 155 -90 237 -81 392 178 830 695 1175 202 136 477 259 689 308 41 10 80 22 85 26 22 17 237 40 365 40 128 0 289 -20 328 -40 9 -5 51 -21 93 -36 112 -39 193 -90 289 -185 176 -173 199 -246 116 -367 -62 -90 -193 -183 -367 -260 -182 -79 -331 -122 -559 -159 -211 -35 -348 -28 -525 27 -192 59 -275 205 -242 427 7 47 6 52 -11 52 -34 0 -123 -52 -182 -107 -154 -142 -229 -338 -202 -525 15 -105 54 -186 129 -268 l60 -64 -52 -71 c-65 -87 -96 -148 -128 -250 -40 -129 -50 -237 -33 -347 25 -153 65 -250 154 -371 54 -74 212 -217 240 -217 14 0 20 20 35 109 29 181 67 275 172 426 140 201 406 386 823 571 68 30 131 59 140 64 9 6 73 36 142 68 271 127 447 238 556 354 107 112 163 201 258 410 70 154 104 503 75 770 -31 289 -155 538 -362 728 -173 158 -325 237 -579 299 -121 30 -137 31 -325 30 -196 0 -200 -1 -348 -39z"/> </g> </svg>', 14, 1, 1, 0, 0, 0, 0, NULL, 0),
	(12, 'rubika', 'روبیکا', '', '', 'msg-item-Rubika', '#f2f2f2', '<svg width="267pt" height="267pt" viewBox="0 0 267 267" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="#ffffffff"><path fill="#ffffff" opacity="1.00" d=" M 134.96 78.26 L 135.16 78.38 L 135.27 78.44 C 151.48 88.04 167.84 97.36 184.09 106.88 L 184.28 107.02 L 184.33 107.66 C 170.40 113.71 157.49 121.85 144.20 129.18 C 140.73 130.91 137.31 134.11 133.14 133.20 C 121.37 126.48 109.48 119.97 97.63 113.41 C 93.75 111.31 89.92 109.09 85.77 107.55 L 85.82 106.88 L 85.91 106.81 C 102.27 97.31 118.66 87.86 134.96 78.26 Z" /></g><g id="#b8ce01ff"><path fill="#b8ce01" opacity="1.00" d=" M 107.54 38.74 C 116.41 34.19 124.82 27.80 135.09 26.98 C 135.33 44.11 135.15 61.25 135.16 78.38 L 134.96 78.26 C 118.73 69.11 102.29 60.29 86.14 51.03 C 93.14 46.71 100.44 42.89 107.54 38.74 Z" /><path fill="#b8ce01" opacity="1.00" d=" M 134.72 190.05 L 135.61 190.60 C 141.22 194.39 147.40 197.23 153.15 200.79 C 163.50 206.67 173.54 213.15 184.17 218.54 L 184.11 218.98 C 176.67 223.69 168.71 227.55 161.10 231.98 C 152.56 235.83 145.03 242.66 135.27 243.07 C 135.31 230.36 135.28 217.65 135.29 204.94 C 135.27 200.14 135.53 195.31 134.84 190.54 L 134.72 190.05 Z" /></g><g id="#7db425ff"><path fill="#7db425" opacity="1.00" d=" M 135.09 26.98 C 142.72 27.45 149.53 31.25 155.99 35.02 C 165.51 40.18 174.88 45.62 184.30 50.96 L 184.36 51.01 C 172.03 57.78 159.68 64.51 147.41 71.39 C 143.32 73.68 139.00 75.58 135.27 78.44 L 135.16 78.38 C 135.15 61.25 135.33 44.11 135.09 26.98 Z" /><path fill="#7db425" opacity="1.00" d=" M 85.65 218.86 C 102.28 209.83 118.25 199.64 134.84 190.54 C 135.53 195.31 135.27 200.14 135.29 204.94 C 135.28 217.65 135.31 230.36 135.27 243.07 C 131.37 242.70 127.45 241.91 123.94 240.09 C 111.08 233.16 98.30 226.10 85.60 218.89 L 85.65 218.86 Z" /></g><g id="#f6a925ff"><path fill="#f6a925" opacity="1.00" d=" M 85.44 50.58 L 86.14 51.03 C 102.29 60.29 118.73 69.11 134.96 78.26 C 118.66 87.86 102.27 97.31 85.91 106.81 C 85.25 88.56 86.01 70.29 85.51 52.04 L 85.44 50.58 Z" /><path fill="#f6a925" opacity="1.00" d=" M 135.50 189.84 C 151.86 181.03 168.15 172.08 184.35 162.98 C 184.22 181.50 184.58 200.02 184.17 218.54 C 173.54 213.15 163.50 206.67 153.15 200.79 C 147.40 197.23 141.22 194.39 135.61 190.60 L 135.50 189.84 Z" /></g><g id="#59d6bdff"><path fill="#59d6bd" opacity="1.00" d=" M 184.30 50.96 C 195.02 57.16 205.89 63.09 216.49 69.50 C 221.97 72.49 227.60 75.95 230.76 81.53 C 215.42 90.23 199.86 98.53 184.46 107.12 L 184.28 107.02 L 184.09 106.88 C 184.81 88.28 184.31 69.63 184.36 51.01 L 184.30 50.96 Z" /></g><g id="#ef7414ff"><path fill="#ef7414" opacity="1.00" d=" M 55.42 68.45 C 65.33 62.55 75.51 57.10 85.44 51.22 L 85.51 52.04 C 86.01 70.29 85.25 88.56 85.91 106.81 L 85.82 106.88 L 85.51 107.05 C 79.98 104.02 74.64 100.65 68.91 97.97 C 59.03 92.63 49.44 86.70 39.36 81.73 C 42.98 75.52 49.41 71.95 55.42 68.45 Z" /><path fill="#ef7414" opacity="1.00" d=" M 184.35 162.98 L 184.54 162.89 C 199.60 172.06 215.00 180.64 230.21 189.55 C 226.39 195.43 220.04 198.78 214.15 202.21 C 204.20 207.91 194.38 213.85 184.11 218.98 L 184.17 218.54 C 184.58 200.02 184.22 181.50 184.35 162.98 Z" /></g><g id="#35ac9dff"><path fill="#35ac9d" opacity="1.00" d=" M 147.41 71.39 C 159.68 64.51 172.03 57.78 184.36 51.01 C 184.31 69.63 184.81 88.28 184.09 106.88 C 167.84 97.36 151.48 88.04 135.27 78.44 C 139.00 75.58 143.32 73.68 147.41 71.39 Z" /></g><g id="#e74b50ff"><path fill="#e74b50" opacity="1.00" d=" M 36.13 97.95 C 36.18 92.40 37.09 86.82 39.36 81.73 C 49.44 86.70 59.03 92.63 68.91 97.97 C 74.64 100.65 79.98 104.02 85.51 107.05 C 68.96 116.55 52.51 126.21 36.01 135.79 C 36.24 123.18 36.00 110.56 36.13 97.95 Z" /><path fill="#e74b50" opacity="1.00" d=" M 233.50 135.86 L 233.86 135.61 C 233.96 148.42 233.86 161.22 233.91 174.02 C 233.93 179.39 232.81 184.81 230.21 189.55 C 215.00 180.64 199.60 172.06 184.54 162.89 C 200.93 154.02 217.33 145.13 233.50 135.86 Z" /></g><g id="#794387ff"><path fill="#794387" opacity="1.00" d=" M 184.46 107.12 C 199.86 98.53 215.42 90.23 230.76 81.53 C 232.62 85.75 233.93 90.27 233.88 94.91 C 233.90 108.48 233.96 122.05 233.86 135.61 L 233.50 135.86 C 217.42 125.86 200.85 116.63 184.46 107.12 Z" /><path fill="#794387" opacity="1.00" d=" M 85.51 107.05 L 85.82 106.88 L 85.77 107.55 C 85.65 126.01 85.76 144.48 85.72 162.95 L 85.35 163.12 C 79.59 159.56 73.50 156.59 67.63 153.23 C 57.01 147.65 46.79 141.35 36.13 135.85 L 36.01 135.79 C 52.51 126.21 68.96 116.55 85.51 107.05 Z" /></g><g id="#4c3683ff"><path fill="#4c3683" opacity="1.00" d=" M 184.28 107.02 L 184.46 107.12 C 200.85 116.63 217.42 125.86 233.50 135.86 C 217.33 145.13 200.93 154.02 184.54 162.89 L 184.35 162.98 C 184.41 144.54 184.44 126.10 184.33 107.66 L 184.28 107.02 Z" /><path fill="#4c3683" opacity="1.00" d=" M 36.13 135.85 C 46.79 141.35 57.01 147.65 67.63 153.23 C 73.50 156.59 79.59 159.56 85.35 163.12 C 70.51 171.83 55.42 180.13 40.81 189.24 L 40.09 189.70 C 36.61 183.39 36.12 176.05 36.09 169.00 C 36.12 157.95 36.03 146.90 36.13 135.85 Z" /></g><g id="#e4e4e4ff"><path fill="#e4e4e4" opacity="1.00" d=" M 85.77 107.55 C 89.92 109.09 93.75 111.31 97.63 113.41 C 109.48 119.97 121.37 126.48 133.14 133.20 C 136.35 136.67 134.89 141.71 135.17 145.97 C 135.31 160.59 134.68 175.24 135.50 189.84 L 135.61 190.60 L 134.72 190.05 C 118.40 180.98 101.94 172.18 85.72 162.95 C 85.76 144.48 85.65 126.01 85.77 107.55 Z" /></g><g id="#f1f1f1ff"><path fill="#f1f1f1" opacity="1.00" d=" M 144.20 129.18 C 157.49 121.85 170.40 113.71 184.33 107.66 C 184.44 126.10 184.41 144.54 184.35 162.98 C 168.15 172.08 151.86 181.03 135.50 189.84 C 134.68 175.24 135.31 160.59 135.17 145.97 C 134.89 141.71 136.35 136.67 133.14 133.20 C 137.31 134.11 140.73 130.91 144.20 129.18 Z" /></g><g id="#0f68a0ff"><path fill="#0f68a0" opacity="1.00" d=" M 85.35 163.12 L 85.72 162.95 C 85.67 181.58 85.81 200.22 85.65 218.86 L 85.60 218.89 C 74.83 212.92 64.11 206.87 53.49 200.65 C 48.36 197.91 43.65 194.34 40.02 189.76 L 40.81 189.24 C 55.42 180.13 70.51 171.83 85.35 163.12 Z" /></g><g id="#49bdcaff"><path fill="#49bdca" opacity="1.00" d=" M 85.72 162.95 C 101.94 172.18 118.40 180.98 134.72 190.05 L 134.84 190.54 C 118.25 199.64 102.28 209.83 85.65 218.86 C 85.81 200.22 85.67 181.58 85.72 162.95 Z" /></g></svg>', 15, 1, 1, 0, 0, 0, 0, NULL, 0),
	(13, 'namasha', 'نماشا', '', '', 'msg-item-Namasha', '#FF0000', '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none"> <path d="M3345 4851 c-26 -12 -170 -149 -400 -380 -283 -283 -365 -361 -385 -361 -19 0 -73 48 -235 211 -116 116 -230 224 -254 240 -120 78 -257 -17 -221 -152 10 -34 36 -67 137 -170 l125 -128 -33 -5 c-19 -3 -91 -15 -162 -26 -346 -57 -598 -187 -847 -439 -206 -208 -349 -470 -404 -744 -26 -123 -36 -334 -36 -737 0 -392 9 -561 36 -695 84 -414 354 -788 728 -1007 170 -100 401 -175 604 -197 130 -14 881 -14 1061 -1 400 31 721 178 992 457 204 208 335 449 400 733 30 131 42 415 36 870 -5 434 -11 497 -62 675 -173 599 -670 1020 -1290 1095 -55 7 -106 14 -114 16 -9 3 79 99 241 262 141 141 263 271 272 289 63 124 -64 255 -189 194z m-370 -1461 c77 -5 167 -16 200 -25 82 -21 228 -94 297 -149 124 -99 233 -269 280 -441 22 -78 23 -93 22 -585 0 -431 -2 -516 -16 -582 -36 -166 -98 -278 -223 -403 -99 -98 -196 -160 -312 -200 -129 -43 -187 -47 -708 -43 -529 4 -522 4 -667 62 -185 75 -347 232 -432 418 -70 152 -70 151 -74 692 -3 521 0 573 44 705 40 121 99 215 194 311 156 158 305 224 545 240 164 11 690 11 850 0z"/> <path d="M2119 2815 c-58 -32 -59 -44 -59 -633 0 -324 4 -551 10 -573 15 -53 51 -82 103 -82 38 0 94 29 483 253 241 139 462 268 491 286 90 57 105 129 40 191 -17 17 -241 151 -497 298 -489 282 -513 293 -571 260z"/> </g> </svg>', 16, 1, 1, 0, 0, 0, 0, NULL, 0),
	(14, 'pinterest', 'پینترست', '', '', 'msg-item-pinterest', '#ffffff', '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 48 48" version="1.1"><title>Pinterest-color</title><desc>Created with Sketch.</desc><defs></defs><g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Color-" transform="translate(-300.000000, -260.000000)" fill="#CC2127"><path d="M324.001411,260 C310.747575,260 300,270.744752 300,284.001411 C300,293.826072 305.910037,302.270594 314.368672,305.982007 C314.300935,304.308344 314.357382,302.293173 314.78356,300.469924 C315.246428,298.522491 317.871229,287.393897 317.871229,287.393897 C317.871229,287.393897 317.106368,285.861351 317.106368,283.59499 C317.106368,280.038808 319.169518,277.38296 321.73505,277.38296 C323.91674,277.38296 324.972306,279.022755 324.972306,280.987123 C324.972306,283.180102 323.572411,286.462515 322.852708,289.502205 C322.251543,292.050803 324.128418,294.125243 326.640325,294.125243 C331.187158,294.125243 334.249427,288.285765 334.249427,281.36532 C334.249427,276.10725 330.707356,272.170048 324.263891,272.170048 C316.985006,272.170048 312.449462,277.59746 312.449462,283.659905 C312.449462,285.754101 313.064738,287.227377 314.029988,288.367613 C314.475922,288.895396 314.535191,289.104251 314.374316,289.708238 C314.261422,290.145705 313.996119,291.21256 313.886047,291.633092 C313.725172,292.239901 313.23408,292.460046 312.686541,292.234256 C309.330746,290.865408 307.769977,287.193509 307.769977,283.064385 C307.769977,276.248368 313.519139,268.069148 324.921503,268.069148 C334.085729,268.069148 340.117128,274.704533 340.117128,281.819721 C340.117128,291.235138 334.884459,298.268478 327.165285,298.268478 C324.577174,298.268478 322.138649,296.868584 321.303228,295.279591 C321.303228,295.279591 319.908979,300.808608 319.615452,301.875463 C319.107426,303.724114 318.111131,305.575587 317.199506,307.014994 C319.358617,307.652849 321.63909,308 324.001411,308 C337.255248,308 348,297.255248 348,284.001411 C348,270.744752 337.255248,260 324.001411,260" id="Pinterest"></path></g></g></svg>', 17, 1, 1, 0, 0, 0, 0, NULL, 0),
	(15, 'linkedin', 'لینکدین', '', '', 'msg-item-linkedin', '#0077b5', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>', 18, 1, 1, 0, 0, 0, 0, NULL, 0),
	(16, 'callback', 'درخواست تماس', '', 'ما با شما تماس میگیریم', 'msg-item-phone', '#145221', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>', 4, 1, 1, 0, 0, 0, 0, 'callback', -1),
	(17, 'popup', 'پاپ آپ سفارشی', '_popup', '', 'msg-item-slack-hash', '#8F5DB7', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M446.2 270.4c-6.2-19-26.9-29.1-46-22.9l-45.4 15.1-30.3-90 45.4-15.1c19.1-6.2 29.1-26.8 23-45.9-6.2-19-26.9-29.1-46-22.9l-45.4 15.1-15.7-47c-6.2-19-26.9-29.1-46-22.9-19.1 6.2-29.1 26.8-23 45.9l15.7 47-93.4 31.2-15.7-47c-6.2-19-26.9-29.1-46-22.9-19.1 6.2-29.1 26.8-23 45.9l15.7 47-45.3 15c-19.1 6.2-29.1 26.8-23 45.9 5 14.5 19.1 24 33.6 24.6 6.8 1 12-1.6 57.7-16.8l30.3 90L78 354.8c-19 6.2-29.1 26.9-23 45.9 5 14.5 19.1 24 33.6 24.6 6.8 1 12-1.6 57.7-16.8l15.7 47c5.9 16.9 24.7 29 46 22.9 19.1-6.2 29.1-26.8 23-45.9l-15.7-47 93.6-31.3 15.7 47c5.9 16.9 24.7 29 46 22.9 19.1-6.2 29.1-26.8 23-45.9l-15.7-47 45.4-15.1c19-6 29.1-26.7 22.9-45.7zm-254.1 47.2l-30.3-90.2 93.5-31.3 30.3 90.2-93.5 31.3z"></path></svg>', 6, 1, 1, 0, 0, 0, 0, NULL, -1),
	(18, 'email_form', 'فرم ایمیل', '', '', 'msg-item-comments-alt-solid', '#000000', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M416 224V64c0-35.3-28.7-64-64-64H64C28.7 0 0 28.7 0 64v160c0 35.3 28.7 64 64 64v54.2c0 8 9.1 12.6 15.5 7.8l82.8-62.1H352c35.3.1 64-28.6 64-63.9zm96-64h-64v64c0 52.9-43.1 96-96 96H192v64c0 35.3 28.7 64 64 64h125.7l82.8 62.1c6.4 4.8 15.5.2 15.5-7.8V448h32c35.3 0 64-28.7 64-64V224c0-35.3-28.7-64-64-64z"></path></svg>', 5, 1, 1, 0, 0, 0, 0, 'email', -1);

-- Dumping structure for table reservation.tbl_page
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `type` enum('main_page','dashboard','sub_page') DEFAULT 'sub_page',
  `link` text,
  `readonly_link` tinyint NOT NULL DEFAULT '0',
  `removable` tinyint NOT NULL DEFAULT '0',
  `writer` int NOT NULL DEFAULT '1',
  `title` varchar(1000) NOT NULL,
  `main_tag` varchar(1000) DEFAULT NULL,
  `metaDescription` varchar(1000) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `data_item` json DEFAULT NULL,
  `description` longtext,
  `view` int NOT NULL DEFAULT '0',
  `date_created` varchar(200) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `p_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=default;2=cant_change_status;3=dashboard_page	',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_page: ~11 rows (approximately)
DELETE FROM `tbl_page`;
INSERT INTO `tbl_page` (`p_id`, `type`, `link`, `readonly_link`, `removable`, `writer`, `title`, `main_tag`, `metaDescription`, `cover`, `data_item`, `description`, `view`, `date_created`, `time`, `p_status`) VALUES
	(1, 'dashboard', 'dashboard-main', 1, 0, 1, 'داشبورد پیش فرض', NULL, NULL, NULL, '[{"ratio": "3-3-3-3", "columns": [[{"title": "تعداد نوبت‌های ماه", "widget": "count_reservation_this_month"}], [{"title": "تعداد کابران ماه", "widget": "count_users_this_month"}], [{"title": "اعتبار پنل پیامک", "widget": "credit_sms_panel"}]]}, {"ratio": "9-3", "columns": [[{"title": "نمودار نوبت‌های رزرو شده در ماه", "widget": "chart_reservation_this_month"}], [{"title": "ساعت آنالوگ", "widget": "clock"}]]}, {"ratio": "6-6", "columns": [[{"title": "آخرین فعالیت های شما", "widget": "last_activity"}], [{"title": "آخرین مشتریان ثبت شده", "widget": "last_users_register"}]]}, {"ratio": "12", "columns": [[{"title": "آخرین مطالب وبلاگ", "widget": "last_blog_article"}]]}]', NULL, 0, '1400/07/07', '22:26', 3),
	(2, 'main_page', NULL, 1, 0, 1, 'صفحه اصلی', NULL, NULL, NULL, NULL, NULL, 0, '1400/07/07', '22:26', 2),
	(3, 'sub_page', 'services', 1, 0, 1, 'خدمات', 'خدمات', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '', NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n\r\n&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n', 0, '1400/07/07', '23:27', 2),
	(4, 'sub_page', 'blog', 1, 0, 1, 'وبلاگ', 'وبلاگ', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '', NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n\r\n&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n', 0, '1400/07/07', '23:27', 2),
	(5, 'sub_page', 'search', 1, 0, 1, 'جستجو', 'جستجو', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', NULL, NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n', 1, '1400/07/07', '22:26', 1),
	(6, 'sub_page', 'contact', 1, 0, 1, 'تماس با ما', 'ارتباط با ما', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '1632945408_5f61a0a0f05ef.png', NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\n', 2, '1400/07/07', '23:26', 1),
	(7, 'sub_page', 'faq', 1, 0, 1, 'سوالات متداول', 'سوالات متداول', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '1654079802_How-To-Prepare-The-Text-FAQ-Page-Simple-Way.نکات مهم در خصوص متن صفحه FAQ_1623481514.png', NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.&lt;/p&gt;\r\n', 2, '1400/07/07', '23:27', 1),
	(8, 'sub_page', 'help', 1, 0, 1, 'راهنما', 'راهنمای استفاده از سایت', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', NULL, NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\n', 1, '1400/07/07', '23:23', 1),
	(9, 'sub_page', 'terms', 1, 0, 1, 'قوانین و مقررات', 'قوانین و مقررات سایت', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', NULL, NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\n\n&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\n', 1, '1400/07/07', '23:24', 1),
	(10, 'sub_page', 'about', 1, 0, 1, 'درباره ما', 'درباره ما', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', NULL, NULL, '&lt;p&gt;لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.&lt;/p&gt;\r\n', 3, '1400/07/07', '22:26', 1);

-- Dumping structure for table reservation.tbl_page_widget
CREATE TABLE IF NOT EXISTS `tbl_page_widget` (
  `ip_id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL,
  `template_id` int NOT NULL,
  `ip_title` varchar(250) NOT NULL,
  `ip_order` int NOT NULL,
  `ip_content` text NOT NULL,
  `ip_status` int NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_page_widget: 0 rows
DELETE FROM `tbl_page_widget`;
/*!40000 ALTER TABLE `tbl_page_widget` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_page_widget` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_payment_log
CREATE TABLE IF NOT EXISTS `tbl_payment_log` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `payment_vids_id` varchar(100) NOT NULL,
  `order_vids_id` varchar(100) NOT NULL,
  `part` int NOT NULL DEFAULT '1' COMMENT '1=service;2=course;3=other',
  `user_ip` varchar(100) DEFAULT NULL,
  `price` int NOT NULL DEFAULT '0',
  `beforepay` varchar(255) DEFAULT '-',
  `afterpay` varchar(255) DEFAULT '-',
  `type` varchar(15) NOT NULL DEFAULT 'cash',
  `pay_to` varchar(255) DEFAULT '-',
  `time_payment` varchar(20) DEFAULT NULL,
  `date_payment` varchar(30) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_payment_log: ~0 rows (approximately)
DELETE FROM `tbl_payment_log`;

-- Dumping structure for table reservation.tbl_payment_methods
CREATE TABLE IF NOT EXISTS `tbl_payment_methods` (
  `pay_id` int NOT NULL AUTO_INCREMENT,
  `pay_default` tinyint NOT NULL DEFAULT '0',
  `pay_type` varchar(10) NOT NULL DEFAULT '1' COMMENT 'cash;bank',
  `pay_to` int NOT NULL,
  `user_type` tinyint NOT NULL DEFAULT '3' COMMENT 'tbl_customer_level id',
  `pay_title` varchar(250) NOT NULL,
  `pay_desc` varchar(1000) DEFAULT NULL,
  `pay_icon` varchar(250) DEFAULT NULL,
  `pay_merchant` varchar(500) DEFAULT NULL,
  `pay_username` varchar(100) DEFAULT NULL,
  `pay_password` varchar(100) DEFAULT NULL,
  `test_status` tinyint NOT NULL DEFAULT '0',
  `pay_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_payment_methods: 3 rows
DELETE FROM `tbl_payment_methods`;
/*!40000 ALTER TABLE `tbl_payment_methods` DISABLE KEYS */;
INSERT INTO `tbl_payment_methods` (`pay_id`, `pay_default`, `pay_type`, `pay_to`, `user_type`, `pay_title`, `pay_desc`, `pay_icon`, `pay_merchant`, `pay_username`, `pay_password`, `test_status`, `pay_status`) VALUES
	(1, 0, 'cash', 1000, 0, 'کارت به کارت', 'شما می توانید مبلغ سفارش را به شماره کارت 1234567891011213 به نام تست هستیم واریز و رسید آن را برای پشتیبانی ارسال نمایید', NULL, '', NULL, NULL, 0, 0),
	(2, 1, 'bank', 1000, 0, 'درگاه زرین پال', '', 'bank-logo/zarinpal.png', NULL, NULL, NULL, 0, 0),
	(3, 0, 'cash', 1000, 0, 'پرداخت حضوری', '', NULL, '', NULL, NULL, 0, 0);
/*!40000 ALTER TABLE `tbl_payment_methods` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_pettycash
CREATE TABLE IF NOT EXISTS `tbl_pettycash` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `pettyCash_vids_id` varchar(100) NOT NULL,
  `p_name` varchar(1000) NOT NULL,
  `p_currency` int NOT NULL,
  `p_desc` varchar(1000) DEFAULT NULL,
  `p_date` varchar(50) NOT NULL,
  `p_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_pettycash: 1 rows
DELETE FROM `tbl_pettycash`;
/*!40000 ALTER TABLE `tbl_pettycash` DISABLE KEYS */;
INSERT INTO `tbl_pettycash` (`p_id`, `pettyCash_vids_id`, `p_name`, `p_currency`, `p_desc`, `p_date`, `p_status`) VALUES
	(1000, '1000', 'پیش فرض', 1, '', '1400/02/16', 1);
/*!40000 ALTER TABLE `tbl_pettycash` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_provinces
CREATE TABLE IF NOT EXISTS `tbl_provinces` (
  `pro_id` int unsigned NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pro_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table reservation.tbl_provinces: ~31 rows (approximately)
DELETE FROM `tbl_provinces`;
INSERT INTO `tbl_provinces` (`pro_id`, `pro_name`, `pro_status`) VALUES
	(1, 'آذربايجان شرقي', 1),
	(2, 'آذربايجان غربي', 1),
	(3, 'اردبيل', 1),
	(4, 'اصفهان', 1),
	(5, 'البرز', 1),
	(6, 'ايلام', 1),
	(7, 'بوشهر', 1),
	(8, 'تهران', 1),
	(9, 'چهارمحال بختياري', 1),
	(10, 'خراسان جنوبي', 1),
	(11, 'خراسان رضوي', 1),
	(12, 'خراسان شمالي', 1),
	(13, 'خوزستان', 1),
	(14, 'زنجان', 1),
	(15, 'سمنان', 1),
	(16, 'سيستان و بلوچستان', 1),
	(17, 'فارس', 1),
	(18, 'قزوين', 1),
	(19, 'قم', 1),
	(20, 'كردستان', 1),
	(21, 'كرمان', 1),
	(22, 'كرمانشاه', 1),
	(23, 'كهكيلويه و بويراحمد', 1),
	(24, 'گلستان', 1),
	(25, 'گيلان', 1),
	(26, 'لرستان', 1),
	(27, 'مازندران', 1),
	(28, 'مركزي', 1),
	(29, 'هرمزگان', 1),
	(30, 'همدان', 1),
	(31, 'يزد', 1);

-- Dumping structure for table reservation.tbl_rating
CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `r_type` varchar(20) NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  `r_rate` int DEFAULT '0',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_rating: 0 rows
DELETE FROM `tbl_rating`;
/*!40000 ALTER TABLE `tbl_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rating` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_ratings
CREATE TABLE IF NOT EXISTS `tbl_ratings` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `r_name` varchar(250) NOT NULL,
  `create_date` varchar(50) NOT NULL,
  `r_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_ratings: 0 rows
DELETE FROM `tbl_ratings`;
/*!40000 ALTER TABLE `tbl_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ratings` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_redirect
CREATE TABLE IF NOT EXISTS `tbl_redirect` (
  `r_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('301','302','303','307','404') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '301' COMMENT 'نوع انتقال',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservation.tbl_redirect: 0 rows
DELETE FROM `tbl_redirect`;
/*!40000 ALTER TABLE `tbl_redirect` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_redirect` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_score
CREATE TABLE IF NOT EXISTS `tbl_score` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `rate_id` varchar(40) NOT NULL,
  `rate` float NOT NULL,
  `rated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_score: ~0 rows (approximately)
DELETE FROM `tbl_score`;

-- Dumping structure for table reservation.tbl_searches
CREATE TABLE IF NOT EXISTS `tbl_searches` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_phrase` varchar(1000) NOT NULL,
  `s_count_result` int NOT NULL DEFAULT '0',
  `s_count_search` int NOT NULL DEFAULT '0',
  `s_suggest_search` tinyint NOT NULL DEFAULT '0',
  `s_management_selection` tinyint NOT NULL DEFAULT '0',
  `s_date` varchar(50) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_searches: 0 rows
DELETE FROM `tbl_searches`;
/*!40000 ALTER TABLE `tbl_searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_searches` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services
CREATE TABLE IF NOT EXISTS `tbl_services` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_title` varchar(250) NOT NULL,
  `s_title_en` varchar(250) NOT NULL,
  `seo_title` varchar(250) NOT NULL,
  `seo_desc` varchar(500) DEFAULT NULL,
  `s_recovery_times` int NOT NULL DEFAULT '0',
  `s_recovery_times_desc` text,
  `s_avg_time_to_do` varchar(30) NOT NULL,
  `s_durability` varchar(100) DEFAULT NULL,
  `s_mainKeyword` varchar(100) NOT NULL,
  `s_slug` varchar(250) NOT NULL,
  `s_description` varchar(10000) DEFAULT NULL,
  `s_cover` varchar(200) DEFAULT NULL,
  `s_date_created` varchar(20) NOT NULL,
  `s_calendar_background_color` varchar(10) DEFAULT '#FF0000',
  `s_view` int NOT NULL DEFAULT '0',
  `s_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services: 0 rows
DELETE FROM `tbl_services`;
/*!40000 ALTER TABLE `tbl_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_related_blog
CREATE TABLE IF NOT EXISTS `tbl_services_related_blog` (
  `srb_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `blog_id` int NOT NULL,
  `srb_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`srb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_related_blog: 0 rows
DELETE FROM `tbl_services_related_blog`;
/*!40000 ALTER TABLE `tbl_services_related_blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_related_blog` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_reservation
CREATE TABLE IF NOT EXISTS `tbl_services_reservation` (
  `sre_id` int NOT NULL AUTO_INCREMENT,
  `reason_create` varchar(20) DEFAULT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `order_service_vids_id` varchar(50) DEFAULT NULL,
  `sre_date` varchar(30) NOT NULL,
  `sre_time` varchar(10) NOT NULL,
  `sre_day` varchar(50) DEFAULT NULL,
  `sre_vip` tinyint NOT NULL DEFAULT '0',
  `sre_pay` tinyint NOT NULL DEFAULT '0' COMMENT '1=ok;0=no',
  `beforepay` varchar(255) NOT NULL DEFAULT '-',
  `afterpay` varchar(255) NOT NULL DEFAULT '-',
  `payment_method_id` int DEFAULT NULL,
  `sre_date_payment` varchar(30) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `sre_time_payment` varchar(10) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `sre_is_need_to_prepayment` tinyint NOT NULL DEFAULT '1',
  `sre_price_prepayment` varchar(15) NOT NULL DEFAULT '0',
  `sre_price_payment` varchar(15) NOT NULL DEFAULT '0',
  `sre_price_total` varchar(15) NOT NULL DEFAULT '0',
  `sre_off_code` varchar(100) DEFAULT NULL,
  `sre_off_code_price` varchar(100) DEFAULT '0',
  `sre_date_create` varchar(30) NOT NULL,
  `sre_time_create` varchar(10) NOT NULL,
  `sre_timestamp_expire` varchar(30) NOT NULL,
  `sre_accounting_description` text,
  `sre_done_date` varchar(30) DEFAULT NULL,
  `sre_status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`sre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_reservation: 0 rows
DELETE FROM `tbl_services_reservation`;
/*!40000 ALTER TABLE `tbl_services_reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_reservation` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_reservation_log
CREATE TABLE IF NOT EXISTS `tbl_services_reservation_log` (
  `idusr_activity` int NOT NULL AUTO_INCREMENT,
  `admin_id` int unsigned DEFAULT NULL,
  `reservation_id` varchar(250) NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `activity` varchar(500) DEFAULT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusr_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3
/*!50100 PARTITION BY HASH (`idusr_activity`)
PARTITIONS 10 */;

-- Dumping data for table reservation.tbl_services_reservation_log: ~0 rows (approximately)
DELETE FROM `tbl_services_reservation_log`;

-- Dumping structure for table reservation.tbl_services_reservation_product
CREATE TABLE IF NOT EXISTS `tbl_services_reservation_product` (
  `srp_id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` varchar(250) NOT NULL,
  `storeroom_id` int NOT NULL,
  `product_id` int NOT NULL,
  `srp_count` int NOT NULL,
  `srp_price` int NOT NULL,
  `srp_date` varchar(100) DEFAULT NULL,
  `srp_status` tinyint NOT NULL DEFAULT '1',
  `srp_desc` text,
  PRIMARY KEY (`srp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_services_reservation_product: 0 rows
DELETE FROM `tbl_services_reservation_product`;
/*!40000 ALTER TABLE `tbl_services_reservation_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_reservation_product` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_reservation_staff
CREATE TABLE IF NOT EXISTS `tbl_services_reservation_staff` (
  `os_id` int NOT NULL AUTO_INCREMENT,
  `order_service_vids_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `os_profit` varchar(100) DEFAULT NULL,
  `os_received_date` varchar(50) DEFAULT NULL,
  `os_prepare_date` varchar(50) DEFAULT NULL,
  `os_bank_fees` varchar(100) DEFAULT NULL,
  `os_settlement_sold` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`os_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_services_reservation_staff: 0 rows
DELETE FROM `tbl_services_reservation_staff`;
/*!40000 ALTER TABLE `tbl_services_reservation_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_reservation_staff` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_staff
CREATE TABLE IF NOT EXISTS `tbl_services_staff` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `staff_vids_id` varchar(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `expertise` varchar(250) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `no_sheba` varchar(255) NOT NULL DEFAULT '-',
  `no_card` varchar(50) DEFAULT '-',
  `image` varchar(100) DEFAULT NULL,
  `score` float NOT NULL DEFAULT '10',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_services_staff: 0 rows
DELETE FROM `tbl_services_staff`;
/*!40000 ALTER TABLE `tbl_services_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_staff` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_tag
CREATE TABLE IF NOT EXISTS `tbl_services_tag` (
  `pt_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_tag: 0 rows
DELETE FROM `tbl_services_tag`;
/*!40000 ALTER TABLE `tbl_services_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_tag` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_tariff
CREATE TABLE IF NOT EXISTS `tbl_services_tariff` (
  `st_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `operator_id` int NOT NULL,
  `st_is_vip` tinyint NOT NULL DEFAULT '0',
  `st_price` varchar(11) NOT NULL DEFAULT '0',
  `st_deposit` varchar(11) NOT NULL DEFAULT '0',
  `st_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_tariff: 0 rows
DELETE FROM `tbl_services_tariff`;
/*!40000 ALTER TABLE `tbl_services_tariff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_tariff` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_timing
CREATE TABLE IF NOT EXISTS `tbl_services_timing` (
  `st_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `st_auto_timing_enabled` tinyint NOT NULL DEFAULT '0',
  `st_date_reservation` int NOT NULL DEFAULT '1',
  `st_date_reservation_for_admin` int NOT NULL DEFAULT '0',
  `st_allowed_time_book_repair_appointment` int NOT NULL DEFAULT '0',
  `st_complete_time_reservation` varchar(5) NOT NULL DEFAULT '30' COMMENT 'minutes',
  `st_turn_default` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_custom_date` varchar(20) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT 'custome_date',
  `st_turn_saturday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_sunday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_monday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_tuesday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_wednesday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_thursday` varchar(20) NOT NULL DEFAULT 'default',
  `st_turn_friday` varchar(20) NOT NULL DEFAULT 'not_turn',
  `st_turn_holiday` varchar(20) NOT NULL DEFAULT 'not_turn',
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_timing: 0 rows
DELETE FROM `tbl_services_timing`;
/*!40000 ALTER TABLE `tbl_services_timing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_timing` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_services_timing_manage_day
CREATE TABLE IF NOT EXISTS `tbl_services_timing_manage_day` (
  `sm_id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `sm_title_day` varchar(30) NOT NULL,
  `sm_time_start` varchar(10) NOT NULL DEFAULT '08:00',
  `sm_time_end` varchar(10) DEFAULT '15:00',
  `sm_capacity` int NOT NULL DEFAULT '0',
  `sm_description` varchar(4000) DEFAULT NULL,
  `sm_vip` tinyint NOT NULL DEFAULT '0',
  `sm_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`sm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_services_timing_manage_day: 0 rows
DELETE FROM `tbl_services_timing_manage_day`;
/*!40000 ALTER TABLE `tbl_services_timing_manage_day` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_services_timing_manage_day` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_settings
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` text,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_settings: ~104 rows (approximately)
DELETE FROM `tbl_settings`;
INSERT INTO `tbl_settings` (`id`, `key`, `value`) VALUES
	(1, 'root', 'root_path'),
	(2, 'admin_path', 'manage'),
	(3, 'show_error', '0'),
	(4, 'site', 'web_title'),
	(5, 'meta_description', ''),
	(6, 'meta_keyword', ''),
	(7, 'channel_service_reservation', ''),
	(8, 'channel_payment', ''),
	(9, 'channel_blog', ''),
	(10, 'bot_token', ''),
	(11, 'logo', '1679993228_2454_logo.svg'),
	(12, 'logo_square', '1679993414_7401_logo-min.svg'),
	(13, 'location', ''),
	(14, 'address', ''),
	(15, 'site_short_name', 'web_title'),
	(16, 'factor_sales', ''),
	(17, 'google', ''),
	(18, 'theme_color', '#e81124'),
	(19, 'legal_name', 'web_title'),
	(20, 'footer_about', 'متن پیش فرض درباره ما که می توانید از بخش پیکربندی در قسمت تنظیمات آن را تغییر دهید'),
	(21, 'customJS', ''),
	(22, 'sms_status', '0'),
	(23, 'sms_api_key', ''),
	(24, 'sms_secret_key', ''),
	(25, 'sms_site', 'sms_ir'),
	(26, 'sms_number', ''),
	(27, 'sms_pattern_code', ''),
	(28, 'google_captcha_site_key', ''),
	(29, 'google_secret_site_key', ''),
	(30, 'national_id', ''),
	(31, 'registration_number', ''),
	(32, 'economic_code', ''),
	(33, 'postal_code', ''),
	(34, 'favicon', '1679993744_337_fav.png'),
	(35, 'field_of_activity', 'سالن زیبایی'),
	(36, 'business_type', '1'),
	(37, 'province', ''),
	(38, 'city', ''),
	(39, 'login_admin_background', '1667072402_9794_adam-winger-KVVjmb3IIL8-unsplash.jpg'),
	(40, 'cookie_duration', '7'),
	(41, 'sms_template_for_forget_password_admin', ''),
	(42, 'sms_template_login', ''),
	(43, 'offline_mode', '1'),
	(44, 'phone', ''),
	(45, 'blog_item_per_page', '6'),
	(46, 'theme', 'default'),
	(47, 'customJS_position', 'top'),
	(48, 'site_public', 'index'),
	(49, 'samandehi_link', ''),
	(50, 'samandehi_image', ''),
	(51, 'enamad_link', ''),
	(52, 'enamad_image', ''),
	(53, 'zarinpal_link', ''),
	(54, 'zarinpal_image', ''),
	(55, 'logo_dark', '1679993220_3112_logo dark.svg'),
	(56, 'logo_square_dark', '1679993439_9243_logo-min-dark.svg'),
	(57, 'google_captcha_status', '0'),
	(58, 'copyright', 'کلیه حقوق مادی و معنوی برای این سایت محفوظ می باشد.'),
	(59, 'notification', '0'),
	(60, 'notification_text_position', 'center'),
	(61, 'notification_message', ''),
	(62, 'development_mode', '0'),
	(63, 'development_mode_text', 'در حال تغییراتی بر روی سایت هستیم و به زودی باز خواهیم گشت'),
	(64, 'admin_ip_lock', '0'),
	(65, 'admin_ip', ''),
	(66, 'notification_text_color', '#ffffff'),
	(67, 'notification_background_color', '#5049f6'),
	(68, 'footer_logo', '1'),
	(69, 'active_wallet', '0'),
	(70, 'service_item_per_page', '6'),
	(71, 'management_name', ''),
	(72, 'comment_item_per_page', '15'),
	(73, 'comment_limit_for_user', '2'),
	(74, 'comment_confirm_method', 'admin'),
	(75, 'comment_reply_button', '1'),
	(76, 'comment_show_for_login_user', '0'),
	(77, 'comment_word_check', '0'),
	(78, 'comment_word_forbidden', ''),
	(79, 'dashboard_default', '[{"ratio": "3-3-3-3", "columns": [[{"title": "تعداد نوبت‌های ماه", "widget": "count_reservation_this_month"}], [{"title": "تعداد کابران ماه", "widget": "count_users_this_month"}], [{"title": "اعتبار پنل پیامک", "widget": "credit_sms_panel"}]]}, {"ratio": "9-3", "columns": [[{"title": "نمودار نوبت‌های رزرو شده در ماه", "widget": "chart_reservation_this_month"}], [{"title": "ساعت آنالوگ", "widget": "clock"}]]}, {"ratio": "6-6", "columns": [[{"title": "آخرین فعالیت های شما", "widget": "last_activity"}], [{"title": "آخرین مشتریان ثبت شده", "widget": "last_users_register"}]]}, {"ratio": "12", "columns": [[{"title": "آخرین مطالب وبلاگ", "widget": "last_blog_article"}]]}]'),
	(80, 'csrf_token_name', 'unix_csrf_token'),
	(81, 'float_contact', '0'),
	(82, 'float_contact_color', '#ff5c62'),
	(83, 'float_contact_position', 'right'),
	(84, 'float_contact_size', 'large'),
	(85, 'float_contact_text', 'تماس با ما'),
	(86, 'float_contact_icons_animation_speed', '3000'),
	(87, 'float_contact_icons_animation_pause', '2000'),
	(88, 'float_contact_online_badge', '1'),
	(89, 'float_contact_menu_backdrop', '1'),
	(90, 'float_contact_menu_size', 'normal'),
	(91, 'float_contact_menu_header_close_btn_bg_color', '#008749'),
	(92, 'float_contact_menu_header_close_btn_color', '#ffffff'),
	(93, 'float_contact_menu_show_header_close_btn', '1'),
	(94, 'float_contact_menu_show_header', '1'),
	(95, 'float_contact_menu_header_text', 'ما را در شبکه های اجتماعی دنبال کنید'),
	(96, 'float_contact_menu_sub_header_text', ''),
	(97, 'float_contact_items_icon_type', 'rounded'),
	(98, 'float_contact_popup_animation', 'scale'),
	(99, 'float_contact_menu_popup_style', 'sidebar'),
	(100, 'float_contact_sidebar_animation', 'elastic'),
	(101, 'float_contact_menu_items_animation', 'fromaside'),
	(102, 'float_contact_mode_select_options', 'regular'),
	(103, 'float_contact_menu_click_away', '1'),
	(104, 'bot_status', '0'),
    (105, 'license_info', 'license_info_set_demo_time');

-- Dumping structure for table reservation.tbl_sidebar
CREATE TABLE IF NOT EXISTS `tbl_sidebar` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_parent_id` int NOT NULL DEFAULT '0',
  `s_name` varchar(200) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `s_link` varchar(200) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `s_counter_num` tinyint NOT NULL DEFAULT '0',
  `s_counter_num_type` varchar(200) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `s_icon` varchar(50) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `s_order` int NOT NULL,
  `s_removable` tinyint NOT NULL DEFAULT '1',
  `s_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_sidebar: 72 rows
DELETE FROM `tbl_sidebar`;
/*!40000 ALTER TABLE `tbl_sidebar` DISABLE KEYS */;
INSERT INTO `tbl_sidebar` (`s_id`, `s_parent_id`, `s_name`, `s_link`, `s_counter_num`, `s_counter_num_type`, `s_icon`, `s_order`, `s_removable`, `s_status`) VALUES
	(1, 0, 'داشبورد', 'dashboard', 0, NULL, 'fa-dashboard', 1, 0, 1),
	(2, 0, 'خدمات', '-', 1, 'newReserve#', 'fa-hand-scissors-o', 2, 0, 1),
	(3, 0, 'وبلاگ', '-', 0, NULL, 'fa-newspaper-o', 5, 0, 1),
	(4, 10, 'برگه', '-', 0, NULL, 'fa-clone', 13, 0, 1),
	(5, 93, 'مشتریان', 'users', 0, NULL, 'fa-users', 7, 0, 1),
	(6, 0, 'بررسی', '-', 1, 'newComments#newContact', 'fa-comment-o', 9, 0, 1),
	(81, 13, 'مدیریت استان و شهرها', '-', 0, NULL, 'fa-map-o', 19, 0, 1),
	(7, 0, 'حسابداری', '-', 0, NULL, 'fa-money', 10, 0, 1),
	(10, 0, 'نمایش', '-', 0, NULL, 'fa-television', 12, 0, 1),
	(11, 0, 'سوالات متداول', '-', 0, NULL, 'fa-question', 13, 0, 1),
	(12, 0, 'مدیریت فایل ها', 'filemanager', 0, NULL, 'fa-file', 15, 0, 1),
	(13, 0, 'تنظیمات', '-', 0, NULL, 'fa-cog', 17, 0, 1),
	(14, 2, 'ثبت نوبت جدید', 'reservations/new', 0, NULL, 'fa-plus-square', 3, 0, 1),
	(15, 2, 'لیست رزروها', 'reservations/list', 1, 'newReserve#', 'fa-list', 4, 0, 1),
	(16, 2, 'افزودن خدمت جدید', 'services/add', 0, NULL, 'fa-plus-square', 5, 0, 1),
	(17, 2, 'مدیریت خدمات', 'services', 0, NULL, 'fa-circle', 6, 0, 1),
	(19, 0, 'کد تخفیف', 'discounts', 0, NULL, 'fa-quote-right', 7, 0, 1),
	(20, 0, 'کارت هدیه', 'giftCart', 0, NULL, 'fa-gift', 8, 0, 1),
	(22, 2, 'تنظیمات خدمات', '-', 0, NULL, 'fa-cog', 7, 0, 1),
	(23, 22, 'شعبه ها', 'branches', 0, NULL, 'fa-circle', 8, 0, 1),
	(24, 22, 'انبارها', 'storeroom/list', 0, NULL, 'fa-circle', 9, 0, 1),
	(25, 22, 'پرسنل سالن', 'staffs', 0, NULL, 'fa-circle', 10, 0, 1),
	(29, 22, 'وضعیت های خدمت', 'status/service', 0, NULL, 'fa-circle', 12, 0, 1),
	(31, 22, 'آیتم های امتیازبندی', 'ratings', 0, NULL, 'fa-circle', 13, 0, 1),
	(33, 3, 'افزودن مطلب جدید', 'blog/new', 0, NULL, 'fa-plus-square', 6, 0, 1),
	(34, 3, 'مدیریت مطالب', 'blog', 0, NULL, 'fa-circle', 7, 0, 1),
	(35, 3, 'دسته بندی ها', 'categories/blog', 0, NULL, 'fa-th-list', 8, 0, 1),
	(36, 3, 'مدیریت منابع', 'sources', 0, NULL, 'fa-hdd-o', 9, 0, 1),
	(37, 3, 'کلمات کلیدی', 'tags', 0, NULL, 'fa-tags', 10, 0, 1),
	(38, 4, 'افزودن برگه جدید', 'pages/new', 0, NULL, 'fa-plus-square', 14, 0, 1),
	(39, 4, 'مدیریت برگه ها', 'pages', 0, NULL, 'fa-circle', 15, 0, 1),
	(83, 81, 'شهرها', 'cities', 0, NULL, 'fa-circle', 21, 0, 1),
	(42, 6, 'پشتیبانی', 'support', 1, 'newContact#', 'fa-support', 10, 0, 1),
	(43, 6, 'نظرات', 'comments', 1, 'newComments#', 'fa-comment', 11, 0, 1),
	(82, 81, 'استان ها', 'provinces', 0, NULL, 'fa-circle', 20, 0, 1),
	(45, 7, 'ثبت دریافتی جدید', 'payment/add', 0, NULL, 'fa-plus-square', 11, 0, 1),
	(46, 7, 'دریافتی‌های ثبت شده', 'payment', 0, NULL, 'fa-circle', 12, 0, 1),
	(47, 7, 'ثبت هزینه جدید', 'cost/add', 0, NULL, 'fa-minus-square', 13, 0, 1),
	(48, 7, 'هزینه‌های ثبت شده', 'cost', 0, NULL, 'fa-circle', 14, 0, 1),
	(49, 7, 'بانکداری', '-', 0, NULL, 'fa-bank', 15, 0, 1),
	(50, 49, 'حساب های بانکی', '-', 0, NULL, 'fa-credit-card', 16, 0, 1),
	(51, 50, 'افزودن حساب جدید', 'accounts/add', 0, NULL, 'fa-plus-square', 17, 0, 1),
	(52, 50, 'لیست حساب ها', 'accounts', 0, NULL, 'fa-circle', 18, 0, 1),
	(53, 49, 'صندوق ها', '-', 0, NULL, 'fa-money', 17, 0, 1),
	(54, 53, 'افزودن صندوق جدید', 'cash/add', 0, NULL, 'fa-plus-square', 18, 0, 1),
	(55, 53, 'لیست صندوق ها', 'cash', 0, NULL, 'fa-circle', 19, 0, 1),
	(56, 49, 'تنخواه گردان ها', 'pettyCash', 0, NULL, 'fa-briefcase', 18, 0, 1),
	(57, 7, 'دسته بندی هزینه ها', 'costCategory', 0, NULL, 'fa-tags', 16, 0, 1),
	(61, 10, 'پوسته', 'theme', 0, NULL, 'fa-circle', 15, 0, 1),
	(62, 10, 'اسلایدر', 'slider', 0, NULL, 'fa-circle', 14, 0, 1),
	(63, 10, 'بنرهای تبلیغاتی', 'banners', 0, NULL, 'fa-circle', 16, 0, 1),
	(64, 94, 'مدیریت هدر', 'menu/header', 0, NULL, 'fa-circle', 19, 0, 1),
	(65, 94, 'مدیریت فوتر', 'menu/footer', 0, NULL, 'fa-circle', 20, 0, 1),
	(66, 94, 'مدیریت منوی پنل مدیریت', 'menu/sidebar', 0, NULL, 'fa-circle', 21, 0, 1),
	(67, 10, 'آیکون ها و نمادها', 'icons', 0, NULL, 'fa-circle', 17, 0, 1),
	(68, 11, 'ثبت سوال جدید', 'faq/add', 0, NULL, 'fa-plus-square', 14, 0, 1),
	(69, 11, 'سوالات ثبت شده', 'faq', 0, NULL, 'fa-circle', 15, 0, 1),
	(70, 13, 'پیکربندی', 'businessInformation', 0, NULL, 'fa-circle', 18, 0, 1),
	(71, 93, 'کارکنان', '-', 0, NULL, 'fa-user-secret', 8, 0, 1),
	(72, 71, 'مدیریت کارکنان', 'admins', 0, NULL, 'fa-circle', 10, 0, 1),
	(73, 71, 'نقش ها و دسترسی ها', 'admins/roles', 0, NULL, 'fa-circle', 9, 0, 1),
	(74, 71, 'سوابق فعالیت کارکنان', 'admins/activity', 0, NULL, 'fa-circle', 11, 0, 1),
	(75, 6, 'موضوعات پیام های پشتیبانی', 'contactSubject', 0, NULL, 'fa-circle', 12, 0, 1),
	(76, 22, 'مدیریت روزهای تعطیل', 'holidays', 0, NULL, 'fa-circle', 11, 0, 1),
	(77, 7, 'صورتحساب سفارشات', 'accounting', 0, NULL, 'fa-circle', 17, 0, 0),
	(79, 0, 'جست و جو های پرتکرار', 'searches', 0, NULL, 'fa-search', 14, 0, 1),
	(93, 0, 'کاربران', '-', 0, NULL, 'fa-users', 6, 0, 1),
	(94, 10, 'منوها', '-', 1, NULL, 'fa-bars', 18, 0, 1),
	(96, 4, 'ریدایرکت صفحات', 'redirect', 0, NULL, 'fa-exchange', 16, 0, 1),
	(97, 0, 'تقویم کاری', 'calendar', 0, '', 'fa-calendar', 3, 0, 1),
	(98, 13, 'راه های ارتباطی', 'methodsContacting', 0, NULL, 'fa-circle', 18, 0, 1),
	(99, 13, 'مدیریت لایسنس برنامه', 'license', 0, NULL, 'fa-circle', 18, 0, 1);
/*!40000 ALTER TABLE `tbl_sidebar` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_sidebar_access_list
CREATE TABLE IF NOT EXISTS `tbl_sidebar_access_list` (
  `sal_id` int NOT NULL AUTO_INCREMENT,
  `sidebar_id_main_part` int NOT NULL COMMENT 'آیدی منوی اصلی',
  `sidebar_menu_id` int NOT NULL COMMENT 'آیدی لینک مورد نظر در جدول sidebar',
  `sidebar_id_part` int NOT NULL COMMENT 'آیدی منویی که لینک در آن نمایش داده شود',
  `sal_title` varchar(100) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `sal_permisson` varchar(100) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `sal_status` tinyint DEFAULT '1',
  PRIMARY KEY (`sal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_sidebar_access_list: ~187 rows (approximately)
DELETE FROM `tbl_sidebar_access_list`;
INSERT INTO `tbl_sidebar_access_list` (`sal_id`, `sidebar_id_main_part`, `sidebar_menu_id`, `sidebar_id_part`, `sal_title`, `sal_permisson`, `sal_status`) VALUES
	(1, 2, 14, 15, 'ثبت نوبت جدید', 'service_reservation_add', 1),
	(2, 2, 15, 15, 'مشاهده لیست', 'service_reservation_list_view', 1),
	(3, 2, 15, 15, 'ویرایش اطلاعات سرویس و زمان رزرو', 'service_reservation_details_info_edit', 1),
	(4, 2, 15, 15, 'حذف نوبت', 'service_reservation_delete', 1),
	(5, 2, 15, 15, 'مشاهده جزئیات نوبت', 'service_reservation_details_view', 1),
	(7, 2, 15, 15, 'ارسال پیامک به کاربر', 'service_reservation_status_info_send_sms', 1),
	(8, 2, 16, 17, 'افزودن خدمت جدید', 'service_add', 1),
	(9, 2, 17, 17, 'مشاهده لیست خدمات', 'service_list_view', 1),
	(10, 2, 17, 17, 'ویرایش اطلاعات خدمت', 'service_info_edit', 1),
	(11, 2, 17, 17, 'حدف خدمت', 'service_delete', 1),
	(12, 2, 17, 17, 'ویرایش اطلاعات زمانبندی خدمت', 'service_timing_info_edit', 1),
	(13, 2, 17, 17, 'ویرایش اطلاعات تعرفه خدمت', 'service_tariff_info_edit', 1),
	(14, 2, 17, 17, 'ارسال اطلاعات خدمت در تلگرام', 'service_info_telegram_send', 1),
	(15, 2, 22, 23, 'مشاهده لیست شعبه ها', 'service_branch_list_view', 1),
	(16, 2, 22, 23, 'ویرایش اطلاعات شعبه', 'service_branch_info_edit', 1),
	(17, 2, 22, 23, 'حذف شعبه', 'service_branch_delete', 1),
	(18, 2, 22, 23, 'افزودن شعبه جدید', 'service_branch_add', 1),
	(19, 2, 22, 24, 'مشاهده لیست انبارها', 'service_storeroom_list_view', 1),
	(20, 2, 22, 24, 'افزودن انبار جدید', 'service_storeroom_add', 1),
	(21, 2, 22, 24, 'ویرایش اطلاعات انبار', 'service_storeroom_info_edit', 1),
	(22, 2, 22, 24, 'حذف انبار', 'service_storeroom_delete', 1),
	(23, 2, 22, 24, 'مشاهده کالاهای انبار', 'service_storeroom_products_list_view', 1),
	(24, 2, 22, 24, 'ثبت کالای جدید', 'service_product_add', 1),
	(25, 2, 22, 24, 'ویرایش اطلاعات کالا', 'service_product_info_edit', 1),
	(26, 2, 22, 24, 'حذف کالا', 'service_product_delete', 1),
	(27, 2, 22, 24, 'ویرایش موجودی کالا', 'service_inventory_product_edit', 1),
	(28, 2, 22, 25, 'مشاهده لیست پرسنل', 'service_staff_list_view', 1),
	(29, 2, 22, 25, 'افزودن پرسنل جدید', 'service_staff_add', 1),
	(30, 2, 22, 25, 'ویرایش اطلاعات پرسنل', 'service_staff_info_edit', 1),
	(31, 2, 22, 25, 'حذف پرسنل', 'service_staff_delete', 1),
	(32, 2, 22, 25, 'لیست کارهای انجام شده پرسنل', 'service_staff_service_list_view', 1),
	(33, 2, 22, 25, 'ویرایش وضعیت پرداخت کارهای پرسنل', 'service_staff_status_payment_edit', 1),
	(34, 2, 22, 29, 'مشاهده لیست وضعیت های خدمت', 'service_status_list_view', 1),
	(35, 2, 22, 29, 'افزودن وضعیت جدید', 'service_status_add', 1),
	(36, 2, 22, 29, 'ویرایش اطلاعات وضعیت', 'service_status_info_edit', 1),
	(37, 2, 22, 29, 'حذف وضعیت', 'service_status_delete', 1),
	(38, 2, 22, 31, 'مشاهده لیست آیتم های امتیازبندی', 'service_rating_list_view', 1),
	(39, 2, 22, 31, 'افزودن آیتم جدید', 'service_rating_add', 1),
	(40, 2, 22, 31, 'ویرایش اطلاعات آیتم امتیازبندی', 'service_rating_info_edit', 1),
	(41, 2, 22, 31, 'حذف آیتم امتیازبندی', 'service_rating_delete', 1),
	(42, 2, 22, 31, 'ویرایش وضعیت آیتم امتیازبندی', 'service_rating_status_edit', 1),
	(43, 2, 22, 76, 'مشاهده لیست روزهای تعطیل', 'service_holidays_list_view', 1),
	(44, 2, 22, 76, 'افزودن تاریخ جدید', 'service_holidays_add', 1),
	(45, 2, 22, 76, 'ویرایش تاریخ', 'service_holidays_edit', 1),
	(46, 2, 22, 76, 'حذف تاریخ', 'service_holidays_delete', 1),
	(48, 1, 1, 1, 'مشاهده داشبورد', 'dashboard_view', 1),
	(49, 97, 97, 97, 'مشاهده تقویم کاری', 'calendar_view', 1),
	(50, 20, 20, 20, 'مشاهده لیست کارت ها', 'gift_cart_list_view', 1),
	(51, 20, 20, 20, 'افزودن کارت جدید', 'gift_cart_add', 1),
	(52, 20, 20, 20, 'ویرایش کارت', 'gift_cart_edit', 1),
	(53, 20, 20, 20, 'حذف کارت', 'gift_cart_delete', 1),
	(83, 3, 33, 34, 'افزودن مطلب جدید', 'blog_add', 1),
	(84, 3, 34, 34, 'مشاهده لیست مطالب', 'blog_list_view', 1),
	(85, 3, 34, 34, 'ویرایش وضعیت و جزئیات مطلب', 'blog_status_info_edit', 1),
	(86, 3, 34, 34, 'حدف مطلب', 'blog_delete', 1),
	(87, 3, 34, 34, 'ارسال اطلاعات مطلب در تلگرام', 'blog_info_telegram_send', 1),
	(88, 3, 35, 35, 'مشاهده لیست دسته بندی', 'blog_category_list_view', 1),
	(89, 3, 35, 35, 'افزودن دسته بندی جدید', 'blog_category_add', 1),
	(90, 3, 35, 35, 'ویرایش اطلاعات دسته بندی', 'blog_category_edit', 1),
	(91, 3, 35, 35, 'حذف دسته بندی', 'blog_category_delete', 1),
	(92, 3, 36, 36, 'مشاهده لیست منابع', 'blog_source_list_view', 1),
	(93, 3, 36, 36, 'افزودن منبع جدید', 'blog_source_add', 1),
	(94, 3, 36, 36, 'ویرایش اطلاعات منبع', 'blog_source_edit', 1),
	(95, 3, 36, 36, 'حذف منبع', 'blog_source_delete', 1),
	(96, 3, 37, 37, 'مشاهده لیست کلمات کلیدی', 'blog_tag_list_view', 1),
	(97, 3, 37, 37, 'افزودن کلمه کلیدی جدید', 'blog_tag_add', 1),
	(98, 3, 37, 37, 'ویرایش کلمه کلیدی', 'blog_tag_edit', 1),
	(99, 3, 37, 37, 'حذف کلمه کلیدی', 'blog_tag_delete', 1),
	(100, 93, 5, 5, 'مشاهده لیست مشتریان', 'users_list_view', 1),
	(101, 93, 5, 5, 'مشاهده اطلاعات مشتری', 'users_info_view', 1),
	(102, 93, 5, 5, 'افزودن مشتری جدید', 'users_add', 1),
	(103, 93, 5, 5, 'ویرایش اطلاعات مشتری', 'users_edit', 1),
	(104, 93, 5, 5, 'حذف مشتری', 'users_delete', 1),
	(105, 93, 71, 73, 'مشاهده لیست نقش ها', 'admin_roles_list_view', 1),
	(106, 93, 71, 73, 'افزودن نقش جدید', 'admin_roles_add', 1),
	(107, 93, 71, 73, 'ویرایش وضعیت و جزئیات نقش', 'admin_roles_status_info_edit', 1),
	(108, 93, 71, 73, 'حذف نقش', 'admin_roles_delete', 1),
	(109, 93, 71, 72, 'مشاهده لیست کارکنان', 'admin_list_view', 1),
	(110, 93, 71, 72, 'افزودن فرد جدید', 'admin_add', 1),
	(111, 93, 71, 72, 'ویرایش وضعیت و جزئیات افراد', 'admin_status_info_edit', 1),
	(112, 93, 71, 72, 'حذف فرد', 'admin_delete', 1),
	(113, 93, 71, 74, 'مشاهده لیست سوابق فعالیت ها', 'admin_activity_list_view', 1),
	(114, 19, 19, 19, 'مشاهده لیست کدها', 'discount_list_view', 1),
	(115, 19, 19, 19, 'افزودن کد جدید', 'discount_add', 1),
	(116, 19, 19, 19, 'ویرایش کد', 'discount_edit', 1),
	(117, 19, 19, 19, 'حذف کد', 'discount_delete', 1),
	(118, 19, 19, 19, 'مشاهده لیست کاربران استفاده کننده کدها', 'discount_users_use_list_view', 1),
	(119, 6, 42, 42, 'مشاهده لیست پیام ها', 'support_list_view', 1),
	(120, 6, 42, 42, 'حذف پیام', 'support_delete', 1),
	(121, 6, 42, 42, 'تایید پیام', 'support_confirm', 1),
	(122, 6, 43, 43, 'مشاهده لیست نظرات', 'comment_list_view', 1),
	(123, 6, 43, 43, 'ویرایش وضعیت نظر', 'comment_status_edit', 1),
	(124, 6, 43, 43, 'حذف نظر', 'comment_delete', 1),
	(125, 6, 43, 43, 'پاسخ به نظر', 'comment_reply', 1),
	(126, 6, 43, 43, 'تایید نظر', 'comment_confirm', 1),
	(127, 6, 75, 75, 'مشاهده لیست موضوعات', 'contact_subject_list_view', 1),
	(128, 6, 75, 75, 'افزودن موضوع جدید', 'contact_subject_add', 1),
	(129, 6, 75, 75, 'ویرایش وضعیت و جزئیات موضوع', 'contact_subject_status_info_edit', 1),
	(130, 6, 75, 75, 'حذف موضوع', 'contact_subject_delete', 1),
	(131, 7, 45, 46, 'ثبت دریافتی جدید', 'payment_add', 1),
	(132, 7, 46, 46, 'مشاهده لیست دریافتی ها', 'payment_list_view', 1),
	(133, 7, 46, 46, 'ویرایش اطلاعات دریافتی', 'payment_edit', 1),
	(134, 7, 46, 46, 'حذف دریافتی', 'payment_delete', 1),
	(135, 7, 47, 48, 'ثبت هزینه جدید', 'cost_add', 1),
	(136, 7, 48, 48, 'مشاهده لیست هزینه ها', 'cost_list_view', 1),
	(137, 7, 48, 48, 'ویرایش اطلاعات هزینه', 'cost_edit', 1),
	(138, 7, 48, 48, 'حذف هزینه', 'cost_delete', 1),
	(139, 7, 52, 50, 'مشاهده لیست حساب های بانکی', 'account_list_view', 1),
	(140, 7, 51, 50, 'افزودن حساب جدید', 'account_add', 1),
	(141, 7, 52, 50, 'ویرایش وضعیت و اطلاعات حساب', 'account_status_info_edit', 1),
	(142, 7, 52, 50, 'حذف حساب', 'account_delete', 1),
	(143, 7, 52, 50, 'مشاهده لیست گردش حساب', 'account_transactions_list_view', 1),
	(144, 7, 55, 53, 'مشاهده لیست صندوق ها', 'cash_list_view', 1),
	(145, 7, 54, 53, 'افزودن صندوق جدید', 'cash_add', 1),
	(146, 7, 55, 53, 'ویرایش وضعیت و اطلاعات صندوق', 'cash_status_info_edit', 1),
	(147, 7, 55, 53, 'حذف صندوق', 'cash_delete', 1),
	(148, 7, 55, 53, 'مشاهده لیست گردش حساب', 'cash_transactions_list_view', 1),
	(149, 7, 49, 56, 'مشاهده لیست تنخواه گردان ها', 'petty_cash_list_view', 1),
	(150, 7, 49, 56, 'افزودن تنخواه گردان جدید', 'petty_cash_add', 1),
	(151, 7, 49, 56, 'ویرایش وضعیت و اطلاعات تنخواه گردان', 'petty_cash_status_info_edit', 1),
	(152, 7, 49, 56, 'حذف تنخواه گردان', 'petty_cash_delete', 1),
	(153, 7, 57, 57, 'مشاهده لیست دسته بندی', 'cost_category_list_view', 1),
	(154, 7, 57, 57, 'افزودن دسته بندی جدید', 'cost_category_add', 1),
	(155, 7, 57, 57, 'ویرایش اطلاعات دسته بندی', 'cost_category_edit', 1),
	(156, 7, 57, 57, 'حذف دسته بندی', 'cost_category_delete', 1),
	(158, 10, 38, 39, 'افزودن برگه جدید', 'page_add', 1),
	(159, 10, 39, 39, 'مشاهده لیست برگه ها', 'page_list_view', 1),
	(160, 10, 39, 39, 'ویرایش وضعیت و اطلاعات برگه', 'page_status_info_edit', 1),
	(161, 10, 39, 39, 'حذف برگه', 'page_delete', 1),
	(162, 10, 39, 96, 'مشاهده لیست ریدایرکت ها', 'redirect_list_view', 1),
	(163, 10, 39, 96, 'افزودن لینک جدید', 'redirect_add', 1),
	(164, 10, 39, 96, 'ویرایش وضعیت و اطلاعات لینک', 'redirect_status_info_edit', 1),
	(165, 10, 39, 96, 'حذف لینک', 'redirect_delete', 1),
	(166, 10, 62, 62, 'مشاهده لیست اسلایدرها', 'slider_list_view', 1),
	(167, 10, 62, 62, 'افزودن اسلایدر جدید', 'slider_add', 1),
	(168, 10, 62, 62, 'ویرایش وضعیت و اطلاعات اسلایدر', 'slider_status_info_edit', 1),
	(169, 10, 62, 62, 'حذف اسلایدر', 'slider_delete', 1),
	(170, 10, 62, 62, 'مشاهده لیست تصاویر اسلایدر', 'slider_image_list_view', 1),
	(171, 10, 62, 62, 'افزودن تصویر جدید', 'slider_image_add', 1),
	(172, 10, 62, 62, 'ویرایش وضعیت و اطلاعات تصویر', 'slider_image_status_info_edit', 1),
	(173, 10, 62, 62, 'حذف تصویر', 'slider_image_delete', 1),
	(174, 10, 61, 61, 'مشاهده لیست پوسته ها', 'theme_view', 1),
	(175, 10, 61, 61, 'تغییر پوسته', 'theme_change', 1),
	(176, 10, 63, 63, 'مشاهده لیست بنرهای تبلیغاتی', 'banner_list_view', 1),
	(177, 10, 63, 63, 'افزودن بنر جدید', 'banner_add', 1),
	(178, 10, 63, 63, 'ویرایش وضعیت و اطلاعات بنر', 'banner_status_info_edit', 1),
	(179, 10, 63, 63, 'حذف بنر', 'banner_delete', 1),
	(180, 10, 63, 63, 'مشاهده لیست تصاویر بنر', 'banner_image_list_view', 1),
	(181, 10, 63, 63, 'افزودن تصویر جدید', 'banner_image_add', 1),
	(182, 10, 63, 63, 'ویرایش وضعیت و اطلاعات تصویر', 'banner_image_status_info_edit', 1),
	(183, 10, 63, 63, 'حذف تصویر', 'banner_image_delete', 1),
	(184, 10, 94, 64, 'مشاهده لینک های هدر', 'menu_header_list_view', 1),
	(185, 10, 94, 64, 'افزودن لینک جدید', 'menu_header_add', 1),
	(186, 10, 94, 64, 'ویرایش وضعیت و اطلاعات لینک', 'menu_header_status_info_edit', 1),
	(187, 10, 94, 64, 'حذف لینک', 'menu_header_delete', 1),
	(188, 10, 94, 65, 'مشاهده لینک های فوتر', 'menu_footer_list_view', 1),
	(189, 10, 94, 65, 'افزودن لینک جدید', 'menu_footer_add', 1),
	(190, 10, 94, 65, 'ویرایش وضعیت و اطلاعات لینک', 'menu_footer_status_info_edit', 1),
	(191, 10, 94, 65, 'حذف لینک', 'menu_footer_delete', 1),
	(192, 10, 94, 66, 'مشاهده لینک های سایدبار', 'menu_sidebar_list_view', 1),
	(193, 10, 94, 66, 'افزودن لینک جدید', 'menu_sidebar_add', 1),
	(194, 10, 94, 66, 'ویرایش وضعیت و اطلاعات لینک', 'menu_sidebar_status_info_edit', 1),
	(195, 10, 67, 67, 'مشاهده لیست آیکون ها', 'icon_list_view', 1),
	(196, 10, 67, 67, 'افزودن آیکون جدید', 'icon_add', 1),
	(197, 10, 67, 67, 'ویرایش وضعیت و اطلاعات آیکون ', 'icon_status_info_edit', 1),
	(198, 10, 67, 67, 'حذف آیکون ', 'icon_delete', 1),
	(199, 11, 69, 69, 'مشاهده لیست سوالات', 'faq_list_view', 1),
	(200, 11, 68, 69, 'افزودن سوال جدید', 'faq_add', 1),
	(201, 11, 69, 69, 'ویرایش وضعیت و اطلاعات سوال', 'faq_status_info_edit', 1),
	(202, 11, 69, 69, 'حذف سوال', 'faq_delete', 1),
	(203, 79, 79, 79, 'مشاهده لیست جستجوهای پرتکرار', 'search_list_view', 1),
	(204, 79, 79, 79, 'افزودن عبارت جدید', 'search_add', 1),
	(205, 79, 79, 79, 'ویرایش وضعیت عبارت ', 'search_status_edit', 1),
	(206, 12, 12, 12, 'مشاهده لیست فایل ها', 'file_manager_list_view', 1),
	(210, 13, 70, 70, 'مشاهده و ویرایش پیکربندی', 'business_information_view_edit', 1),
	(211, 13, 81, 82, 'مشاهده لیست استان ها', 'province_list_view', 1),
	(212, 13, 81, 82, 'افزودن استان جدید', 'province_add', 1),
	(213, 13, 81, 82, 'ویرایش وضعیت و اطلاعات استان', 'province_status_info_edit', 1),
	(214, 13, 81, 82, 'حذف استان', 'province_delete', 1),
	(215, 13, 81, 83, 'مشاهده لیست شهرها', 'city_list_view', 1),
	(216, 13, 81, 83, 'افزودن شهر جدید', 'city_add', 1),
	(217, 13, 81, 83, 'ویرایش وضعیت و اطلاعات شهر', 'city_status_info_edit', 1),
	(218, 13, 81, 83, 'حذف شهر', 'city_delete', 1),
	(219, 19, 19, 19, 'حذف کاربران استفاده کننده کدها', 'discount_users_use_delete', 1),
	(221, 79, 79, 79, 'حذف عبارت', 'search_delete', 1),
	(222, 1, 1, 1, 'مشاهده آمار پنل پیامک', 'dashboard_sms_info_view', 1),
	(223, 13, 98, 98, 'مشاهده و ویرایش شبکه های اجتماعی', 'methods_contacting_view_edit', 1),
	(224, 13, 99, 99, 'فعالسازی لایسنس', 'license_view', 1);

-- Dumping structure for table reservation.tbl_slider
CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_title` varchar(250) NOT NULL,
  `s_type` int NOT NULL DEFAULT '0',
  `s_create_date` varchar(30) NOT NULL,
  `s_status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_slider: 0 rows
DELETE FROM `tbl_slider`;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_slider_image
CREATE TABLE IF NOT EXISTS `tbl_slider_image` (
  `si_id` int NOT NULL AUTO_INCREMENT,
  `slider_id` int NOT NULL,
  `si_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `si_link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `si_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `si_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`si_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- Dumping data for table reservation.tbl_slider_image: ~0 rows (approximately)
DELETE FROM `tbl_slider_image`;

-- Dumping structure for table reservation.tbl_sources
CREATE TABLE IF NOT EXISTS `tbl_sources` (
  `so_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `link` varchar(1000) DEFAULT '#',
  `image` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `date` varchar(200) NOT NULL,
  `date_edit` varchar(200) NOT NULL DEFAULT '-',
  `user_id_edit` varchar(200) NOT NULL DEFAULT '-',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`so_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_sources: ~0 rows (approximately)
DELETE FROM `tbl_sources`;

-- Dumping structure for table reservation.tbl_status
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'sale',
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `code` int DEFAULT NULL,
  `show_in_status` tinyint DEFAULT '1',
  `show_in_sms` tinyint DEFAULT '1',
  `percent` int DEFAULT '0',
  `background_color` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `removable` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- Dumping data for table reservation.tbl_status: ~8 rows (approximately)
DELETE FROM `tbl_status`;
INSERT INTO `tbl_status` (`id`, `type`, `title`, `text`, `code`, `show_in_status`, `show_in_sms`, `percent`, `background_color`, `removable`, `status`) VALUES
	(1, 'service', 'در انتظار تایید', 'خدمت [SERVICE] برای روز [DATE] برای شما رزرو و در انتظار تایید ادمین می باشد.\r\nمبلغ پرداختی: [PRICE] تومان\r\nشماره پیگیری: [RCODE]\r\n\r\n[BNAME]', NULL, 1, 1, 10, 'blue', 0, 1),
	(2, 'service', 'تایید شده', 'سفارش شما با کد پیگیری [RCODE] تایید شد.\r\nباتشکر\r\n[BNAME]', NULL, 1, 1, 30, 'green', 0, 1),
	(3, 'service', 'در انتظار پرداخت', 'سفارش شما با کد [RCODE] در انتظار پرداخت می باشد.\r\nلطفا در صورت تمایل به تکمیل رزرو پرداخت را انجام دهید.\r\nباتشکر\r\n[BNAME]', NULL, 1, 1, 40, 'blue', 0, 1),
	(4, 'service', 'پرداخت شده', 'هزینه سفارش شما با کد پیگیری [RCODE] باموفقیت پرداخت شد!\r\nباتشکر\r\n[BNAME]', NULL, 1, 1, 50, 'yellow', 0, 1),
	(5, 'service', 'انجام شده', 'سفارش شما با کد پیگیری [RCODE] باموفقیت انجام داده شد!\r\nباتشکر\r\n[BNAME]', NULL, 1, 1, 100, 'green', 0, 1),
	(6, 'service', 'لغو شده', 'سفارش شما با کد پیگیری [RCODE] به علت عدم پاسخگویی لغو گردید.\r\n[BNAME]', NULL, 1, 1, 100, 'red', 0, 1),
	(7, 'service', 'یادآوری زمان رزرو شده', '[DATE] جهت انجام خدمت [SERVICE] در سالن منتظر شما دوست عزیز هستیم.\r\n[NAME]', NULL, 0, 1, 0, NULL, 0, 1),
	(8, 'service', 'کد پیگیری درخواست', 'کد پیگیری درخواست رزرو شما [RCODE] می‌باشد.\r\nباتشکر\r\n[BNAME]', NULL, 0, 1, 0, NULL, 0, 1);

-- Dumping structure for table reservation.tbl_storeroom
CREATE TABLE IF NOT EXISTS `tbl_storeroom` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `storeroom_vids_id` varchar(100) NOT NULL,
  `branch_id` int NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_storekeeper` varchar(200) NOT NULL,
  `s_date` varchar(50) DEFAULT NULL,
  `s_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_storeroom: 1 rows
DELETE FROM `tbl_storeroom`;
/*!40000 ALTER TABLE `tbl_storeroom` DISABLE KEYS */;
INSERT INTO `tbl_storeroom` (`s_id`, `storeroom_vids_id`, `branch_id`, `s_name`, `s_storekeeper`, `s_date`, `s_status`) VALUES
	(1, '1000', 1000, 'انبار مرکزی', 'مدیر اصلی', '1401/12/19', 1);
/*!40000 ALTER TABLE `tbl_storeroom` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_storeroom_product
CREATE TABLE IF NOT EXISTS `tbl_storeroom_product` (
  `sr_id` int NOT NULL AUTO_INCREMENT,
  `product_vids_id` varchar(100) NOT NULL,
  `storeroom_id` int NOT NULL,
  `sr_name` varchar(1000) NOT NULL,
  `sr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`sr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reservation.tbl_storeroom_product: 0 rows
DELETE FROM `tbl_storeroom_product`;
/*!40000 ALTER TABLE `tbl_storeroom_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_storeroom_product` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_storeroom_product_inventory
CREATE TABLE IF NOT EXISTS `tbl_storeroom_product_inventory` (
  `spi_id` int NOT NULL AUTO_INCREMENT,
  `storeroom_id` int NOT NULL,
  `product_id` int NOT NULL,
  `spi_total_inventory` int NOT NULL DEFAULT '0',
  `spi_count` int NOT NULL DEFAULT '0',
  `spi_create_date` varchar(50) NOT NULL,
  `spi_purchase_date` varchar(50) NOT NULL,
  `spi_existing_completion_date` varchar(50) DEFAULT NULL,
  `spi_status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`spi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_storeroom_product_inventory: 0 rows
DELETE FROM `tbl_storeroom_product_inventory`;
/*!40000 ALTER TABLE `tbl_storeroom_product_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_storeroom_product_inventory` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_tags
CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(1000) NOT NULL,
  `user_id` int NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `date` varchar(200) NOT NULL,
  `date_edit` varchar(200) NOT NULL DEFAULT '-',
  `user_id_edit` varchar(200) NOT NULL DEFAULT '-',
  `type` int NOT NULL COMMENT 'news=1;shop=2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_tags: ~0 rows (approximately)
DELETE FROM `tbl_tags`;

-- Dumping structure for table reservation.tbl_template
CREATE TABLE IF NOT EXISTS `tbl_template` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `t_part` enum('dashboard','main') CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `t_href` varchar(50) DEFAULT NULL,
  `t_title` varchar(250) NOT NULL,
  `t_show_title` tinyint DEFAULT '0',
  `t_description` varchar(1000) DEFAULT NULL,
  `t_help_txt` varchar(1000) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `t_image` varchar(100) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
  `t_theme` varchar(20) NOT NULL DEFAULT 'default',
  `t_is_custom` tinyint DEFAULT '0',
  `t_is_default_widget` tinyint DEFAULT '0',
  `t_status` int NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_template: 19 rows
DELETE FROM `tbl_template`;
/*!40000 ALTER TABLE `tbl_template` DISABLE KEYS */;
INSERT INTO `tbl_template` (`t_id`, `t_part`, `t_href`, `t_title`, `t_show_title`, `t_description`, `t_help_txt`, `t_image`, `t_theme`, `t_is_custom`, `t_is_default_widget`, `t_status`) VALUES
  (16, 'dashboard', 'clock2', 'ساعت آنالوگ 2', 0, NULL, 'نمایش ساعت فعلی', 'clock2.png', 'default', 0, 0, 1),
  (13, 'dashboard', 'last_users_register', 'آخرین مشتریان ثبت شده', 0, NULL, 'در این قسمت لیست آخرین مشتریان ثبت شده نمایش داده می شود.', 'last-user-register.png', 'default', 0, 1, 1),
  (14, 'dashboard', 'last_blog_article', 'آخرین مطالب وبلاگ', 0, NULL, 'در این قسمت لیست جدیدترین اخبار و اطلاعیه های سامانه نمایش داده می شود.', 'last-blog-article.png', 'default', 0, 1, 1),
  (12, 'dashboard', 'last_activity', 'آخرین فعالیت های شما', 0, NULL, 'در این قسمت لیست آخرین فعالیت هایی که انجام داده اید نمایش داده می شود. برای مشاهده لیست کامل فعالیت ها می توانید به بخش سوابق فعالیت کارکنان مراجعه نمایید.', 'last-activity.png', 'default', 0, 1, 1),
  (11, 'dashboard', 'chart_reservation_this_month', 'نمودار نوبت‌های رزرو شده در ماه', 0, NULL, 'در این قسمت تعمیرات ثبت شده در هر ماه به صورت روزانه نمایش داده می شود. برای مشاهده نمودار در حالات مختلف و گرفتن خروجی می توانید از دکمه های سمت راست استفاده نمایید. همچنین برای مشاهده بازه های مختلف می توانید به بخش گزارش مالی مراجعه نمایید.', 'reservation-chart.png', 'default', 0, 1, 1),
  (10, 'dashboard', 'credit_sms_panel', 'اعتبار پنل پیامک', 0, NULL, 'در این قسمت تعداد روزهای باقیمانده از اشتراک شما نمایش داده می شود. برای تمدید/ارتقا اشتراک می توانید از دکمه اطلاعات بیشتر استفاده نمایید.', 'credit-sms-panel.png', 'default', 0, 1, 1),
  (4, 'main', 'banner', 'بنر تبلیغاتی', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (3, 'main', 'service', 'خدمات', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (5, 'main', 'comment', 'نظرات مشتریان', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (2, 'main', 'blog', 'مطالب وبلاگ', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (6, 'main', 'socialmedia', 'شبکه های اجتماعی', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (7, 'main', 'textArea', 'متن', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (8, 'dashboard', 'count_reservation_this_month', 'تعداد نوبت‌های ماه', 0, NULL, 'در این قسمت تعداد تعمیرات ثبت شده در هر ماه نمایش داده می شود.  برای مشاهده لیست کامل تعمیرات می توانید از دکمه اطلاعات بیشتر استفاده نمایید.', 'reservation-count.png', 'default', 0, 1, 1),
  (9, 'dashboard', 'count_users_this_month', 'تعداد کابران ماه', 0, NULL, 'در این قسمت تعداد مشتری های جدید ثبت شده در هر ماه نمایش داده می شود. برای مشاهده لیست کامل مشتریان می توانید از دکمه اطلاعات بیشتر استفاده نمایید.', 'customer.png', 'default', 0, 1, 1),
  (1, 'main', 'slider', 'اسلایدر', 0, NULL, NULL, NULL, 'default', 0, 0, 1),
  (15, 'dashboard', 'clock', 'ساعت آنالوگ', 0, NULL, 'نمایش ساعت فعلی', 'clock.png', 'default', 0, 0, 1);
/*!40000 ALTER TABLE `tbl_template` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_vids
CREATE TABLE IF NOT EXISTS `tbl_vids` (
  `vids_id` int NOT NULL AUTO_INCREMENT,
  `panel_id` int NOT NULL,
  `order_service_id` varchar(1000) NOT NULL DEFAULT '1000',
  `staff_id` varchar(1000) NOT NULL DEFAULT '1000',
  `branch_id` varchar(100) NOT NULL DEFAULT '1000',
  `customer_id` varchar(100) NOT NULL DEFAULT '1000',
  `payment_id` varchar(100) NOT NULL DEFAULT '1000',
  `cost_id` varchar(100) NOT NULL DEFAULT '1000',
  `cost_category_id` varchar(100) NOT NULL DEFAULT '1000',
  `bank_id` varchar(100) NOT NULL DEFAULT '1000',
  `cash_id` varchar(100) NOT NULL DEFAULT '1000',
  `pettyCash_id` varchar(100) NOT NULL DEFAULT '1000',
  `storeroom_id` varchar(100) NOT NULL DEFAULT '1000',
  `product_id` varchar(100) NOT NULL DEFAULT '1000',
  `admin_id` varchar(100) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`vids_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table reservation.tbl_vids: 1 rows
DELETE FROM `tbl_vids`;
/*!40000 ALTER TABLE `tbl_vids` DISABLE KEYS */;
INSERT INTO `tbl_vids` (`vids_id`, `panel_id`, `order_service_id`, `staff_id`, `branch_id`, `customer_id`, `payment_id`, `cost_id`, `cost_category_id`, `bank_id`, `cash_id`, `pettyCash_id`, `storeroom_id`, `product_id`, `admin_id`) VALUES
	(1, 1000, '10000', '1000', '1001', '1000', '1000', '1000', '1001', '1000', '1001', '1001', '1001', '10000', '1001');
/*!40000 ALTER TABLE `tbl_vids` ENABLE KEYS */;

-- Dumping structure for table reservation.tbl_view
CREATE TABLE IF NOT EXISTS `tbl_view` (
  `v_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `type` varchar(30) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table reservation.tbl_view: 0 rows
DELETE FROM `tbl_view`;
/*!40000 ALTER TABLE `tbl_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_view` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
