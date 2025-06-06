FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy everything into Apache web root
COPY . /var/www/html/

# Enable Apache rewrite if needed (optional)
RUN a2enmod rewrite
