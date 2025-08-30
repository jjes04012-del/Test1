# Use official PHP Apache image
FROM php:8.2-apache

# Enable mysqli extension for MySQL
RUN docker-php-ext-install mysqli

# Copy project files to web root
COPY . /var/www/html/

# Expose port 10000 (Apache default 80)
EXPOSE 80
