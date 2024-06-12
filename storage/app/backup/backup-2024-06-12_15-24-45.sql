-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: socialmedia
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `postId` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_userid_foreign` (`userId`),
  KEY `comments_postid_foreign` (`postId`),
  CONSTRAINT `comments_postid_foreign` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (38,19,13,'hello','2024-06-05 15:44:00','2024-06-05 15:44:00'),(39,19,13,'hi','2024-06-08 12:43:36','2024-06-08 12:43:36'),(40,19,13,'fggrh','2024-06-08 12:50:58','2024-06-08 12:50:58'),(41,19,10,'yyyhu','2024-06-08 12:59:42','2024-06-08 12:59:42'),(42,19,13,'vgff','2024-06-08 13:00:13','2024-06-08 13:00:13'),(43,1,13,'it\'s mee','2024-06-08 13:05:36','2024-06-08 13:05:36'),(44,19,11,'hello Mr ali','2024-06-08 14:28:58','2024-06-08 14:28:58'),(45,20,13,'suart dabm walla','2024-06-08 15:18:44','2024-06-08 15:18:44'),(46,20,19,'hello it\'s me','2024-06-09 15:15:56','2024-06-09 15:15:56'),(47,20,20,'this is me','2024-06-09 15:33:23','2024-06-09 15:33:23'),(48,10,20,'nice picture','2024-06-09 21:13:01','2024-06-09 21:13:01'),(49,10,19,'nice image','2024-06-09 21:13:26','2024-06-09 21:13:26'),(50,10,18,'cool image','2024-06-09 21:13:36','2024-06-09 21:13:36'),(51,7,1,'fine , what about you ?','2024-06-10 14:59:53','2024-06-10 14:59:53'),(52,7,2,'fine , what about you ?','2024-06-10 15:01:01','2024-06-10 15:01:01'),(53,7,4,'fine , what about you ?','2024-06-10 15:01:04','2024-06-10 15:01:04'),(54,7,1,'fine , what about you ?','2024-06-10 15:11:29','2024-06-10 15:11:29'),(55,7,1,'fine , what about you ?','2024-06-10 15:12:53','2024-06-10 15:12:53'),(56,7,13,'fine , what about you ?','2024-06-10 15:15:33','2024-06-10 15:15:33'),(58,7,13,'yeah i\'v been there','2024-06-10 15:23:07','2024-06-10 15:23:07');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow_user`
--

DROP TABLE IF EXISTS `follow_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `follow_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `follow_user_follow_id_user_id_unique` (`follow_id`,`user_id`),
  KEY `follow_user_user_id_foreign` (`user_id`),
  CONSTRAINT `follow_user_follow_id_foreign` FOREIGN KEY (`follow_id`) REFERENCES `follows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follow_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_user`
--

