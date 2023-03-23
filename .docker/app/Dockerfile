FROM php:8.1-fpm
COPY . /var/www/site
WORKDIR /var/www/site

ARG NODE_VERSION=18

# Install required dependencies
RUN apt-get update && apt-get install -y  \
    build-essential \
    libmcrypt-dev \
    git  \
    zip  \
    unzip  \
    nano  \
    default-mysql-client \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install node
RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Install Xdebug
RUN pecl install xdebug;
COPY ./.docker/app/xdebug.ini /usr/local/etc/php/conf.d

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]
