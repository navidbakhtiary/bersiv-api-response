# Authentication Responses

Authentication response methods are available through the `BersivApiResponse` facade.

`JsonResource` means `Illuminate\Http\Resources\Json\JsonResource`.

`JsonResponse` means `Illuminate\Http\JsonResponse`.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;
```

## Available Methods

| Method | HTTP Status | Purpose |
| --- | ---: | --- |
| `login()` | 200 | Return successful login response. |
| `logout()` | 200 | Return successful logout response. |
| `tokenValid()` | 200 | Return successful token validation response. |
| `invalidLoginCredentials()` | 401 | Return invalid login credentials response. |
| `invalidToken()` | 401 | Return invalid token response. |
| `unauthenticated()` | 401 | Return unauthenticated access response. |

## `login(array|JsonResource $data = []): JsonResponse`

Returns a success response for a completed login operation.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::login([
    'user' => [
        'id' => 1,
        'email' => 'navid@example.com',
    ],
    'token' => [
        'token' => 'example-token',
        'device_name' => 'mobile',
    ],
]);
```

Example response:

```json
{
  "success": true,
  "message": "Logged in successfully.",
  "data": {
    "user": {
      "id": 1,
      "email": "navid@example.com"
    },
    "token": {
      "token": "example-token",
      "device_name": "mobile"
    }
  }
}
```

## `invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response for invalid login credentials.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::invalidLoginCredentials([
    'email' => ['These credentials do not match our records.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "Invalid credentials.",
  "errors": {
    "email": [
      "These credentials do not match our records."
    ]
  }
}
```

## `logout(array|JsonResource $data = []): JsonResponse`

Returns a success response for a completed logout operation.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::logout();
```

Example response:

```json
{
  "success": true,
  "message": "Logged out successfully.",
  "data": []
}
```

## `tokenValid(array|JsonResource $data = []): JsonResponse`

Returns a success response when the provided token is valid.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::tokenValid([
    'user_id' => 1,
    'valid' => true
]);
```

Example response:

```json
{
  "success": true,
  "message": "Token is valid.",
  "data": {
    "user_id": 1,
    "valid": true
  }
}
```

## `invalidToken(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response when the provided token is invalid.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::invalidToken([
    'token' => ['The provided token is invalid.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "The token is invalid.",
  "errors": {
    "token": [
      "The provided token is invalid."
    ]
  }
}
```

## `unauthenticated(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response for unauthenticated access.

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::unauthenticated();
```

Example response:

```json
{
  "success": false,
  "message": "Authentication is required.",
  "errors": []
}
```

## Translation Keys

Authentication messages are resolved through package translations.

Examples:

```php
<?php

__('bersiv-api-response::auths.successful.login');
__('bersiv-api-response::auths.successful.logout');
__('bersiv-api-response::auths.successful.valid_token');
__('bersiv-api-response::auths.failures.incorrect_credentials');
__('bersiv-api-response::auths.failures.invalid_token');
__('bersiv-api-response::auths.failures.unauthenticated');
```
