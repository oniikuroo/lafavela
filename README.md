# La Favela

Laravel application for the La Favela bar site and menu management.

## Stack

- PHP 8.2
- Laravel 12
- SQLite
- Blade templates
- Vite

## Main Features

- Public site in `es`, `en`, and `pt`
- Menu, cocktails, and shots pages
- Admin area for notices, settings, and menu editing
- Menu content stored in `menu_pages` as JSON by `locale + page`

## Local Setup

### Option 1: existing XAMPP layout

Project path used in this repo:

```bash
/Applications/XAMPP/xamppfiles/htdocs/lafavela
```

Local URLs:

```text
http://localhost/lafavela/public/es
http://localhost/lafavela/public/es/menu
http://localhost/lafavela/public/es/cocktails
http://localhost/lafavela/public/es/chupitos
```

### Option 2: standard Laravel setup

```bash
composer setup
php artisan db:seed
php artisan serve
npm run dev
```

## Environment

Start from `.env.example`:

```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed
```

Important values:

```env
APP_NAME="La Favela"
APP_URL=https://your-domain.example
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

If you serve the project from a subdirectory, set `APP_URL` to that full base path.

## Database

Current menu editing uses:

```sql
SELECT * FROM menu_pages WHERE locale = 'es' AND page = 'menu';
```

`payload` stores page metadata and sections/items as JSON.

Main tables:

- `menu_pages`
- `site_settings`
- `notices`
- `users`

Legacy tables `menu_sections` and `menu_items` still exist in the project history but are no longer the active menu source.

## Admin

Menu admin:

```text
/admin/menu?locale=es&page=menu
```

Examples:

- `locale=es&page=menu`
- `locale=en&page=cocktails`
- `locale=pt&page=shots`

## Deployment

### Docker

Build:

```bash
docker build -t lafavela .
```

Run:

```bash
docker run --name lafavela \
  -p 8080:80 \
  -e APP_KEY=base64:YOUR_APP_KEY \
  -e APP_URL=https://your-domain.example \
  -v $(pwd)/database:/var/www/html/database \
  lafavela
```

Then open:

```text
http://localhost:8080/es
```

The container entrypoint automatically:

- ensures `database/database.sqlite` exists
- runs `php artisan migrate --force`

### Generic host requirements

Any host is fine if it supports:

- PHP 8.2+
- SQLite
- writable `storage/` and `bootstrap/cache/`
- document root pointed to `public/`

### Notes for production

- set a real `APP_KEY`
- set `APP_DEBUG=false`
- persist the `database/` folder
- persist `storage/` if you want logs/files to survive deploys

## Repo Notes

Current GitHub main was updated from the definitive local Laravel version.

Latest published commit in this working session:

```text
2bf0e62 Finalize Laravel menu pages version
```
