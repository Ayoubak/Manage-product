FROM php:8.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_pgsql intl

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN apt update && apt install -y nodejs npm

COPY . /var/www/

COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

SHELL ["/bin/bash", "--login", "-i", "-c"]

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash

RUN source /root/.bashrc && nvm install 16.4.0

RUN cd /var/www && \
    composer install && \
    npm install --force && \
    npm run build

WORKDIR /var/www/docker

RUN chmod +x *.sh

ENTRYPOINT [ "./docker/docker.sh" ]

WORKDIR /var/www/

EXPOSE 80