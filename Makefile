up:
	docker-compose up -d
	docker exec php-container composer install

first:
	make build
	make create-db
	make migrate-update

build:
	docker-compose up --build -d
	docker exec php-container composer install

down:
	docker-compose down --remove-orphans --volumes

create-db:
	docker exec php-container php bin/console doctrine:database:create --if-not-exists

migrate-update:
	docker exec php-container php bin/console doctrine:schema:update --force

test:
	docker exec php-container php bin/phpunit

bash:
	docker exec -it php-container bash

