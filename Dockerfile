FROM php:8.0-alpine

WORKDIR /app

RUN apk update 
RUN docker-php-ext-install mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.4.3 --install-dir=/usr/local/bin --filename=composer

COPY . .
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install

CMD ["php","artisan","serve","--host=0.0.0.0"]
