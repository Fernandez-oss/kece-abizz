    -- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
    --
    -- Host: localhost    Database: owl_post
    -- ------------------------------------------------------
    -- Server version	8.4.3

    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!50503 SET NAMES utf8mb4 */;
    /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
    /*!40103 SET TIME_ZONE='+00:00' */;
    /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
    /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
    /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
    /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

    --
    -- Table structure for table `authors`
    --

    DROP TABLE IF EXISTS `authors`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `authors` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `authors`
    --

    LOCK TABLES `authors` WRITE;
    /*!40000 ALTER TABLE `authors` DISABLE KEYS */;
    INSERT INTO `authors` VALUES (1,'a','2026-09-06 20:09:03','2026-09-06 20:09:03');
    /*!40000 ALTER TABLE `authors` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `book_types`
    --

    DROP TABLE IF EXISTS `book_types`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `book_types` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `book_types`
    --

    LOCK TABLES `book_types` WRITE;
    /*!40000 ALTER TABLE `book_types` DISABLE KEYS */;
    INSERT INTO `book_types` VALUES (1,'d','2026-09-06 20:09:22','2026-09-06 20:09:22');
    /*!40000 ALTER TABLE `book_types` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `books`
    --

    DROP TABLE IF EXISTS `books`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `books` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `publisher_id` bigint unsigned NOT NULL,
      `year` year NOT NULL,
      `stock` int NOT NULL,
      `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      `author_id` bigint unsigned NOT NULL,
      `genre_id` bigint unsigned NOT NULL,
      `category_id` bigint unsigned NOT NULL,
      `book_type_id` bigint unsigned NOT NULL,
      PRIMARY KEY (`id`),
      KEY `books_author_id_foreign` (`author_id`),
      KEY `books_genre_id_foreign` (`genre_id`),
      KEY `books_category_id_foreign` (`category_id`),
      KEY `books_book_type_id_foreign` (`book_type_id`),
      CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
      CONSTRAINT `books_book_type_id_foreign` FOREIGN KEY (`book_type_id`) REFERENCES `book_types` (`id`) ON DELETE CASCADE,
      CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
      CONSTRAINT `books_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `books`
    --

    LOCK TABLES `books` WRITE;
    /*!40000 ALTER TABLE `books` DISABLE KEYS */;
    INSERT INTO `books` VALUES (2,'adalah','1788751177_download.jpg.jfif',1,2000,10,'cuih','2026-09-06 20:19:37','2026-09-06 22:56:13',1,1,1,1),(3,'itulah','1788760251_download.jfif',1,2009,10,'meh','2026-09-06 22:50:51','2026-09-06 22:56:03',1,1,1,1),(4,'sanalah','1788760287_rabbids invasion icon.jpeg',1,2008,10,'dih','2026-09-06 22:51:27','2026-09-06 22:56:08',1,1,1,1);
    /*!40000 ALTER TABLE `books` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `borrowings`
    --

    DROP TABLE IF EXISTS `borrowings`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `borrowings` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `user_id` bigint unsigned NOT NULL,
      `book_id` bigint unsigned NOT NULL,
      `borrowed_at` datetime NOT NULL,
      `due_date` date NOT NULL,
      `returned_at` datetime DEFAULT NULL,
      `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'borrowed',
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `borrowings`
    --

    LOCK TABLES `borrowings` WRITE;
    /*!40000 ALTER TABLE `borrowings` DISABLE KEYS */;
    /*!40000 ALTER TABLE `borrowings` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `cache`
    --

    DROP TABLE IF EXISTS `cache`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `cache` (
      `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `expiration` bigint NOT NULL,
      PRIMARY KEY (`key`),
      KEY `cache_expiration_index` (`expiration`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `cache`
    --

    LOCK TABLES `cache` WRITE;
    /*!40000 ALTER TABLE `cache` DISABLE KEYS */;
    /*!40000 ALTER TABLE `cache` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `cache_locks`
    --

    DROP TABLE IF EXISTS `cache_locks`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `cache_locks` (
      `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `expiration` bigint NOT NULL,
      PRIMARY KEY (`key`),
      KEY `cache_locks_expiration_index` (`expiration`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `cache_locks`
    --

    LOCK TABLES `cache_locks` WRITE;
    /*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
    /*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `carts`
    --

    DROP TABLE IF EXISTS `carts`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `carts` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `user_id` bigint unsigned NOT NULL,
      `book_id` bigint unsigned NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `carts_user_id_book_id_unique` (`user_id`,`book_id`),
      KEY `carts_book_id_foreign` (`book_id`),
      CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
      CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `carts`
    --

    LOCK TABLES `carts` WRITE;
    /*!40000 ALTER TABLE `carts` DISABLE KEYS */;
    /*!40000 ALTER TABLE `carts` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `categories`
    --

    DROP TABLE IF EXISTS `categories`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `categories` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `categories`
    --

    LOCK TABLES `categories` WRITE;
    /*!40000 ALTER TABLE `categories` DISABLE KEYS */;
    INSERT INTO `categories` VALUES (1,'c','2026-09-06 20:09:15','2026-09-06 20:09:15');
    /*!40000 ALTER TABLE `categories` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `failed_jobs`
    --

    DROP TABLE IF EXISTS `failed_jobs`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `failed_jobs` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
      KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `failed_jobs`
    --

    LOCK TABLES `failed_jobs` WRITE;
    /*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
    /*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `genres`
    --

    DROP TABLE IF EXISTS `genres`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `genres` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `genres`
    --

    LOCK TABLES `genres` WRITE;
    /*!40000 ALTER TABLE `genres` DISABLE KEYS */;
    INSERT INTO `genres` VALUES (1,'b','2026-09-06 20:09:09','2026-09-06 20:09:09');
    /*!40000 ALTER TABLE `genres` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `job_batches`
    --

    DROP TABLE IF EXISTS `job_batches`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `job_batches` (
      `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `total_jobs` int NOT NULL,
      `pending_jobs` int NOT NULL,
      `failed_jobs` int NOT NULL,
      `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `options` mediumtext COLLATE utf8mb4_unicode_ci,
      `cancelled_at` int DEFAULT NULL,
      `created_at` int NOT NULL,
      `finished_at` int DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `job_batches`
    --

    LOCK TABLES `job_batches` WRITE;
    /*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
    /*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `jobs`
    --

    DROP TABLE IF EXISTS `jobs`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `jobs` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `attempts` smallint unsigned NOT NULL,
      `reserved_at` int unsigned DEFAULT NULL,
      `available_at` int unsigned NOT NULL,
      `created_at` int unsigned NOT NULL,
      PRIMARY KEY (`id`),
      KEY `jobs_queue_index` (`queue`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `jobs`
    --

    LOCK TABLES `jobs` WRITE;
    /*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
    /*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `migrations`
    --

    DROP TABLE IF EXISTS `migrations`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `migrations` (
      `id` int unsigned NOT NULL AUTO_INCREMENT,
      `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `batch` int NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `migrations`
    --

    LOCK TABLES `migrations` WRITE;
    /*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
    INSERT INTO `migrations` VALUES (191,'0001_01_01_000000_create_users_table',1),(192,'0001_01_01_000001_create_cache_table',1),(193,'0001_01_01_000002_create_jobs_table',1),(194,'2026_08_20_052923_create_books_table',1),(195,'2026_08_20_054908_add_some_column_to_users_table',1),(196,'2026_08_20_060826_create_borrowings_table',1),(197,'2026_08_20_061344_drop_some_column_from_books_table',1),(198,'2026_08_20_062642_create_book_type_table',1),(199,'2026_08_20_062658_create_genre_table',1),(200,'2026_08_20_062714_create_category_table',1),(201,'2026_08_20_062728_create_author_table',1),(202,'2026_08_20_062740_create_publisher_table',1),(203,'2026_09_06_030330_add_relationships_to_books_table',1),(204,'2026_09_07_010844_modify_borrowings_table',1),(205,'2026_09_07_042149_add_status_to_borrowings_table',2),(206,'2026_09_07_053908_create_carts_table',3);
    /*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `password_reset_tokens`
    --

    DROP TABLE IF EXISTS `password_reset_tokens`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `password_reset_tokens` (
      `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `password_reset_tokens`
    --

    LOCK TABLES `password_reset_tokens` WRITE;
    /*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
    /*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `publishers`
    --

    DROP TABLE IF EXISTS `publishers`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `publishers` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `publishers`
    --

    LOCK TABLES `publishers` WRITE;
    /*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
    INSERT INTO `publishers` VALUES (1,'e','2026-09-06 20:09:28','2026-09-06 20:09:28');
    /*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `sessions`
    --

    DROP TABLE IF EXISTS `sessions`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `sessions` (
      `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `user_id` bigint unsigned DEFAULT NULL,
      `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `user_agent` text COLLATE utf8mb4_unicode_ci,
      `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
      `last_activity` int NOT NULL,
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
    /*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
    UNLOCK TABLES;

    --
    -- Table structure for table `users`
    --

    DROP TABLE IF EXISTS `users`;
    /*!40101 SET @saved_cs_client     = @@character_set_client */;
    /*!50503 SET character_set_client = utf8mb4 */;
    CREATE TABLE `users` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `email_verified_at` timestamp NULL DEFAULT NULL,
      `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
      `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `users_email_unique` (`email`),
      UNIQUE KEY `users_phone_number_unique` (`phone_number`),
      UNIQUE KEY `users_name_unique` (`name`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    /*!40101 SET character_set_client = @saved_cs_client */;

    --
    -- Dumping data for table `users`
    --

    LOCK TABLES `users` WRITE;
    /*!40000 ALTER TABLE `users` DISABLE KEYS */;
    INSERT INTO `users` VALUES (1,'admin','admin@gmail.com',NULL,'$2y$12$O1wUwL5YNW7KUqXylkf5POZ3PwchKhGxJFmk6xImyVz7SamcgOCxS','admin',NULL,'2026-09-06 20:08:18','2026-09-06 20:08:26','080000000000','1788750506_download (2).jpg'),(2,'user11','user@gmail.com',NULL,'$2y$12$sCBhkt5386M2rzp4c6/2..uIKvZ.QYMXjGXOFrq.eEXHnYKAKTMN2','user',NULL,'2026-09-06 20:20:39','2026-09-06 20:20:49','0811111111111','1788751249_download (1).jpeg');
    /*!40000 ALTER TABLE `users` ENABLE KEYS */;
    UNLOCK TABLES;
    /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

    /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
    /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
    /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

    -- Dump completed on 2026-09-07 13:00:26
