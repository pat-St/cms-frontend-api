FROM php:7.4-apache
COPY ./src/ /var/www/html/
COPY config.ini /var/www/private/config.ini
COPY php.ini /usr/local/etc/php/conf.d/30-custom.ini
COPY apache.conf /etc/apache2/sites-enabled
ENV ALLOW_OVERRIDE=true
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN a2enmod proxy_fcgi proxy proxy_http http2 ssl expires headers rewrite