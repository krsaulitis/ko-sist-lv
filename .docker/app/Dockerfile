FROM php:8.1-fpm
COPY . /var/www/site
WORKDIR /var/www/site

# Install required dependencies
RUN apt-get update && apt-get install -y libmcrypt-dev \
    nodejs npm git zip unzip nano \
    default-mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

RUN pecl install xdebug;
COPY ./.docker/app/xdebug.ini /usr/local/etc/php/conf.d

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
