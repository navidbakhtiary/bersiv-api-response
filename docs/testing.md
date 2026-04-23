# Testing

The package uses PHPUnit together with Orchestra Testbench.

## Run All Tests

```bash
./vendor/bin/phpunit
```

## Run a Specific Test File

```bash
./vendor/bin/phpunit tests/Unit/Actions/Authentication/AuthenticationResponseActionTokenValidTest.php
```

## Run a Specific Test Method

```bash
./vendor/bin/phpunit tests/Unit/Actions/Authentication --filter testTokenValidReturnsOkStatusCode
```

## Package TestCase

A typical package `TestCase` for this package looks like this:

```php
<?php

namespace NavidBakhtiary\BersivApiResponse\Tests;

use NavidBakhtiary\BersivApiResponse\BersivApiResponseServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BersivApiResponseServiceProvider::class,
        ];
    }
}
```

## Notes

- Keep test method names descriptive and in camelCase.
- Prefer small focused tests.
- Split action tests into multiple files when that improves readability.
- Use Laravel response status code constants from `Illuminate\Http\Response`.
