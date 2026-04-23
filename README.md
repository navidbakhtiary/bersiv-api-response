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

## Default Response Structure

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

use NavidBakhtiary\BersivApiResponse\Actions\Authentication\AuthenticationResponseAction;

$action = new AuthenticationResponseAction();

return $action->tokenValid();
```

## Running Tests

```bash
./vendor/bin/phpunit
```

## License

MIT
