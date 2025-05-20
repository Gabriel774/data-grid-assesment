#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
  php artisan key:generate
fi

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

chmod +x node_modules/.bin/vite || true
chmod +x node_modules/@esbuild/linux-x64/bin/esbuild || true

php artisan migrate --force
php artisan db:seed --force

exec "$@"
