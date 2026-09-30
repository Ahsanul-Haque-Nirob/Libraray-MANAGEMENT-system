-- Nirob Library database: demo data for import with phpMyAdmin
SET FOREIGN_KEY_CHECKS=0;

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
DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authors_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'George Orwell','gorwell@example.com','English novelist and essayist, known for Nineteen Eighty-Four and Animal Farm.','British','1903-06-25','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(2,'J.K. Rowling','jkrowling@example.com','Author of the Harry Potter fantasy series.','British','1965-07-31','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(3,'Yuval Noah Harari','yharari@example.com','Historian and author of Sapiens and Homo Deus.','Israeli','1976-02-24','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(4,'Agatha Christie','achristie@example.com','Queen of mystery fiction, creator of Hercule Poirot.','British','1890-09-15','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(5,'Stephen Hawking','shawking@example.com','Theoretical physicist and author of A Brief History of Time.','British','1942-01-08','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(6,'Toni Morrison','tmorrison@example.com','Nobel Prize-winning American novelist.','American','1931-02-18','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(7,'Malcolm Gladwell','mgladwell@example.com','Author and journalist known for Outliers and The Tipping Point.','Canadian','1963-09-03','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(8,'Frank Herbert','fherbert@example.com','Science fiction author of the Dune saga.','American','1920-10-08','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(9,'Chimamanda Ngozi Adichie','cadichie@example.com','Nigerian author known for Americanah and Half of a Yellow Sun.','Nigerian','1977-09-15','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(10,'Dan Brown','dbrown@example.com','Bestselling thriller author, known for The Da Vinci Code.','American','1964-06-22','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(11,'Yolanda Bartoletti','zora42@example.org','Nihil voluptatem quisquam dolor. Aut et dolor reprehenderit molestiae omnis voluptatem. Sed rem et non laborum fuga.','Lithuania','1955-03-25','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(12,'Prof. Yazmin Hermann DDS','dvonrueden@example.net','Accusantium ad aut et hic quis aut illo. Dolor saepe ex voluptate perferendis quaerat consequuntur earum. Ut ipsum iure doloribus a error.','Saint Vincent and the Grenadines','1970-11-14','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(13,'Mr. Brady Howell DDS','virgil.macejkovic@example.org','Magnam nobis nam dolor sit illo dolor dolores. Voluptate aut rem ea.','Bahrain','1978-04-20','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(14,'Einar Grady III','bernhard.monserrate@example.com','Repellat enim esse non consequuntur. Eaque laudantium placeat consequatur iusto velit culpa nesciunt.','Guinea','1991-06-30','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(15,'Arely McLaughlin','pbechtelar@example.com','Nulla repudiandae perspiciatis et libero aut cum libero quam. Libero ex iure laborum ab. Laborum dolorem vel voluptatem magnam. Et saepe dolorum asperiores eos nihil nisi saepe quo. Velit cum cupiditate libero illum.','Guadeloupe','1950-05-23','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(16,'Prof. Tatyana Schneider','rhettinger@example.org','Distinctio sed est ducimus sit blanditiis doloremque. Voluptas odio sed hic necessitatibus qui. Ut minima ipsam molestiae quos harum ut est.','Denmark','2004-03-26','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(17,'Pattie Considine','sanford.ashly@example.net','Eaque porro hic ullam doloribus sint consequatur voluptatem fugiat. Sint cupiditate modi perferendis repellat. Aut illo delectus ea corporis quo alias. Minus nihil ut iure possimus voluptas perferendis.','Canada','1991-08-02','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(18,'Claudie Gibson','hblick@example.net','Blanditiis nulla officia reiciendis nostrum laudantium voluptatem. Id vitae quidem quidem quos repellat placeat necessitatibus. Aliquid dolores ut aspernatur est ullam omnis in.','Chad','1961-04-25','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(19,'Jaleel Jast','vgleason@example.org','Aperiam voluptas aut eligendi molestias. Quos tempora est ex rerum. Molestias harum doloremque excepturi reiciendis eveniet nobis veniam.','Fiji','1958-05-03','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(20,'Lurline VonRueden','hector.smitham@example.net','Laborum ea officiis minima ratione fugit. Saepe et perferendis dolores numquam consectetur. Et impedit libero praesentium commodi ex quia odio suscipit. Sunt dolor maiores aut omnis. Impedit placeat itaque reiciendis.','Palestinian Territories','1953-10-01','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL);
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fiction','fiction','Imaginative and invented narratives.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(2,'Non-Fiction','non-fiction','Factual accounts and real-world topics.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(3,'Science','science','Books covering scientific discoveries and concepts.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(4,'History','history','Historical events and civilizations.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(5,'Biography','biography','Life stories of real people.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(6,'Technology','technology','Computing, software, and modern tech.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(7,'Philosophy','philosophy','Philosophical thought and ethics.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(8,'Psychology','psychology','Human behavior and mental processes.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(9,'Self-Help','self-help','Personal development and productivity.','2026-09-30 11:15:38','2026-09-30 11:15:38'),(10,'Mystery','mystery','Crime, suspense, and detective stories.','2026-09-30 11:15:38','2026-09-30 11:15:38');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `published_year` year(4) DEFAULT NULL,
  `total_copies` int(10) unsigned NOT NULL DEFAULT 1,
  `available_copies` int(10) unsigned NOT NULL DEFAULT 1,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `books_isbn_unique` (`isbn`),
  KEY `books_author_id_foreign` (`author_id`),
  KEY `books_category_id_foreign` (`category_id`),
  CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'1984','9780451524935',1,1,'A dystopian novel set in a totalitarian society ruled by Big Brother.','Secker & Warburg',1949,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 17:50:38',NULL),(2,'Animal Farm','9780451526342',1,1,'An allegorical novella about a farm where animals revolt.','Secker & Warburg',1945,4,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 17:47:44',NULL),(3,'Harry Potter and the Philosopher\'s Stone','9780439708180',2,1,'A young boy discovers he is a wizard and attends Hogwarts School.','Bloomsbury',1997,6,6,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(4,'Sapiens','9780062316097',3,4,'A brief history of humankind from the Stone Age to the present.','Harper Collins',2011,4,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(5,'Homo Deus','9780062464316',3,4,'A brief history of tomorrow and the future of humanity.','Harper Collins',2015,3,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(6,'Murder on the Orient Express','9780062693662',4,10,'Poirot investigates a murder aboard a luxury train.','Collins Crime Club',1934,3,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(7,'A Brief History of Time','9780553380163',5,3,'An exploration of cosmology and the nature of the universe.','Bantam Books',1988,4,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 21:26:04',NULL),(8,'Beloved','9781400033416',6,1,'A former enslaved woman is haunted by the ghost of her daughter.','Alfred A. Knopf',1987,2,0,NULL,'unavailable','2026-09-30 11:15:38','2026-09-30 22:09:39',NULL),(9,'Outliers','9780316017930',7,8,'The story of success and what makes high-achievers different.','Little, Brown',2008,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(10,'Dune','9780441013593',8,1,'Epic science fiction set on the desert planet Arrakis.','Chilton Books',1965,4,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(11,'Americanah','9780307455925',9,1,'A young Nigerian woman emigrates to the US and navigates race and identity.','Knopf',2013,3,1,NULL,'available','2026-09-30 11:15:38','2026-09-30 21:26:08',NULL),(12,'The Da Vinci Code','9780385504201',10,10,'A symbologist unravels a mystery hidden in Leonardo da Vinci\'s artwork.','Doubleday',2003,6,6,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(13,'Rerum odio quia velit optio ullam.','9795400927170',6,7,'Odit iusto quis cupiditate consectetur cumque. Voluptates aspernatur dicta eum. Quasi aliquam et explicabo consequatur. Perferendis reprehenderit voluptatem eaque alias in aut dolorem.\n\nConsequatur molestiae aut enim quibusdam est dolorem. Incidunt et voluptatem nostrum iure. Praesentium officia quis cupiditate omnis non et.','Ritchie-Schinner',1983,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(14,'Quaerat sunt ea voluptatem.','9797685929214',6,9,'Enim tenetur doloremque ut consectetur vel quis quisquam consequatur. Qui aut mollitia id. Facilis ab sunt autem doloremque ut.\n\nSed alias harum et reiciendis sequi aliquid. Alias harum aut quia nihil quis. Quia doloribus iusto iure. Libero eveniet sapiente ducimus magnam explicabo.','Kessler Group',1976,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(15,'Vero repellendus et quis et.','9788634220087',20,1,'Saepe sit dolorum facere accusantium. Pariatur eum ut modi rerum saepe. Neque qui iure cupiditate amet soluta possimus et. Cumque sed voluptas minus veritatis rerum qui qui id.\n\nEst ipsum corrupti optio ex consequatur ut. Aut eos qui vero quas aut aut omnis.','Auer, Ernser and Gulgowski',1982,5,3,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(16,'Molestiae aut est corrupti ut.','9786582128264',7,8,'Omnis exercitationem labore id minus sequi placeat sed. Occaecati amet animi magnam explicabo illum.\n\nTemporibus modi autem iure nostrum. Id est maxime amet quis error sit qui. Aut et illo numquam porro veritatis cumque.','Lang, Hilpert and Durgan',2021,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(17,'Sint dolores ea qui deleniti sed.','9783819629297',16,6,'Totam voluptatem perferendis exercitationem quae. Reprehenderit dolores illo aliquam recusandae nemo. Voluptatem est officia voluptas et. Voluptatum ipsa doloremque quaerat at quia error iure.\n\nVelit ut ipsa dolor asperiores voluptatem distinctio magni. Facere vero est ea exercitationem. Et qui debitis aspernatur voluptatem ipsa deserunt et magni. Id et aut laboriosam aut omnis enim.','Abbott LLC',1997,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(18,'Ut sint.','9793381670597',12,5,'Veritatis at sint quasi excepturi aut sequi quibusdam. Aut aut at quo eius sint excepturi est. Accusamus rem aut est rerum debitis. Est quas sit saepe voluptas voluptatem. Iste vel vitae tempore dolor incidunt id aut.\n\nReprehenderit id facilis aut sint beatae. Quo inventore reiciendis quis velit excepturi. Et rerum laudantium quae assumenda maiores.','Leffler-Kutch',1987,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(19,'Totam quam deserunt.','9784176792891',1,7,'Eos atque omnis quia consequuntur. Provident dolorem dolor quia omnis ex.\n\nEos dignissimos dolores voluptatem cumque omnis itaque omnis. Et similique eaque atque iusto et ut. Vel quidem corporis fugiat vero excepturi voluptatibus ullam.','Kihn and Sons',2010,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(20,'Suscipit cumque facilis officia consequuntur esse.','9793817966768',16,10,'Aut ea odio debitis dolorem qui. Sit veritatis quisquam repudiandae architecto eum reiciendis impedit. In est sed iste est. Harum et dignissimos beatae. Vitae minus voluptas et repellat voluptatum ullam.\n\nIpsam totam quidem corrupti ipsam quaerat ex eveniet. Voluptatum minima alias quod perferendis quas aut nemo. Quae vel veritatis aut ut itaque aperiam.','Collier, Sawayn and Hyatt',1974,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(21,'Aspernatur sed aperiam.','9797939233197',19,10,'Accusamus et inventore eos et non impedit fugiat. Voluptatum vel ducimus tempore ut rerum qui quia enim. Deserunt delectus expedita eos et. Ducimus sed et sit commodi non quis aut.\n\nAb et sed quis suscipit accusamus aut. Autem quisquam est rem consequatur magnam et eos. Odit sint dolore asperiores et voluptatum doloribus et.','Toy, Wilderman and Moore',1988,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(22,'Quia unde nobis ducimus nemo cupiditate.','9792105754858',14,4,'Numquam expedita quos est at quia. Modi occaecati dolores suscipit tenetur est explicabo. Fuga ipsa alias autem doloribus consequatur. Natus voluptas non et.\n\nSint veritatis vitae pariatur dicta ea. Explicabo possimus laboriosam fugiat.','Kunze-Spinka',2017,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(23,'Perferendis odit.','9797083926471',15,4,'Laboriosam corporis voluptatibus facilis. Ab odio dolores non quidem vitae. Quia et non eum est repellendus. Perferendis alias natus id reiciendis quis explicabo.\n\nVelit magni fuga omnis dolores qui. Et modi expedita eum sapiente voluptatem officia.','Prosacco LLC',1989,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(24,'Dolores voluptatem quos libero alias sint.','9792875866522',12,5,'Aliquid delectus numquam aut quia libero ut. Eveniet provident temporibus eos itaque deleniti nemo illum. Dolor nobis soluta est a aut a.\n\nEos et earum nobis possimus mollitia asperiores. Ut et molestias sint. Doloribus corporis omnis ex excepturi consequatur et suscipit. Aut nobis autem alias explicabo aspernatur eaque.','Klein-Gottlieb',2021,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(25,'Autem atque enim cum dolor.','9798335398046',6,1,'Aut aut quia accusamus delectus. Ut rerum nemo dolorem modi error nihil ea. Quia consequatur perferendis qui soluta. Maiores quos qui ut velit nobis nesciunt. In quia et dicta molestiae enim veritatis.\n\nSit asperiores repellat velit nihil praesentium sit. Nulla iusto saepe voluptas earum qui. Repudiandae omnis odit laudantium soluta sint minima expedita.','Mertz Ltd',1973,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(26,'Doloremque tempore autem.','9790909585197',12,3,'Natus tempore qui aut molestiae consequatur ratione voluptatem et. Minima quisquam et corporis sit saepe et. Molestiae facilis sequi cupiditate eum nihil quasi explicabo. Laudantium dolorem modi debitis et.\n\nEnim inventore rem excepturi corporis sed. Quidem iure voluptatem laudantium assumenda quae eligendi incidunt quos. Quia vel itaque quas sapiente iste architecto.','Leannon, Prosacco and Little',2000,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(27,'Natus sit consequatur cum.','9782718787275',16,2,'Dicta eos expedita quia quia nisi sed ab aliquam. Sunt amet qui voluptatem accusantium facilis incidunt. Dolores nihil suscipit dignissimos reprehenderit. Expedita sit illo quae voluptas tenetur voluptatum. Vero commodi error ipsum aut tenetur sint nisi ratione.\n\nSapiente mollitia quos non dolore odit. Nulla animi quidem doloribus quam corporis. Dolor praesentium est nobis vitae qui molestiae sint illo.','Kris-O\'Keefe',1986,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(28,'Dolores alias atque cum.','9796929827712',8,2,'Laboriosam possimus officia dolores sed debitis officia iusto ut. Mollitia maiores nesciunt molestiae itaque. Rerum iusto ratione sed possimus perferendis.\n\nQuo animi aliquam et officia. Tempore eos aut facilis beatae deleniti quis facilis. Incidunt et unde dignissimos vel.','Harvey, Swift and Keeling',1986,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(29,'Aspernatur accusantium odit eos.','9780145635060',8,6,'Dolore quibusdam non ipsum. Sequi tenetur quos qui in voluptas magni impedit. Voluptatibus aut qui et officiis ea incidunt. Fugiat ut officia deleniti voluptatum.\n\nAssumenda sint exercitationem qui id autem. Officiis odio odio quia eum tenetur. Quia adipisci enim est itaque quia aut. Doloribus autem ipsum inventore accusamus.','Hartmann-Prosacco',1978,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 21:26:13',NULL),(30,'Vitae dolor.','9799221226603',10,6,'Facilis corrupti enim velit laborum rerum illo. Et aspernatur et dolor nulla qui veritatis commodi. Consequatur qui harum culpa ipsa unde est. Nemo pariatur eligendi corporis odit.\n\nEum debitis veritatis id molestiae aut in optio non. Quia exercitationem omnis consectetur voluptas voluptatem minima. Assumenda fuga ut cumque et rerum. Fugit sit ex modi omnis hic nostrum ullam.','Hansen, Towne and Hill',2009,5,4,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:39',NULL),(31,'Nulla eum qui.','9793964880252',1,4,'Quidem ut commodi incidunt autem aut. Commodi vero sit voluptatem unde voluptas accusamus.\n\nNumquam dolor molestias autem excepturi ex laudantium. Reiciendis quia rerum molestias quasi id soluta. Minima mollitia amet molestiae possimus in tempora alias. Corporis eum sunt non rerum nemo sit.','Jast, Deckow and Witting',2006,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(32,'Possimus dolor dolorem error dicta aliquam.','9786487422016',18,2,'Sint in eaque inventore molestiae unde. Et sequi laudantium natus nihil. Ex dolores quis perspiciatis doloremque quaerat dolorem sit.\n\nRatione voluptatem amet consequuntur beatae est omnis. Voluptas nobis autem rerum odit rerum. Sit molestiae laudantium non exercitationem sit.','Wyman and Sons',2012,5,5,NULL,'available','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2024_01_01_000001_create_authors_table',1),(8,'2024_01_01_000002_create_categories_table',1),(9,'2024_01_01_000003_create_books_table',1),(10,'2024_01_01_000004_create_members_table',1),(11,'2024_01_01_000005_create_borrow_records_table',1),(12,'2024_01_01_000006_create_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


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
DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `membership_start` date NOT NULL,
  `membership_end` date NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_member_code_unique` (`member_code`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'LIB-6ABD43BAE289B','Alice Johnson','alice@example.com','555-0101','123 Maple St, Springfield','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(2,'LIB-6ABD43BAE7888','Bob Smith','bob@example.com','555-0102','456 Oak Ave, Shelbyville','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(3,'LIB-6ABD43BAE884B','Carol White','carol@example.com','555-0103','789 Pine Rd, Capital City','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(4,'LIB-6ABD43BAEA1E7','David Brown','david@example.com','555-0104','321 Elm Blvd, Ogdenville','2025-09-30','2027-09-30','inactive','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(5,'LIB-6ABD43BAEB131','Eva Martinez','eva@example.com','555-0105','654 Cedar Ln, North Haverbrook','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(6,'LIB-WF0442','Yasmin Gulgowski','liliane73@example.com','+1-256-895-7178','2409 Treutel Via Suite 946\nNew Cassidy, OR 24153-1451','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(7,'LIB-OH0703','Dean D\'Amore','cornell18@example.net','(240) 841-2425','239 Lexie Loop\nGracielashire, NH 76436','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(8,'LIB-HF9176','Kaley Rath','carey13@example.com','+1 (740) 940-3525','85297 Amya Mission Apt. 188\nSydneyfort, CA 67706','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(9,'LIB-DV7405','Laurel Cormier','bruen.bernie@example.net','+1-820-517-5249','659 Hegmann Center\nBerenicemouth, MN 62782','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(10,'LIB-VE9788','Kathlyn Conroy','gilda.bogan@example.org','+1 (732) 794-0788','9119 Janice Plains\nWilkinsonbury, NM 51338-5788','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(11,'LIB-CR9980','Kristy Steuber','jerald59@example.com','870-446-7528','555 Breitenberg Isle Suite 797\nMauriceland, ID 70401','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(12,'LIB-UK7823','Krista Sipes','kreilly@example.com','1-279-494-0328','2875 Imogene Place\nSouth Myron, NM 39473','2025-09-30','2027-09-30','active','2026-09-30 11:15:38','2026-09-30 11:15:38',NULL),(13,'LIB-YE4386','Prof. Malachi Kuhlman V','ghahn@example.com','+1-252-382-7584','64680 Abbott Manors\nHoegermouth, NC 23655','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(14,'LIB-CX5250','Ms. Marguerite Kohler','noemie.lehner@example.com','+14697363797','611 Lockman Terrace\nNew Adelinefort, NY 78148','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(15,'LIB-JJ3227','Christian Koss','vernice76@example.net','+12143186164','2150 Thompson Knolls Apt. 753\nLake Lorenzahaven, NY 79802-8909','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(16,'LIB-QX4717','Dr. Fanny Kemmer Sr.','ofriesen@example.net','+1-870-242-1748','8860 Jeremie Avenue\nStoltenbergview, MA 94696-6210','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(17,'LIB-SJ7853','Joey Ryan','beatrice38@example.com','+1-571-912-3297','6505 Gerlach Forks Suite 667\nLake Laurencetown, LA 64025-0775','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(18,'LIB-RX7384','Jennifer Oberbrunner II','dach.mateo@example.org','310.772.3611','99085 Dedric Mews Apt. 355\nSallychester, MS 79364','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(19,'LIB-MG6350','Jon Bauch','nicholaus.monahan@example.net','1-539-529-7450','8522 Jeanette Coves Suite 912\nHarristown, OH 51900-8787','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(20,'LIB-KD1219','Dr. Iliana Botsford Jr.','wiza.aurelia@example.com','(386) 876-9063','255 Willard Groves\nOrnfort, NY 51418-9526','2025-09-30','2027-09-30','active','2026-09-30 11:15:39','2026-09-30 11:15:39',NULL),(21,'LIB-6ABD4B380A5C9','Library Admin','admin@library.com',NULL,NULL,'2026-09-30','2027-09-30','active','2026-09-30 17:47:36','2026-09-30 17:47:36',NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


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
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Library Admin','admin@library.com',NULL,'$2y$12$5l3CiIbKKpDIjW6D7U01YuBfu5wrzD8c579YMXzXDJu13rmHSxQWS',NULL,'2026-09-30 11:15:38','2026-09-30 11:15:38');
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
DROP TABLE IF EXISTS `borrow_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrow_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `member_id` bigint(20) unsigned NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned','overdue') NOT NULL DEFAULT 'borrowed',
  `fine_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borrow_records_book_id_foreign` (`book_id`),
  KEY `borrow_records_member_id_foreign` (`member_id`),
  CONSTRAINT `borrow_records_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `borrow_records_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `borrow_records` WRITE;
/*!40000 ALTER TABLE `borrow_records` DISABLE KEYS */;
INSERT INTO `borrow_records` VALUES (1,4,1,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(2,17,2,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(3,16,3,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(4,30,5,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(5,15,6,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(6,21,7,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(7,19,8,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(8,15,9,'2026-09-25','2026-10-09',NULL,'borrowed',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(9,11,1,'2026-08-31','2026-09-14',NULL,'overdue',16.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(10,2,2,'2026-08-31','2026-09-14',NULL,'overdue',16.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(11,8,3,'2026-08-31','2026-09-14',NULL,'overdue',16.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(12,27,1,'2026-08-29','2026-09-12','2026-09-03','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(13,21,2,'2026-08-19','2026-09-02','2026-08-21','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(14,4,3,'2026-08-29','2026-09-12','2026-09-14','returned',2.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(15,11,5,'2026-08-12','2026-08-26','2026-08-14','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(16,30,6,'2026-09-06','2026-09-20','2026-09-13','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(17,12,7,'2026-08-12','2026-08-26','2026-08-29','returned',3.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(18,27,8,'2026-08-11','2026-08-25','2026-08-27','returned',2.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(19,15,9,'2026-08-12','2026-08-26','2026-08-22','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(20,31,10,'2026-08-15','2026-08-29','2026-08-23','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(21,3,11,'2026-09-03','2026-09-17','2026-09-12','returned',0.00,NULL,'2026-09-30 11:15:39','2026-09-30 11:15:39'),(22,1,21,'2026-09-30','2026-10-14','2026-09-30','returned',0.00,NULL,'2026-09-30 17:47:36','2026-09-30 17:47:36');
/*!40000 ALTER TABLE `borrow_records` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

UPDATE books b SET available_copies = b.total_copies - (SELECT COUNT(*) FROM borrow_records r WHERE r.book_id = b.id AND r.status <> 'returned'), status = IF(b.total_copies > (SELECT COUNT(*) FROM borrow_records r WHERE r.book_id = b.id AND r.status <> 'returned'), 'available', 'unavailable');
SET FOREIGN_KEY_CHECKS=1;
