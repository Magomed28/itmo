FROM php:8.2-fpm

# add apt-get installs to this RUN
RUN apt-get update \
    && apt-get install -y \
        zip git libicu-dev libzip-dev libpq-dev libmemcached-dev nano mc pv htop curl  \
        libpng-dev libmagickwand-dev supervisor wget unzip librabbitmq-dev libssh-dev \
    && docker-php-ext-install \
        intl zip opcache mysqli pdo pdo_mysql bcmath sockets gd soap sockets \
    && pecl install memcached \
    && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    pdo_mysql \
    && pecl install apcu \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN groupadd -g 1000 example
#RUN useradd -u 1000 -g example example

COPY ./conf/php-fpm/dev/php.ini /usr/local/etc/php/php.ini
COPY ./conf/php-fpm/dev/remote-xdebug.ini /usr/local/etc/php/conf.d/remote-xdebug.ini
COPY ./conf/php-fpm/dev/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./conf/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

### timezone ###
ARG TZ="UTC"
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN echo "\ndate.timezone = $TZ" >> /usr/local/etc/php/php.ini



#USER example:example

### permissions ###
RUN mkdir -p /var/www/var/cache /var/www/var/log && chmod -R 777 /var/www/var
