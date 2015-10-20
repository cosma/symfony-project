FROM debian:jessie

MAINTAINER Vincent Composieux <vincent.composieux@gmail.com>

RUN apt-get update && apt-get install -y \
	php5-dev \
	php5-cli \
	php5-fpm \
	php5-mcrypt \
	php5-gd \
	php5-curl \
	php5-intl \
	php5-mysql \
	php5-xdebug \
	php5-redis \
	php5-intl \
	php5-curl \
	php5-apcu \
	php5-imagick \
	php-pear \
	--no-install-recommends

ADD symfony.ini /etc/php5/fpm/conf.d/
ADD symfony.ini /etc/php5/cli/conf.d/

ADD symfony.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

CMD ["php5-fpm", "-F"]

EXPOSE 9000
