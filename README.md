# Bersiv API Response

A lightweight Laravel package for standardized JSON response structures.

## Features

- Consistent success and failure response formats
- Dedicated response classes for common API cases
- Action-based response generators
- Authentication response helpers
- Validation response helpers
- External API failure response helpers
- Easy integration into Laravel projects
- Supports both arrays and JsonResource instances as payloads
- Built-in namespaced translation support for response messages

## Installation

```bash
composer require navidbakhtiary/bersiv-api-response
```

```md
### Translations

The package uses namespaced translation keys such as:

```php
__('bersiv-api-response::auths.successful.login');
__('bersiv-api-response::messages.failures.invalid_inputs');
```

To customize the package translations in your application, publish them with:

```php
php artisan vendor:publish --tag=bersiv-api-response-translations
```

## Response Structure

### Success response

```json
{
  "success": true,
  "message": "Operation was successful.",
  "data": []
}
```

### Failure response

```json
{
  "success": false,
  "message": "The operation failed.",
  "errors": []
}
```

## Documentation

- [Installation](docs/installation.md)
- [Authentication responses](docs/authentication.md)
- [Response types](docs/responses.md)
- [Testing](docs/testing.md)

## Basic Usage

```php
<?php

use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;

$action = new AuthenticationResponseAction();

return $action->login([
    'token' => 'sample-token',
    'user' => [
        'id' => 1,
        'email' => 'navid@example.com',
    ],
]);
```

## Running Tests

```bash
./vendor/bin/phpunit
```

## License

MIT
