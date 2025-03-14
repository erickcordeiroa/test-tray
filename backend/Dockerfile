FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip unzip \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql
    
# Ative o mod_rewrite para o Apache
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiando o arquivo de configuracao
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf

COPY . /var/www/html

RUN composer install

RUN chown -R www-data:www-data \
	/var/www/html/storage \
	/var/www/html/bootstrap/cache 