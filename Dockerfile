FROM php:8.1-apache

# Install ekstensi mysqli dan lainnya
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan modul Apache rewrite (jika pakai .htaccess)
RUN a2enmod rewrite

# Salin seluruh project ke dalam container
COPY . /var/www/html/

# Set hak akses ke folder proyek
RUN chown -R www-data:www-data /var/www/html
