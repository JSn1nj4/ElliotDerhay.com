# ElliotDerhay.com

This project is my personal website.

## Setup

### Initial

- Clone the project.
- Copy `.env.example` to `.env`.

### Database

- To use SQLite (the default), create the file at `database/database.sqlite`.
- To use MySQL or PostgreSQL, create your DB and configure the `DB_*` vars.

### Install Dependencies

1. Make sure you meet the project's runtime requirements:
	- If you use ASDF, run `asdf install`
	- If you manage runtimes another way:
		- PHP 8.2.x
		- Node 20.x
		- Yarn 1.22.x
2. Run `composer install`.
3. Run `yarn` to install dependencies.
	- If you use vanilla `npm` instead, I'm terribly sorry. ¯\\\_(ツ)\_/¯

### Finish

- Generate project key: `php artisan key:generate`.
- Run migrations: `php artisan migrate`.
- Link public storage: `php artisan storage:link`
- _Optionally_, seed dev data: `php artisan db:seed --seeder=DemoSeeder`

---

### _A Note about caching_

This project's `.env` uses the `file` cache store. But Laravel 11.x's default cache store is `database`. Feel free to
change this or comment it out to use the default.

### _A note on the `ImageService`_

There are a couple of helpers used around the project (`assets_url()` and `image_url()`) that hook into
the `App\Services\ImageService` class. This exists to:

- allow permanent image storage to live on another `disk`
- *Still* provide fast load times for images by "caching" them on the same disk as the application at first request

The ENV var `IMAGE_SERVICE_REMOTE_DISK` lets you choose where to look for downloadable assets. It defaults to a local
disk to ensure these features work as intended after cloning.

---

[Changelog](CHANGELOG.md)

[License](LICENSE.md)