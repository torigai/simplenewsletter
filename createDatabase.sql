/*
	Change password according to your wish and also
	in newsletter/model/Connect/Database.php !!!
*/


CREATE DATABASE IF NOT EXISTS simplenewsdb;
USE simplenewsdb;

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified` varchar(255) DEFAULT NULL,
  PRIMARY KEY(`id`),
  UNIQUE(`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE USER IF NOT EXISTS simplenewsdb_user IDENTIFIED WITH simplenewsdb_user_pwd;
GRANT ALL PRIVILEGES on simplenewsdb.* to simplenewsdb_user@localhost;