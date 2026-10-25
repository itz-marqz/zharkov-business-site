# Business Training Website

A responsive website for a business training and consulting practice, with a Laravel and Filament content management system. The project brings the public pages and editable site content into one maintainable application.

## The problem

The inherited site was difficult to run and maintain: application setup depended on missing local runtime files, the admin panel was not available through the expected entry point, and contact form submissions were not safely persisted or manageable. Some pages and image variants also needed to be restored and checked.

## What I changed

- Repaired the Laravel setup flow, database migrations, seed data, and Filament admin access.
- Restored the homepage infographic and aligned its image formats and displayed metrics.
- Added validation and spam protection to the contact form, and an admin inbox for submitted messages.
- Fixed upcoming-event filtering and refreshed the site content and imagery.
- Added automated feature coverage for the main pages, form flow, event filtering, and admin access.

## Stack

PHP 8.3+, Laravel, Filament, Blade, SQLite, and Cloudflare Turnstile for production form protection.

## Run locally

```bash
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open `http://127.0.0.1:8000`. If `public/storage` already exists, skip `php artisan storage:link`. To create a local admin account, run `php artisan make:filament-user`, then open `/admin/login`.

## Verify

```bash
php artisan test
```

## Before deployment

- Keep `.env`, SQLite databases, logs, uploaded files, and generated caches out of public repositories and archives. This project’s ignore rules exclude local runtime data.
- Set `APP_DEBUG=false` and use a private production `.env` with a unique application key.
- Configure both `TURNSTILE_SITE_KEY` and `TURNSTILE_SECRET_KEY` for the production contact form.
- Confirm that published client logos, testimonials, photographs, and business information are approved for public use.

The repository contains no production credentials or contact form submissions. The included seeder provides the site’s presentation content; review its assets and permissions before republishing the live website or its content.
