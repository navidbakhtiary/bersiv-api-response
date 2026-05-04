# Usage Examples

This page shows common usage examples with the `BersivApiResponse` facade.

```php
<?php

use NBDev\BersivApiResponse\Facades\BersivApiResponse;
```

## Authentication

### Login

```php
<?php

return BersivApiResponse::login([
    'user' => [
        'id' => $user->id,
        'email' => $user->email,
    ],
    'token' => [
        'token' => $token,
        'device_name' => $request->string('device_name')->toString(),
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

### Invalid Login Credentials

```php
<?php

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
    "email": ["These credentials do not match our records."]
  }
}
```

### Logout

```php
<?php

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

### Token Is Valid

```php
<?php

return BersivApiResponse::tokenValid([
    'user_id' => auth()->id(),
]);
```

Example response:

```json
{
  "success": true,
  "message": "Token is valid.",
  "data": {
    "user_id": 1
  }
}
```

### Invalid Token

```php
<?php

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
    "token": ["The provided token is invalid."]
  }
}
```

### Unauthenticated

```php
<?php

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

## Data Responses

### Detail Response

```php
<?php

return BersivApiResponse::detail('User', [
    'id' => $user->id,
    'name' => $user->name,
    'email' => $user->email,
]);
```

Example response:

```json
{
  "success": true,
  "message": "User found.",
  "data": {
    "id": 1,
    "name": "Navid",
    "email": "navid@example.com"
  }
}
```

### Detail Not Found Response

```php
<?php

return BersivApiResponse::detail('User');
```

Example response:

```json
{
  "success": false,
  "message": "user not found.",
  "errors": []
}
```

### List Response

```php
<?php

return BersivApiResponse::list('User', [
    [
        'id' => 1,
        'name' => 'Navid',
    ],
    [
        'id' => 2,
        'name' => 'Sara',
    ],
]);
```

Example response:

```json
{
  "success": true,
  "message": "User list retrieved.",
  "data": [
    {
      "id": 1,
      "name": "Navid"
    },
    {
      "id": 2,
      "name": "Sara"
    }
  ]
}
```

### Empty List Response

```php
<?php

return BersivApiResponse::list('User');
```

Example response:

```json
{
  "success": true,
  "message": "No user found.",
  "data": []
}
```

### Filtered List Response

```php
<?php

return BersivApiResponse::filteredList('User', ['status', 'role'], [
    [
        'id' => 1,
        'name' => 'Navid',
        'status' => 'active',
        'role' => 'admin',
    ],
]);
```

Example response:

```json
{
  "success": true,
  "message": "Filtered user list retrieved for status, role.",
  "data": [
    {
      "id": 1,
      "name": "Navid",
      "status": "active",
      "role": "admin"
    }
  ]
}
```

### Empty Filtered List Response

```php
<?php

return BersivApiResponse::filteredList('User', ['status', 'role']);
```

Example response:

```json
{
  "success": true,
  "message": "No filtered user found.",
  "data": []
}
```

### Search Results Response

```php
<?php

return BersivApiResponse::searchResults('Location', [
    [
        'id' => 1,
        'name' => 'Berlin',
    ],
]);
```

Example response:

```json
{
  "success": true,
  "message": "Search results retrieved for user.",
  "data": [
    {
      "id": 1,
      "name": "Navid"
    }
  ]
}
```

### Empty Search Results Response

```php
<?php

return BersivApiResponse::searchResults('Location');
```

Example response:

```json
{
  "success": true,
  "message": "No search results found for user.",
  "data": []
}
```

### Attributes List Response

```php
<?php

return BersivApiResponse::attributesList('User', [
    'id',
    'name',
    'email',
    'created_at',
]);
```

Example response:

```json
{
  "success": true,
  "message": "user attributes retrieved.",
  "data": ["id", "name", "email", "created_at"]
}
```

### Empty Attributes List Response

```php
<?php

return BersivApiResponse::attributesList('User');
```

Example response:

```json
{
  "success": true,
  "message": "No attributes found for user.",
  "data": []
}
```

### Values List Response

```php
<?php

return BersivApiResponse::valuesList('User', 'status', [
    'active',
    'inactive',
]);
```

Example response:

```json
{
  "success": true,
  "message": "status values retrieved for user.",
  "data": ["active", "inactive"]
}
```

### Empty Values List Response

```php
<?php

return BersivApiResponse::valuesList('User', 'status');
```

Example response:

```json
{
  "success": true,
  "message": "No values found for status in user.",
  "data": []
}
```

### Attribute Ranges Response

```php
<?php

return BersivApiResponse::attributeRanges('sensor reading', [
    'temperature' => [
        'min' => 10,
        'max' => 35,
    ],
    'humidity' => [
        'min' => 20,
        'max' => 90,
    ],
]);
```

Example response:

```json
{
  "success": true,
  "message": "sensor reading attribute ranges retrieved.",
  "data": {
    "temperature": {
      "min": 10,
      "max": 35
    },
    "humidity": {
      "min": 20,
      "max": 90
    }
  }
}
```

### Empty Attribute Ranges Response

```php
<?php

