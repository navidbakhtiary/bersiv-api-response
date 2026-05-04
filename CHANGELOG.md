# Changelog

All notable changes to this package will be documented in this file.

The format is based on Keep a Changelog, and this project follows semantic versioning.

## [Unreleased]

## [1.0.0] - 2026-05-03

### Added

- Standard success and failure JSON response structures.
- Success responses with `success`, `message`, and `data`.
- Failure responses with `success`, `message`, and `errors`.
- Empty payload defaults using empty arrays instead of `null`.
- List-style responses that return `200 OK` even when results are empty.
- Missing single-resource responses with `404 Not Found`.
- Missing AI-answer responses with `404 Not Found`.
- Facade-based semantic response methods through `BersivApiResponse`.
- Authentication response helpers:
  - `login()`
  - `logout()`
  - `tokenValid()`
  - `invalidLoginCredentials()`
  - `invalidToken()`
  - `unauthenticated()`
- Data response helpers:
  - `detail()`
  - `list()`
  - `filteredList()`
  - `searchResults()`
  - `attributesList()`
  - `valuesList()`
  - `attributeRanges()`
  - `dateRange()`
- Validation response helpers:
  - `invalidInputs()`
  - `invalidAttributes()`
  - `invalidCaptcha()`
- External API response helpers:
  - `externalApiRejected()`
  - `externalApiUnavailable()`
- Process response helpers:
  - `processAccepted()`
  - `processFinished()`
  - `processRejected()`
- AI response helper:
  - `aiAnswer()`
- Rate limit response helper:
  - `tooManyRequests()`
- System error response helper:
  - `serverError()`
- Array and Laravel `JsonResource` payload support.
- Namespaced translation support using the `bersiv-api-response` namespace.
- Authentication translation file support through `auths.php`.
- General message translation file support through `messages.php`.
- Publishable translation files using the `bersiv-api-response-translations` tag.
- PHPUnit and Orchestra Testbench test coverage.
- Documentation for installation, response types, facade API, usage examples, authentication responses, translations, testing, and release checklist.
