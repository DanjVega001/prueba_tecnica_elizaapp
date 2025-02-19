FROM php:8.2-fpm

WORKDIR /var/www

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./app .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]

