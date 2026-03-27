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

## Control Panel Guide

### Access

Local login URL:

```text
http://localhost/lafavela/public/login
```

Current local admin user:

```text
Email: mikefavela@gmail.com
Password: 12345678
```

After login, main admin sections are:

- Home settings: `/admin`
- Menu editor: `/admin/menu?locale=es&page=menu`

### Home settings panel

URL:

```text
/admin
```

This panel lets you manage:

- home subtitle
- opening hours
- visit intro text
- operational notices

Available actions:

- choose language with the `lang` selector
- update the home texts for the selected language
- create operational notices
- publish notices for one language or for all languages
- delete existing notices

### Menu editor panel

URL pattern:

```text
/admin/menu?locale=es&page=menu
```

The editor works with the `menu_pages` table using:

```sql
SELECT * FROM menu_pages WHERE locale = 'es' AND page = 'menu';
```

Query meaning:

- `locale` = page language
- `page` = one of `menu`, `cocktails`, `shots`

Available controls:

- `locale` selector: `es`, `en`, `pt`
- `page` selector: `menu`, `cocktails`, `shots`

### What can be edited in Menu editor

At page level:

- `heading`
- `subtitle`
- `hours`
- `ad`

At section level:

- create section
- rename section
- change section position
- delete section

At item level:

- create item
- edit item name
- edit item description
- edit item price
- change item position
- delete item

### Recommended editing flow

1. Open the correct `locale`
2. Choose the target `page`
3. Save page metadata first
4. Create or reorder sections
5. Add or edit items inside each section
6. Open the public page in another tab and verify the result

### Public pages to review after changes

Spanish:

```text
/es
/es/menu
/es/cocktails
/es/chupitos
```

English:

```text
/en
/en/menu
/en/cocktails
/en/chupitos
```

Portuguese:

```text
/pt
/pt/menu
/pt/cocktails
/pt/chupitos
```

### Permissions

Admin routes require a logged-in user with:

```text
is_admin = 1
```

Middleware used:

- `auth`
- `verified`
- `admin`

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
