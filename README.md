# PDO Basic Users

This is a simple project that demonstarates the use of Create Read Update Delete (CRUD) functionality with PHP. We use the PDO extension to connect to MySQL database. Additionally we use prepared statements to prevent against SQL injection attacks.

The project allows us to add, view, update and delete users. 

## Usage

In order to use this project, you need to have a server installed on your computer. I use [XAMPP](https://www.apachefriends.org/download.html "Download XAMPP").

Start XAMPP and make sure both Modules Apache and MySQL are running.
![xampp_modules](https://user-images.githubusercontent.com/6689087/106453702-6193a180-6492-11eb-9718-ac0269abd193.png)

### Then you need to create a database

In you browser go to `localhost/phpmyadmin`

Create a new database - `test`

![new_database](https://user-images.githubusercontent.com/6689087/106453713-63f5fb80-6492-11eb-8f0c-e7be44a666c8.png)

Go to the SQL tab and paste the following query and click Go
```sql
CREATE TABLE `test`.`users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(60) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
![sql_tab](https://user-images.githubusercontent.com/6689087/106453718-65bfbf00-6492-11eb-8d3c-7f735d6492cd.png)

Then perform the following steps
1. Download the project
2. Place it inside the htdocs folder of your XAMPP installation
3. Make sure XAMPP is running (both Apache and MySQL)
4. In your borwser of choice enter `localhost/pdo-basic-users-main`

Enjoy

## Screenshots
![users](https://user-images.githubusercontent.com/6689087/106454961-3316c600-6494-11eb-8ca2-86a3d5ce24b1.png)

![update-users](https://user-images.githubusercontent.com/6689087/106454965-34e08980-6494-11eb-8c65-629abf58091b.png)
