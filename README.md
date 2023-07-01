# SETUP GUIDE

### Clone the project

```bash
https - https://github.com/janzcio/kangaroos_information_system.git
ssh - git@github.com:janzcio/kangaroos_information_system.git
```

Run composer

```bash
composer install
```

Php version should be `php 8.0` above

### Connection guide
Config your connection or create `.env` file.
```bash
cp .env.example .env
```
Create a `database` file the same database name value in your `.env` file for your connection 

run this command for your app key
```bash
php artisan key:generate
```

run migration
```bash
php artisan migrate
```

run seeder. 
Default credential `email: admin@admin.com password: password`
```bash
php artisan db:seed
```
### Run the project
```bash
php artisan serve
```



