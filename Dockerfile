FROM php:8.2-cli-alpine

WORKDIR /var/www
COPY . .
RUN docker-php-ext-install pdo pdo_mysql

# Install Node.js for Tailwind/Alpine.js
RUN apk add --no-cache nodejs npm
RUN npm install
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
