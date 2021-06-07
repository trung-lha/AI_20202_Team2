## About Human Pose Estimation Project

Human pose estimation project is a website which use Blaze Pose Model to counts the number of movements of each exercise that you practice every day, provides a tool to help you track your training progress.

## Installing Project

- Step 1: Setup pakcage

	```
	composer install	
	```
- Step 2: Config enviroment
	
	Make file .env
	
	```
	cp .env.example .env
	```
	Change value configuration
	
	```
	DB_DATABASE= 'database_name'
	DB_USERNAME=	
	DB_PASSWORD=
	```
	Generate key
	
	```
	php artisan key:generate
	```
- Step 3: Make table of database and Generate fake data
	Fake data
    
	```
	php artisan migrate --seed
	```
- Step 4: Run project
	
	```
	php artisan serve
	```
## Guide

Use Pose Estimation application
- Step 1: Register or Login
- Step 2: Choose exercises
- Step 3: Accept camera and exercise
- Step 4: End exercise
Click  ``My Workout`` or ``Workout Detail`` to see your workout history.

## Contributing



Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
