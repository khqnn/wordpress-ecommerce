#!/bin/sh
set -e

# MySQL backup for WordPress (env overridable)
DB_CONTAINER="${MYSQL_CONTAINER:-wordpress_db}"
DB_USER="${MYSQL_USER:-wordpress_user}"
DB_PASSWORD="${MYSQL_PASSWORD:-wordpress_password}"
DB_NAME="${MYSQL_DATABASE:-wordpress}"

# S3 settings
S3_BUCKET="${S3_BACKUP_BUCKET:-medusa-db-backups}"
S3_PATH="${S3_BACKUP_PATH:-mysql-backups}"

TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="/tmp/${DB_NAME}_${TIMESTAMP}.sql.gz"

ENDPOINT_ARGS=""
if [ -n "$AWS_ENDPOINT_URL" ]; then
    ENDPOINT_ARGS="--endpoint-url $AWS_ENDPOINT_URL"
fi

aws_with_endpoint() {
    aws $ENDPOINT_ARGS "$@"
}

echo "[$(date)] Starting backup of database $DB_NAME from container $DB_CONTAINER"

docker exec -e MYSQL_PWD="$DB_PASSWORD" "$DB_CONTAINER" mysqldump -u "$DB_USER" --single-transaction --routines --triggers "$DB_NAME" | gzip > "$BACKUP_FILE"

if [ ! -s "$BACKUP_FILE" ]; then
    echo "ERROR: Backup file is empty."
    exit 1
fi
BACKUP_SIZE=$(wc -c < "$BACKUP_FILE")
if [ "$BACKUP_SIZE" -lt 100 ]; then
    echo "ERROR: Backup file too small ($BACKUP_SIZE bytes). Check MySQL credentials and connectivity."
    rm -f "$BACKUP_FILE"
    exit 1
fi
echo "Backup created: $BACKUP_FILE ($(du -h "$BACKUP_FILE" | cut -f1))"

aws_with_endpoint s3 cp "$BACKUP_FILE" "s3://${S3_BUCKET}/${S3_PATH}/" --only-show-errors
if [ $? -eq 0 ]; then
    echo "Upload to S3 successful."
else
    echo "ERROR: Upload to S3 failed."
    exit 1
fi

rm -f "$BACKUP_FILE"
echo "[$(date)] Backup completed successfully."
