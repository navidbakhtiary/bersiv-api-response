# Facade API Reference

This page documents all public semantic functions available through the `BersivApiResponse` facade.

```php
<?php

use NBDev\BersivApiResponse\Facades\BersivApiResponse;
```

All methods return `Illuminate\Http\JsonResponse`.

All success payloads are returned under `data`.
All failure payloads are returned under `errors`.

> The exact message text can be customized through package translations.

## Status Code Summary

| Method                      | Success Status | Failure Status | Purpose                                                                    |
| --------------------------- | -------------: | -------------: | -------------------------------------------------------------------------- |
| `aiAnswer()`                |            200 |            404 | Return an AI answer or a missing-answer failure.                           |
| `login()`                   |            200 |              - | Return successful login data.                                              |
| `logout()`                  |            200 |              - | Return successful logout data.                                             |
| `tokenValid()`              |            200 |              - | Confirm that a token is valid.                                             |
| `invalidLoginCredentials()` |              - |            401 | Return invalid credential failure.                                         |
| `invalidToken()`            |              - |            401 | Return invalid token failure.                                              |
| `unauthenticated()`         |              - |            401 | Return unauthenticated access failure.                                     |
| `detail()`                  |            200 |            404 | Return a single resource or not found.                                     |
| `list()`                    |            200 |              - | Return a collection, whether it has items or is empty.                     |
| `filteredList()`            |            200 |              - | Return filtered data, whether it has items or is empty.                    |
| `searchResults()`           |            200 |              - | Return search results, whether results exist or are empty.                 |
| `attributesList()`          |            200 |              - | Return attribute names, whether attributes exist or the list is empty.     |
| `valuesList()`              |            200 |              - | Return values for an attribute, whether values exist or the list is empty. |
| `attributeRanges()`         |            200 |              - | Return attribute ranges, whether ranges exist or the list is empty.        |
| `dateRange()`               |            200 |              - | Return date range data, whether a range exists or is empty.                |
| `invalidAttributes()`       |              - |            422 | Return invalid attributes failure.                                         |
| `invalidCaptcha()`          |              - |            422 | Return captcha validation failure.                                         |
| `invalidInputs()`           |              - |            422 | Return input validation failure.                                           |
| `externalApiRejected()`     |              - |            502 | Return external API rejected failure.                                      |
| `externalApiUnavailable()`  |              - |            503 | Return external API unavailable failure.                                   |
| `processAccepted()`         |            202 |              - | Return accepted background process response.                               |
| `processFinished()`         |            200 |              - | Return finished process response.                                          |
| `processRejected()`         |              - |            422 | Return rejected process response.                                          |
| `tooManyRequests()`         |              - |            429 | Return rate limit failure.                                                 |
| `serverError()`             |              - |            500 | Return internal server error failure.                                      |

## AI Responses

### `aiAnswer(array|JsonResource $data = []): JsonResponse`

Returns an AI answer response.

Use this when your application asks an AI service or agent for an answer and wants to return the result in a consistent response structure.

When `$data` is provided, the response is successful.
When `$data` is empty, the response is a not found failure.

Parameters:

| Parameter | Type                  | Required | Description        |
| --------- | --------------------- | -------- | ------------------ |
| `$data`   | `array\|JsonResource` | No       | AI answer payload. |

Example:

```php
<?php

return BersivApiResponse::aiAnswer([
    'answer' => 'Generated answer.',
]);
```

Success response:

```json
{
  "success": true,
  "message": "AI answer was generated successfully.",
  "data": {
    "answer": "Generated answer."
  }
}
```

Failure response when no answer is available:

```json
{
  "success": false,
  "message": "No answer could be found for the provided question.",
  "errors": []
}
```

## Authentication Responses

### `login(array|JsonResource $data = []): JsonResponse`

Returns a success response for a completed login operation.

Parameters:

| Parameter | Type                  | Required | Description                                      |
| --------- | --------------------- | -------- | ------------------------------------------------ |
| `$data`   | `array\|JsonResource` | No       | Login payload, usually user data and token data. |

Example:

```php
<?php

return BersivApiResponse::login([
    'user' => [
        'id' => 1,
        'email' => 'navid@example.com',
    ],
    'token' => [
        'token' => 'example-token',
        'device_name' => 'web',
    ],
]);
```

### `logout(array|JsonResource $data = []): JsonResponse`

Returns a success response for a completed logout operation.

Parameters:

| Parameter | Type                  | Required | Description              |
| --------- | --------------------- | -------- | ------------------------ |
| `$data`   | `array\|JsonResource` | No       | Optional logout payload. |

Example:

```php
<?php

return BersivApiResponse::logout();
```

### `tokenValid(array|JsonResource $data = []): JsonResponse`

Returns a success response when the provided token is valid.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$data`   | `array\|JsonResource` | No       | Optional token validation payload. |

Example:

```php
<?php

return BersivApiResponse::tokenValid([
    'valid' => true,
]);
```

### `invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response for invalid login credentials.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional structured error details. |

