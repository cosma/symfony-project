FROM ubuntu:wily

MAINTAINER Cosmin Voicu <cosmin.voicu@gmail.com>

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

RUN apt-get install -y \
	curl \
	--no-install-recommends

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

ADD symfony.ini /etc/php5/fpm/conf.d/
ADD symfony.ini /etc/php5/cli/conf.d/

ADD symfony.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

CMD ["php5-fpm", "-F"]

EXPOSE 9000
