FROM php:8.3-apache as base
COPY ./src/ /var/www/html/
COPY buildsrc/config.ini /var/www/private/config.ini
COPY buildsrc/php.ini /usr/local/etc/php/conf.d/30-custom.ini
COPY buildsrc/apache.conf /etc/apache2/sites-enabled
ENV ALLOW_OVERRIDE=true
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN a2enmod proxy_fcgi proxy proxy_http http2 ssl expires headers rewrite