Example:

```php
<?php

return BersivApiResponse::invalidLoginCredentials([
    'email' => ['These credentials do not match our records.'],
]);
```

### `invalidToken(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response when the provided token is invalid.

Parameters:

| Parameter | Type                  | Required | Description                              |
| --------- | --------------------- | -------- | ---------------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional structured token error details. |

Example:

```php
<?php

return BersivApiResponse::invalidToken([
    'token' => ['The token is invalid.'],
]);
```

### `unauthenticated(array|JsonResource $errors = []): JsonResponse`

Returns an unauthorized response for unauthenticated access.

Parameters:

| Parameter | Type                  | Required | Description                            |
| --------- | --------------------- | -------- | -------------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional authentication error details. |

Example:

```php
<?php

return BersivApiResponse::unauthenticated();
```

## Data Responses

### `detail(string $model_name, array|JsonResource $model_resource = []): JsonResponse`

Returns a response for one resource.

When the resource payload exists, it returns a success response.
When the resource payload is empty, it returns a not found response.

Parameters:

| Parameter         | Type                  | Required | Description                                 |
| ----------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name`     | `string`              | Yes      | Entity/model display name used in messages. |
| `$model_resource` | `array\|JsonResource` | No       | Single resource payload.                    |

Example:

```php
<?php

return BersivApiResponse::detail('User', [
    'id' => 1,
    'name' => 'Navid',
]);
```

### `list(string $model_name, array|JsonResource $data_resource = []): JsonResponse`

Returns a response for a collection of entities.

Parameters:

| Parameter        | Type                  | Required | Description                                 |
| ---------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name`    | `string`              | Yes      | Entity/model display name used in messages. |
| `$data_resource` | `array\|JsonResource` | No       | Collection resource or array data.          |

Example:

```php
<?php

return BersivApiResponse::list('User', [
    ['id' => 1, 'name' => 'Navid'],
]);
```

### `filteredList(string $model_name, string|array $attributes = "", array|JsonResource $data_resource = []): JsonResponse`

Returns a response for filtered data.

Parameters:

| Parameter        | Type                  | Required | Description                                         |
| ---------------- | --------------------- | -------- | --------------------------------------------------- |
| `$model_name`    | `string`              | Yes      | Entity/model display name used in messages.         |
| `$attributes`    | `string\|array`       | No       | Filter attribute or attributes used in the request. |
| `$data_resource` | `array\|JsonResource` | No       | Filtered data payload.                              |

Example:

```php
<?php

return BersivApiResponse::filteredList('User', ['status', 'role'], $users);
```

### `searchResults(string $query_entity, array|JsonResource $data_resource = []): JsonResponse`

Returns a response for search results.

Parameters:

| Parameter        | Type                  | Required | Description            |
| ---------------- | --------------------- | -------- | ---------------------- |
| `$query_entity`  | `string`              | Yes      | Searched entity name.  |
| `$data_resource` | `array\|JsonResource` | No       | Search result payload. |

Example:

```php
<?php

return BersivApiResponse::searchResults('Location', $locations);
```

### `attributesList(string $model_name, array|JsonResource $attributes = []): JsonResponse`

Returns a response for a list of available attributes.

Parameters:

| Parameter     | Type                  | Required | Description                                 |
| ------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name` | `string`              | Yes      | Entity/model display name used in messages. |
| `$attributes` | `array\|JsonResource` | No       | Attribute names or metadata.                |

Example:

```php
<?php

return BersivApiResponse::attributesList('User', [
    'id',
    'name',
    'email',
]);
```

### `valuesList(string $model_name, string $attribute, array|JsonResource $values = []): JsonResponse`

Returns a response for a list of values belonging to one attribute.

Parameters:

| Parameter     | Type                  | Required | Description                                 |
| ------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name` | `string`              | Yes      | Entity/model display name used in messages. |
| `$attribute`  | `string`              | Yes      | Attribute name used in messages.            |
| `$values`     | `array\|JsonResource` | No       | Values for the given attribute.             |

Example:

```php
<?php

return BersivApiResponse::valuesList('User', 'role', [
    'admin',
    'editor',
    'viewer',
]);
```

### `attributeRanges(string $model_name, array|JsonResource $ranges = []): JsonResponse`

Returns a response for available attribute ranges.

Parameters:

| Parameter     | Type                  | Required | Description                                 |
| ------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name` | `string`              | Yes      | Entity/model display name used in messages. |
| `$ranges`     | `array\|JsonResource` | No       | Attribute range data.                       |

Example:

```php
<?php

return BersivApiResponse::attributeRanges('sensor reading', [
    'temperature' => [
        'min' => 10,
        'max' => 35,
    ],
]);
```

### `dateRange(string $model_name, array|JsonResource $date_range_resource = []): JsonResponse`

Returns a response for date range data.

Parameters:

| Parameter              | Type                  | Required | Description                                 |
| ---------------------- | --------------------- | -------- | ------------------------------------------- |
| `$model_name`          | `string`              | Yes      | Entity/model display name used in messages. |
| `$date_range_resource` | `array\|JsonResource` | No       | Date range data.                            |

Example:

```php
<?php

