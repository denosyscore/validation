# denosyscore/validation

Validation engine and rules

## Status

Initial extraction snapshot from denosyscore monorepo as of 2026-02-14.

## Installation

composer require denosyscore/validation

## Included Modules

- src/Validation/*

## Direct field errors

When a field-specific failure is discovered after ordinary rule validation,
raise it without constructing an empty validator in the caller:

```php
throw \Denosys\Validation\ValidationException::withMessages([
    'email' => 'The email address is unavailable.',
]);
```

Values may be a string or a non-empty list of strings. The existing
`ValidationException(Validator $validator)` constructor remains supported.

## Development

composer validate --strict
find src tests -type f -name '*.php' -print0 | xargs -0 -n1 php -l
composer test

## CI Workflows

- CI: Composer validation, PHP syntax lint, and regression tests on supported
  PHP versions for push and pull requests.
- Release: GitHub release publication on semantic version tags.
- Dependabot: weekly Composer dependency update checks.
