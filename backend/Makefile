app-init:
	composer install
	cp .env.staging .env
	php artisan key:generate
	@php artisan storage:link
	php artisan migrate