LOCK TABLES `follow_user` WRITE;
/*!40000 ALTER TABLE `follow_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `follow_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `followerId` bigint(20) unsigned NOT NULL,
  `followeeId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `follows_followerid_followeeid_unique` (`followerId`,`followeeId`),
  KEY `follows_followeeid_foreign` (`followeeId`),
  CONSTRAINT `follows_followeeid_foreign` FOREIGN KEY (`followeeId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follows_followerid_foreign` FOREIGN KEY (`followerId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (35,2,1,'2024-06-05 13:17:40','2024-06-05 13:17:40'),(36,19,1,'2024-06-08 13:23:37','2024-06-08 13:23:37'),(37,19,7,'2024-06-08 13:31:33','2024-06-08 13:31:33'),(38,19,3,'2024-06-08 13:42:43','2024-06-08 13:42:43'),(39,19,2,'2024-06-08 14:25:47','2024-06-08 14:25:47'),(41,7,2,'2024-06-08 14:31:38','2024-06-08 14:31:38'),(42,7,3,'2024-06-08 14:31:39','2024-06-08 14:31:39'),(43,7,4,'2024-06-08 14:31:40','2024-06-08 14:31:40'),(44,7,5,'2024-06-08 14:31:42','2024-06-08 14:31:42'),(45,7,6,'2024-06-08 14:31:43','2024-06-08 14:31:43'),(46,7,8,'2024-06-08 14:31:49','2024-06-08 14:31:49'),(47,7,9,'2024-06-08 14:31:51','2024-06-08 14:31:51'),(48,7,10,'2024-06-08 14:31:53','2024-06-08 14:31:53'),(49,20,1,'2024-06-08 14:35:55','2024-06-08 14:35:55'),(50,20,7,'2024-06-08 14:54:03','2024-06-08 14:54:03'),(51,20,3,'2024-06-08 14:54:23','2024-06-08 14:54:23'),(52,20,8,'2024-06-08 14:55:49','2024-06-08 14:55:49'),(53,20,6,'2024-06-08 15:04:47','2024-06-08 15:04:47'),(54,20,5,'2024-06-08 15:05:47','2024-06-08 15:05:47'),(55,20,2,'2024-06-08 15:09:37','2024-06-08 15:09:37'),(56,20,4,'2024-06-08 16:26:39','2024-06-08 16:26:39'),(57,7,20,'2024-06-08 16:27:46','2024-06-08 16:27:46'),(59,10,20,'2024-06-09 21:12:50','2024-06-09 21:12:50'),(60,10,2,'2024-06-09 21:14:09','2024-06-09 21:14:09'),(67,10,7,'2024-06-09 21:35:25','2024-06-09 21:35:25'),(68,10,1,'2024-06-09 21:35:33','2024-06-09 21:35:33'),(70,10,5,'2024-06-09 21:54:18','2024-06-09 21:54:18'),(71,20,10,'2024-06-10 13:40:46','2024-06-10 13:40:46'),(72,21,22,'2024-06-10 14:46:29','2024-06-10 14:46:29'),(76,7,21,'2024-06-10 15:39:23','2024-06-10 15:39:23');
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_post`
--

DROP TABLE IF EXISTS `like_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `like_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `like_post_like_id_post_id_unique` (`like_id`,`post_id`),
  KEY `like_post_post_id_foreign` (`post_id`),
  CONSTRAINT `like_post_like_id_foreign` FOREIGN KEY (`like_id`) REFERENCES `likes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `like_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_post`
--

LOCK TABLES `like_post` WRITE;
/*!40000 ALTER TABLE `like_post` DISABLE KEYS */;
INSERT INTO `like_post` VALUES (71,68,5,NULL,NULL),(72,69,10,NULL,NULL),(73,70,7,NULL,NULL),(74,71,8,NULL,NULL),(75,72,6,NULL,NULL),(79,76,9,NULL,NULL),(80,77,9,NULL,NULL),(81,78,10,NULL,NULL),(89,86,11,NULL,NULL),(92,89,11,NULL,NULL),(95,92,11,NULL,NULL),(100,97,11,NULL,NULL),(102,99,10,NULL,NULL),(103,100,16,NULL,NULL),(104,101,15,NULL,NULL),(105,102,17,NULL,NULL),(106,103,18,NULL,NULL),(108,105,17,NULL,NULL),(109,106,18,NULL,NULL),(120,117,1,NULL,NULL),(133,130,13,NULL,NULL),(137,134,26,NULL,NULL),(138,135,24,NULL,NULL),(139,136,23,NULL,NULL),(140,137,22,NULL,NULL),(141,138,20,NULL,NULL),(142,139,27,NULL,NULL);
/*!40000 ALTER TABLE `like_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `postId` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `likes_userid_postid_unique` (`userId`,`postId`),
  KEY `likes_postid_foreign` (`postId`),
  CONSTRAINT `likes_postid_foreign` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (68,10,5,'2024-06-01 12:37:26','2024-06-01 12:37:26'),(69,10,10,'2024-06-01 13:29:22','2024-06-01 13:29:22'),(70,10,7,'2024-06-01 13:44:35','2024-06-01 13:44:35'),(71,10,8,'2024-06-01 13:45:02','2024-06-01 13:45:02'),(72,10,6,'2024-06-01 14:51:16','2024-06-01 14:51:16'),(76,10,9,'2024-06-02 11:56:22','2024-06-02 11:56:22'),(77,14,9,'2024-06-02 14:42:16','2024-06-02 14:42:16'),(78,14,10,'2024-06-02 14:42:24','2024-06-02 14:42:24'),(86,1,11,'2024-06-03 15:18:41','2024-06-03 15:18:41'),(89,17,11,'2024-06-03 16:13:50','2024-06-03 16:13:50'),(92,18,11,'2024-06-03 23:58:24','2024-06-03 23:58:24'),(97,20,11,'2024-06-08 14:53:51','2024-06-08 14:53:51'),(99,20,10,'2024-06-08 14:55:41','2024-06-08 14:55:41'),(100,20,16,'2024-06-08 17:40:52','2024-06-08 17:40:52'),(101,20,15,'2024-06-08 17:43:20','2024-06-08 17:43:20'),(102,20,17,'2024-06-08 17:46:01','2024-06-08 17:46:01'),(103,20,18,'2024-06-08 17:49:57','2024-06-08 17:49:57'),(105,1,17,'2024-06-09 20:12:11','2024-06-09 20:12:11'),(106,1,18,'2024-06-09 20:12:21','2024-06-09 20:12:21'),(117,1,1,'2024-06-09 20:53:44','2024-06-09 20:53:44'),(130,1,13,'2024-06-09 21:10:53','2024-06-09 21:10:53'),(134,20,26,'2024-06-10 13:58:32','2024-06-10 13:58:32'),(135,20,24,'2024-06-10 13:58:51','2024-06-10 13:58:51'),(136,20,23,'2024-06-10 14:22:13','2024-06-10 14:22:13'),(137,20,22,'2024-06-10 14:22:16','2024-06-10 14:22:16'),(138,20,20,'2024-06-10 14:22:21','2024-06-10 14:22:21'),(139,21,27,'2024-06-10 14:45:56','2024-06-10 14:45:56');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `senderId` bigint(20) unsigned NOT NULL,
  `reciverId` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_senderid_foreign` (`senderId`),
  KEY `messages_reciverid_foreign` (`reciverId`),
  CONSTRAINT `messages_reciverid_foreign` FOREIGN KEY (`reciverId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_senderid_foreign` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (155,1,7,'fine , what about you ?','2024-06-09 19:55:53','2024-06-09 19:55:53'),(156,7,1,'fine , what about you ?','2024-06-09 19:56:00','2024-06-09 19:56:00'),(157,7,1,'fine , what about you ?','2024-06-09 19:56:22','2024-06-09 19:56:22'),(158,1,7,'fine , what about you ?','2024-06-09 21:04:40','2024-06-09 21:04:40'),(159,7,1,'fine , what about you ?','2024-06-09 21:04:47','2024-06-09 21:04:47'),(160,1,7,'fine , what about you ?','2024-06-09 21:05:22','2024-06-09 21:05:22'),(161,7,1,'fine , what about you ?','2024-06-09 21:05:26','2024-06-09 21:05:26'),(162,7,1,'fine , what about you ?','2024-06-09 21:11:00','2024-06-09 21:11:00'),(163,1,7,'fine , what about you ?','2024-06-11 08:43:11','2024-06-11 08:43:11');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_05_26_120308_create_posts_table',1),(6,'2024_05_26_120325_create_comments_table',1),(7,'2024_05_26_120342_create_likes_table',1),(8,'2024_05_26_120354_create_follows_table',1),(9,'2024_05_26_120431_create_notifications_table',1),(10,'2024_05_26_120450_create_messages_table',1),(11,'2024_05_26_142347_create_sessions_table',1),(13,'2024_05_28_152629_create_like_post_table',2),(14,'2024_05_28_163915_create_follow_user_table',3),(15,'0000_00_00_000000_create_websockets_statistics_entries_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `read_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_userid_foreign` (`userId`),
  CONSTRAINT `notifications_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (25,20,'SentFollow','{\"follower_id\":20,\"followee_id\":10}','2024-06-10 13:40:46','2024-06-10 13:40:46','2024-06-10 13:40:46'),(26,20,'SentLike','{\"user_id\":10,\"post_id\":26}','2024-06-10 13:58:32','2024-06-10 13:58:32','2024-06-10 13:58:32'),(27,20,'SentLike','{\"user_id\":10,\"post_id\":24}','2024-06-10 13:58:51','2024-06-10 13:58:51','2024-06-10 13:58:51'),(28,20,'SentLike','{\"user_id\":10,\"post_id\":23}','2024-06-10 14:22:13','2024-06-10 14:22:13','2024-06-10 14:22:13'),(29,20,'SentLike','{\"user_id\":10,\"post_id\":22}','2024-06-10 14:22:16','2024-06-10 14:22:16','2024-06-10 14:22:16'),(30,21,'SentLike','{\"user_id\":22,\"post_id\":27}','2024-06-10 14:45:56','2024-06-10 14:45:56','2024-06-10 14:45:56'),(31,21,'SentFollow','{\"follower_id\":21,\"followee_id\":22}','2024-06-10 14:46:29','2024-06-10 14:46:29','2024-06-10 14:46:29'),(39,7,'SentComment','{\"user_id\":1,\"comment_id\":58,\"post_id\":13}','2024-06-10 15:23:07','2024-06-10 15:23:07','2024-06-10 15:23:07'),(41,7,'SentFollow','{\"follower_id\":7,\"followee_id\":21}','2024-06-10 15:39:23','2024-06-10 15:39:23','2024-06-10 15:39:23');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (29,'App\\Models\\User',3,'apiToken','136f1bfbcf3c8589e05eaf0dd2a5e8b0b17b78782deeabce31c1be68ef0332c7','[\"*\"]',NULL,NULL,'2024-05-28 14:05:02','2024-05-28 14:05:02'),(44,'App\\Models\\User',2,'apiToken','09946010a333c822a861bfb82376c4dd2694895d409c9082958e4bb2d7cd4326','[\"*\"]','2024-06-09 15:14:28',NULL,'2024-05-29 16:10:59','2024-06-09 15:14:28'),(85,'App\\Models\\User',8,'apiToken','eaa3b0cc157a00a649273f695a0f7a700eebfaa3d7cf4ba1b455e325c3adb159','[\"*\"]','2024-06-01 12:06:29',NULL,'2024-06-01 11:53:49','2024-06-01 12:06:29'),(86,'App\\Models\\User',9,'apiToken','767e8d3eef581e540f3aeb3b2623c4dafb5d3acb97e88acde844d0892277ff18','[\"*\"]','2024-06-01 12:23:43',NULL,'2024-06-01 12:07:23','2024-06-01 12:23:43'),(89,'App\\Models\\User',12,'apiToken','d503c0e440939de29104dc8c3d922fec1743187548b4a8ddbcf11c0aac5522be','[\"*\"]',NULL,NULL,'2024-06-01 14:54:12','2024-06-01 14:54:12'),(92,'App\\Models\\User',13,'apiToken','c7c9e4556f8f0c43083f14e8621f4374052d4299f70bbef06a00a02d409dfe7c','[\"*\"]',NULL,NULL,'2024-06-01 14:58:12','2024-06-01 14:58:12'),(97,'App\\Models\\User',14,'apiToken','225ba2b587549c078e607e77276ea81a8cf30351688b20aaf8a76f7d094d017b','[\"*\"]','2024-06-02 14:42:35',NULL,'2024-06-02 14:23:52','2024-06-02 14:42:35'),(98,'App\\Models\\User',15,'apiToken','3100d568a59106363e7be91276ef86b38e46084dc25cd925f2ab33ed3e7ebda0','[\"*\"]','2024-06-02 17:52:01',NULL,'2024-06-02 15:03:09','2024-06-02 17:52:01'),(107,'App\\Models\\User',17,'apiToken','3a50b1680c52b0318d6d006627c4f47b27fba05e55283fed41cba242012463da','[\"*\"]','2024-06-03 23:56:06',NULL,'2024-06-03 16:13:44','2024-06-03 23:56:06'),(108,'App\\Models\\User',18,'apiToken','dd0c8e00a5a66c1a283f62fd3ecd03f1ffdc9613d2f4dabb8ee71a59359c7df8','[\"*\"]','2024-06-05 15:35:27',NULL,'2024-06-03 23:57:57','2024-06-05 15:35:27'),(111,'App\\Models\\User',19,'apiToken','40bd95df5fa794994c10c8b04c12cb0c25f5c4fb5551ebbd50f248c8938e8218','[\"*\"]','2024-06-08 14:29:06',NULL,'2024-06-08 12:52:41','2024-06-08 14:29:06'),(121,'App\\Models\\User',7,'apiToken','bff92c0aa2aa7e3b37f5b9541ba5fceaf19d66d7ae06760e9b1a925b6456cda5','[\"*\"]','2024-06-10 16:09:12',NULL,'2024-06-09 13:28:31','2024-06-10 16:09:12'),(124,'App\\Models\\User',1,'apiToken','36c7db82787a92a58e86f7ee1a31b2476aeb836ebb4a68c286d34b338aca9b71','[\"*\"]','2024-06-11 08:43:10',NULL,'2024-06-09 19:50:00','2024-06-11 08:43:10'),(126,'App\\Models\\User',10,'apiToken','2da55cf17060646348a1d390181b7442b2daf40b61e0e7c81102828bd0e2689b','[\"*\"]','2024-06-09 21:54:21',NULL,'2024-06-09 21:12:10','2024-06-09 21:54:21'),(127,'App\\Models\\User',20,'apiToken','1b4746175ed5b5f5b5a632f1f36590d38578e312a14d49a82d027d239d1f4a78','[\"*\"]','2024-06-10 14:24:11',NULL,'2024-06-10 13:40:23','2024-06-10 14:24:11'),(128,'App\\Models\\User',21,'apiToken','b3b0d00fed73912eee46892443c6c6f03f1e5e614bfe98b713a6655d0f0edab7','[\"*\"]','2024-06-10 15:42:07',NULL,'2024-06-10 14:26:16','2024-06-10 15:42:07'),(129,'App\\Models\\User',22,'apiToken','659b3c3eae0736f3800d61ee3b82b1ebb60a251c27e256801f0d4debc26a3446','[\"*\"]','2024-06-10 14:46:46',NULL,'2024-06-10 14:45:21','2024-06-10 14:46:46');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_userid_foreign` (`userId`),
  CONSTRAINT `posts_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,3,'autem consectetur velit','test1.jpg','2024-06-01 12:09:38','2024-06-01 12:09:38'),(2,7,'odio harum in','jack.jpg','2024-06-01 12:09:38','2024-06-01 12:09:38'),(3,2,'rem et ut','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(4,6,'et assumenda sint','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(5,2,'perferendis id ad','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(6,6,'dolor nihil cum','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(7,7,'alias quia non','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(8,3,'asperiores corrupti ratione','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(9,5,'voluptatem debitis expedita','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(10,8,'ex voluptas architecto','null','2024-06-01 12:09:38','2024-06-01 12:09:38'),(11,7,'What a beautiful view in here !','665dde461295c.jpg','2024-06-03 15:16:22','2024-06-03 15:16:22'),(13,1,'Just Released!','665de0ba5b9ee.jpg','2024-06-03 15:26:50','2024-06-03 15:26:50'),(15,7,'zaka xwertyyyyyyyyyyyyyyyyy mndara kar','6664970384321.jpg','2024-06-08 17:38:11','2024-06-08 17:38:11'),(16,2,'hello','66649769ca483.png','2024-06-08 17:39:53','2024-06-08 17:39:53'),(17,20,'Tony Montana I love this guy','6664980065ba8.jpg','2024-06-08 17:42:24','2024-06-08 17:42:24'),(18,20,'today I found someone','6664998f13f20.jpg','2024-06-08 17:49:03','2024-06-08 17:49:03'),(19,20,'1-8-7-7 I love this team','6665c0d46777e.jpg','2024-06-09 14:48:52','2024-06-09 14:48:52'),(20,20,'test image','6665cb371b005.jpg','2024-06-09 15:33:11','2024-06-09 15:33:11'),(21,10,'rekaute awanday awanda','6666210fc9696.jpg','2024-06-09 21:39:27','2024-06-09 21:39:27'),(22,10,'rekaute awanday awanda','6666211e17b2c.jpg','2024-06-09 21:39:42','2024-06-09 21:39:42'),(23,10,'bo froshtn nrx : gubxo','666621410f84f.jpg','2024-06-09 21:40:17','2024-06-09 21:40:17'),(24,10,'amro la jaueki nawaza','6666216078c5b.jpg','2024-06-09 21:40:48','2024-06-09 21:40:48'),(25,10,'awash zansta sardama qashmar','66662174a32ae.jpg','2024-06-09 21:41:08','2024-06-09 21:41:08'),(26,10,'خوشکی وەش دەگرم برێ بڕۆگرام خۆشە','6666219bd4bb5.jpg','2024-06-09 21:41:47','2024-06-09 21:41:47'),(27,22,'..','6667119846ae5.jpg','2024-06-10 14:45:44','2024-06-10 14:45:44');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `sessions` VALUES ('4QtE7v8ggmq2omiuTYCgmAtE5rHeIjdxK6lAaWgn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzhtRzNOWUlabFZQZGJPVXd1WjBtUG1SZEdiZXZMS0xQQmQzSkJnYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9rdXJkZ3JhbS50ZXN0Ijt9fQ==',1718187572),('CWVMdVk3xqlZ8wswOAjCwOw6K0wtoSLuZW4OnJWQ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0x0WjdPMXFjSjZiNllFMVNnZHlCdUJhNVhHSThuaTVIbmZNUXhBOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGktZGVtbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718195025),('dX7QuTH9xPH9MUbURiHGX7nXonsCnOT0vrn9p0Ej',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibUk1c3V1YmlWQnpRZjFsRFJCc2hWd0NUdXE5S3liSjNZYmU2TEVYWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO319',1718187608),('esiff77xDZTIwBkLdXlog9QoLsNfIuY5g1xBTBa1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzNZVE1UWjZ6Qm1HREQ5RFZROGRVS2pWVGsyRVN1NHZIMmtGM3RQWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9rdXJkZ3JhbS50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1718188709),('gp3zOnH8ehLTj8K762pgKYCrcgkhnPWkdsa26tB5',NULL,'192.168.1.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkhPZElrNlZZZ01FU0dTenNtellPalpLM3hmd3o2Q1RIMW52TllBWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xOTIuMTY4LjEuNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718188134),('hsvlP4FdSkUVy9JiCcDZjKEilIToa4J9eKFT93PW',NULL,'192.168.1.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkE3Qnc2R2ZmbHlGZEpwV1ZKWE9TNlBHYnJCTmtEZ3pnZWRXOEhRdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xOTIuMTY4LjEuNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718193059),('Ti1kKknfmNoWm9BgRLtQfGbZlTOmxHatyWY1w5qR',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFVrS284RVAzd2p4ODhrdVprVUVNN3hDT3NuUjRWcnp4d2pValNEOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vbG9jYWxob3N0Ojg0NDMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1718194021),('tYckWXrBcMgpkNDRWbFMNnDWUZdcZdQxCQpEOzkj',NULL,'192.168.1.4','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTU1TnZGb0syRUtXYktKbG9HcWx6bzR5Y1R1cU05YW9GTUY0SlloSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xOTIuMTY4LjEuNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718192260),('ZiKh0InE6xNhfxMiJXw4q1NF3yMCKbCZSmL8fQSF',NULL,'192.168.1.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib1ExTTdCTk9ZamhwckRKdW5VY0tmVnRXSkpveTd4a3UxZzFtaEgwUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xOTIuMTY4LjEuNzo4MDgwL2t1cmRncmFtL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718194361);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profilepicture` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Muhammad','muhammad@gmail.com','2024-06-03 13:00:02','$2y$10$vacWLyf3HUh0OfOQ7zygru3fqhLv4cDtiLrPCQyWb7UIaPiuhh0aa','665de2278d3d7.jpg','Coding For Life!',NULL,'2024-05-26 15:18:03','2024-06-03 15:32:55'),(2,'zakarea','jabbarzakarea@gmail.com','2024-06-03 13:10:40','$2y$10$hm1T4/d/R95EZWkFJB7W8Ovet3hl6bhHwDS2m8CgUAoY.gI8sx2Oq','dummy.jpg',NULL,NULL,'2024-05-27 12:07:12','2024-06-05 13:50:09'),(3,'zakarwa','darkzaka10@gmail.com','2024-06-03 13:12:38','$2y$10$8JvKollsau0dbMIzOl6N0eJRDnACmwfduvg5KU4K3MpDFHTA8RVVq','dummy.jpg',NULL,NULL,'2024-05-28 12:59:19','2024-06-05 13:50:09'),(4,'zakarea','gaszaka20@gmail.com','2024-06-03 13:12:43','$2y$10$92IFt3Z.W5JvD02F/b9kcOycpag1Zw5Bye088mxshZO6LAy1i9C8a','dummy.jpg',NULL,NULL,'2024-05-28 13:02:35','2024-06-05 13:50:09'),(5,'zakareasssss','gaszaka54@gmail.com','2024-06-03 13:12:49','$2y$10$R4e.EqfdCQ38gPo4cNCjm.Qgl9kwTCwW616qgaRyKGlSDb3KOnO0W','dummy.jpg',NULL,NULL,'2024-05-28 13:04:18','2024-06-05 13:50:09'),(6,'zakarea','darkzaka9099@gmail.com','2024-06-03 13:12:52','$2y$10$tDOwGez5tv2Jen8c7e2BjObuFjOQkGvxdOEWjoarWjX6rLu55xiXO','dummy.jpg',NULL,NULL,'2024-05-29 15:39:21','2024-06-05 13:50:09'),(7,'Ali Jabbar','ali@gmail.com','2024-06-01 14:48:26','$2y$10$hk8S1wcFzHzhht7MIztzW.ewSpeoMnIwWrryKYyHdJzsh.kjvkMHi','665b1ab105e3e.png','Be tough , so no one can beat ya!',NULL,'2024-05-30 11:24:50','2024-06-01 14:48:26'),(8,'zakarea','zakarea@gmail.com','2024-06-03 13:12:58','$2y$10$n1Ll7CHyW9GMPLYLvDbr6ev.ZStFmn0dVQuMsebtKcph4u87DvRJq','dummy.jpg',NULL,NULL,'2024-06-01 11:52:20','2024-06-05 13:50:09'),(9,'hola125','hola@gmail.com','2024-06-03 13:17:22','$2y$10$sKCCuz/eAvy/EsypsXxBZukCgpHY5hm89XiegVAbArlyXacsPE3xq','dummy.jpg',NULL,NULL,'2024-06-01 12:07:17','2024-06-05 13:50:09'),(10,'zakajabar','zaka@gmail.com','2024-06-03 13:17:26','$2y$10$oaQgtEZx4CF9QZXgjS9lx.ETKY0wPc/8rXPLxm1amBLi2xghusibi','66661ac5edb9a.jpg','Kill me',NULL,'2024-06-01 12:24:18','2024-06-09 21:12:37'),(11,'zakaJabar','zaka12@gmail.com','2024-06-03 13:17:30','$2y$10$a5Eg/bor.kVnMU.B8pF35ePnmo4KNhzezC5ZNbTY07dnl9/KHGSFO','dummy.jpg',NULL,NULL,'2024-06-01 14:52:54','2024-06-05 13:50:09'),(12,'zakarea','hola10@gmail.com','2024-06-03 13:17:33','$2y$10$FHlExFRbBlmTowKSH7q8EuvTSxIdeVXWMyB5LYfiZfV.FjmrN4yLW','dummy.jpg',NULL,NULL,'2024-06-01 14:54:04','2024-06-05 13:50:09'),(13,'alibabm','alibram@gmail.com','2024-06-03 13:17:36','$2y$10$yzQF7qhpxDyJh1NQontl/.XMUvAX7fY36BerD9YMyhLfkc1KUqcbS','dummy.jpg',NULL,NULL,'2024-06-01 14:57:42','2024-06-05 13:50:09'),(14,'zakareajabbar','jabbarzaka@gmail.com',NULL,'$2y$10$7B61EgfNRnQPlvrrlGYJ9.8i/mU8JBLvEQtDyV.Tals8kmUHYk6FS','dummy.jpg',NULL,NULL,'2024-06-02 14:23:41','2024-06-05 13:50:09'),(15,'balen','balen@gmail.com','2024-06-03 13:21:05','$2y$10$mxzj8SruuvguJ/60YLLpLeyLNhjEUBIMZwanDLGJgjaHcunCW96Ca','dummy.jpg',NULL,NULL,'2024-06-02 15:02:58','2024-06-05 13:50:09'),(16,'test','testuser@gmail.com','2024-06-03 13:07:34','$2y$10$m04SooJJfxro5hoVTJU.rOKrhBichEfJQpGjsCU.w2ovhrfELSvli','dummy.jpg',NULL,NULL,'2024-06-03 13:07:20','2024-06-05 13:50:09'),(17,'zakareaQahpa','zakaqahpa@gmail.com','2024-06-05 12:07:38','$2y$10$sDMtIP.UngxNz2lBI3H2fu42tA8oOHIn4cNx4hK91kdd0xtve1.7K','dummy.jpg',NULL,NULL,'2024-06-03 16:13:28','2024-06-05 13:50:09'),(18,'agrin','agrin@gmail.com','2024-06-05 12:07:26','$2y$10$K3ZpAnE8IKDPzi/avPdZiu2.Voz79jLz/c5qSbXIl4YRUJupGqCy6','dummy.jpg',NULL,NULL,'2024-06-03 23:57:47','2024-06-05 13:50:09'),(19,'zaka_new','newzaka@gmail.com',NULL,'$2y$10$/xnOf/XVDRHptThKsWEGjesED08rCJaX9/BP4ZEM.hjhDKgC9mNVq','666451f25a1a4.jpg',NULL,'muL2kZdNZxrXhFLM7BYHD4kQQF5D7UJM','2024-06-05 15:36:52','2024-06-08 12:43:30'),(20,'xla_gyan','xla@gmail.com',NULL,'$2y$10$8TiByg44bPHf/8dNaQWUYutsVAwAWiPLmbJY3hKwHgFV4GeacbqEq','6665b2964bbc9.jpg','don\'t love girl Because your error important than girl bitch','luevZDXSv7zXO6zg8J7LdFkF3nWfNqB6','2024-06-08 14:30:13','2024-06-09 13:48:06'),(21,'zakaia','zakaj@gmail.com',NULL,'$2y$10$R2sR6beANs51q9Rs/nthreECxSZ1Cc9TIf3hVC1blZoeBCfe/rMHS','6667114668a81.jpg','It\'s me','YuLBYK8OE77TPMtabbuH3bhAbJUnD3pU','2024-06-10 14:26:03','2024-06-10 14:44:22'),(22,'Rawyar Shkak','rawyar@gmail.com',NULL,'$2y$10$q3C422uMdXa58hM.NJMrSOKINKuqlPnLLMD31jwT4Am6bbSFqxBTC','666711b8c4cdc.jpg','Hahah','1KZn3cdgXDNzlQpEpKhfcqnvjPRHWtfO','2024-06-10 14:45:06','2024-06-10 14:46:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websockets_statistics_entries`
--

LOCK TABLES `websockets_statistics_entries` WRITE;
/*!40000 ALTER TABLE `websockets_statistics_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `websockets_statistics_entries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-12 15:24:46
