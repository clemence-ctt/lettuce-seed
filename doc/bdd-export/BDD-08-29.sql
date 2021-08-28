-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.3.29-MariaDB-0+deb10u1 - Debian 10
-- SE du serveur:                debian-linux-gnu
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table lettuce. doctrine_migration_versions
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table lettuce.doctrine_migration_versions : ~4 rows (environ)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20210805162313', '2021-08-05 18:23:22', 179),
	('DoctrineMigrations\\Version20210806151828', '2021-08-06 17:18:43', 318),
	('DoctrineMigrations\\Version20210806160315', '2021-08-06 18:03:23', 75),
	('DoctrineMigrations\\Version20210806171149', '2021-08-06 19:11:56', 71),
	('DoctrineMigrations\\Version20210828142553', '2021-08-28 16:26:11', 660);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Listage de la structure de la table lettuce. picture
DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `like_counter` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lettuce.picture : ~67 rows (environ)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`id`, `name`, `description`, `date`, `file`, `like_counter`, `created_at`, `updated_at`) VALUES
	(5050, 'Claudia Goldner', 'Asperiores et corporis in. Ullam ab quis harum qui eius id. Aut eaque voluptas molestiae ducimus molestiae eius. Repudiandae sed asperiores repellendus dolore voluptas.', '2016-10-19', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 405, '2021-08-09 18:36:33', '2021-08-28 15:18:58'),
	(5051, 'Flo Schroeder II', 'Similique ipsum ipsam ullam autem est iste. Eligendi quasi dolores officia non velit quisquam sed.', '2020-04-21', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 145, '2021-08-09 18:36:33', '2021-08-25 16:56:27'),
	(5052, 'Stephany Anderson', 'Perspiciatis earum eligendi commodi qui porro non tenetur nisi. Ut eum et eum inventore facere exercitationem. Laborum praesentium minima non ut quia ab. Qui ab aut non voluptas molestiae facere.', '2017-11-04', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 509, '2021-08-09 18:36:00', '2021-08-28 15:28:46'),
	(5053, 'Orland Dicki', 'Aut iste laudantium et iure enim dolores id. Recusandae vel ipsam recusandae molestiae. Explicabo quaerat consequatur reiciendis sunt voluptates non.', '2016-08-06', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 376, '2021-08-09 18:36:33', '2021-08-28 14:40:51'),
	(5054, 'Mrs. Anais Lueilwitz', 'Velit et eum tempore repellat odit. Fugiat vel architecto accusamus blanditiis. Aut vero enim eos est. Quisquam consequatur officia nobis sunt sit in. Illo enim quas aut recusandae.', '1991-02-02', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 422, '2021-08-09 18:36:33', NULL),
	(5055, 'Shea Rutherford', 'Architecto repellendus ut non est. Aspernatur est sed rerum eveniet provident voluptatem. Occaecati est minus fugiat vero rem maiores.', '1984-06-04', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 382, '2021-08-09 18:36:33', NULL),
	(5056, 'Janessa Wiza', 'Quaerat sint exercitationem reiciendis id aut nesciunt nostrum ut. Blanditiis maxime et corrupti. Explicabo harum sapiente non accusantium ipsum. Sed aut veritatis earum sapiente.', '1995-10-17', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 72, '2021-08-09 18:36:33', NULL),
	(5057, 'Miss Rosina Monahan', 'Magnam rerum quisquam id qui ipsam et. Id aliquam vel illo nulla. Nihil fugit enim omnis sit eligendi soluta enim.', '1988-05-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 227, '2021-08-09 18:36:33', NULL),
	(5058, 'Bianka Raynor', 'Laboriosam quo necessitatibus esse rerum qui optio fugiat. Et quo excepturi ducimus quas ab. Aut quos inventore sit eos repudiandae quo iste.', '1987-11-25', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 399, '2021-08-09 18:36:33', NULL),
	(5059, 'Kavon Heidenreich', 'Perferendis facere illo rem ratione. Aut impedit quia nesciunt ut fugiat in. Consequatur nulla nihil natus veniam nemo aut voluptate. Soluta ducimus ipsa laboriosam quia praesentium.', '1971-02-20', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 327, '2021-08-09 18:36:33', NULL),
	(5060, 'Micaela Hagenes MD', 'Optio esse officia consectetur ipsam quia. Laborum velit asperiores quo id sed hic. Atque qui impedit occaecati totam qui. Qui perferendis occaecati qui at.', '1983-02-16', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 392, '2021-08-09 18:36:33', NULL),
	(5061, 'Gabriel Metz DDS', 'Nihil et qui ipsam et provident ut. Perspiciatis exercitationem deserunt ut consectetur praesentium. Dolorem et dolor officiis nobis.', '1997-03-14', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 146, '2021-08-09 18:36:33', NULL),
	(5062, 'Mrs. Cali Daniel', 'Nihil voluptate reprehenderit voluptatem suscipit culpa saepe. Facilis sit sed ea dolor et excepturi quibusdam. Distinctio assumenda tempore odit. Rerum et assumenda quia assumenda.', '2001-12-21', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 469, '2021-08-09 18:36:33', NULL),
	(5063, 'Mr. Pietro Beer', 'In ut quam aut consequatur sequi qui. Corporis asperiores quam aut sit ab quia quo ad. Saepe veritatis maiores est tempore. Nihil sapiente ad doloremque qui corporis aut non.', '2021-05-09', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 155, '2021-08-09 18:36:33', '2021-08-25 16:51:59'),
	(5064, 'Jarod Walter', 'Ullam ratione aut impedit consequatur. Rerum voluptatem consequatur exercitationem corrupti nihil excepturi modi. Et perferendis aperiam fuga.', '2002-01-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 162, '2021-08-09 18:36:33', NULL),
	(5065, 'Maryjane Lindgren', 'Numquam quaerat quis sunt quaerat reiciendis et eum hic. Et beatae voluptate dicta repellat a voluptatem ipsum. Fugiat aspernatur voluptatem quia similique velit sit.', '1993-10-03', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 118, '2021-08-09 18:36:33', NULL),
	(5066, 'Dr. Dimitri Nienow PhD', 'Ipsa cupiditate ipsum itaque. Optio quis aut sit adipisci. Sint perferendis quod sint sunt quasi occaecati.', '1972-02-25', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 39, '2021-08-09 18:36:33', NULL),
	(5067, 'Mrs. Opal Friesen DVM', 'Dolore impedit ut dolores deserunt nisi. Animi dicta quia expedita fugiat commodi. Qui quas officia quia autem vero eaque.', '1975-02-17', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 462, '2021-08-09 18:36:33', NULL),
	(5068, 'Sheridan Cremin', 'Neque quasi est voluptatem architecto. Animi ipsum voluptates voluptates consectetur. Odit aspernatur impedit dicta itaque. Sint iusto debitis dolorum facilis sint.', '1999-03-13', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 203, '2021-08-09 18:36:33', NULL),
	(5069, 'Daisha Ondricka', 'Debitis reiciendis blanditiis sed. Sapiente est beatae corrupti quis perspiciatis dolor rerum nam. Et et dolorem architecto in. Quia rerum et sed accusamus commodi saepe.', '2021-07-03', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 175, '2021-08-09 18:36:33', '2021-08-27 19:02:19'),
	(5070, 'Brendan Dietrich', 'Amet voluptatem expedita beatae quis. Repudiandae hic consectetur cum rerum. Ut explicabo dolor labore temporibus. Repudiandae aut est et quam cupiditate.', '2006-12-20', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 155, '2021-08-09 18:36:33', NULL),
	(5071, 'Ms. Katherine Purdy', 'Aut quis eveniet vitae qui harum nostrum. Quod molestiae quos rem voluptatem ipsam. Porro ipsum dolorum tenetur voluptatem magni.', '2021-03-17', '0621191baa4d6489697da8104079cca4.jpg', 495, '2021-08-09 18:36:33', '2021-08-27 17:43:23'),
	(5072, 'Ansley Quitzon', 'Labore aut harum eos perferendis. Est reprehenderit voluptas aut officia dignissimos sunt. Maiores quia odit sit atque sunt. Praesentium exercitationem itaque totam doloremque.', '2003-03-12', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 91, '2021-08-09 18:36:33', NULL),
	(5073, 'Ethan Bartoletti', 'Nihil ipsum non ex voluptas distinctio. Non explicabo consectetur cupiditate dolores repellat accusamus explicabo. Neque magni et molestias et explicabo. Sint velit harum neque optio cum.', '1987-12-07', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 262, '2021-08-09 18:36:33', NULL),
	(5074, 'Ms. Araceli Kunde Jr.', 'Blanditiis consequatur fugiat est est id. Earum accusamus dolore et ipsam rerum asperiores. Eos odio laboriosam ut culpa aut nihil similique et.', '2009-07-24', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 378, '2021-08-09 18:36:33', NULL),
	(5075, 'Prof. Darion Murazik', 'Enim placeat sunt harum aut est unde. Voluptatem tempora provident praesentium harum eaque. Non numquam a voluptatem rerum sapiente voluptas libero. Et quisquam sapiente ipsa et.', '2016-11-08', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 360, '2021-08-09 18:36:33', NULL),
	(5077, 'Jaeden Ferry Sr.', 'Ut libero voluptatum tempora molestias. Non et iusto dolores exercitationem molestiae sunt facere. Hic enim illum ipsam labore aliquid qui laboriosam.', '2021-08-21', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 65, '2021-08-09 18:36:33', '2021-08-27 19:10:10'),
	(5078, 'Waylon Harber', 'In cupiditate dolor ea et praesentium aperiam ut. Omnis assumenda aut est id sint. Soluta accusamus enim iste atque ipsum. Tenetur doloribus laborum aspernatur voluptas rerum facere pariatur.', '1994-12-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 454, '2021-08-09 18:36:33', NULL),
	(5079, 'Shanel Mayert', 'Et omnis explicabo minus vero. Cum deleniti officiis explicabo aperiam provident. Cum vero qui et qui vel minima.', '2009-03-13', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 478, '2021-08-09 18:36:33', NULL),
	(5080, 'Santos Ryan II', 'Accusamus vel voluptatibus deleniti neque. Vel maiores nobis corrupti sit voluptas. Delectus repudiandae amet in vel culpa saepe. Accusantium distinctio perferendis quis voluptas.', '1975-02-21', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 78, '2021-08-09 18:36:33', NULL),
	(5081, 'Unique Cummings', 'Nihil rerum nihil rerum consequatur. Voluptates et corrupti quidem dolorem tempora delectus debitis error. Praesentium quibusdam repellendus explicabo accusamus illo sit velit.', '2000-07-22', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 392, '2021-08-09 18:36:33', NULL),
	(5082, 'Gregory Walsh', 'Tempora minima consequuntur unde voluptas. A suscipit harum harum voluptates. Deleniti voluptates nihil ratione accusantium labore.', '2007-02-18', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 226, '2021-08-09 18:36:33', NULL),
	(5083, 'Jarod Orn', 'Incidunt provident quia sunt omnis sed sunt inventore. Placeat quibusdam aut dolorem commodi autem possimus expedita quod. Rem totam aut maxime repellendus.', '2002-04-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 455, '2021-08-09 18:36:33', NULL),
	(5084, 'Prof. Leon Lubowitz PhD', 'Pariatur ab consequuntur provident dolore qui voluptas et fuga. Nisi esse laboriosam vel. Cum vel dolores soluta.', '1995-06-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 310, '2021-08-09 18:36:33', NULL),
	(5085, 'Lemuel Heaney', 'Quo velit corrupti eligendi autem dolores culpa minus quia. Est est illum eligendi dicta. Atque quia vel ea vero omnis. Iste neque similique repellendus ut vel. Necessitatibus modi dolor sit.', '1973-09-08', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 244, '2021-08-09 18:36:33', NULL),
	(5086, 'Oren Grant', 'Rem impedit est culpa voluptatem molestiae eos. Quam dolorem aliquam incidunt consequatur.', '1992-08-05', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 106, '2021-08-09 18:36:33', NULL),
	(5087, 'Vernie Wisozk DDS', 'Sint fugit rem dolores fugiat velit ea. Quasi rerum consectetur dolores molestiae. Itaque qui aspernatur doloribus aut quam ea nulla molestiae.', '2009-06-30', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 297, '2021-08-09 18:36:33', NULL),
	(5088, 'Wilma Satterfield', 'Accusamus perspiciatis at et expedita. Et qui doloremque quis non. Molestiae recusandae suscipit qui natus. Porro necessitatibus ea deserunt eum sint aut et.', '2001-11-01', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 189, '2021-08-09 18:36:33', NULL),
	(5089, 'Bridget Bode', 'Asperiores voluptate ducimus dolorum incidunt. Blanditiis eligendi ipsa cupiditate. Qui repellat reprehenderit reiciendis sit sit.', '1980-11-05', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 164, '2021-08-09 18:36:33', NULL),
	(5090, 'Demetrius Rolfson PhD', 'Impedit vitae error velit corporis ea voluptas repudiandae rerum. Fugit aspernatur exercitationem ullam incidunt ut et ea. Dolorum sed ea sit cum totam. Qui recusandae vero et vero consectetur.', '2010-05-25', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 108, '2021-08-09 18:36:33', NULL),
	(5091, 'Samir Carroll', 'Magnam est sunt laboriosam. Reprehenderit sed alias nesciunt doloremque laboriosam perferendis magnam. Reiciendis sunt dolores vel voluptatibus.', '1974-02-10', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 243, '2021-08-09 18:36:33', NULL),
	(5092, 'Alvis Pollich', 'Adipisci sit ducimus amet quis eveniet. Repellat suscipit iste ut aliquam et sed corporis. Iusto est dolorem libero sint temporibus atque impedit distinctio. Enim sequi eius facere eum.', '2005-04-27', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 13, '2021-08-09 18:36:33', NULL),
	(5093, 'Lowell Fadel', 'Consequatur doloremque optio optio. Eaque officiis quia ut accusantium velit. Laborum rerum et fuga consequuntur.', '2016-08-27', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 279, '2021-08-09 18:36:33', NULL),
	(5095, 'Mrs. Zita Grady V', 'Modi neque et non porro fugiat quasi id. Qui repellendus dolores recusandae consequatur. Dolore sit nihil est vitae omnis sapiente eos. Ea aut nobis rerum ipsum sed in.', '1989-07-29', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 122, '2021-08-09 18:36:33', NULL),
	(5096, 'Casandra Paucek MD', 'Voluptatem sequi labore sed fugiat quaerat porro. Eum suscipit quibusdam vel eos. Qui dolorem natus est. Labore id quas quisquam fugiat nemo tempore.', '1992-04-18', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 109, '2021-08-09 18:36:33', NULL),
	(5097, 'Neoma Rath', 'Dolores molestiae quia officiis. Numquam qui itaque quibusdam ratione et dignissimos dolor. Vel et facere reiciendis rem doloremque iste aut.', '2013-08-16', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 88, '2021-08-09 18:36:33', NULL),
	(5098, 'Anabelle Considine', 'Optio architecto sunt numquam provident aut eaque consequuntur. Rerum eligendi laudantium qui vitae veritatis. Ducimus et animi sit quam quia.', '2017-11-09', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 316, '2021-08-09 18:36:33', NULL),
	(5099, 'Prof. Dena Quigley', 'Omnis est maxime saepe. Dolorem suscipit dignissimos consequatur illo consequatur delectus.', '1999-05-20', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 418, '2021-08-09 18:36:33', NULL),
	(5100, 'Mr. Merlin Denesik PhD', 'Omnis voluptate dignissimos officia. Similique ratione alias omnis et praesentium sint voluptas. Consequatur illo amet enim beatae sunt. Aut iste modi excepturi itaque.', '2002-08-09', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 19, '2021-08-09 18:36:33', NULL),
	(5101, 'Jaime Conn', 'Qui et neque optio repellendus. Commodi nostrum ipsa non possimus atque sed. Sed ut eos itaque temporibus velit et quae voluptatem. Voluptatem ex mollitia ipsa vel.', '1998-02-12', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 325, '2021-08-09 18:36:33', NULL),
	(5102, 'Alena Mertz', 'Eum est dolorum illo dolor. Ut voluptas sit ipsa non harum a. Pariatur autem consectetur ut qui ut velit voluptas.', '1977-12-21', '0621191baa4d6489697da8104079cca4.jpg', 166, '2021-08-09 18:36:33', NULL),
	(5103, 'Eudora Lockman', 'Quo quasi tempore inventore omnis blanditiis. Distinctio ea maiores beatae et rerum quaerat. Doloremque minima animi error qui.', '2006-04-13', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 339, '2021-08-09 18:36:33', NULL),
	(5104, 'Sunny Swift', 'Blanditiis deleniti iure ex excepturi. Non doloremque modi soluta natus voluptatem. Corrupti magni quam culpa hic facere qui reprehenderit rem.', '1986-05-21', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 383, '2021-08-09 18:36:33', NULL),
	(5105, 'Kayleigh Moen', 'Et quia nobis eum saepe laborum. Repellendus necessitatibus ratione id voluptate. Facilis eum qui eaque.', '1987-09-24', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 441, '2021-08-09 18:36:33', NULL),
	(5106, 'Jennie Kilback', 'Voluptas consequuntur qui aut laudantium molestiae dolore omnis. Culpa eum ea mollitia possimus excepturi vel magni. Doloribus minima quia excepturi aut magni autem totam esse.', '2013-04-28', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 143, '2021-08-09 18:36:33', NULL),
	(5107, 'Kelsie Huel', 'Esse qui molestias quidem iusto nobis fuga consequatur laboriosam. Cumque autem odit libero dignissimos eum amet. Molestias labore velit et deleniti in vitae modi.', '1985-03-19', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 176, '2021-08-09 18:36:33', NULL),
	(5108, 'Dr. Chaz Senger', 'Fuga voluptate blanditiis hic ut. Qui sint fugit eveniet necessitatibus. Velit velit non ex. Adipisci cum enim maxime necessitatibus.', '1974-01-18', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 227, '2021-08-09 18:36:33', NULL),
	(5109, 'Dr. Derick Weimann', 'Numquam perferendis eligendi ut numquam at. Doloremque vel corporis excepturi distinctio non quasi.', '1992-08-14', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 246, '2021-08-09 18:36:33', NULL),
	(5110, 'Demario Runte Sr.', 'Culpa expedita vel cumque. Natus veritatis sapiente eligendi provident eos saepe ut. Repudiandae tempora est iste accusantium.', '1976-03-04', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 67, '2021-08-09 18:36:33', NULL),
	(5113, 'Claudia Choufleur', 'top model', '2020-01-02', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', 9, '2016-01-01 00:00:00', NULL),
	(5114, 'Stephanie de Monakombu', 'a la casserole olé olé', '2021-03-05', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', NULL, '2021-08-24 17:30:23', NULL),
	(5117, 'Castor Sucré', 'a la casserole olé olé', '2021-03-05', 'aefb89ccbf8e40351eaa82daf5de1949.jpg', NULL, '2021-08-24 17:37:26', NULL),
	(5120, 'Show Fleur', 'sqd<qsd', '2018-02-03', 'e2b1001d8dbbb7cabf5bb84bd186494d.jpg', NULL, '2021-08-24 18:43:24', '2021-08-24 19:41:02'),
	(5125, ';kuvgl;kigh', 'yhrtjdryjthr', '2017-02-02', '343592ce882e9419d5fcc534b97b7c74.jpg', NULL, '2021-08-25 20:34:59', '2021-08-28 15:07:56'),
	(5127, 'lkjklmjmjlk', 'kjhjkjhk', '2017-02-04', '7df71916713086f5a1281577fc086354.jpg', NULL, '2021-08-27 17:29:43', NULL),
	(5128, 'Stephany Anderson bis', 'khkhjkhkj', '2021-05-08', 'ea719e8ca97d4a5795c7bc0afa9e1ab0.jpg', NULL, '2021-08-28 15:56:22', NULL),
	(5129, 'Stephanie de Monakombu', 'kombu cha cha cha', '2021-08-07', '76a8f625ea6a6a779100c970aa628066.jpg', NULL, '2021-08-28 15:57:45', '2021-08-28 16:08:24');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;

-- Listage de la structure de la table lettuce. picture_plant
DROP TABLE IF EXISTS `picture_plant`;
CREATE TABLE IF NOT EXISTS `picture_plant` (
  `picture_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  PRIMARY KEY (`picture_id`,`plant_id`),
  KEY `IDX_2BD98A3CEE45BDBF` (`picture_id`),
  KEY `IDX_2BD98A3C1D935652` (`plant_id`),
  CONSTRAINT `FK_2BD98A3C1D935652` FOREIGN KEY (`plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2BD98A3CEE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lettuce.picture_plant : ~88 rows (environ)
/*!40000 ALTER TABLE `picture_plant` DISABLE KEYS */;
INSERT INTO `picture_plant` (`picture_id`, `plant_id`) VALUES
	(5050, 480),
	(5050, 481),
	(5050, 503),
	(5050, 510),
	(5050, 530),
	(5051, 482),
	(5052, 481),
	(5052, 482),
	(5052, 484),
	(5052, 492),
	(5052, 493),
	(5053, 480),
	(5053, 482),
	(5053, 492),
	(5054, 484),
	(5055, 485),
	(5056, 486),
	(5057, 487),
	(5058, 488),
	(5059, 489),
	(5060, 490),
	(5061, 491),
	(5062, 492),
	(5063, 480),
	(5063, 493),
	(5064, 494),
	(5065, 495),
	(5066, 496),
	(5067, 497),
	(5068, 498),
	(5069, 499),
	(5070, 500),
	(5072, 502),
	(5073, 503),
	(5074, 504),
	(5075, 505),
	(5077, 483),
	(5077, 484),
	(5077, 485),
	(5077, 486),
	(5077, 487),
	(5080, 510),
	(5081, 511),
	(5082, 512),
	(5083, 513),
	(5084, 514),
	(5085, 515),
	(5086, 516),
	(5087, 517),
	(5088, 518),
	(5089, 519),
	(5090, 520),
	(5091, 521),
	(5092, 522),
	(5093, 523),
	(5095, 525),
	(5096, 526),
	(5097, 527),
	(5098, 528),
	(5099, 529),
	(5100, 530),
	(5101, 531),
	(5102, 532),
	(5103, 533),
	(5104, 534),
	(5105, 535),
	(5106, 536),
	(5107, 537),
	(5108, 538),
	(5109, 539),
	(5110, 540),
	(5113, 540),
	(5114, 512),
	(5117, 529),
	(5117, 536),
	(5117, 537),
	(5120, 493),
	(5120, 503),
	(5125, 480),
	(5125, 481),
	(5125, 483),
	(5125, 493),
	(5128, 480),
	(5128, 482),
	(5128, 483),
	(5129, 505),
	(5129, 510),
	(5129, 511);
/*!40000 ALTER TABLE `picture_plant` ENABLE KEYS */;

-- Listage de la structure de la table lettuce. plant
DROP TABLE IF EXISTS `plant`;
CREATE TABLE IF NOT EXISTS `plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cover_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AB030D72A76ED395` (`user_id`),
  KEY `IDX_AB030D72922726E9` (`cover_id`),
  CONSTRAINT `FK_AB030D72922726E9` FOREIGN KEY (`cover_id`) REFERENCES `picture` (`id`),
  CONSTRAINT `FK_AB030D72A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=552 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lettuce.plant : ~57 rows (environ)
/*!40000 ALTER TABLE `plant` DISABLE KEYS */;
INSERT INTO `plant` (`id`, `user_id`, `name`, `description`, `date`, `created_at`, `updated_at`, `cover_id`) VALUES
	(480, 14, 'Ail', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(481, 14, 'Artichaut', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(482, 14, 'Asperge', NULL, '2019-04-04', '2021-08-09 18:36:00', '2021-08-14 16:17:33', NULL),
	(483, 14, 'Aubergine', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(484, 14, 'Avocat', NULL, '2016-01-02', '2021-08-09 18:36:33', '2021-08-14 17:02:59', NULL),
	(485, 14, 'Bette', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(486, 14, 'Betterave', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(487, 14, 'Blette', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(488, 14, 'Brocoli', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(489, 14, 'Carotte', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(490, 14, 'Catalonia', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(491, 14, 'Céleri', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(492, 14, 'Champignon', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(493, 14, 'Chou-fleur', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(494, 14, 'Choux', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(495, 14, 'Citrouille', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(496, 14, 'Concombre', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(497, 14, 'Courge', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(498, 14, 'Courgette', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(499, 14, 'Cresson', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(500, 14, 'Crosne', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(502, 14, 'Daikon', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(503, 14, 'Échalote', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(504, 14, 'Endive', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(505, 14, 'Épinard', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(510, 14, 'Haricot', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(511, 14, 'Igname', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(512, 14, 'Konbu', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(513, 14, 'Laitue', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(514, 14, 'Lentille', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(515, 14, 'Mâche', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(516, 14, 'Maïs', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(517, 14, 'Manioc', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(518, 14, 'Navet', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(519, 14, 'Oignon', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(520, 14, 'Olive', 'ntm', '2021-01-01', '2021-08-09 18:36:00', NULL, NULL),
	(521, 14, 'Oseille', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(522, 14, 'Panais', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(523, 14, 'Patate', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(525, 14, 'Petits pois', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(526, 14, 'Poireau', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(527, 14, 'Poivron', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(528, 14, 'Pomme de terre', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(529, 14, 'Potimarron', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(530, 14, 'Potiron', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(531, 14, 'Radis', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(532, 14, 'Rhubarbe', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(533, 14, 'Roquette', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(534, 14, 'Rutabaga', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(535, 14, 'Salade', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(536, 14, 'Salsifi', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(537, 14, 'Tétragone', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(538, 14, 'Tomate', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(539, 14, 'Topinambour', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(540, 14, 'Vitelotte', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(542, 14, 'Wasabi', NULL, NULL, '2021-08-09 18:36:33', NULL, NULL),
	(548, 14, 'Fougère', 'we love the sous-bois', '2021-02-02', '2021-08-23 20:00:09', NULL, NULL);
/*!40000 ALTER TABLE `plant` ENABLE KEYS */;

-- Listage de la structure de la table lettuce. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lettuce.user : ~5 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `created_at`, `updated_at`) VALUES
	(14, 'admin@admin.com', '["ROLE_ADMIN"]', '$2y$13$B0e0j/JcxC3EuYuV0pPt2elkhsumG.bSYkivMK3kOMevpAOUzhWnG', 'Boudin Noir', '2017-01-01 02:02:00', '2021-08-25 15:37:46'),
	(17, 'carotte@pouet.com', '[]', '$2y$13$twSshPE/gCEkPtAkzD.10.iHuVbKccpETUj/VOR9MCqDPezbPGxm6', 'carotte2', '2021-08-14 18:19:23', '2021-08-14 18:48:57'),
	(20, 'poulet@poulet.com', '[]', '$2y$13$bo6FCxUZToozp2Bd/wSPNuEwwWeYDcOV.5pZSSzNGCexYisvNG2hO', 'poulet2', '2021-08-18 16:55:40', '2021-08-18 16:57:05'),
	(26, 'poop@dog.local', '[]', '$2y$13$Wq12/losuDYuI4qO/Y7Kx.bnoiwDzoaFMEmiFm62diygcVFsRHb4i', 'poop', '2021-08-22 00:14:29', NULL),
	(27, 'tonton@tonton.com', '["ROLE_USER"]', '$2y$13$6BVCVpW2SvVOKqgUdDRLCepzOIOsebD.if3mrbTSpt5p0LyWd6DZe', 'tonton', '2021-08-23 15:39:34', '2021-08-23 15:40:31');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
