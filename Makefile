up:
	docker-compose up --build -d
	docker exec php-container composer install

fixtures:
	docker exec php-container python load.py

stats:
	docker exec php-container bin/console delivery:statistics

test:
	docker exec php-container php bin/phpunit

