# Vehicle Availability

## Description
This is a Single App Application using Laravel 5.2 and AngularJs.

## Requirement
* [PHP](http://php.net/supported-versions.php) >= 5.5.9
* [Composer](https://getcomposer.org/)
* MariaDb > 5.0
* Apache 2+

## Installing
- Create a new project folder, eg: logasia
- cd logasia
- git clone https://github.com/flakesns/logasia.git
- Add virtual host in apache, eg: logasia.com
- Edit your host file: add 127.0.0.1 logasia.com
- Install dependencies
```
composer install
```

- Create new database: logasia

- Run table migration
```
php artisan migrate
```

- Run data seeder

```
php artisan db:seed
```

- Update the database configuration in .env file


## Issues
Due to current job workload, i don't have enough time to focus on this app.

## Demo
[Demo](https://logistic8.herokuapp.com/)

## Develop By
[Hafiz](http://hafiznor.wordpress.com)




