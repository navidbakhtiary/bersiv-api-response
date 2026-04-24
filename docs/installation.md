# Installation

## Requirements

- PHP 8.2 or higher
- A compatible Laravel application

## Install the Package

```bash
composer require navidbakhtiary/bersiv-api-response
```

## Package Discovery

The package service provider is registered automatically through Laravel package discovery.

Registered provider:

```php
NavidBakhtiary\BersivApiResponse\BersivApiResponseServiceProvider::class
```

## Translations

The package loads its translation files through the `bersiv-api-response` namespace.

Example:

```php
__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']);
```

If you want to customize the package translations in your Laravel application, publish them with:

```php
php artisan vendor:publish --tag=bersiv-api-response-translations
```

The translation files will be copied to:

```
lang/vendor/bersiv-api-response
```

## Composer Autoloading During Package Development

Make sure your package `composer.json` uses the correct PSR-4 namespaces:

```json
"autoload": {
    "psr-4": {
        "NavidBakhtiary\\BersivApiResponse\\": "src/"
    }
},
"autoload-dev": {
    "psr-4": {
        "NavidBakhtiary\\BersivApiResponse\\Tests\\": "tests/"
    }
}
```

After changing namespaces or moving files, refresh Composer autoloading:

```bash
composer dump-autoload
```

## Notes

This package is a library package.

For library packages, it is generally better not to commit `composer.lock` to the package repository.
