<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic - Full Rest Api in Docker</h1>
    <h1 align="center">Rback module - GhostAccessControl</h1>
    <br>
</p>

Directions
-------------------

	www/assets/             contains assets definition
	www/commands/           contains console commands (controllers)
	www/config/             contains application configurations
	www/controllers/        contains Web controller classes
	www/mail/               contains view files for e-mails
	www/models/             contains model classes
	www/runtime/            contains files generated during runtime
	www/tests/              contains various tests for the basic application
	www/vendor/             contains dependent 3rd-party packages
	www/views/              contains view files for the Web application
	www/web/                contains the entry script and Web resources


Prerequisites
------------

* Linux
* Version PHP 8.1 - set up in Dockerfile
* Composer
* Git
* Docker

# https://thriveread.com/apache-php-with-docker-mysql-and-phpmyadmin/

- You now have Pro Docker Apache PHP Setup with Docker Compose and MySQL. 
- You can now spin up a PHP Apache server Docker Compose container to run any PHP version you choose, i.e. 
- (PHP 5.3, 5.4, 5.6, 7.0, 7.2, 7.3, 7.4, 8.0, 8.1, 8.2). 
- You now have a working CRUD API on docker while using MySQL 
- to run SQL queries using PHP scripts with docker php ext install MySQL command to create the connections.

Instalation
------------

## 1). Clone this git repo on your mashine
- git clone 

## 2). Launch this image something like that
- docker-compose up --build -d

# Your website is here - http://localhost:8000/
# Your PhpMyAdmin is here - http://localhost:8001/

Может не отвечать тогда попробывать этот Url
http://localhost:8081/index.php
http://localhost:8081/index.php?route=/&route=%2F

User: root
Pass: password

Access to the database is that
host = mysql-db
user = db_user
pass = password
db = foquz





Yii2-basic
sudo chmod -R 777 www/
http://localhost:8000/web/
