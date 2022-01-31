#!/bin/bash

composer install
cp .env.example .env
php artisan key:generate

npm install
npm run dev

php artisan cache:clear
php artisan migrate:fresh
php artisan db:seed

echo "Done."

