FROM ubuntu:bionic-20190307

RUN apt-get update
RUN apt -y upgrade

RUN apt install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt -y update

RUN apt install -y librabbitmq-dev
RUN apt install -y wget
RUN apt install -y bash
RUN apt install -y vim
RUN apt install -y mc
RUN apt install -y cron
RUN apt install -y libmagickwand-dev
RUN apt install -y libmagickcore-dev
RUN apt install -y libfreetype6-dev
RUN apt install -y librabbitmq-dev
RUN apt install -y libmcrypt-dev
RUN apt install -y libpq-dev
RUN apt install -y imagemagick
RUN apt install -y libcurl4-gnutls-dev
RUN apt install -y libc-client-dev
RUN apt install -y libkrb5-dev
RUN apt install -y zlib1g-dev
RUN apt install -y libicu-dev
RUN apt install -y libexif-dev
RUN apt install -y libxrender-dev
RUN apt install -y libzlcore-dev
RUN apt install -y libfreetype6-dev
RUN apt install -y fontconfig
RUN apt install -y git
RUN apt install -y ssmtp
RUN apt install -y xvfb
RUN apt install -y xfonts-75dpi
RUN apt install -y libyaml-dev
RUN apt install -y wget
RUN apt install -y gcc
RUN apt install -y g++
RUN apt install -y make
RUN apt install -y autoconf
RUN apt install -y libc-dev
RUN apt install -y pkg-config
RUN apt install -y libedit-dev
RUN apt install -y libedit2
RUN apt install -y curl

ENV TERM xterm
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt install -y php7.3-fpm
RUN apt install -y php7.3-dev
RUN apt install -y php7.3-zip
RUN apt install -y php7.3-imap
RUN apt install -y php7.3-curl
RUN apt install -y php7.3-json
RUN apt install -y php7.3-xml
RUN apt install -y php7.3-iconv
RUN apt install -y php7.3-opcache
RUN apt install -y php7.3-mbstring
RUN apt install -y php7.3-exif
RUN apt install -y php7.3-fileinfo
RUN apt install -y php7.3-intl
RUN apt install -y php7.3-mysql
RUN apt install -y php7.3-pdo
RUN apt install -y php7.3-sqlite3
RUN apt install -y php-pear

RUN pecl install xdebug
RUN pecl install amqp
RUN pecl install imagick
RUN pecl install yaml
RUN pecl install channel://pecl.php.net/mcrypt-1.0.2
RUN pecl install redis

# NPM
RUN curl -sL https://deb.nodesource.com/setup_8.x > /tmp/setup.npm.sh
RUN bash /tmp/setup.npm.sh
RUN apt install -y nodejs
RUN apt install -y build-essential

# PM2
RUN curl -sL https://raw.githubusercontent.com/Unitech/pm2/master/packager/setup.deb.sh > /tmp/setup.pm2.sh
RUN bash /tmp/setup.pm2.sh
RUN npm install pm2 -g && pm2 update

#Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN mkdir /var/www && mkdir /var/www/.composer && chown www-data:www-data /var/www/.composer

COPY www.conf /etc/php/7.3/fpm/pool.d/www.conf
COPY mods/ /etc/php/7.3/mods-available/
RUN ln -s /etc/php/7.3/mods-available/amqp.ini /etc/php/7.3/fpm/conf.d/20-amqp.ini
RUN ln -s /etc/php/7.3/mods-available/imagick.ini /etc/php/7.3/fpm/conf.d/20-imagick.ini
RUN ln -s /etc/php/7.3/mods-available/mcrypt.ini /etc/php/7.3/fpm/conf.d/20-mcrypt.ini
RUN ln -s /etc/php/7.3/mods-available/redis.ini /etc/php/7.3/fpm/conf.d/20-redis.ini
RUN ln -s /etc/php/7.3/mods-available/site.ini /etc/php/7.3/fpm/conf.d/20-site.ini
RUN ln -s /etc/php/7.3/mods-available/xdebug.ini /etc/php/7.3/fpm/conf.d/20-xdebug.ini
RUN ln -s /etc/php/7.3/mods-available/yaml.ini /etc/php/7.3/fpm/conf.d/20-yaml.ini
RUN ln -s /etc/php/7.3/mods-available/amqp.ini /etc/php/7.3/cli/conf.d/20-amqp.ini
RUN ln -s /etc/php/7.3/mods-available/imagick.ini /etc/php/7.3/cli/conf.d/20-imagick.ini
RUN ln -s /etc/php/7.3/mods-available/mcrypt.ini /etc/php/7.3/cli/conf.d/20-mcrypt.ini
RUN ln -s /etc/php/7.3/mods-available/redis.ini /etc/php/7.3/cli/conf.d/20-redis.ini
RUN ln -s /etc/php/7.3/mods-available/site.ini /etc/php/7.3/cli/conf.d/20-site.ini
RUN ln -s /etc/php/7.3/mods-available/xdebug.ini /etc/php/7.3/cli/conf.d/20-xdebug.ini
RUN ln -s /etc/php/7.3/mods-available/yaml.ini /etc/php/7.3/cli/conf.d/20-yaml.ini

ARG UID
ARG GUID
RUN usermod -u $UID www-data
RUN groupmod -g $GUID www-data
WORKDIR /var/www/site
RUN chown -R root:root /var/www/site
RUN mkdir /run/php/
RUN rm -rf /var/lib/apt/lists/*

EXPOSE 9000

CMD ["php-fpm7.3", "-F"]

# PM2
#RUN usermod -aG pm2 www-data
RUN mkdir /var/www/.pm2 && chown www-data:www-data /var/www/.pm2

## Blackfire
#RUN wget -q -O - https://packages.blackfire.io/gpg.key | apt-key add -
#RUN echo "deb http://packages.blackfire.io/debian any main" | tee /etc/apt/sources.list.d/blackfire.list
#RUN apt-get update
#RUN apt-get install blackfire-agen
#RUN blackfire-agent -register
#RUN /etc/init.d/blackfire-agent restart
#RUN apt-get install blackfire-agent
#RUN blackfire config
#RUN apt-get install blackfire-php

### Blackfire
#ENV current_os=linux
#RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
#    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/$current_os/amd64/$version \
#    && mkdir -p /tmp/blackfire \
#    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
#    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
#    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz
#RUN ln -s /etc/php/7.3/mods-available/blackfire.ini /etc/php/7.3/fpm/conf.d/20-blackfire.ini
#RUN ln -s /etc/php/7.3/mods-available/blackfire.ini /etc/php/7.3/cli/conf.d/20-blackfire.ini

RUN apt-get update -y
RUN apt install -y php7.3-gd
RUN apt install -y php7.3-apcu
