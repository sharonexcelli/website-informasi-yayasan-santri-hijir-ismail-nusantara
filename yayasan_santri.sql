-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL COMMENT '1: SuperAdmin, 2: Pengisi Kontent,  3: Admin Alumni',
  `status` enum('0','1','99') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: Disabled, 1: Enabled, 99: deleted',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `administrator` (`id`, `email`, `password`, `name`, `image`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1,	'admin@gmail.com',	'21232f297a57a5a743894a0e4a801fc3',	'Administrator',	'https://yayasan-santri.beruangstudio.com/media/avatars/6204f852bf30f.png',	'1',	'1',	'2020-02-13 12:02:16',	'2022-02-10 14:04:41'),
(16,	'umar@gmail.com',	'21232f297a57a5a743894a0e4a801fc3',	'Umar',	'https://yayasan-santri.beruangstudio.com/media/avatars/ava-62051af369db2.png',	'1',	'1',	'2022-02-10 21:02:27',	'2022-02-10 14:06:54');

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `image_mobile` text NOT NULL,
  `status` enum('0','1','99') NOT NULL COMMENT '0: unpublish, 1:publish, 99:deleted',
  `type` enum('1','2','3','4','5','6') NOT NULL COMMENT '1. Homepage  2. News  3. Events  4. Gallery  5. Contact Us, 6. quotes',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banners` (`id`, `title`, `description`, `image`, `image_mobile`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1,	'Yayasan Santri Hijir Ismail Nusantara',	'Puji syukur kami panjatkan ke hadirat Allah SWT yang atas berkat rahmat dan hidayah-Nya kami bisa meluncurkan situs web Pondok Pesantren Hijir Ismail ini di Internet. Situs web ini bertujuan untuk memperkenalkan Hijir Ismail sebagai lembaga pendidikan dengan memanfaatkan media teknologi internet.',	'https://yayasan-santri.beruangstudio.com/media/banners/620505bb4c623.png',	'https://yayasan-santri.beruangstudio.com/media/banners/620505bb5e894.png',	'1',	'1',	'2020-07-17 11:12:37',	'2022-02-11 10:31:50'),
(2,	'Informasi Terkini Yayasan',	'Beragam informasi dan berita terbaru terkait Yayasan disajikan secara ringan dan menarik. Semua santri dapat memberikan informasi/foto/aktivitas/ link dan sebagainya untuk ditampilkan dalam website ',	'https://yayasan-santri.beruangstudio.com/media/banners/620507ac05926.png',	'https://yayasan-santri.beruangstudio.com/media/banners/620507ac05cec.png',	'1',	'2',	'2020-07-17 11:37:47',	'2022-02-10 12:40:12'),
(3,	'Coming Up Event!',	'Berbagai informasi terkait agenda acara (event) yang menarik dihimpun sebagai referensi para alumni untuk mengikutinya.',	'http://ika.uii.beruangstudio.com/media/banners/5f118db3d732c.png',	'http://ika.uii.beruangstudio.com/media/banners/5f118db3d7330.png',	'1',	'3',	'2020-07-17 11:38:27',	'2020-07-25 09:40:14'),
(4,	'Rekam Jejak Momentum',	'Temukan foto-foto dan video terbaik para Insan Ulil Albab dalam rangkuman galeri para santri.',	'http://ika.uii.beruangstudio.com/media/banners/5f118dde95803.png',	'http://ika.uii.beruangstudio.com/media/banners/5f118dde95807.png',	'1',	'4',	'2020-07-17 11:39:10',	'2022-02-10 11:59:00'),
(5,	'Punya Pertanyaan?',	'Bagi semua yang membutuhkan informasi silahkan mengisi form di bawah ini.',	'https://yayasan-santri.beruangstudio.com/media/banners/6205088aeb413.png',	'https://yayasan-santri.beruangstudio.com/media/banners/6205088aeb8ce.png',	'1',	'5',	'2020-07-17 11:39:42',	'2022-02-10 12:43:54'),
(6,	'Profil Pengajar',	'Sejumlah pengajar adalah tokoh ternama yang menjadi panutan dan tauladan. Simak kutipan yang menginspirasi dan sepak terjang perjalanan karirnya.',	'https://yayasan-santri.beruangstudio.com/media/banners/6205062de8404.png',	'https://yayasan-santri.beruangstudio.com/media/banners/6205062deb9ec.png',	'1',	'6',	'2020-08-21 07:54:44',	'2022-02-10 14:30:33');

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `id_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `image` text NOT NULL,
  `status` enum('0','1','99') NOT NULL DEFAULT '0' COMMENT '0:unpublish, 1: publish, 99:deleted',
  `mark` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:unmark, 1:mark',
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `gallerys`;
CREATE TABLE `gallerys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `media` text NOT NULL,
  `type` enum('P','V') NOT NULL COMMENT 'P: photos, V: Videos',
  `status` enum('0','1','99') NOT NULL DEFAULT '0' COMMENT '0: unpublish, 1: publish, 99:  deleted',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `management`;
CREATE TABLE `management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `position_central_office` int(11) DEFAULT NULL,
  `position_regional_office` int(11) DEFAULT NULL,
  `province_regional_office` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `social_linkedin` varchar(255) DEFAULT NULL,
  `social_twitter` varchar(255) DEFAULT NULL,
  `status` enum('0','1','99') NOT NULL COMMENT '0: Disabled, 1: Enabled, 99: deleted',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `management_position`;
