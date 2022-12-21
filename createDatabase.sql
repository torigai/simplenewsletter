/*
	Change password according to your wish and also
	in newsletter/model/Connect/Database.php !!!
*/


CREATE DATABASE IF NOT EXISTS simplenewsletterdb;
USE simplenewsletterdb;

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `delrequest` varchar(255) DEFAULT NULL;
  PRIMARY KEY(`id`),
  UNIQUE(`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TRIGGER delete_superfluous_rows
AFTER DELETE ON newsletter FOR EACH ROW
  DELETE FROM newsletter 
  WHERE verified IS NOT NULL
  AND DATEDIFF(NOW(), created_at) > 14;

CREATE USER IF NOT EXISTS 'simplenewsletterdb_user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mysimplenewsletterdbpwd';
GRANT SELECT, INSERT, UPDATE, DELETE ON simplenewsletterdb.* TO 'simplenewsletterdb_user'@'localhost';
