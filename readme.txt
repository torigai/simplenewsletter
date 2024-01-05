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

In order to install the mysqldatabase, please follow the instructions in createDatabase.sql

In order to have the program use the correct paths and infos for emailing etc., configure customvars.php according to your needs.

Change logo.png with your own logo.png.

You can run this program by simply creating a link to index.php on your webpage. For administration (writing newsletters and exporting email addresses), you should link your private part of the webpage with /newsletter/admin/write_newsletter.php


=== Security ===

It is reasonable to secure data transfer with a CAA or self-signed certificate

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

