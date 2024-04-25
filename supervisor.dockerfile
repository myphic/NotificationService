FROM php:8.3-fpm-alpine

RUN set -ex && apk add --no-cache postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN apk update && apk add --no-cache supervisor

RUN mkdir -p "/etc/supervisor/logs"

COPY supervisord.conf /etc/supervisor/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
