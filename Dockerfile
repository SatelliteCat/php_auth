FROM php:7.4-apache
RUN apt-get -y update \
&& apt-get install -y libicu-dev git \
&& docker-php-ext-install pdo_mysql \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl 

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

COPY ./ /var/www/html
WORKDIR /var/www/html

RUN composer install