# Image de base
FROM php:7.4-apache

RUN sed 's/;extension=pdo_pqsql/extension=pdo_pgsql/g' /usr/local/etc/php/php.ini-development && apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql && a2enmod rewrite && a2enmod ssl

# Copier le fichier de configuration de site virtuel
COPY networkstories.no-ip.org.conf /etc/apache2/sites-available/networkstories.no-ip.org.conf

# Activer le site virtuel
RUN a2ensite networkstories.no-ip.org.conf

# Copier les fichiers de votre site web
COPY . /var/www/html/

# Copier le fichier .htaccess dans le dossier du site web
COPY .htaccess /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Exposer le port 80
EXPOSE 80
