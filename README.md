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

1. If you use ASDF, run `asdf install` to install tool versions.
2. Run `composer install`.
3. Run `yarn` to install dependencies.
	- If you use vanilla `npm` instead, I'm terribly sorry. ¯\\\_(ツ)\_/¯

### Finish

- Generate project key: `php artisan key:generate`.
- Run migrations: `php artisan migrate`.

### _A Note about caching_

This project's `.env` uses the `file` cache store. But Laravel 11.x's default cache store is `database`. Feel free to
change this or comment it out to use the default.

If you _do_ want to use the `database` cache store, make sure to run migrations first. There are some helper
functions in this project that use caching under the hood, so the `cache` table needs to exist ahead of time.

---

[Changelog](CHANGELOG.md)

[License](LICENSE.md)