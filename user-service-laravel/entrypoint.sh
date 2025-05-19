#!/bin/bash
if [ ! -f "artisan" ]; then
    composer create-project laravel/laravel .
    php artisan key:generate
fi

# Устанавливаем правильные права
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

apache2-foreground