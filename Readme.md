<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic - Full Rest Api in Docker</h1>
    <h3 align="center">Rback module - GhostAccessControl</h3>
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

<a href="https://thriveread.com/apache-php-with-docker-mysql-and-phpmyadmin/" target="_blank">
	https://thriveread.com/apache-php-with-docker-mysql-and-phpmyadmin/
</a>

- You now have Pro Docker Apache PHP Setup with Docker Compose and MySQL. 
- You can now spin up a PHP Apache server Docker Compose container to run any PHP version you choose, i.e. 
- (PHP 5.3, 5.4, 5.6, 7.0, 7.2, 7.3, 7.4, 8.0, 8.1, 8.2). 
- You now have a working CRUD API on docker while using MySQL 
- to run SQL queries using PHP scripts with docker php ext install MySQL command to create the connections.

Instalation
------------

## 0). Must turn off apache, mysql services on your local machine either you won't launch the project.
* ``` sudo services apache2 stop ```
* ``` sudo services mysql stop ```

## 1). Clone this git repo on your mashine
* ```git clone git@github.com:timur-safarov/yii2-restfull-in-docker.git```

## 2). Go to the local repo and Launch this image something like that
* ``` cd /var/www/git-repo/ ```
* ``` docker-compose up --build -d ```

## 3). Next thing you need going to do is actually install composer in docker container
* ``` docker exec -it PHP-webserver sh ```
* ``` composer update ```
- Make sure that the folder vendor is appear
* ``` ls -la ```

## 4). Change rights for some folders
- Leave the docker container
* ``` exit ```
* ``` sudo chmod -R 777 www/runtime www/web/assets ```

## 5). Import the database
- Go to the PhpMyAdmin
<a href="http://localhost:8001/" target="_blank">http://localhost:8001/</a>
- Login: root
- Password: password
- Choose the <b>foquz</b> database and Import there db.sql file

## 6). Time's up to check-in on our site <a href="http://localhost:8000/web/" target="_blank">http://localhost:8000/web/</a>
- Login: a.plotnikov
- Password: 3goxLF%Yfh5B

### Your website is here - http://localhost:8000/
### Your PhpMyAdmin is here - http://localhost:8081/index.php?route=/&route=%2F


### You can change credentials for database here(www/config/db.php). Don't forget to fix docker-composer file.
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql-db;dbname=foquz',
    'username' => 'db_user',
    'password' => 'password',
    'charset' => 'utf8',
];
```
### The root access to database
- User: root
- Pass: password

### Access to the database
- host = mysql-db
- user = db_user
- pass = password
- db = foquz

### File the foquz.postman_collection.json you can use as a postman collections and send API requests.

