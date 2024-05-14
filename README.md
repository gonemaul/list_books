<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to use this project

This project is a simple book list project that uses Laravel 11, some of the features are read, create, update, delete, detail and search by title and author.

Here are a few tips on how to use this project :

- $ git clone https://github.com/gonemaul/list_books
- $ cd list_books
- $ composer install
- $ cp .env-example .env
- $ php artisan key:generate
- $ php artisan storage:link
- $ php artisan migrate
- $ php artisan serve

<b>Note...</b>

in the .env file change the database configuration according to the database you are using and then in the line <b>FILESYSTEM_DISK=local</b> change it to <b>FILESYSTEM_DISK=public</b>

Follow Me
https://www.linkedin.com/in/hasby-maulana-a87320286/