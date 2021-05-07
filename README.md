Set Up
- git clone
- copy past .env file **copy .env.example .env**
- configure .env file and database 
- php composer.phar install
- php artisan key:gen
- php artisan migrate:fresh --seed
- php artisan serve

Open Browser
- http://localhost:8000/api/users
