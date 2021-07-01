app-staging-init:
	composer install
	cp .env.staging .env
	php artisan key:generate
	@php artisan storage:link
	php artisan migrate
app-production-init:
	composer install
	cp .env.production .env
	php artisan key:generate
	@php artisan storage:link
	php artisan migrate
