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

Used for common authentication cases such as login, logout, invalid credentials, token validation, and unauthenticated access.

### Validation responses

Used for invalid inputs, invalid attributes, or failed captcha validation.

### External API responses

Used when an external API rejects a request or is unavailable.

### Data responses

Used for detail views, collections, value lists, attribute ranges, and date ranges.
