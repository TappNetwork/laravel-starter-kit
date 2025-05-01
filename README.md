<picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/TappNetwork/laravel-starter-kit/main/art/logo_dark.png">
    <img alt="Tapp Laravel 12 Starter Kit Light Logo" src="https://raw.githubusercontent.com/TappNetwork/laravel-starter-kit/main/art/logo_light.png">
</picture>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tapp/laravel-starter-kit.svg?style=flat-square&colorA=000000&colorB=2a7de1)](https://packagist.org/packages/tapp/laravel-starter-kit)
![GitHub Tests Action Status](https://github.com/TappNetwork/laravel-starter-kit/actions/workflows/run-tests.yml/badge.svg?style=flat-square)
![GitHub Pint Action Status](https://github.com/TappNetwork/laravel-starter-kit/actions/workflows/pint.yml/badge.svg?style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/tapp/laravel-starter-kit.svg?style=flat-square&colorA=000000&colorB=2a7de1)](https://packagist.org/packages/tapp/laravel-starter-kit)

# Tapp Laravel 12 Starter Kit

Key features include:
- Pre-configured User architecture (Model, Policy, Factory, Migration, and Seeder)
- Authorization using Spatie Permission library (roles and permissions)

## What is included

- Laravel 12
- Livewire 3
- TailwindCSS 4
- AlpineJS
- [Spatie Permission](https://github.com/spatie/laravel-permission)
- [Spatie Media Library](https://github.com/spatie/laravel-medialibrary)

### Dev

- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- Pest
- Peck
- Larastan

## Global Laravel Configurations included

### For local
- [`Model::shouldBeStrict();`](https://laravel-news.com/shouldbestrict): 
    - Prevent lazy loading
    - Prevent silently discarding attributes
    - Prevent accessing missing attributes

### For production
- Force HTTPs (`URL::forceHttps(app()->isProduction())`)
- Prohibit destructive database commands (`DB::prohibitDestructiveCommands(app()->isProduction())`)

### Seeder

- Permission and role seeders
- User seeder

## UI

While TailwindCSS and Alpine.js are included for styling and frontend interactivity, the starter kit doesn't include a pre-built UI component library (like Tailwind UI, Livewire Flux, DaisyUI, or Flowbite). This gives you the freedom to choose and integrate the component library that best fits your project's design requirements.

## Quick Start

```bash
composer create-project tapp/laravel-starter-kit <your-project-name-here>
```

Install dependencies

```bash
npm install
npm run build
```

Setup the environment

In the `.env` file, update the database name and other env vars according to your needs:

```bash
# in the .env file, configure your database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="tapp_starter"
DB_USERNAME=root
DB_PASSWORD=

# Testing
DB_TEST_CONNECTION="mysql-test"
DB_TEST_HOST=127.0.0.1
DB_TEST_PORT=3306
DB_TEST_DATABASE="tapp_starter_test"
DB_TEST_USERNAME=root
DB_TEST_PASSWORD=
```

Run database migrations

```bash
php artisan migrate --seed
```

This will create an admin user:

```
user: admin@dev.com
password: secret
```

and also an "Administrator" role and user permissions.

## Contributing

Thank you for considering contributing to the Tapp Laravel Starter Kit!

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Steve Williamson via [steve@tappnetwork.com](mailto:steve@tappnetwork.com). All security vulnerabilities will be promptly addressed.

## License

The Tapp Laravel SasS Starter Kit software is licensed under the [MIT license](https://opensource.org/licenses/MIT).
