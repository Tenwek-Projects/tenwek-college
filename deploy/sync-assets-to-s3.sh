#!/usr/bin/env bash
# Sync College uploaded media to S3 (run on EC2 with IAM role).
set -euo pipefail

BUCKET="${AWS_BUCKET:-tenwek-college}"
REGION="${AWS_DEFAULT_REGION:-us-east-1}"
ROOT="${1:-/var/www/college}"

echo "== Syncing storage/app/public to s3://${BUCKET}/ =="
aws s3 sync "${ROOT}/storage/app/public" "s3://${BUCKET}/" \
  --region "${REGION}" \
  --cache-control "public, max-age=86400"

echo "SYNC_OK"
