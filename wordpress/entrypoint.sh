#!/bin/bash
set -e

# Parse host and port from WORDPRESS_DB_HOST (e.g., db:3306)
DB_HOST_PORT="$WORDPRESS_DB_HOST"
if [[ "$DB_HOST_PORT" == *:* ]]; then
    DB_HOST=$(echo "$DB_HOST_PORT" | cut -d: -f1)
    DB_PORT=$(echo "$DB_HOST_PORT" | cut -d: -f2)
else
    DB_HOST="$DB_HOST_PORT"
    DB_PORT=3306
fi

echo "Waiting for database to be ready at $DB_HOST:$DB_PORT..."

until mysqladmin ping \
    -h "$DB_HOST" \
    -P "$DB_PORT" \
    -u "$WORDPRESS_DB_USER" \
    -p"$WORDPRESS_DB_PASSWORD" \
    --silent \
    --ssl=0; do
    sleep 2
done

echo "Database is ready."

# Start a background process to update the site URL after WordPress is fully up
if [ -n "$WP_SITE_URL" ]; then
    (
        # Give WordPress a moment to initialize (wp-config.php, tables, etc.)
        sleep 10
        echo "Attempting to update site URL to $WP_SITE_URL..."
        wp option update siteurl "$WP_SITE_URL" --allow-root --path=/var/www/html 2>/dev/null || true
        wp option update home "$WP_SITE_URL" --allow-root --path=/var/www/html 2>/dev/null || true
        echo "Site URL update finished (may have been skipped if WordPress not ready)."
    ) &
fi

# Execute the original WordPress entrypoint (starts Apache)
exec docker-entrypoint.sh "$@"