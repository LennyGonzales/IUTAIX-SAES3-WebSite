# Image de base
FROM php:7.4-apache

RUN sed 's/;extension=pdo_pqsql/extension=pdo_pgsql/g' /usr/local/etc/php/php.ini-development && apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql && a2enmod rewrite

# Copier le fichier de configuration de site virtuel
COPY mysite.conf /etc/apache2/sites-available/mysite.conf

# Activer le site virtuel
RUN a2ensite mysite.conf

# Copier les fichiers de votre site web
COPY . /var/www/html/

# Copier le fichier .htaccess dans le dossier du site web
COPY .htaccess /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Exposer le port 80
EXPOSE 80
