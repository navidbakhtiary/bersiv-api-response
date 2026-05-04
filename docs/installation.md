# Installation

## Requirements

- PHP 8.2 or higher
- Laravel application compatible with the package version
- Composer

## Install the Package

```bash
composer require nbdev/bersiv-api-response
```

## Package Discovery

The package service provider is registered automatically through Laravel package discovery.

Registered provider:

```php
<?php

NBDev\BersivApiResponse\Providers\BersivApiResponseServiceProvider::class;
```

Normally, you do not need to add this provider manually.

## Facade

Use the facade in controllers, services, exception handlers, or route closures.

```php
<?php

use NBDev\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::list('User', $users);
```

## Translations

The package loads translation files through the `bersiv-api-response` namespace.

Example:

```php
<?php

__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']);
```

To customize package translations in your application, publish them with:

```bash
php artisan vendor:publish --tag=bersiv-api-response-translations
```

The translation files will be copied to:

```text
lang/vendor/bersiv-api-response
```

## Composer Autoloading During Package Development

Make sure your package `composer.json` uses the correct PSR-4 namespaces:

```json
{
  "autoload": {
    "psr-4": {
      "NBDev\\BersivApiResponse\\": "src/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "NBDev\\BersivApiResponse\\Tests\\": "tests/"
    }
  }
}
```

After changing namespaces or moving files, refresh Composer autoloading:

```bash
composer dump-autoload
```

## Local Package Development

When developing or testing the package inside another Laravel project, you can use a path repository.

Example in the Laravel application's `composer.json`:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../packages/bersiv-api-response",
      "options": {
        "symlink": true
      }
    }
  ]
}
```

Then require the package:

```bash
composer require nbdev/bersiv-api-response:@dev
```

## Notes

This package is a reusable library package. For public library packages, it is generally better not to commit `composer.lock` to the package repository.