CREATE TABLE `management_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('1','2') NOT NULL COMMENT '1: Pusat, 2: Wilayah',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `id_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `image_source` text NOT NULL,
  `tags` text NOT NULL,
  `status` enum('0','1','99') NOT NULL DEFAULT '0' COMMENT '0: unpublish, 1: publish, 99:  deleted',
  `mark` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: unmark, 1: marked',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `news` (`id`, `slug`, `id_author`, `title`, `content`, `image`, `image_source`, `tags`, `status`, `mark`, `published_at`, `created_at`, `updated_at`) VALUES
(1,	'ulang-tahun-pondok-bersama-santunan-222-anak-yatim-dhuafa-penghafal-qur-an-1',	1,	'Ulang Tahun Pondok Bersama Santunan 222 Anak Yatim, Dhuafa , Penghafal Qur’an',	'<p>Pada tanggal 1 Januari merupakan hari dimana pondok berdiri. Pondok pesantren Hijir Ismail mengadakan santunan kepada 222 Anak-anak yatim, dhuafa , para penghafal al-qur’an yang meliputi dari santri pondok hijir ismail serta dari bagian lingkungan pondok hijir ismail.</p>',	'https://yayasan-santri.beruangstudio.com/media/news/6204f741e899d.jpeg',	'Whatsapp',	'',	'1',	'1',	'2022-01-01 00:00:00',	'2022-02-10 18:30:09',	'2022-02-11 10:21:02'),
(2,	'santri-hijir-ismail-memperingati-hari-kemerdekaan-indonesia-2',	1,	'Santri Hijir Ismail, Memperingati Hari Kemerdekaan Indonesia ',	'<p><span xss=removed>Pada tanggal 17 Agustus 2021 kemarin pada hari selasa pagi santri Pondok Pesantren Hijir Ismail Merayakan hari kemerdekaan indonesia yang di isi dengan Upacara Bersama , Mengkibarkan Bendera merah putih, pembacaan kisah para pahlawan, dan Merayakan Lomba Hari Kemerdekaan. </span></p>',	'https://yayasan-santri.beruangstudio.com/media/news/6206384ed2a56.jpeg',	'Whatsapp',	'',	'1',	'1',	'2021-08-17 00:00:00',	'2022-02-10 18:31:27',	'2022-02-11 10:19:58'),
(3,	'ujian-terbuka-santri-rumah-tahfidz-abdullah-3',	1,	'Ujian Terbuka Santri Rumah Tahfidz Abdullah',	'<p>    Ujian Terbuka dari 5 Santri Rumah Tahfidz Abdullah Pondok Pesantren Hijir Ismail yang di saksikan oleh Para Kiyai dan Ustadz dari Mabes Baddar 313. Ujian yang diujikan terdiri dari hafalan 3 juz ( 28,29,30 ) & Hafalan Hadist Arbain An Nawawi </p>',	'https://yayasan-santri.beruangstudio.com/media/news/62063807bb531.jpeg',	'Whatsapp',	'',	'1',	'1',	'2021-09-21 00:00:00',	'2022-02-10 18:32:24',	'2022-02-11 10:18:47');

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `content` text,
  `image` text NOT NULL,
  `status` enum('0','1','99') NOT NULL DEFAULT '0' COMMENT '0: unpublish, 1: publish, 99: deleted',
  `mark` enum('0','1') DEFAULT '0' COMMENT '0: unmark, 1: marked',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `quotes` (`id`, `slug`, `name`, `profession`, `message`, `content`, `image`, `status`, `mark`, `updated_at`, `created_at`) VALUES
