up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down-clear cms-clear docker-pull docker-build docker-up cms-init
test: cms-test
test-coverage: cms-test-coverage
test-unit: cms-test-unit
test-unit-coverage: cms-test-unit-coverage

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

cms-init: cms-composer-install cms-migrations cms-fixtures cms-ready

cms-clear:
	docker run --rm -v ${PWD}/cms:/app --workdir=/app alpine rm -f .ready

cms-composer-install:
	docker-compose run --rm cms-php-cli composer install
cms-schema-diff:
	docker-compose run --rm cms-php-cli php bin/console doctrine:migrations:diff --no-interaction
	docker-compose run --rm cms-php-cli php bin/console doctrine:schema:drop --full-database --no-interaction

cms-migrations:
	docker-compose run --rm cms-php-cli php bin/console doctrine:migrations:migrate --no-interaction

cms-fixtures:
	docker-compose run --rm cms-php-cli php bin/console doctrine:fixtures:load --no-interaction

cms-fixtures-cms-payment-methods:
	docker-compose run --rm cms-php-cli php bin/console doctrine:fixtures:load --append --group=cms-payment-methods --no-interaction

cms-fixtures-cms-delivery-methods:
	docker-compose run --rm cms-php-cli php bin/console doctrine:fixtures:load --append --group=cms-delivery-methods --no-interaction

cms-cache-clear:
	docker-compose run --rm cms-php-cli php bin/console cache:clear

cms-ready:
	docker run --rm -v ${PWD}/cms:/app --workdir=/app alpine touch .ready

cms-assets-dev:
	docker-compose run --rm cms-node npm run dev

cms-test:
	docker-compose run --rm cms-php-cli php bin/phpunit

cms-test-coverage:
	docker-compose run --rm cms-php-cli php bin/phpunit --coverage-clover var/clover.xml --coverage-html var/coverage

cms-test-unit:
	docker-compose run --rm cms-php-cli php bin/phpunit --testsuite=unit

cms-test-unit-coverage:
	docker-compose run --rm cms-php-cli php bin/phpunit --testsuite=unit --coverage-clover var/clover.xml --coverage-html var/coverage
