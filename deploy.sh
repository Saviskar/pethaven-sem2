#!/bin/bash
set -e

echo "Deployment started..."

# 1. Enter project directory
cd /var/www/pethaven

# 2. Turn on maintenance mode
php artisan down || true

# 3. Pull the latest version of the master branch
git pull origin main

# 4. Install Dependencies
# --no-dev: Don't install testing tools
# --no-interaction: Don't ask yes/no questions
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# 5. Run Migrations (Database updates)
php artisan migrate --force

# 6. Clear and Cache Configs
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Install Node Dependencies & Build Assets (Optional if you use Vite/Tailwind)
# npm ci
# npm run build

# 8. Fix Permissions (Just in case)
sudo chown -R ubuntu:www-data .
sudo chmod -R 775 storage bootstrap/cache

# 9. Turn off maintenance mode
php artisan up

echo "Deployment finished!"