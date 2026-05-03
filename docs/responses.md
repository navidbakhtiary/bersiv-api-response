# Response Types

Bersiv API Response provides structured response classes and semantic facade functions for common API scenarios.

The main goal is to make API responses predictable and readable.

## Success Responses

Success responses use the `success` key and place payloads under `data`.

```json
{
  "success": true,
  "message": "Request completed successfully.",
  "data": []
}
```

Success payloads may be provided as either an array or a Laravel `JsonResource`.

## Failure Responses

Failure responses use the `success` key and place payloads under `errors`.

```json
{
  "success": false,
  "message": "The request failed.",
  "errors": []
}
```

Failure payloads may be provided as either an array or a Laravel `JsonResource`.

## Why Empty Arrays Are Used by Default

This package uses empty arrays by default instead of `null`.

This helps API clients because:

- the response structure is stable
- frontend code needs fewer null checks
- clients can safely loop over `data` or `errors`
- success and failure responses stay predictable

## Empty Payload Behavior

Empty payloads do not always mean failure.

Some methods use an empty payload as a valid successful response. For example, list-style responses such as `list()`, `filteredList()`, `searchResults()`, `attributesList()`, `valuesList()`, `attributeRanges()`, and `dateRange()` return `200 OK` even when the result is empty.

Some methods treat an empty payload as a missing result. For example, `detail()` returns `404 Not Found` when the resource payload is empty, and `aiAnswer()` returns `404 Not Found` when no answer is available.

## Main Response Categories

### Authentication Responses

Used for common authentication cases:

- login success
- logout success
- valid token
- invalid token
- invalid login credentials
- unauthenticated access

### Data Responses

Used for common read operations:

- detail response
- list response
- filtered list response
- search results response
- attributes list response
- values list response
- attribute ranges response
- date range response

### Validation Responses

Used when user input is invalid:

- invalid inputs
- invalid attributes
- invalid captcha

### Process Responses

Used for long-running or background operations:

- accepted process
- finished process
- rejected process

### AI Responses

Used for AI-generated content:

- available AI answer
- missing AI answer

### External API Responses

Used when the application depends on another service:

- external API rejected the request
- external API is unavailable

### Rate Limit Responses

Used when the client sends too many requests.

### System Responses

Used for internal server errors.

## Response Construction Layers

The package is built around three layers.

### Response Classes

Response classes define the HTTP status code and final response shape.

Examples:

- `OkResponse`
- `UnauthorizedResponse`
- `NotFoundResponse`
- `BadGatewayResponse`
- `ServiceUnavailableResponse`
- `UnprocessableEntityResponse`
- `TooManyRequestsResponse`
- `InternalServerErrorResponse`

### Action Classes

Action classes contain higher-level response methods for common use cases.

Examples:

- `AiResponseAction`
- `AuthenticationResponseAction`
- `DetailResponseAction`
- `ListResponseAction`
- `RangesResponseAction`
- `ValuesResponseAction`
- `ExternalApiResponseAction`
- `ProcessResponseAction`
- `RateLimitResponseAction`
- `SystemResponseAction`
- `ValidationResponseAction`

### Manager and Facade

The manager is the central entry point behind the facade.

Most applications should use the facade directly:

```php
<?php

use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;

return BersivApiResponse::invalidInputs(errors: $validator->errors()->toArray());
```
