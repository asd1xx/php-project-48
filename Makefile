# Makefile

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

tests:
	composer exec --verbose phpunit tests

coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
