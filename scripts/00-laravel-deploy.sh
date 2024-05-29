#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --ignore-platform-req=ext-fileinfo  --ignore-platform-req=ext-curl

echo "generating application key..."
php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed
