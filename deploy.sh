git pull

composer install --optimize-autoloader --no-dev

sudo -s /bin/bash -c "php artisan config:cache" -g www-data www-data

sudo -s /bin/bash -c "php artisan route:cache" -g www-data www-data

sudo -s /bin/bash -c "php artisan view:cache" -g www-data www-data

sudo -s /bin/bash -c "php artisan cache:clear" -g www-data www-data
