#!/usr/bin/env bash
set -euo pipefail

APP_DIR="${TENWEK_APP_DIR:?set TENWEK_APP_DIR}"
ROOT="/var/www/${APP_DIR}"
STAGING="/home/tenwek-deploy/staging-${APP_DIR}"
INCOMING="/home/tenwek-deploy/incoming/${APP_DIR}"
CODE_TAR="$INCOMING/tenwek-code.tar.gz"
BUILD_TAR="$INCOMING/tenwek-build.tar.gz"

mkdir -p "$INCOMING" "$STAGING"
cd "$ROOT"

echo "== Extract code to staging =="
rm -rf "$STAGING" && mkdir -p "$STAGING"
tar --no-same-owner --no-same-permissions -xzf "$CODE_TAR" -C "$STAGING"

echo "== Sync code =="
rsync -r --delete --no-group --no-owner --no-perms --omit-dir-times \
  --exclude=.env --exclude=vendor --exclude=storage/app \
  --exclude=storage/logs --exclude=storage/framework \
  --exclude=public/build \
  "$STAGING"/ "$ROOT"/
rm -rf "$STAGING"

echo "== Extract build =="
if [ -f "$BUILD_TAR" ]; then
  rm -rf public/build && mkdir -p public
  tar --no-same-owner --no-same-permissions -xzf "$BUILD_TAR" -C public
  chmod -R g+rwX public/build
fi

composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan route:cache 2>/dev/null || true
php artisan view:cache

rm -f "$CODE_TAR" "$BUILD_TAR"
echo "DEPLOY_OK"
