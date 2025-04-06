FROM composer:latest
WORKDIR /var/www/tz
ENTRYPOINT ["composer", "--ignore-platform-reqs"]