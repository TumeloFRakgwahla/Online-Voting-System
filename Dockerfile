FROM php:8.2-apache

# Copy everything into Apache web root
COPY . /index

# Enable Apache rewrite if needed (optional)
RUN a2enmod rewrite