.PHONY: shell
shell:
	docker-compose exec php-fpm bash

.PHONY: run
run:
	docker-compose up -d

.PHONY: build
build:
	docker-compose up -d --build

.PHONY: stop
stop:
	docker-compose stop

.PHONY: install
install:
	cp .env.example .env
	docker-compose up -d
	docker-compose exec php-fpm composer install
	docker-compose exec php-fpm php artisan key:generate
	docker-compose exec php-fpm php artisan migrate --seed
