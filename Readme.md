# WordPress Ecommerce

A lightweight, self‑hosted WordPress stack with optional S3 integration for media offloading and automated backups. Run WordPress anywhere with minimal costs—no managed database fees, just a simple Docker setup.

## ✨ One‑Liner Benefit

**Run WordPress on any server, eliminate database costs by containerizing MySQL, and optionally keep your media and backups safe on S3‑compatible storage.**

---

## 🚀 Features

- Fully Dockerized: WordPress + MySQL in separate containers.
- Automatic site URL configuration via environment variable.
- Increased upload limits (64MB) via mounted `uploads.ini`.
- **Two optional custom plugins**:
  - **S3 Media Uploader**: Offloads media uploads to an S3 bucket.
  - **S3 Backup Uploader**: Monitors a folder and uploads backup files to S3.
- Works with any S3‑compatible service (AWS, Supabase, MinIO, etc.).
- **Encouraged backup method**: Use **UpdraftPlus** (included as a zipped plugin) to easily send backups to Google Drive.

---

## 📦 Installation

### Prerequisites

- Docker & Docker Compose installed on your server.
- Git (to clone the repository).
- (Optional) An S3‑compatible bucket with access keys.

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/khqnn/wordpress-ecommerce.git
   cd wordpress-ecommerce
   ```

2. **Set up environment variables**
   ```bash
   cp .env.template .env
   ```
   Edit `.env` and fill in your database credentials and WordPress site URL.

3. **Start the containers**
   ```bash
   docker-compose up -d
   ```

4. **Complete WordPress installation**
   - Open your browser and go to `http://your-server:8080`.
   - Follow the standard WordPress setup wizard.

5. **Install plugins (optional)**
   - The `plugins/` directory contains the two S3‑related plugins and a zipped copy of **UpdraftPlus**.
   - You can install them via WordPress admin by uploading the ZIP files, or copy them directly into the mounted `wp_content/plugins` folder.

---

## 💾 Backup Options

### Recommended: UpdraftPlus + Google Drive

UpdraftPlus is a reliable, user‑friendly backup plugin. The repository includes a zipped copy (`updraftplus.zip`) that you can install from the WordPress admin. After activation:

1. Go to **Settings → UpdraftPlus Backups**.
2. Choose **Google Drive** as your remote storage.
3. Follow the prompts to authenticate your Google account.
4. Configure your backup schedule and what to include (database, plugins, themes, uploads).

This method keeps your backups safe in Google Drive without needing any S3 setup.

### Advanced: S3 Backup Uploader (Optional)

If you prefer to use S3‑compatible storage, you can install the **S3 Backup Uploader** plugin. It monitors a local folder (e.g., where UpdraftPlus stores its backups) and uploads files to an S3 bucket. See the [S3 Backup Uploader](#s3-backup-uploader) section below for configuration details.

---

## 🔧 S3 Integration (Optional)

Both S3‑related plugins are **entirely optional**. Use them only if you want to offload media or backups to S3‑compatible storage.

### S3 Media Uploader

When enabled, all media uploads (including thumbnails) are sent directly to your S3 bucket, and local copies are deleted. URLs are rewritten to point to the public S3 endpoint.

**Configuration:** Go to **Settings → S3 Media Upload** and enter your S3 credentials, bucket, region, and public URL.

### S3 Backup Uploader

This plugin can watch a local folder (e.g., `wp-content/updraft`) and automatically upload backup files to a timestamped folder in your S3 bucket. It can also delete local files after upload and clean up old backups.

**Configuration:** Go to **Settings → S3 Backup Uploader** and set:
- S3 credentials, bucket, region, endpoint (if needed)
- Local path to monitor
- Allowed file extensions (e.g., `zip,gz,tar`)
- Interval (hourly, daily, etc.)

---

## 📋 Useful Commands

| Command | Description |
|--------|-------------|
| `docker-compose up -d` | Start all containers in background |
| `docker-compose up -d --build wordpress` | Build and start only the WordPress container (useful for testing plugin changes without restarting MySQL) |
| `docker-compose down` | Stop and remove containers |
| `docker-compose logs -f` | Follow logs from all containers |
| `docker exec -it wordpress_app bash` | Open a shell inside the WordPress container |
| `docker exec -it wordpress_app wp ...` | Run WP‑CLI commands directly |
| `docker-compose restart` | Restart both services |
---

## 🔑 Environment Variables (.env)

```
# Database
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=wordpress_password
MYSQL_ROOT_PASSWORD=root

# WordPress
WORDPRESS_PORT=8080
WP_SITE_URL=http://localhost:8080
```

Adjust these to match your environment.

---

Enjoy your low‑cost, self‑hosted WordPress – with or without S3!