# Blog Template #2 — Community Blog Platform

A reusable Laravel Blade multi-author blog platform built for creators, publishers, educational blogs, marketing blogs, tech blogs, magazines, and personal brands.

This template includes public blog pages, author dashboards, admin moderation, comments, contact inbox, site settings, and reusable branding controls.

---

## Features

### Public Website

- Homepage with latest published posts
- Category pages
- Tag pages
- Single post page
- Author profile page
- Search
- Pagination
- Responsive layout
- SEO-friendly structure

### Authentication

- Register
- Login
- Logout
- Forgot password
- Reset password

### Author Features

- Author dashboard
- Create posts
- Edit posts
- Delete posts
- Upload featured images
- Save draft
- Submit posts for review
- Manage profile
- Upload avatar
- Update bio and social links
- Change password

### Admin Features

- Admin dashboard
- Manage users
- Manage roles
- Enable / disable users
- Manage categories
- Manage tags
- Moderate posts
- Approve / reject posts
- Moderate comments
- View contact messages
- Mark messages as read / unread
- Manage site settings

### Settings

- Site name
- Site tagline
- Logo
- Favicon
- Contact email
- Posts per page
- Default SEO meta title
- Default SEO meta description
- Footer text

---

## Tech Stack

- Laravel
- Blade
- MySQL
- Eloquent ORM
- Session-based authentication
- Custom middleware for roles and active user checks

---

## Requirements

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js and npm (optional if you expand frontend assets later)

---

## Installation

### 1. Clone the project

```bash
git clone <your-repository-url>
cd blog-template-2
```

2. Install dependencies
   composer install
3. Create environment file
   cp .env.example .env

If you are on Windows:

copy .env.example .env 4. Configure .env

Set your database credentials:

APP_NAME="Community Blog"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=community_blog
DB_USERNAME=root
DB_PASSWORD= 5. Generate app key
php artisan key:generate 6. Run migrations and seed demo data
php artisan migrate:fresh --seed 7. Create storage symlink
php artisan storage:link 8. Serve the project
php artisan serve

Visit:

http://127.0.0.1:8000
Demo Credentials
Admin

Email: admin@communityblog.com

Password: password123

Demo Authors

Email: hasan@example.com

Password: password123

Email: maya@example.com

Password: password123

Email: omar@example.com

Password: password123

Editorial Workflow
Author flow

Author registers or logs in

Author creates a post

Author saves as draft or submits for review

Submitted posts get status = pending

Admin flow

Admin reviews pending posts

Admin approves → post becomes published

Admin rejects → post becomes rejected

Author edits rejected post and resubmits

Comments

Logged-in users can comment

New comments start as pending

Admin approves or rejects comments

Only approved comments appear publicly

Public Visibility Rules

Only posts that match all of the following are shown publicly:

status = published

published_at is not null

published_at <= now()

Only comments with:

status = approved

are shown publicly.

Folder Structure
app/
├── Http/
│ ├── Controllers/
│ │ ├── Admin/
│ │ ├── Author/
│ │ ├── Auth/
│ │ └── Web/
│ ├── Middleware/
│ └── Requests/
├── Models/
├── Helpers/

resources/views/
├── layouts/
├── partials/
├── auth/
├── web/
├── author/
└── admin/

public/css/
├── app.css
├── auth.css
├── dashboard.css
└── home.css
Important Commands
Run server
php artisan serve
Clear caches
php artisan optimize:clear
Reseed database
php artisan migrate:fresh --seed
Create storage link
php artisan storage:link
Branding / White-label Notes

This template is designed to be reusable for multiple clients.

You can update branding from:

Admin → Settings

This includes:

site name

tagline

logo

favicon

footer text

The footer can also include agency branding such as:

Powered by brndng.
Recommended Production Checklist

Before deploying to production:

set APP_DEBUG=false

configure real mail credentials for password reset

use HTTPS

verify storage permissions

check uploads

update contact email

update branding in settings

review demo users and remove if needed

test moderation flows

test public pages

clear caches

License / Usage

This template is intended as a reusable product build for client delivery and deployment.

You may customize branding, design, content, and configuration as needed per client project.

Credits

Built by brndng.

---

# 11) Recommended extra polish for README

For your brndng delivery, I also recommend adding:

- screenshots section
- deployment section for Hostinger/VPS/shared hosting
- changelog section
- support/contact section

But the README above is already strong enough for first release.

---

# 12) Final recommended next tiny step

After this, the smartest thing is to do one final pass on:

- hardcoded `Community Blog` strings
- inline styles
- active sidebar states
- pagination appearance
- final footer styling

If you want, I can do the last polish pass as a compact checklist with exact code replacements.
