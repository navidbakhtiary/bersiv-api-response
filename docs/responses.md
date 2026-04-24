# Response Types

This package provides structured response classes and action classes for common API scenarios.

## Success Responses

Success responses use the `success` key and place payloads inside `data`.

Example:

```json
{
  "success": true,
  "message": "Request completed successfully.",
  "data": []
}
```

Success payloads may be provided as either an array or a `JsonResource`.

## Failure Responses

Failure responses use the `success` key and place payloads inside `errors`.

Example:

```json
{
  "success": false,
  "message": "The request failed.",
  "errors": []
}
```

Failure payloads may be provided as either an array or a `JsonResource`.

## Design Choice

### Why `data` and `errors` default to empty arrays

This package uses empty arrays by default instead of `null`.

Advantages:

- stable API structure
- simpler frontend handling
- fewer null checks in clients
- consistent response expectations

## Main Response Categories

### Authentication responses

Used for common authentication cases such as login, invalid login credentials, logout, token validation, and unauthenticated access.

### Validation responses

Used for invalid inputs, invalid attributes, or failed captcha validation.

### External API responses

Used when an external API rejects a request or is unavailable.

### Data responses

Used for detail views, collections, filtered lists, search results, value lists, attribute ranges, and date ranges.

## Response Construction

The package is built around three layers:

### Response classes

Response classes define the HTTP status code and final response shape.

Examples include:

- `OkResponse`
- `UnauthorizedResponse`
- `ForbiddenResponse`
- `NotFoundResponse`
- `BadGatewayResponse`
- `ServiceUnavailableResponse`
- `UnprocessableEntityResponse`

### Action classes

Action classes provide higher-level response builders for common use cases.

Examples include:

- `AuthenticationResponseAction`
- `DetailResponseAction`
- `ListResponseAction`
- `RangesResponseAction`
- `ValuesResponseAction`
- `ExternalApiResponseAction`
- `ValidationResponseAction`

### Manager and facade entry point

The package also provides a central manager and facade entry point for delegating to action classes from a single access point.

## Translation Support

Response messages are resolved through namespaced package translations.

Examples:

```php
<?php

__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']);
__('bersiv-api-response::messages.failures.invalid_inputs');
__('bersiv-api-response::auths.successful.login');
```

If you want to override these messages in your application, publish the package translations:

```php
php artisan vendor:publish --tag=bersiv-api-response-translations
```