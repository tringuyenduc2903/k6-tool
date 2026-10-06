#!/usr/bin/env bash
set -euo pipefail

: "${BASE_URL:?Set BASE_URL to the application base URL}"
export BASE_URL

script_dir="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"

for concurrent_users in 1 5 10 50 100; do
    k6 run --env "CONCURRENT_USERS=$concurrent_users" "$script_dir/k6-home.js"
done
