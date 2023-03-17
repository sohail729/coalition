# Setup Guide

1. Create local database with name `test`.
2. Clone project `git clone https://github.com/sohail729/coalition-test.git`.
3. Rename `.env.example` to `.env`.
4. Set `DB_DATABASE` to `test` and `DB_USERNAME` & `DB_PASSWORD` to local phpmyadmin credentials in `.env` file.
5. Run `composer install` in terminal inside the folder.
6. Run `php artisan migrate:fresh --seed` to fill database with fake data. 
7. Start laravel development server `php artisan serve`.

```
URL -> http://127.0.0.1:8000/
Email -> admin@gmail.com
Password -> 123456
```
>  #### PHP Version Requirment `>=8.0`
