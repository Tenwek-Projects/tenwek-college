#!/usr/bin/env bash
# CI uploads tarballs to /home/tenwek-deploy/incoming/, then runs this script.
# Requires tenwek-deploy in ubuntu group; app dirs owned ubuntu:www-data with g+rwX.
set -euo pipefail

APP_DIR="${TENWEK_APP_DIR:?set TENWEK_APP_DIR}"
ROOT="/var/www/${APP_DIR}"
STAGING="/home/tenwek-deploy/staging-${APP_DIR}"

cd "$ROOT"

echo "== Extract code to staging =="
rm -rf "$STAGING"
mkdir -p "$STAGING"
tar --no-same-owner --no-same-permissions -xzf /home/tenwek-deploy/incoming/tenwek-code.tar.gz -C "$STAGING"

echo "== Sync code (preserve .env, storage, vendor) =="
rsync -r --delete --no-group --no-owner --no-perms --omit-dir-times \
  --exclude=.env \
  --exclude=vendor \
  --exclude=storage/app \
  --exclude=storage/logs \
  --exclude=storage/framework \
  "$STAGING"/ "$ROOT"/
rm -rf "$STAGING"
find "$ROOT/deploy" -name '*.sh' -exec sed -i 's/\r$//' {} \; 2>/dev/null || true

echo "== Extract build =="
if [ -f /home/tenwek-deploy/incoming/tenwek-build.tar.gz ]; then
  rm -rf public/build
  mkdir -p public
  tar --no-same-owner --no-same-permissions -xzf /home/tenwek-deploy/incoming/tenwek-build.tar.gz -C public
  chmod -R g+rwX public/build
fi

echo "== Composer =="
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

echo "== Laravel =="
php artisan migrate --force
php artisan config:cache
php artisan route:cache 2>/dev/null || true
php artisan view:cache

rm -f /home/tenwek-deploy/incoming/tenwek-code.tar.gz /home/tenwek-deploy/incoming/tenwek-build.tar.gz
echo "DEPLOY_OK"
