# Authentication Responses

The `AuthenticationResponseAction` class provides common authentication-related responses.

## Class

```php
<?php

use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
```

## Available methods

### `login(JsonResource|array $data = [])`

Returns a success response for a completed login operation.

```php
<?php

$action = new AuthenticationResponseAction();

return $action->login([
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
  "message": "Login was successful.",
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

When no payload is provided, `data` defaults to an empty array.

```php
<?php

return $action->login();
```

Example response:

```json
{
  "success": true,
  "message": "Login was successful.",
  "data": []
}
```

### `invalidLoginCredentials(JsonResource|array $errors = [])`

Returns an unauthorized response for incorrect login credentials.

```php
<?php

$action = new AuthenticationResponseAction();

return $action->invalidLoginCredentials();
```

Example response:

```json
{
  "success": false,
  "message": "Credentials are incorrect.",
  "errors": []
}
```

You may also provide structured error details.

```php
<?php

return $action->invalidLoginCredentials([
    'email' => ['These credentials do not match our records.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "Credentials are incorrect.",
  "errors": {
    "email": [
      "These credentials do not match our records."
    ]
  }
}
```

### `logout(JsonResource|array $data = [])`

Returns a success response for a completed logout operation.

```php
<?php

$action = new AuthenticationResponseAction();

return $action->logout();
```

Example response:

```json
{
  "success": true,
  "message": "Logout was successful.",
  "data": []
}
```

You may also attach optional response data.

```php
<?php

return $action->logout([
    'revoked_tokens_count' => 2,
]);
```

Example response:

```json
{
  "success": true,
  "message": "Logout was successful.",
  "data": {
    "revoked_tokens_count": 2
  }
}
```

### `tokenValid(JsonResource|array $data = [])`

Returns a success response when the provided token is valid.

```php
<?php

$action = new AuthenticationResponseAction();

return $action->tokenValid();
```

Example response:

```json
{
  "success": true,
  "message": "Token is valid.",
  "data": []
}
```

You may also attach optional response data.

```php
<?php

return $action->tokenValid([
    'user_id' => 1,
    'valid' => true,
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

### `unauthenticated(JsonResource|array $errors = [])`

Returns an unauthorized response for unauthenticated access.

```php
<?php

$action = new AuthenticationResponseAction();

return $action->unauthenticated();
```

Example response:

```json
{
  "success": false,
  "message": "Authentication token is invalid.",
  "errors": []
}
```

You may also provide structured error details.

```php
<?php

return $action->unauthenticated([
    'token' => ['The provided token is invalid.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "Authentication token is invalid.",
  "errors": {
    "token": [
      "The provided token is invalid."
    ]
  }
}
```

## Notes

- Success responses use the `success` key and place payloads under `data`.
- Failure responses use the `success` key and place payloads under `errors`.
- All authentication action methods accept either an array or a `JsonResource`.
- Translation strings are resolved using the package namespace, for example:

```php
__('bersiv-api-response::auths.successful.login')
__('bersiv-api-response::auths.failures.incorrect_credentials')
```
