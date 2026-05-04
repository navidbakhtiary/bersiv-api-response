# Publishing Checklist

Use this checklist before publishing a new release of Bersiv API Response.

## Code Readiness

- [ ] All public facade methods are intentionally named.
- [ ] All facade methods have complete PHPDoc comments.
- [ ] All action methods have complete PHPDoc comments.
- [ ] All response classes have clear names and responsibilities.
- [ ] Public APIs do not expose unnecessary internal implementation details.
- [ ] Method names are consistent across concerns.
- [ ] Namespaces are correct.
- [ ] Composer autoloading works after `composer dump-autoload`.

## Response Contract

- [ ] Success responses always include `success`, `message`, and `data`.
- [ ] Failure responses always include `success`, `message`, and `errors`.
- [ ] Empty success payloads default to `data: []`.
- [ ] Empty failure payloads default to `errors: []`.
- [ ] List-style empty responses return `200 OK`.
- [ ] Missing single-resource responses return `404 Not Found`.
- [ ] Missing AI-answer responses return `404 Not Found`.
- [ ] All semantic methods return the expected HTTP status codes.
- [ ] All messages are translation-based.

## Facade API

- [ ] `aiAnswer()` is documented and tested.
- [ ] Authentication methods are documented and tested.
- [ ] Data methods are documented and tested.
- [ ] External API methods are documented and tested.
- [ ] Process methods are documented and tested.
- [ ] Rate limit methods are documented and tested.
- [ ] System methods are documented and tested.
- [ ] Validation methods are documented and tested.

## Documentation

- [ ] README explains the package purpose.
- [ ] README shows basic facade usage.
- [ ] Installation documentation is complete.
- [ ] Response structure documentation is complete.
- [ ] Facade API reference lists all public methods.
- [ ] Usage examples are realistic.
- [ ] Usage examples include matching example JSON responses.
- [ ] Translation publishing is documented.
- [ ] Translation keys in docs match the actual translation file keys.
- [ ] Example response messages match default translation files.
- [ ] Empty payload behavior is documented consistently.
- [ ] Testing instructions are documented.
- [ ] Local development installation is documented separately from public Packagist installation.
- [ ] License is included.
- [ ] Changelog is updated.

## Composer Package

- [ ] `composer.json` has the correct package name.
- [ ] `composer.json` has a clear description.
- [ ] `composer.json` has useful keywords.
- [ ] `composer.json` has the correct license.
- [ ] `composer.json` has the correct PHP version constraint.
- [ ] `composer.json` has the correct Laravel dependency constraint.
- [ ] `composer.json` has correct PSR-4 autoload mappings.
- [ ] `composer.json` includes the Laravel package discovery provider.
- [ ] `composer validate --strict` passes.

Example keywords:

```json
[
	"laravel",
	"api",
	"response",
	"json-response",
	"api-response",
	"facade",
	"php"
]
```

## Testing Before Release

- [ ] Run all package tests.
- [ ] Test every public facade method.
- [ ] Test every action class method.
- [ ] Test success response structure.
- [ ] Test failure response structure.
- [ ] Test expected HTTP status codes.
- [ ] Test array payloads.
- [ ] Test `JsonResource` payloads.
- [ ] Test empty payload behavior.
- [ ] Test translation loading.
- [ ] Test translation publishing.
- [ ] Test customized translations.
- [ ] Test service provider registration.
- [ ] Test facade binding.
- [ ] Install the package into a real Laravel application.
- [ ] Test facade usage from a controller.
- [ ] Test facade usage from an exception handler.
- [ ] Test with `composer install --prefer-dist` in a clean environment.

## Recommended Commands

```bash
composer validate --strict
composer dump-autoload
./vendor/bin/phpunit
```

If you use a Laravel test application, also test the package in that application:

```bash
composer update nbdev/bersiv-api-response
php artisan vendor:publish --tag=bersiv-api-response-translations
php artisan test
```

## Versioning

Use semantic versioning for public releases.

Examples:

```text
v1.0.1
v1.1.0
v2.0.0
```

Use pre-release tags if you want real-world testing before a stable release:

```text
v1.1.0-beta.1
v2.0.0-beta.1
```

## Release Notes Template

```md
# v1.1.0

## Added

- Added ...

## Changed

- Changed ...

## Fixed

- Fixed ...

## Documentation

- Updated ...
```

## Git Release Flow

```bash
git status
git add .
git commit -m "Prepare release v1.1.0"
git tag v1.1.0
git push origin main
git push origin v1.1.0
```

## After Release

- [ ] Confirm the new version appears on Packagist.
- [ ] Confirm Composer can install the new version.
- [ ] Confirm the README and documentation links work.
- [ ] Confirm the changelog includes the released version.
- [ ] Create a GitHub release if you use GitHub releases.
