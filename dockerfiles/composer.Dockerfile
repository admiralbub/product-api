FROM composer:latest
WORKDIR /var/www/chystagriadka
ENTRYPOINT ["composer", "--ignore-platform-reqs"]