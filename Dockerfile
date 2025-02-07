FROM php:8.3-cli

RUN apt-get update && apt-get install -y unzip git

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN pecl install xdebug

# Configure Xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app

COPY composer.json composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --prefer-dist

RUN composer global require phpunit/phpunit --dev

ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY . .

# Ensure log directory and file exist
RUN mkdir -p /app/logs && \
    touch /app/logs/app.log && \
    chmod -R 0777 /app/logs

CMD ["php", "-S", "0.0.0.0:8000"]
