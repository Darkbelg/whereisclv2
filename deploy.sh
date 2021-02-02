git pull

composer install --optimize-autoloader --no-dev

sudo -s /bin/bash -c "php artisan optimize:clear" -g www-data www-data
