# Translations

Bersiv API Response uses Laravel translation files for response messages.

The package translation namespace is:

```text
bersiv-api-response
```

The package currently uses two main translation files:

```text
auths.php
messages.php
```

## Example Translation Usage

```php
<?php

__('bersiv-api-response::auths.successful.login');
__('bersiv-api-response::auths.failures.unauthenticated');

__('bersiv-api-response::messages.failures.invalid_inputs');
__('bersiv-api-response::messages.successful.model_found', [
    'model' => 'user',
]);
```

## Publish Translation Files

To customize response messages in your Laravel application, publish the package translations:

```bash
php artisan vendor:publish --tag=bersiv-api-response-translations
```

The translation files will be copied to:

```text
lang/vendor/bersiv-api-response
```

## Translation Files

### `auths.php`

Authentication response messages are stored in `auths.php`.

#### Successful Authentication Keys

| Key | Used By | Default Message | Placeholders |
| --- | --- | --- | --- |
| `auths.successful.login` | `login()` | `Logged in successfully.` | - |
| `auths.successful.logout` | `logout()` | `Logged out successfully.` | - |
| `auths.successful.valid_token` | `tokenValid()` | `Token is valid.` | - |

#### Failed Authentication Keys

| Key | Used By | Default Message | Placeholders |
| --- | --- | --- | --- |
| `auths.failures.incorrect_credentials` | `invalidLoginCredentials()` | `Invalid credentials.` | - |
| `auths.failures.invalid_token` | `invalidToken()` | `The token is invalid.` | - |
| `auths.failures.unauthenticated` | `unauthenticated()` | `Authentication is required.` | - |

Example:

```php
<?php

__('bersiv-api-response::auths.successful.login');
__('bersiv-api-response::auths.successful.logout');
__('bersiv-api-response::auths.successful.valid_token');

__('bersiv-api-response::auths.failures.incorrect_credentials');
__('bersiv-api-response::auths.failures.invalid_token');
__('bersiv-api-response::auths.failures.unauthenticated');
```

### `messages.php`

General response messages are stored in `messages.php`.

#### Successful Message Keys

| Key | Used By | Default Message | Placeholders |
| --- | --- | --- | --- |
| `messages.successful.ai_answer_generated` | `aiAnswer()` | `AI answer was generated successfully.` | - |
| `messages.successful.attributes_list_retrieved` | `attributesList()` | `:model attributes retrieved.` | `model` |
| `messages.successful.attributes_ranges_retrieved` | `attributeRanges()` | `:model attribute ranges retrieved.` | `model` |
| `messages.successful.date_range_retrieved` | `dateRange()` | `:model date range retrieved.` | `model` |
| `messages.successful.empty_attributes_list` | `attributesList()` empty result message | `No attributes found for :model.` | `model` |
| `messages.successful.empty_attributes_ranges` | `attributeRanges()` empty result message | `No attribute ranges found for :model.` | `model` |
| `messages.successful.empty_date_range` | `dateRange()` empty result message | `No date range found for :model.` | `model` |
| `messages.successful.empty_filtered_models_list` | `filteredList()` empty result message | `No filtered :model found.` | `model` |
| `messages.successful.empty_models_list` | `list()` empty result message | `No :model found.` | `model` |
| `messages.successful.empty_searched_query_list` | `searchResults()` empty result message | `No search results found for :entity.` | `entity` |
| `messages.successful.empty_values_list` | `valuesList()` empty result message | `No values found for :attribute in :model.` | `attribute`, `model` |
| `messages.successful.external_api_rejected` | External API rejected message if used internally | `External API rejected the request.` | - |
| `messages.successful.filtered_models_list_retrieved` | `filteredList()` | `Filtered :model list retrieved for :attributes.` | `model`, `attributes` |
| `messages.successful.model_found` | `detail()` | `:model found.` | `model` |
| `messages.successful.models_list_retrieved` | `list()` | `:model list retrieved.` | `model` |
| `messages.successful.process_finished` | `processFinished()` | `The :name process finished successfully.` | `name` |
| `messages.successful.processing_accepted` | `processAccepted()` | `The requested :name was accepted and is being processed. You will be notified when the result is ready.` | `name` |
| `messages.successful.searched_query_list_retrieved` | `searchResults()` | `Search results retrieved for :entity.` | `entity` |
| `messages.successful.values_list_retrieved` | `valuesList()` | `:attribute values retrieved for :model.` | `attribute`, `model` |

