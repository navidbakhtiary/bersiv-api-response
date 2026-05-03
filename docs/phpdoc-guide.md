# PHPDoc Guide

This package exposes purpose-based facade methods. Each public facade method should explain what response purpose the method represents, the accepted payload type, the expected response key, and the expected HTTP status code.

## Recommended PHPDoc Style

```php
<?php

/**
 * Return a success response for a completed login operation.
 *
 * Use this response after credentials are verified and the application has
 * generated the login payload, such as user data and token data.
 *
 * HTTP status: 200 OK.
 * Response payload key: data.
 *
 * @param array|JsonResource $data Login payload, usually user data and token data.
 *
 * @return JsonResponse The formatted JSON response.
 */
public function login(array|JsonResource $data = []): JsonResponse
{
    return $this->authentication_response_action->login($data);
}
```

## What Each Method Should Mention

| Method | Must Mention |
| --- | --- |
| `aiAnswer()` | 200 when answer exists, 404 when no answer is available. |
| `login()` | 200 OK, payload under `data`. |
| `logout()` | 200 OK, payload under `data`. |
| `tokenValid()` | 200 OK, payload under `data`. |
| `invalidLoginCredentials()` | 401 Unauthorized, payload under `errors`. |
| `invalidToken()` | 401 Unauthorized, payload under `errors`. |
| `unauthenticated()` | 401 Unauthorized, payload under `errors`. |
| `detail()` | 200 when resource exists, 404 when resource is empty. |
| `list()` | 200 OK, whether the collection has items or is empty. |
| `filteredList()` | 200 OK, whether filtered data has items or is empty. |
| `searchResults()` | 200 OK, whether search results exist or are empty. |
| `attributesList()` | 200 OK, whether attributes exist or the list is empty. |
| `valuesList()` | 200 OK, whether values exist or the list is empty. |
| `attributeRanges()` | 200 OK, whether ranges exist or the list is empty. |
| `dateRange()` | 200 OK, whether a date range exists or is empty. |
| `invalidInputs()` | 422 Unprocessable Entity, payload under `errors`. |
| `invalidAttributes()` | 422 Unprocessable Entity, payload under `errors`. |
| `invalidCaptcha()` | 422 Unprocessable Entity, payload under `errors`. |
| `externalApiRejected()` | 502 Bad Gateway, payload under `errors`. |
| `externalApiUnavailable()` | 503 Service Unavailable, payload under `errors`. |
| `processAccepted()` | 202 Accepted, payload under `data`. |
| `processFinished()` | 200 OK, payload under `data`. |
| `processRejected()` | 422 Unprocessable Entity, payload under `errors`. |
| `tooManyRequests()` | 429 Too Many Requests, payload under `errors`. |
| `serverError()` | 500 Internal Server Error, payload under `errors`. |

## Example: Failure Method

```php
<?php

/**
 * Return an unprocessable entity response for invalid request inputs.
 *
 * Use this response when request validation fails and the client must fix
 * submitted input before trying again.
 *
 * HTTP status: 422 Unprocessable Entity.
 * Response payload key: errors.
 *
 * @param string|null $message Optional custom validation message.
 * @param array|JsonResource $errors Structured validation errors.
 *
 * @return JsonResponse The formatted JSON response.
 */
public function invalidInputs(?string $message = null, array|JsonResource $errors = []): JsonResponse
{
    return $this->validation_response_action->invalidInputs($message, $errors);
}
```

## Notes

- Prefer short first lines.
- Add one short paragraph when the purpose is not obvious.
- Mention the HTTP status explicitly.
- Mention `data` for success responses and `errors` for failure responses.
- Keep the `@param` description practical and based on how users call the facade.
- Keep `@return JsonResponse The formatted JSON response.` consistent across methods.
