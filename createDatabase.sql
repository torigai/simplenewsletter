/*
 Change password according to your wish and also
 in newsletter/model/Connect/Database.php !!!

  If you don't want to use authentication for the admin part
  via htaccess or the apache config, you have to create the 
  table `users`. Change the name and password of the admin-user
  as you like!! The password must be the sha1 of your plain 
  password!!
*/


CREATE DATABASE IF NOT EXISTS simplenewsletterdb;
USE simplenewsletterdb;

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `delrequest` varchar(255) DEFAULT NULL,
  PRIMARY KEY(`id`),
  UNIQUE(`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TRIGGER delete_superfluous_rows
AFTER UPDATE ON newsletter FOR EACH ROW
  DELETE FROM newsletter 
  WHERE verified IS NOT NULL
  AND DATEDIFF(NOW(), created_at) > 14;

CREATE USER IF NOT EXISTS 'simplenewsletterdb_user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mysimplenewsletterdbpwd';
GRANT SELECT, INSERT, UPDATE, DELETE ON simplenewsletterdb.* TO 'simplenewsletterdb_user'@'localhost';


/**
 * BEGIN Optional table 'users'
**/

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY(`id`),
  UNIQUE(`username`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users (username, password, last_login) VALUES ('myadminname', 'my-sha1-adminpwd', now());

/**
 * END
**/


