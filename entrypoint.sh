#!/bin/sh
set -e

cd /var/www/html

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache

echo "*\n!.gitignore" | tee storage/framework/cache/.gitignore \
                       storage/framework/sessions/.gitignore \
                       storage/framework/views/.gitignore > /dev/null

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage
chmod -R 775 storage

rm -f bootstrap/cache/config.php /var/run/crond.pid

composer install --no-interaction --prefer-dist --optimize-autoloader

php artisan migrate --force
php artisan db:seed --force

exec "$@"
