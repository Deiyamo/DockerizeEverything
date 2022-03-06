FROM php:8.1-apache
COPY ./src /usr/src/dst_folder
WORKDIR /usr/src/dst_folder
RUN docker-php-ext-install pdo pdo_mysql