FROM php:7.3-apache
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql
VOLUME /var/www/html
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80

# docker build -t cordovez_php73 .
# docker run -p 80:80 -v . cordovez_php73