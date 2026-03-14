#!/bin/bash
set -e

# MySQL restore for WordPress
S3_BUCKET="${S3_BACKUP_BUCKET:-medusa-db-backups}"
S3_PATH="${S3_BACKUP_PATH:-mysql-backups}"
AWS_ENDPOINT_URL="${AWS_ENDPOINT_URL:-}"
DB_CONTAINER="${MYSQL_CONTAINER:-wordpress_db}"
DB_USER="${MYSQL_USER:-wordpress_user}"
DB_PASSWORD="${MYSQL_PASSWORD:-wordpress_password}"
DB_NAME="${MYSQL_DATABASE:-wordpress}"

usage() {
    echo "Usage: $0 [OPTIONS]"
    echo "Options:"
    echo "  -l, --list               List available backups"
    echo "  --latest                 Restore the latest backup"
    echo "  -f, --file FILENAME      Restore a specific backup file"
    echo "  -h, --help               Show this help"
    exit 0
}

aws_with_endpoint() {
    if [ -n "$AWS_ENDPOINT_URL" ]; then
        aws --endpoint-url "$AWS_ENDPOINT_URL" "$@"
    else
        aws "$@"
    fi
}

reset_database() {
    echo "Resetting database $DB_NAME..."
    docker exec -i -e MYSQL_PWD="$DB_PASSWORD" "$DB_CONTAINER" mysql -u "$DB_USER" -e "DROP DATABASE IF EXISTS \`$DB_NAME\`; CREATE DATABASE \`$DB_NAME\`;"
    echo "Database reset complete."
}

LATEST=false
SPECIFIC_FILE=""

while [[ $# -gt 0 ]]; do
    case $1 in
        -l|--list)
            echo "Listing backups in s3://${S3_BUCKET}/${S3_PATH}/"
            aws_with_endpoint s3 ls "s3://${S3_BUCKET}/${S3_PATH}/"
            exit 0
            ;;
        --latest)
            LATEST=true
            shift
            ;;
        -f|--file)
            SPECIFIC_FILE="$2"
            shift 2
            ;;
        -h|--help)
            usage
            ;;
        *)
            echo "Unknown option: $1"
            usage
            ;;
    esac
done

if [ -n "$SPECIFIC_FILE" ]; then
    BACKUP_FILE="$SPECIFIC_FILE"
elif [ "$LATEST" = true ]; then
    echo "Finding latest backup..."
    LATEST_FILE=$(aws_with_endpoint s3 ls "s3://${S3_BUCKET}/${S3_PATH}/" | sort -k1,2 | tail -n1 | awk '{print $4}')
    if [ -z "$LATEST_FILE" ]; then
        echo "No backups found."
        exit 1
    fi
    BACKUP_FILE="$LATEST_FILE"
else
    echo "Available backups:"
    aws_with_endpoint s3 ls "s3://${S3_BUCKET}/${S3_PATH}/"
    echo ""
    read -p "Enter backup filename to restore (or 'q' to quit): " BACKUP_FILE
    if [[ "$BACKUP_FILE" == "q" ]]; then
        exit 0
    fi
fi

if [ -z "$BACKUP_FILE" ]; then
    echo "No backup file specified."
    exit 1
fi

echo "Restoring backup: $BACKUP_FILE"

TMP_DIR=$(mktemp -d)
TMP_FILE="${TMP_DIR}/${BACKUP_FILE}"

echo "Downloading from S3..."
aws_with_endpoint s3 cp "s3://${S3_BUCKET}/${S3_PATH}/${BACKUP_FILE}" "$TMP_FILE"

echo ""
echo "This will OVERWRITE the database '$DB_NAME' in container '$DB_CONTAINER'."
read -p "Are you sure? (y/N) " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "Restore cancelled."
    rm -rf "$TMP_DIR"
    exit 0
fi

reset_database

echo "Restoring database from backup..."
if [[ "$BACKUP_FILE" == *.gz ]]; then
    gunzip -c "$TMP_FILE" | docker exec -i -e MYSQL_PWD="$DB_PASSWORD" "$DB_CONTAINER" mysql -u "$DB_USER" "$DB_NAME"
else
    docker exec -i -e MYSQL_PWD="$DB_PASSWORD" "$DB_CONTAINER" mysql -u "$DB_USER" "$DB_NAME" < "$TMP_FILE"
fi

if [ $? -eq 0 ]; then
    echo "✅ Restore completed successfully."
else
    echo "❌ Restore failed."
    exit 1
fi

rm -rf "$TMP_DIR"
