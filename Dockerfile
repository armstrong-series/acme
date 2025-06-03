FROM php:8.3-cli
RUN apt-get update && apt-get install -y git unzip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . /app
RUN composer install
CMD ["tail", "-f", "/dev/null"]