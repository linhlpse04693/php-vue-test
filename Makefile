build: ## build develoment environment
	cp .env.example .env
	composer install
	docker-compose build
	docker-compose run --rm php composer install
	docker-compose run --rm php cp .env.example .env
	docker-compose run --rm php php artisan key:generate
	docker-compose run --rm php php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
	docker-compose run --rm php php artisan jwt:secret
	npm i
serve:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down -v
migrate:
	docker-compose run --rm php php artisan migrate
	docker-compose run --rm php php artisan db:seed