return BersivApiResponse::dateRange('order', [
    'start_date' => '2026-01-01',
    'end_date' => '2026-12-31',
]);
```

## Validation Responses

### `invalidInputs(?string $message = null, array|JsonResource $errors = []): JsonResponse`

Returns an unprocessable entity response for invalid request inputs.

Parameters:

| Parameter  | Type                  | Required | Description                         |
| ---------- | --------------------- | -------- | ----------------------------------- |
| `$message` | `string\|null`        | No       | Optional custom validation message. |
| `$errors`  | `array\|JsonResource` | No       | Structured validation errors.       |

Example:

```php
<?php

return BersivApiResponse::invalidInputs(errors: [
    'email' => ['The email field is required.'],
]);
```

### `invalidAttributes(array $attributes, array|JsonResource $errors = []): JsonResponse`

Returns an unprocessable entity response for invalid attribute names.

Parameters:

| Parameter     | Type                  | Required | Description                        |
| ------------- | --------------------- | -------- | ---------------------------------- |
| `$attributes` | `array`               | Yes      | Invalid attribute names.           |
| `$errors`     | `array\|JsonResource` | No       | Optional structured error details. |

Example:

```php
<?php

return BersivApiResponse::invalidAttributes([
    'unknown_column',
]);
```

### `invalidCaptcha(array|JsonResource $errors = []): JsonResponse`

Returns an unprocessable entity response for failed captcha validation.

Parameters:

| Parameter | Type                  | Required | Description                         |
| --------- | --------------------- | -------- | ----------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional captcha validation errors. |

Example:

```php
<?php

return BersivApiResponse::invalidCaptcha([
    'captcha' => ['Captcha validation failed.'],
]);
```

## External API Responses

### `externalApiRejected(array|JsonResource $errors = []): JsonResponse`

Returns a bad gateway response when an external API rejects the request.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional structured error details. |

Example:

```php
<?php

return BersivApiResponse::externalApiRejected(
    errors: [
        'provider_code' => 'CARD_DECLINED',
    ],
);
```

### `externalApiUnavailable(array|JsonResource $errors = []): JsonResponse`

Returns a service unavailable response when an external API cannot be reached or is temporarily unavailable.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional structured error details. |

Example:

```php
<?php

return BersivApiResponse::externalApiUnavailable([
    'service' => 'weather API',
]);
```

## Process Responses

### `processAccepted(string $process_name, array|JsonResource $data = []): JsonResponse`

Returns an accepted response when a process has started but the final result is not ready yet.

Parameters:

| Parameter       | Type                  | Required | Description                                                         |
| --------------- | --------------------- | -------- | ------------------------------------------------------------------- |
| `$process_name` | `string`              | Yes      | Display name of the requested process.                              |
| `$data`         | `array\|JsonResource` | No       | Optional process payload, such as job ID, status, or tracking data. |

Example:

```php
<?php

return BersivApiResponse::processAccepted('data import', [
    'job_id' => 'job-123',
    'status' => 'queued',
]);
```

### `processFinished(string $process_name, array|JsonResource $data = []): JsonResponse`

Returns a success response when a process has completed successfully and the result is available.

Parameters:

| Parameter       | Type                  | Required | Description                            |
| --------------- | --------------------- | -------- | -------------------------------------- |
| `$process_name` | `string`              | Yes      | Display name of the requested process. |
| `$data`         | `array\|JsonResource` | No       | Optional process result payload.       |

Example:

```php
<?php

return BersivApiResponse::processFinished('data import', [
    'imported_rows' => 150,
]);
```

### `processRejected(string $process_name, array|JsonResource $errors = []): JsonResponse`

Returns an unprocessable entity response when a process cannot be accepted.

Parameters:

| Parameter       | Type                  | Required | Description                            |
| --------------- | --------------------- | -------- | -------------------------------------- |
| `$process_name` | `string`              | Yes      | Display name of the requested process. |
| `$errors`       | `array\|JsonResource` | No       | Optional structured error details.     |

Example:

```php
<?php

return BersivApiResponse::processRejected('data import', [
    'file' => ['The uploaded file format is not supported.'],
]);
```

## Rate Limit Responses

### `tooManyRequests(array|JsonResource $errors = []): JsonResponse`

Returns a too many requests response.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional rate limit error details. |

Example:

```php
<?php

return BersivApiResponse::tooManyRequests([
    'retry_after' => 60,
]);
```

## System Responses

### `serverError(array|JsonResource $errors = []): JsonResponse`

Returns an internal server error response.

Parameters:

| Parameter | Type                  | Required | Description                        |
| --------- | --------------------- | -------- | ---------------------------------- |
| `$errors` | `array\|JsonResource` | No       | Optional structured error details. |

Example:

```php
<?php

return BersivApiResponse::serverError();
```
