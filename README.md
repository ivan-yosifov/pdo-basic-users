# pdo-simple-crud

This is a simple project that demonstarates the use of Create Read Update Delete (CRUD) functionality with PHP. We use the PDO extension to connect to MySQL database. 

The project allows us to add, view, update and delete users. 

## Usage

In order to use this project, you need to have a server installed on your computer. I use [XAMPP](https://www.apachefriends.org/download.html "Download XAMPP").

Start XAMPP and make sure both Modules Apache and MySQL are running.


Then you need to create a database
In you browser go to `localhost/phpmyadmin`

Create a new database - `test`
Go to the SQL tab and paste the following query
```sql
CREATE TABLE `test`.`users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(60) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```

Then perform the following steps
1. Download the project
2. Place it inside the htdocs folder of your XAMPP installation
3. Make sure XAMPP is running (both Apache and MySQL)
4. In your borwser of choice enter `localhost/pdo-basic-users-main`

Enjoy
