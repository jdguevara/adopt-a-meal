FROM php:7-cli-alpine3.7

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apk add --update nodejs
COPY . .
RUN npm install
RUN npm run prod
EXPOSE 8000
RUN composer install
CMD php artisan serve
