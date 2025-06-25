/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.1-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: tekom
-- ------------------------------------------------------
-- Server version	11.8.1-MariaDB-4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `about_us_section`
--

DROP TABLE IF EXISTS `about_us_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `about_us_section` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `about_us_description` text DEFAULT NULL,
  `vision_text` text DEFAULT NULL,
  `mission_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mission_items`)),
  `facts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facts`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_us_section`
--

LOCK TABLES `about_us_section` WRITE;
/*!40000 ALTER TABLE `about_us_section` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `about_us_section` VALUES
(2,'Tekom adalah prodi yang berdedikasi untuk menjadi yang terdepan dalam inovasi teknologi, pendidikan, dan penelitian. Kami membentuk talenta digital masa depan.','Menjadi program studi yang unggul dan terkemuka dalam menyiapkan SDM Sarjana Terapan yang profesional di bidang rekayasa cerdas pada sistem berbasis komputer modern serta berkarakter kewirausahaan untuk mendukung sektor pertanian, kelautan, dan biosains tropika pada tahun 2030.','[{\"mission_point\":\" Menyiapkan insan terdidik yang memiliki pengetahuan dan keterampilan di bidang rekayasa cerdas pada sistem berbasis komputer modern yang unggul, professional, dan berkarakter kewirausahaan di bidang pertanian, kelautan, dan biosains tropika\"},{\"mission_point\":\"Mengembangkan ilmu dan teknologi terapan di bidang rekayasa cerdas pada sistem berbasis komputer modern yang unggul untuk sektor pertanian, kelautan, dan biosains tropika\"},{\"mission_point\":\"Mengaplikasikan ilmu dan teknologi terapan di bidang rekayasa cerdas pada sistem berbasis komputer modern yang inovatif untuk peningkatan kualitas kehidupan masyarakat secara berkelanjutan\"},{\"mission_point\":\"Menjalin kerja sama dengan berbagai pihak terkait teknologi rekayasa komputer untuk peningkatan kompetensi lulusan\"}]','[{\"label\":\"Jumlah pelamar\",\"value\":\"420\"},{\"label\":\"Diterima\",\"value\":\"65\"},{\"label\":\"Ketetatan\",\"value\":\"6,46\"}]','2025-06-24 13:03:21','2025-06-24 13:39:32');
/*!40000 ALTER TABLE `about_us_section` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_status_published_at_index` (`status`,`published_at`),
  KEY `articles_category_id_index` (`category_id`),
  KEY `articles_author_id_index` (`author_id`),
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `articles` VALUES
(7,'Laravel 11 Dirilis: Fitur Baru dan Perubahan Penting','laravel-11-dirilis-fitur-baru-dan-perubahan-penting','Laravel 11 membawa banyak pembaruan termasuk peningkatan performa dan arsitektur.','<p>Laravel 11 hadir dengan berbagai fitur baru seperti streamlined bootstrap, route caching yang lebih cepat, dan banyak lagi.</p>','articles/01JYEPAHV6A1SRFG6BEFXER07S.jpg',1,3,'published','2025-06-13 15:25:23',20,'{\"tags\":[\"laravel\",\"php\",\"framework\"]}','2025-06-23 15:25:23','2025-06-24 06:43:06'),
(8,'Tips Menulis Artikel SEO untuk Developer','tips-menulis-artikel-seo-untuk-developer','Pelajari teknik penulisan artikel SEO yang efektif bagi pengembang.','<p><strong><em>Menulis artikel SEO membutuhkan pemahaman keyword, struktur heading, dan readability.&nbsp; </em></strong>&nbsp; &nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus animi quos qui labore quibusdam nihil voluptates, cumque corrupti quisquam velit voluptate, corporis similique pariatur cupiditate, optio quam doloribus. Autem veniam voluptate aut, expedita accusamus numquam architecto possimus nulla commodi ut ab quis sint quia rem soluta ducimus? Quidem rem corrupti error quae, molestiae saepe, commodi facere necessitatibus alias incidunt consequuntur cum atque. Maiores labore quibusdam, velit, sapiente eum aspernatur fugiat aperiam architecto quod non eaque at nemo ipsa, quisquam cumque laboriosam veritatis adipisci! Deleniti dolorum sit tempore labore consequatur quo. Nemo et dicta tempora quam aspernatur blanditiis itaque? Beatae unde dolor inventore vel deleniti obcaecati culpa ratione debitis expedita natus veritatis sequi, ex sit tenetur provident? Recusandae nostrum, beatae ullam nulla quos dicta laborum officia quam? Facilis repellendus cum harum quae qui aperiam exercitationem repellat. Optio, nesciunt autem quibusdam rerum harum ipsa unde similique iusto at id aliquam, dolores quas sequi deleniti? Minima quidem sint odit repudiandae laboriosam distinctio ipsum necessitatibus officiis illum inventore officia omnis incidunt nemo, vitae numquam perferendis enim harum quisquam accusantium ratione minus. Obcaecati quibusdam doloribus debitis, sequi eum sapiente nihil veritatis, quas corrupti tenetur expedita labore repudiandae distinctio perspiciatis facilis sunt alias architecto cum et praesentium magni error illo tempora soluta. Eligendi possimus quibusdam facere voluptatibus, magnam cumque molestiae officia? Porro deserunt amet quidem quas dignissimos mollitia, voluptates ducimus alias laborum minus repellat libero nobis molestias harum ipsa rem quibusdam animi dolores totam sequi cupiditate. Illo ducimus esse perspiciatis totam dignissimos nesciunt numquam dolor ipsam! Voluptatem, nesciunt! Aliquam tempore labore numquam reiciendis qui amet perferendis nam dignissimos autem, totam minus, veritatis facere possimus exercitationem voluptate. Laboriosam id sequi eligendi quibusdam facilis, excepturi, delectus, ullam voluptatem dolore rem consequuntur et quis. Ullam magnam ratione voluptatum blanditiis est quibusdam harum rem accusantium distinctio? Laboriosam, doloremque facilis ipsa sunt commodi quo, modi inventore iure error neque quia maxime quas laborum corrupti? Eligendi sunt placeat sed rem? Rem earum eveniet officiis harum veritatis sint, modi nostrum pariatur maiores in quibusdam, nisi ipsum quae eaque molestias neque corporis blanditiis ad molestiae reprehenderit porro expedita id. Dicta dignissimos itaque earum ut veritatis quod, quia quasi, amet nihil esse iste eligendi nobis assumenda ex optio placeat nam a facilis sequi ea rerum ipsa! Dicta quia at cupiditate repellat! Rerum nemo quis nobis quas dolore ea eaque, qui fuga molestias exercitationem quo aliquam alias, sunt recusandae vero nostrum vel nulla cumque a amet voluptate! Voluptas quibusdam sint excepturi laboriosam veritatis. Beatae quibusdam maiores illo aspernatur sit doloremque! Quis autem impedit eveniet dolorem voluptatibus, similique earum doloremque nesciunt ea, animi dolores fuga iste consectetur illum, sequi incidunt itaque ad aperiam adipisci pariatur cumque odit! Accusamus quaerat laboriosam saepe voluptates, necessitatibus consequatur incidunt, ullam illo nisi expedita quibusdam voluptatem mollitia in asperiores porro consequuntur facilis minus nemo eum maiores sapiente? Maxime quia, aperiam rem asperiores facilis ducimus voluptatem, deleniti consequatur dolores adipisci officia sit eum eveniet mollitia quam magni sed, iste minus. Ipsum beatae id pariatur natus officiis, magni illo quae, unde debitis ducimus laborum sed cupiditate. Voluptas, architecto dicta unde maxime nobis ducimus molestiae labore porro. Enim autem, molestiae, pariatur provident esse repellendus ab in delectus illo, quasi vero corporis reiciendis dicta tempora saepe ullam numquam exercitationem mollitia ipsam natus. Accusamus, doloremque ratione corrupti officiis voluptates delectus quo deleniti numquam nostrum maxime enim deserunt architecto sapiente fugiat dignissimos obcaecati nulla laudantium explicabo dolore aut voluptatum nam eveniet iste! Recusandae enim, repellat maiores incidunt minima sequi, eum sed dolorum quasi soluta optio ea! Velit quia est cumque fugiat placeat dicta quibusdam, perferendis voluptate voluptatem porro, fuga nisi rem dolor quos odit consequuntur quisquam vero corporis eius dolorem sed accusamus pariatur nobis quidem! Repellendus veniam consequatur reiciendis magni, doloribus architecto illum, soluta enim, animi iure voluptas deserunt provident molestias earum accusamus nesciunt repudiandae? Nostrum ex commodi, aliquam doloribus nobis cupiditate possimus amet iste sed, accusamus tenetur! Est dicta magni ipsum quisquam. Libero blanditiis impedit accusamus excepturi sint saepe ducimus sit facere magnam voluptas, in minima asperiores omnis neque, nemo a eius doloremque culpa dolor fuga alias porro. Tempora accusantium voluptatem in aut ex blanditiis doloremque atque quibusdam veniam deserunt. Quod quibusdam, ipsum dolorum quam ullam magnam voluptatum et ab ipsam repellat voluptate enim corrupti, cupiditate ad exercitationem minus nostrum. Quisquam soluta suscipit rerum cum, magni eligendi necessitatibus sapiente mollitia error itaque accusamus non asperiores officiis harum, iste, debitis blanditiis. Quam repellendus laborum minima deserunt aut, ipsam similique ipsum impedit quod, possimus doloremque ea. Voluptas tenetur, inventore aliquid cupiditate at enim quibusdam id aspernatur illo. Reprehenderit ut dolorem doloribus minima, repellat distinctio hic iusto omnis? Odio corrupti adipisci officiis cum obcaecati temporibus quasi veniam mollitia. Omnis corporis facere ab! Doloremque officiis impedit aperiam perspiciatis qui error, hic doloribus explicabo rem et modi consequuntur laboriosam eum earum incidunt eius. Maiores, molestias quo repellat voluptatum laboriosam repudiandae cum autem impedit veritatis aperiam. Quae a quis ratione nemo dicta? Accusamus velit voluptatem eaque numquam ea ullam adipisci eos eligendi neque ex. Voluptates, asperiores fuga ipsum nisi quia impedit veniam odio dolores perspiciatis dicta amet, in assumenda sapiente explicabo voluptatibus? Quibusdam, iure quisquam temporibus reprehenderit nemo quam quidem? Nam voluptatibus, perspiciatis deserunt modi temporibus accusantium? Fuga ipsam accusamus, odit expedita dolorem esse odio exercitationem? Amet, facere animi cupiditate quasi enim voluptate qui quis cum quod rerum ratione vel hic. Nam itaque architecto quasi sunt consequatur. Assumenda, nobis quo repellendus voluptas odit aspernatur neque beatae unde aperiam blanditiis eligendi aliquid quae. Ipsam nam nihil hic molestiae harum. Reprehenderit sint, fugit nihil quibusdam cupiditate necessitatibus impedit laudantium magni, deleniti architecto incidunt eius repellat. Tempore dolorum illum ex maxime facere deleniti recusandae sed nostrum ab dolore. Quisquam nostrum exercitationem quia maxime corrupti omnis earum magni at ipsam temporibus. Alias ipsum odio recusandae, quidem repellendus hic natus sunt saepe adipisci? Corporis expedita maxime vero cupiditate! Fugit, voluptate, sapiente quas odit impedit eius omnis ad accusamus minus numquam quidem veritatis sed quia error illum perferendis perspiciatis maiores. Ipsam repellat nam consequatur non, veniam consequuntur nemo! Mollitia cupiditate deserunt quasi blanditiis, veniam perspiciatis placeat quae qui illo!</p>','articles/01JYEPEECZ4VEPAT5KAZZVTBM0.jpg',3,3,'published','2025-06-23 15:28:07',67,'{\"tags\":[\"seo\",\"content writing\"]}','2025-06-23 15:25:23','2025-06-24 15:20:12'),
(9,'Cara Membuat API dengan Laravel Sanctum','cara-membuat-api-dengan-laravel-sanctum','Laravel Sanctum adalah solusi ringan untuk autentikasi API di Laravel.','<p>Sanctum cocok digunakan untuk SPA dan mobile app karena simplicity-nya.</p>','articles/01JYEPDK1CBYY1Y7C5084NTDHJ.jpg',1,1,'published','2025-06-13 15:25:23',188,'{\"tags\":[\"laravel\",\"api\",\"sanctum\"]}','2025-06-23 15:25:23','2025-06-24 15:24:34');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authors_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `authors` VALUES
(1,'Budi Santoso','budi-santoso','Penulis teknologi dan pengembang web.','https://i.pravatar.cc/150?img=1','budi@example.com','https://budi.dev',1,'2025-06-23 13:35:31','2025-06-23 13:35:31'),
(2,'Siti Aminah','siti-aminah','Spesialis konten kreatif dan sosial media.','https://i.pravatar.cc/150?img=2','siti@example.com','https://siti.id',1,'2025-06-23 13:35:31','2025-06-23 13:35:31'),
(3,'Andi Nugroho','andi-nugroho','Penulis artikel edukatif dan trainer.',NULL,'andi@example.com','https://andi.com',1,'2025-06-23 13:35:31','2025-06-23 13:35:51');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slides` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`slides`)),
  `link_url` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `banners` VALUES
(4,'Kegiatan',NULL,'[{\"title\":\"Ahdi Khalida Fathir\",\"description\":null,\"image\":\"banners\\/slides\\/01JYES8B9DB4YPPQGMPXTWZ0FQ.jpg\",\"link_url\":null,\"button_text\":null,\"order\":1},{\"title\":\"web developoer\",\"description\":null,\"image\":\"banners\\/slides\\/01JYES8B9R09AQVFQDFEZPRX8R.jpg\",\"link_url\":null,\"button_text\":null,\"order\":1},{\"title\":\"Teknologi Rekayasa Komputer\",\"description\":null,\"image\":\"banners\\/slides\\/01JYH0R3TBV3BQEW6KSTK0TEE8.png\",\"link_url\":null,\"button_text\":null,\"order\":1}]',NULL,NULL,1,1,'2025-06-23 16:17:03','2025-06-24 13:06:28');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `cache` VALUES
('356a192b7913b04c54574d18c28d46e6395428ab','i:10;',1750777001),
('356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1750777001;',1750777001),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:1;',1750770028),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1750770028;',1750770028);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `categories` VALUES
(1,'Teknologi','teknologi','Artikel seputar perkembangan teknologi dan gadget terbaru.','https://source.unsplash.com/400x300/?technology',1,'2025-06-23 13:39:30','2025-06-23 13:39:30'),
(2,'Pemrograman','pemrograman','Tips, tutorial, dan berita tentang dunia pemrograman.','https://source.unsplash.com/400x300/?programming',1,'2025-06-23 13:39:30','2025-06-23 13:39:30'),
(3,'Desain UI/UX','desain-uiux','Panduan dan inspirasi desain antarmuka pengguna.','https://source.unsplash.com/400x300/?ui,ux',1,'2025-06-23 13:39:30','2025-06-23 13:39:30'),
(4,'Kesehatan Digital','kesehatan-digital','Topik tentang kesehatan mental & fisik di era digital.','https://source.unsplash.com/400x300/?health,technology',0,'2025-06-23 13:39:30','2025-06-23 13:39:30');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sks` varchar(10) NOT NULL,
  `prerequisite` varchar(255) DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `courses` VALUES
(1,'EKO1101','Ekonomi','2(2-0)',NULL,1,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42'),
(2,'IPB110A','Agama Islam','3(2-1)',NULL,1,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42'),
(3,'IPB110C','Pertanian Inovatif','2(2-0)',NULL,1,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42'),
(4,'IPB110F','Bahasa Inggris','2(1-1)',NULL,1,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42'),
(5,'KIM1104','Kimia Sains dan Teknologi','3(2-1)',NULL,1,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42'),
(6,'KPM1131','Sosiologi','2(2-0)',NULL,2,'PPKU/Common Core Courses',1,'2025-06-22 17:42:42','2025-06-22 17:42:42');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `galleries_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `galleries` VALUES
(1,'Kegiatan Sekolah','kegiatan-sekolah','Dokumentasi kegiatan belajar mengajar dan ekstrakurikuler.','[\"galleries\\/01JYEKN8E4ZK9GEKQ0KBW53GXZ.jpg\",\"galleries\\/01JYGA9FSF8K82H88X650P750K.jpg\",\"galleries\\/01JYH70KF6N83H63ETGW6WGY5R.jpeg\",\"galleries\\/01JYH70KFA2KJC9JJ9109X18R8.jpeg\",\"galleries\\/01JYH70KFCMX0VD5K6WFZ54XGS.jpeg\",\"galleries\\/01JYH70KFDATH8C35MAZB8QP1C.jpeg\",\"galleries\\/01JYH70KFE05ZX37DQJ8W39XYG.jpeg\",\"galleries\\/01JYH70KFF64YNRFQ62FS0JP73.jpeg\",\"galleries\\/01JYH70KFG5PF865G9CEKCJP1Z.jpeg\",\"galleries\\/01JYH70KFJPYHECCV11A0EHV27.jpeg\",\"galleries\\/01JYH70KFKGC0MGEHKR7WFNVRR.jpeg\",\"galleries\\/01JYH70KFP99GEB6B4T0FYWMRG.jpeg\"]',1,'2025-06-23 13:48:01','2025-06-24 14:55:58'),
(2,'Pameran Kreatif','pameran-kreatif','Karya-karya siswa dalam pameran seni tahunan.','[\"galleries\\/01JYEKX2V9H926WGR8XRCBJRRN.jpg\"]',1,'2025-06-23 13:48:01','2025-06-23 14:43:31'),
(3,'Dokumentasi Alumni','dokumentasi-alumni','Kenangan bersama para alumni.','[\"galleries\\/01JYENPPNJK6M9G4KM6YNP9J7K.jpg\"]',1,'2025-06-23 13:48:01','2025-06-23 15:15:16');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_06_13_162258_create_categories_table',1),
(5,'2025_06_13_162350_create_authors_table',1),
(6,'2025_06_13_162402_create_articles_table',1),
(7,'2025_06_13_162417_create_galleries_table',1),
(8,'2025_06_13_162428_create_resources_table',1),
(9,'2025_06_13_162439_create_quotes_table',1),
(10,'2025_06_13_162449_create_banners_table',1),
(11,'2025_06_13_162501_create_faqs_table',1),
(12,'2025_06_13_162509_create_settings_table',1),
(13,'2025_06_23_003127_create_courses_table',1),
(14,'2025_06_24_144708_create_user_questions_table',2),
(15,'2025_06_24_145203_add_answer_to_user_questions_table',2),
(16,'2025_06_24_195505_create_about_us_section_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote` text NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `quotes` VALUES
(2,'The best way to get started is to quit talking and begin doing.','Walt Disney','Speech',1,'2025-06-23 13:43:51','2025-06-23 13:43:51'),
(3,'Success is not in what you have, but who you are.','Bo Bennett','Book: Year to Success',1,'2025-06-23 13:43:51','2025-06-23 13:43:51'),
(4,'The only limit to our realization of tomorrow is our doubts of today.','Franklin D. Roosevelt','Public Address',0,'2025-06-23 13:43:51','2025-06-23 13:43:51'),
(5,'In the middle of every difficulty lies opportunity.','Albert Einstein','Letter',1,'2025-06-23 13:43:51','2025-06-23 13:43:51'),
(6,'Be yourself; everyone else is already taken.','Oscar Wilde','Quote Collection',1,'2025-06-23 13:43:51','2025-06-23 13:43:51');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `download_url` varchar(255) DEFAULT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resources_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `resources` VALUES
(4,'Github','github','Github flatform',NULL,NULL,NULL,'https://code.visualstudio.com/docs/?dv=linux64_deb',2,1,'2025-06-24 13:19:00','2025-06-24 14:58:11'),
(5,'apk','apk',NULL,'resources/01JYH3Y1JMEB80GZK7A8K6JGA0.pdf','pdf',442499,NULL,1,1,'2025-06-24 14:02:08','2025-06-24 14:57:45');
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('CHKkIHuEo2KrtpssfJnETe8eh5A4CLsyiObQ0bjN',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZHQxeHJ2VGx4MEZwUWJENkJHWTFNRlRhNExUTWo2VEowVHFMNXVINCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL2NhcmEtbWVtYnVhdC1hcGktZGVuZ2FuLWxhcmF2ZWwtc2FuY3R1bSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkLjJNUm8ya1hvZVhFWGJFdVJ5SzU4ZVJOeUhTeU5RSGJQSUlCQk42S0w3b3paZ0RmMmRVZ0ciO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=',1750778674);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `user_questions`
--

DROP TABLE IF EXISTS `user_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_questions`
--

LOCK TABLES `user_questions` WRITE;
/*!40000 ALTER TABLE `user_questions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `user_questions` VALUES
(2,'ahdi','','saya mau namnya bang apakah ada yang namanya ahdi ?','<p>ada sayang adaaaa......</p>','answered','2025-06-24 08:12:15','2025-06-24 08:13:42'),
(3,'ahdi khalida fathir','ahdikhalida@gmail.com','aku suka kamu beb','<p>idiih sebel</p>','answered','2025-06-24 08:19:19','2025-06-24 08:19:37'),
(4,'ahdi khalida fathir','ahdikhalida@gmail.com','hewan hewan apa yang ganteng ?',NULL,'pending','2025-06-24 08:39:59','2025-06-24 08:39:59'),
(5,' hahahahahhawoke','ahdikhalida@gmail.com','gak tau pusing',NULL,'pending','2025-06-24 08:40:33','2025-06-24 08:40:33'),
(6,'ahdi','ahdikhalida@gmail.com','kamu udh makan belum ?','<p>udh dong brooo</p>','answered','2025-06-24 08:46:17','2025-06-24 08:46:49'),
(7,' hahahahahhawoke','ahdikhalida@gmail.com','yffygghggy',NULL,'pending','2025-06-24 09:14:23','2025-06-24 09:14:23'),
(8,'ahdi','ahdikhalida@gmail.com','ahdi udh makan belum ?','<p>udh broo</p>','answered','2025-06-24 14:59:33','2025-06-24 14:59:58');
/*!40000 ALTER TABLE `user_questions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'ahdi','tekom@gmail.com',NULL,'$2y$12$.2MRo2kXoeXEXbEuRyK58eRNyHSyNQHbPIIBBN6KL7ozZgDf2dUgG',NULL,'2025-06-22 17:41:00','2025-06-22 17:41:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-06-24 22:27:11
