FROM php:7.4-fpm

ENV DEBIAN_FRONTEND="noninteractive"

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libxml2-dev libxslt-dev vim\
    && docker-php-ext-install intl opcache pdo pdo_mysql xml simplexml ctype iconv json session tokenizer xsl\
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip
    # && pecl install apcu -o -f redis \
    # &&  rm -rf /tmp/pear \
    # && docker-php-ext-enable redis \

WORKDIR /var/www/issatex

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# WORKDIR /var/www/issatex
# RUN chown -R www-data:$(whoami) public/
# COPY ./issatex /var/www/issatex

# RUN mkdir ${UPLOADS_DIR}
    # && chown -R ${USER_ID}:${GROUP_ID} ${UPLOADS_DIR} \
    # && usermod --uid ${USER_ID} --home ${UPLOADS_DIR} --shell /bin/bash www-data \
    # && groupmod --gid ${GROUP_ID} www-data

# RUN usermod -u ${whoami} www-data 

RUN git config --global user.email "marwentlili@gmail.com" \ 
    && git config --global user.name "marwentlili" \
    && git config --global credential.helper cache