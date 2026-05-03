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

use NavidBakhtiary\BersivApiResponse\Providers\BersivApiResponseServiceProvider;
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

## Facade Testing

Facade tests should confirm that each public facade method returns the expected response structure and status code.

Example:

```php
<?php

use Illuminate\Http\JsonResponse;
use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

public function testCanReturnLoginResponseUsingFacade(): void
{
    $response = BersivApiResponse::login([
        'token' => 'sample-token',
    ]);

    $response_data = $response->getData(true);

    $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
    $this->assertTrue($response_data['success']);
    $this->assertArrayHasKey('data', $response_data);
}
```

## Recommended Test Coverage Before Release

Before publishing a new version, test:

- every facade method
- every action class method
- success response structure
- failure response structure
- expected HTTP status codes
- array payloads
- `JsonResource` payloads
- empty payload behavior
- translation loading
- translation publishing
- service provider registration
- facade binding

## Notes

- Keep test method names descriptive and in camelCase.
- Prefer small focused tests.
- Split action tests into multiple files when that improves readability.
- Use Laravel response status code constants from `Illuminate\Http\JsonResponse` or `Illuminate\Http\Response`.
