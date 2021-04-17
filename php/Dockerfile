FROM composer:2.0.12 AS composer
FROM php:7.4.16-apache AS shared
# user
ARG USERNAME=app
ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN groupadd --gid $USER_GID $USERNAME \
  && useradd --uid $USER_UID --gid $USER_GID -m $USERNAME \
  && apt-get update && apt-get install -y sudo \
  && apt-get clean && rm -rf /var/lib/apt/lists/* \
  && echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME \
  && chmod 0440 /etc/sudoers.d/$USERNAME
# Node.js
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
  && apt-get install -y nodejs \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
# PHP
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y \
  libpq-dev \
  libzip-dev \
  unzip \
  && docker-php-ext-install \
  bcmath \
  pdo_mysql \
  pdo_pgsql \
  zip \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
COPY ./php/php/my.ini /usr/local/etc/php/conf.d/
# Apache2
ENV APACHE_RUN_USER=app
ENV APACHE_RUN_GROUP=app
RUN	chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/www/html \
  && chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/run/apache2 \
  && chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/lock/apache2 \
  && chown -R --no-dereference ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/log/apache2
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY ./php/apache2/001-my.conf /etc/apache2/sites-available/001-my.conf
RUN a2dissite 000-default \
  && a2ensite 001-my
# Supervisor
RUN apt-get update && apt-get install -y \
  busybox-static \
  supervisor \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN mkdir -p /var/log/supervisor
COPY ./php/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./php/crontabs/ /var/spool/cron/crontabs/
RUN ln -sfT /dev/stdout /var/log/cron
CMD ["/usr/bin/supervisord"]

FROM shared AS develop
