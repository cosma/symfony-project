test:
	SYMFONY_DEPRECATIONS_HELPER=weak bin/phpunit -c app/ src/

coverage:
	SYMFONY_DEPRECATIONS_HELPER=weak bin/phpunit -c app/ --coverage-text --coverage-text src/

test_d:
	docker-compose run php /bin/sh -c 'cd /var/www/symfony &&  SYMFONY_DEPRECATIONS_HELPER=weak bin/phpunit -c app src/'

coverage_d:
	docker-compose run php /bin/sh -c 'cd /var/www/symfony &&  SYMFONY_DEPRECATIONS_HELPER=weak bin/phpunit -c app --coverage-text src/'