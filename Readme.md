# WordPress Ecommerce

A lightweight, self‑hosted WordPress stack with built‑in S3 integration for media offloading and automated backups. Run WordPress anywhere with minimal costs—no managed database fees, just cheap object storage for your files and backups.

## ✨ One‑Liner Benefit

**Run WordPress on any server, eliminate database costs by containerizing MySQL, and keep your media and backups safe on S3‑compatible storage (like Supabase).**

## 🚀 Features

- Fully Dockerized: WordPress + MySQL in separate containers.
- Automatic site URL configuration via environment variable.
- Two custom plugins:
  - **S3 Media Uploader**: Offloads all media uploads (including thumbnails) to an S3 bucket and deletes local copies.
  - **S3 Backup Uploader**: Monitors a local folder (e.g., Updraft backups), uploads files to a timestamped S3 folder, and cleans up old backups.
- Works with any S3‑compatible service (AWS, Supabase, MinIO, etc.).
- No external database costs – MySQL runs inside the container.
- **Increased upload limits** – an `uploads.ini` file is mounted into PHP to allow larger file uploads (up to 64MB), perfect for backup files and media.

## 📦 Installation

### Prerequisites

- Docker & Docker Compose installed on your server.
- Git (to clone the repository).
- An S3‑compatible bucket with access keys.

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
   Edit `.env` and fill in your database credentials, WordPress site URL, and any AWS/S3 settings you’ll need later (the plugins have their own admin settings pages).

3. **Start the containers**
   ```bash
   docker-compose up -d
   ```
   This will start MySQL and WordPress. The first startup may take a moment while WordPress initialises.

4. **Complete WordPress installation**
   - Open your browser and go to `http://your-server:8080` (or the port you set in `.env`).
   - Follow the standard WordPress setup wizard.

5. **Install the plugins**
   - The plugins are located in the `plugins/` directory (or wherever you placed them). You can install them manually by uploading the ZIP files via the WordPress admin, or copy them into the `wp-content/plugins/` folder (already mounted as `./wp_content/plugins`).


6. **Configure the plugins**
   - Go to **Settings → S3 Media Upload** and enter your S3 credentials, bucket, region, and public URL.
   - Go to **Settings → S3 Backup Uploader** and set the local folder to monitor (e.g., `wp-content/updraft`), allowed file extensions, interval, and S3 details.

## ⚙️ Upload Limits

The project includes an `uploads.ini` file in the root directory that is automatically mounted into the WordPress container. It sets:

```
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 300
```

These values allow uploading larger files (like backup archives) without hitting PHP limits. You can adjust them in `uploads.ini` as needed.

## 🔧 How It Works

### Docker & Entrypoint

- The WordPress image is built from the official one, adding `mysql-client` and `wp-cli`.
- The custom `entrypoint.sh` waits for MySQL to be ready using `mysqladmin ping`.
- Once the database is reachable, it runs `wp-cli` in the background (after a short delay) to set the `siteurl` and `home` options to the value of `WP_SITE_URL` from your `.env`. This ensures your site URL is correct even if you access it via a different domain later.

### S3 Media Uploader

- When an image is uploaded, the plugin uploads the original file and all generated thumbnails to your S3 bucket.
- Local copies are deleted immediately to save disk space.
- All attachment URLs are rewritten to point to the S3 public URL.
- Works with `srcset` for responsive images.

### S3 Backup Uploader

- Monitors a local directory (e.g., where UpdraftPlus stores its backups) at a configurable interval.
- Uploads files with allowed extensions (e.g., `.zip`, `.gz`) to a timestamped folder inside your S3 bucket.
- After a successful upload, it deletes the local file.
- Older backup folders are automatically purged, keeping only the most recent backup set.

## 📋 Useful Commands

| Command | Description |
|--------|-------------|
| `docker-compose up -d` | Start containers in background |
| `docker-compose down` | Stop and remove containers |
| `docker-compose logs -f` | Follow logs from all containers |
| `docker exec -it wordpress_app bash` | Open a shell inside the WordPress container |
| `docker exec -it wordpress_app wp ...` | Run WP‑CLI commands directly |
| `docker-compose restart` | Restart both services |

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

You can change these to match your needs.

## 🧩 Plugin Configuration Details

### S3 Media Uploader

- **Access Key / Secret Key** – Your S3 credentials.
- **Region** – e.g., `us-east-1` or the region of your compatible service.
- **Endpoint** – Optional, for S3‑compatible services like Supabase (e.g., `https://<project>.supabase.co/storage/v1/s3`).
- **Bucket** – Name of the bucket.
- **Base URL** – Public URL for files (e.g., `https://<project>.supabase.co/storage/v1/object/public/<bucket>`).

### S3 Backup Uploader

- **AWS credentials** – same as above.
- **Region / Endpoint / Bucket** – same as above.
- **Local Path** – Absolute or relative (to `wp-content`) path to monitor. Use an absolute path if monitoring a folder outside `wp-content`.
- **Allowed Extensions** – Comma‑separated list (e.g., `zip,gz,tar`). Leave empty to allow all.
- **Interval** – How often to check for new files (Hourly, Twice Daily, Daily, or Custom minutes).
- **S3 Path (Prefix)** – Optional subfolder inside the bucket where backups will be stored.

---

Enjoy your low‑cost, self‑hosted WordPress with S3 superpowers!