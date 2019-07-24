FROM php:7.0.8-apache
COPY . /var/www/html
EXPOSE 80
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
RUN composer install --prefer-source --no-interaction
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
RUN a2enmod rewrite && service apache2 restart
RUN chown -R www-data:www-data /var/www