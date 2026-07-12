# Laravel Cache Sync

> A powerful, expressive cache management package for Laravel that makes caching, refreshing, invalidating, and synchronizing data effortless.

[![Latest Version](https://img.shields.io/packagist/v/goldenfavour/laravel-cache-sync.svg)](https://packagist.org/packages/goldenfavour/laravel-cache-sync)
[![PHP Version](https://img.shields.io/packagist/php-v/goldenfavour/laravel-cache-sync.svg)](https://packagist.org/packages/goldenfavour/laravel-cache-sync)
[![License](https://img.shields.io/github/license/goldenfavour/laravel-cache-sync.svg)](LICENSE)

---

## Introduction

Laravel Cache Sync extends Laravel's caching capabilities by providing a clean and centralized API for managing cached resources.

Instead of scattering cache logic throughout your application, Cache Sync lets you define cache operations in one place and execute them consistently.

It is designed for applications that need to:

- Cache expensive database queries
- Refresh cache after updates
- Forget related cache entries
- Synchronize cache across multiple operations
- Keep cache logic maintainable and reusable

---

## Features

- Laravel-like syntax
- Automatic cache population
- Cache refreshing
- Cache invalidation
- Tagged cache support (where supported)
- Flexible TTL handling
- Driver agnostic
- Queue-friendly architecture
- Extensible operations
- Lightweight with zero configuration

---

# Installation

Install via Composer:

```bash
composer require goldenfavour/laravel-cache-sync
```

Publish the configuration file (optional):

```bash
php artisan vendor:publish --tag=cache-sync-config
```

---

# Requirements

- PHP 8.2+
- Laravel 12+

---

# Basic Usage

## Remember

Cache a value if it doesn't exist.

```php
use Goldenfavour\CacheSync\Facades\CacheSync;

$states = CacheSync::remember(
    'states',
    now()->addHour(),
    function () {
        return State::with('local_govt_areas.wards')->get();
    }
);
```

The callback is only executed when the cache does not already exist.

---

## Get Cached Value

```php
$value = CacheSync::get('states');
```

---

## Store Value

```php
CacheSync::put(
    'settings',
    $settings,
    now()->addDay()
);
```

---

## Check Cache

```php
if (CacheSync::has('states')) {
    //
}
```

---

## Forget Cache

```php
CacheSync::forget('states');
```

---

## Refresh Cache

Instead of manually forgetting and remembering, simply refresh it.

```php
CacheSync::refresh(
    'states',
    now()->addHour(),
    fn () => State::all()
);
```

---

## Forever Cache

```php
CacheSync::forever(
    'countries',
    fn () => Country::all()
);
```

---

## Flush Cache

```php
CacheSync::flush();
```

---

# Using Tags

If your cache driver supports tags:

```php
CacheSync::tags(['users'])
    ->remember(
        'admins',
        now()->addHour(),
        fn () => User::admins()->get()
    );
```

Clear tagged cache:

```php
CacheSync::tags(['users'])->flush();
```

---

# Synchronizing Cache

You can define cache synchronization operations that automatically update related cache whenever your application data changes.

Example:

```php
CacheSync::sync(function () {

    CacheSync::refresh(
        'states',
        now()->addHour(),
        fn () => State::all()
    );

    CacheSync::forget('dashboard.statistics');

});
```

This allows multiple cache operations to execute together in a clean and consistent way.

---

# Expiration

You may pass any Laravel-supported expiration value.

```php
now()->addMinutes(10)

now()->addHour()

now()->addDay()

3600

DateInterval

DateTimeInterface
```

---

# Configuration

After publishing:

```php
config/cache-sync.php
```

Example:

```php
return [

    'default_store' => env('CACHE_STORE'),

    'prefix' => env('CACHE_PREFIX'),

];
```

---

# Testing

Run the package tests.

```bash
composer test
```

or

```bash
php artisan test
```

---

# Roadmap

- Redis synchronization
- Event listeners
- Automatic model cache refresh
- Wildcard cache invalidation
- Cache metrics
- Cache warming
- Queue integration
- Distributed cache synchronization
- Cache versioning

---

# Contributing

Contributions are welcome.

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Open a Pull Request

---

# Security

If you discover any security vulnerability, please open a private security report instead of creating a public issue.

---

# License

This package is open-sourced software licensed under the MIT license.

---

Made with ❤️ for the Laravel community.
