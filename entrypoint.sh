#!/bin/bash
mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

exec php-fpm
