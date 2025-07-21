FROM php:8.1-apache

# Salin semua file ke dalam container
COPY . /var/www/html/

# Aktifkan modul rewrite (jika pakai htaccess)
RUN a2enmod rewrite

# Set hak akses
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