return BersivApiResponse::attributeRanges('sensor reading');
```

Example response:

```json
{
  "success": true,
  "message": "No attribute ranges found for sensor reading.",
  "data": []
}
```

### Date Range Response

```php
<?php

return BersivApiResponse::dateRange('sensor reading', [
    'start_date' => '2026-01-01',
    'end_date' => '2026-12-31',
]);
```

Example response:

```json
{
  "success": true,
  "message": "sensor reading date range retrieved.",
  "data": {
    "start_date": "2026-01-01",
    "end_date": "2026-12-31"
  }
}
```

### Empty Date Range Response

```php
<?php

return BersivApiResponse::dateRange('sensor reading');
```

Example response:

```json
{
  "success": true,
  "message": "No date range found for sensor reading.",
  "data": []
}
```

## Validation Responses

### Invalid Inputs

```php
<?php

$validator = validator($request->all(), [
    'email' => ['required', 'email'],
    'password' => ['required'],
]);

if ($validator->fails())
{
    return BersivApiResponse::invalidInputs(
        errors: $validator->errors()->toArray(),
    );
}
```

Example response:

```json
{
  "success": false,
  "message": "Invalid input.",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password field is required."]
  }
}
```

### Invalid Inputs With Custom Message

```php
<?php

return BersivApiResponse::invalidInputs(
    message: 'The submitted profile data is invalid.',
    errors: [
        'email' => ['The email field is required.'],
    ],
);
```

Example response:

```json
{
  "success": false,
  "message": "The submitted profile data is invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### Invalid Attributes

```php
<?php

return BersivApiResponse::invalidAttributes([
    'unknown_column',
    'private_field',
]);
```

Example response:

```json
{
  "success": false,
  "message": "Invalid attributes: unknown_column, private_field.",
  "errors": []
}
```

### Invalid Captcha

```php
<?php

return BersivApiResponse::invalidCaptcha([
    'captcha' => ['Captcha validation failed.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "Invalid captcha.",
  "errors": {
    "captcha": ["Captcha validation failed."]
  }
}
```

## Process Responses

### Accepted Process

```php
<?php

return BersivApiResponse::processAccepted('data import', [
    'job_id' => $job_id,
    'status' => 'queued',
]);
```

Example response:

```json
{
  "success": true,
  "message": "The requested data import was accepted and is being processed. You will be notified when the result is ready.",
  "data": {
    "job_id": "job-123",
    "status": "queued"
  }
}
```

### Finished Process

```php
<?php

return BersivApiResponse::processFinished('data import', [
    'imported_rows' => 150,
    'failed_rows' => 0,
]);
```

Example response:

```json
{
  "success": true,
  "message": "The data import process finished successfully.",
  "data": {
    "imported_rows": 150,
    "failed_rows": 0
  }
}
```

### Rejected Process

```php
<?php

return BersivApiResponse::processRejected('data import', [
    'file' => ['The file extension is not supported.'],
]);
```

Example response:

```json
{
  "success": false,
  "message": "The data import process could not be accepted.",
  "errors": {
    "file": ["The file extension is not supported."]
  }
}
```

## AI Responses

### AI Answer

```php
<?php

return BersivApiResponse::aiAnswer([
    'answer' => 'The best matching crop is wheat.',
    'confidence' => 0.91,
]);
```

Example response:

```json
{
  "success": true,
  "message": "AI answer was generated successfully.",
  "data": {
    "answer": "The best matching crop is wheat.",
    "confidence": 0.91
  }
}
```

### Missing AI Answer

```php
<?php

return BersivApiResponse::aiAnswer();
```

Example response:

```json
{
  "success": false,
  "message": "No answer could be found for the provided question.",
  "errors": []
}
```

## External API Responses

### External API Rejected

```php
<?php

return BersivApiResponse::externalApiRejected(
    errors: [
        'service' => 'payment provider',
        'code' => 'CARD_DECLINED',
    ],
);
```

Example response:

```json
{
  "success": false,
  "message": "External API rejected the request.",
  "errors": {
    "service": "payment provider",
    "code": "CARD_DECLINED"
  }
}
```

### External API Unavailable

```php
<?php

return BersivApiResponse::externalApiUnavailable([
    'service' => 'weather API',
]);
```

Example response:

```json
{
  "success": false,
  "message": "External API is unavailable.",
  "errors": {
    "service": "weather API"
  }
}
```

## Rate Limit Response

```php
<?php

return BersivApiResponse::tooManyRequests([
    'retry_after' => 60,
]);
```

Example response:

```json
{
  "success": false,
  "message": "Too many requests.",
  "errors": {
    "retry_after": 60
  }
}
```

## System Error Response

```php
<?php

return BersivApiResponse::serverError([
    'reference' => 'ERR-2026-001',
]);
```

Example response:

```json
{
  "success": false,
  "message": "Server error.",
  "errors": {
    "reference": "ERR-2026-001"
  }
}
```

## Using JsonResource

All payload parameters that accept `array|JsonResource` can receive Laravel resources.

```php
<?php

use App\Http\Resources\UserResource;
use NBDev\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::detail('User', new UserResource($user));
```

Example response:

```json
{
  "success": true,
  "message": "user found.",
  "data": {
    "id": 1,
    "name": "Navid",
    "email": "navid@example.com"
  }
}
```