(11,	'ustadz-ismail-attibawy-11',	'Ustadz Ismail Attibawy',	'Kepala Pondok',	'Mencerdaskan dan Berakhlak',	'<p><br></p>',	'https://yayasan-santri.beruangstudio.com/media/avatars/6205068875058.png',	'1',	'1',	'2022-02-11 10:14:44',	'2022-02-10 19:35:20');

DROP TABLE IF EXISTS `testimonys`;
CREATE TABLE `testimonys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` text NOT NULL,
  `status` enum('0','1','99') NOT NULL DEFAULT '0' COMMENT '0: unpublish, 1: publish, 99: deleted',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `testimonys` (`id`, `name`, `profession`, `message`, `image`, `status`, `updated_at`, `created_at`) VALUES
(1,	'HW Notonegoro',	'KEPALA SEKSI INTELIJEN KANTOR IMIGRASI KELAS I KHUSUS NGURAH RAI, BALI.',	'&quot;Kerja itu yang Tata, Titi, Titis, Tatag, Tutug&quot; - Bambang Rantam',	'http://ika.uii.beruangstudio.com/media/avatars/5f1c1287b8fff.jpeg',	'99',	'2022-02-10 11:35:31',	'2020-06-16 09:59:04'),
(2,	'Tomy Ristanto',	'News Presenter',	'IKA UII emang paling jos!',	'http://ika.uii.beruangstudio.com/media/avatars/5f1c119d8e21e.jpeg',	'99',	'2022-02-10 11:35:34',	'2020-06-16 09:59:47'),
(3,	'Maftuh Ihsan',	'1 SMP',	'Nyaman menghafal karena dibawah pohon&quot; sejuk',	'https://yayasan-santri.beruangstudio.com/media/avatars/6204f98bb71e2.png',	'1',	'2022-02-11 10:28:26',	'2022-02-10 18:39:55'),
(4,	'Dendi Muhammad Rizki',	'1 SMP ',	'saya sangat senang krna ustadz dn ustadzah mendidik dengan ramah dan baik-baik',	'https://yayasan-santri.beruangstudio.com/media/avatars/6204f9a687dd0.png',	'1',	'2022-02-11 10:28:02',	'2022-02-10 18:40:22'),
(5,	'Fajar Ramadhani',	'1 SMP',	'Di pondok Hijir Ismail banyak hal baru yang menjadikan saya lebih mengerti kehidupan yang baik.',	'https://yayasan-santri.beruangstudio.com/media/avatars/6204f9c91978a.png',	'1',	'2022-02-11 10:27:46',	'2022-02-10 18:40:57');

-- 2022-07-12 15:13:23