#### Failed Message Keys

| Key | Used By | Default Message | Placeholders |
| --- | --- | --- | --- |
| `messages.failures.entity_not_found` | `detail()` and other not-found responses | `:entity not found.` | `entity` |
| `messages.failures.errors_in_external_api` | `externalApiRejected()` | `External API rejected the request.` | - |
| `messages.failures.invalid_attributes` | `invalidAttributes()` | `Invalid attributes: :attributes.` | `attributes` |
| `messages.failures.invalid_captcha` | `invalidCaptcha()` | `Invalid captcha.` | - |
| `messages.failures.invalid_inputs` | `invalidInputs()` | `Invalid input.` | - |
| `messages.failures.no_ai_answer` | `aiAnswer()` when no answer exists | `No answer could be found for the provided question.` | - |
| `messages.failures.process_rejected` | `processRejected()` | `The :name process could not be accepted.` | `name` |
| `messages.failures.server_error` | `serverError()` | `Server error.` | - |
| `messages.failures.server_restriction` | `tooManyRequests()` | `Too many requests.` | - |
| `messages.failures.unavailable_external_api` | `externalApiUnavailable()` | `External API is unavailable.` | - |

Example:

```php
<?php

__('bersiv-api-response::messages.successful.model_found', [
    'model' => 'user',
]);

__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
    'model' => 'user',
    'attributes' => 'status, role',
]);

__('bersiv-api-response::messages.successful.values_list_retrieved', [
    'attribute' => 'status',
    'model' => 'user',
]);

__('bersiv-api-response::messages.failures.entity_not_found', [
    'entity' => 'user',
]);

__('bersiv-api-response::messages.failures.invalid_attributes', [
    'attributes' => 'unknown_column, private_field',
]);

__('bersiv-api-response::messages.failures.process_rejected', [
    'name' => 'data import',
]);
```

## Important Naming Notes

### Empty Result Messages

Some keys are named as successful messages but describe empty results:

```php
<?php

__('bersiv-api-response::messages.successful.empty_models_list');
__('bersiv-api-response::messages.successful.empty_filtered_models_list');
__('bersiv-api-response::messages.successful.empty_searched_query_list');
```

These keys are stored under `messages.successful` because the related list-style methods still return `200 OK` when the result is empty.

Keeping them is acceptable if the code already uses them, but the documentation should clearly explain the behavior.

## Why Customize Translations?

You can customize translations when you want to:

- change response messages
- support another language
- adjust wording to your API style
- keep messages consistent with your product

## Recommended Message Style

Use short and clear messages.

Good:

```text
User was found successfully.
```

Avoid very technical messages in public API responses:

```text
Query builder returned empty result set for App\\Models\\User.
```

## Placeholders

Some messages use placeholders.

Example:

```php
<?php

__('bersiv-api-response::messages.successful.model_found', [
    'model' => 'user',
]);
```

The translated message can then include the model name.

Common placeholders:

| Placeholder | Meaning |
| --- | --- |
| `:model` | Model or entity display name, for example `user`. |
| `:entity` | Entity or search target name, for example `location`. |
| `:attribute` | Attribute name, for example `status`. |
| `:attributes` | One or more attributes, for example `status, role`. |
| `:name` | Process name, for example `data import`. |

## Version Control

After publishing translations, the files inside your application belong to the application.

You can commit them if your project needs customized messages.
