#!/usr/bin/env bash
set -euo pipefail

if [[ -t 2 && "${TERM:-dumb}" != dumb && -z "${NO_COLOR:-}" ]]; then
    composer install --no-interaction --ansi
else
    composer install --no-interaction --no-progress
fi
php artisan config:clear

if ! php -r '
    require "vendor/autoload.php";
    $env = Dotenv\Dotenv::parse(file_get_contents(".env"));
    exit(empty($env["APP_KEY"]) ? 1 : 0);
'; then
    php artisan key:generate --no-interaction
fi

php <<'PHP'
<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$connection = $app->make('db')->connection();
$path = $connection->getDatabaseName();

if ($connection->getDriverName() === 'sqlite' && is_string($path)
    && dirname($path) === database_path() && str_ends_with($path, '.sqlite')
    && !file_exists($path) && !touch($path)) {
    exit(1);
}
PHP
php artisan migrate --no-interaction

if [[ -f package-lock.json ]]; then
    npm ci
else
    npm install
fi
npm run build
