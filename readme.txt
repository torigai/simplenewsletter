=== Simplenews Plugin ===

Contributor:  Torigai
Author URI:   https://github.com/torigai
Description:  Simple Newsletter Plugin
Version:      1.0.0
License:      MIT
License URI:  https://mit-license.org/


=== Description ===

The simple newsletter plugin allows users to subscribe and unsubscribe for 
a newsletter. After subscribing or unsubscribing, by adding their email-adress to
a mysql database, the user will be requested by email to open a link and thereby to
confirm his or her action. 

The program also comes with an administrational part. The admin of the website can either write newsletters in raw-html code and send it to all registered users, or copy-paste the email adresses of the users and then send an email via any email client.


=== Installation ===

You have to install composer to get autoloader and phpmailer. For this open the root folder of this program (newsletter/) and type in the following commands:
	
	curl -sS https://getcomposer.org/installer | php
	php composer.phar update

In order to install the mysqldatabase, please follow the instructions in createDatabase.sql. But before doing that you should decide on how you want to
secure your administrational part (cf. the section on security below).

In order to have the program use the correct paths and infos for emailing etc., configure customvars.php according to your needs.

Change logo.png with your own logo.png.

You can run this program by simply creating a link to /newsletter/index.php on your webpage. For administration (writing newsletters and exporting email addresses), you should link your private part of the webpage with /newsletter/admin/index.php

Make sure that the file rights of /simplenewsletter/import_emails.php are 600 (rw----)!


=== Security ===

It is reasonable to secure data transfer with a CAA or self-signed certificate

Make sure that the file rights of /simplenewsletter/import_emails.php are 600 (rw----)!

For securing the administrational part I propose two methods:

METHOD 1:

The directory /newsletter/admin should be secured with a password, for instance via an appropriate htaccess file or directly in the apache configs. For instance add 

<Directory /var/www/MYPATHTO/newsletter/admin>
    ...
    
    AuthType Basic
    AuthName "admin"
    AuthBasicProvider dbm
    AuthDBMUserFile /var/www/MYPATHTO/.dbmpwd
    require user admin

    ...
</Directory>

to your website config-settings and use authentification with a DBM file. For more informations confer the Apache documentation: https://httpd.apache.org/docs/

In order to secure the admin-part in that way, change the header in /admin/index.php such that it points to /admin/views/write_newsletter.php

Further you have to comment out

    require_once '../controller/session_check.php';

in /admin/views/preview.php and /admin/views/write_newsletter.php

as well as
    
    require_once 'session_check.php';

in /admin/controller/preview.php, /admin/controller/send_newsletter.php and /admin/controller/write_newsletter.php

For method 1 it is not necessary to create a table 'users' as described in createDatabase.sql!


METHOD 2

If you prefer the login method integrated in this program, leave everything as is. When you create the tables, you also have to create a table 'users' and insert the name of your admin and the sha1-hash of the password for your admin as is described
in createDatabase.sql.


=== Import mailinglist ===

The script simplenewsletter/import_emails.php allows you to import emails into the database without confirmation. It's important that the file rights should be set to 600 after you finished with that script.
