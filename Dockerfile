# Dockerfile
FROM php:8.3-fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql opcache zip

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Variables d'environnement nécessaires
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/tmp

# Installer les dépendances de Symfony
RUN composer install

# Donner les permissions au répertoire de Symfony
RUN chown -R www-data:www-data /var/www/html/var

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande par défaut pour PHP-FPM
CMD ["php-fpm"]
