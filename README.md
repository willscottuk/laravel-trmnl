# Develop TRMNL plugins with Laravel

⚠️ This is work in progress and not yet ready for production use. ⚠️

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bnussbau/laravel-trmnl.svg?style=flat-square)](https://packagist.org/packages/bnussbau/laravel-trmnl)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bnussbau/laravel-trmnl/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bnussbau/laravel-trmnl/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bnussbau/laravel-trmnl/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bnussbau/laravel-trmnl/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bnussbau/laravel-trmnl.svg?style=flat-square)](https://packagist.org/packages/bnussbau/laravel-trmnl)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Buy me a coffee
–

## Installation

You can install the package via composer:

```bash
composer require bnussbau/laravel-trmnl
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="trmnl-migrations"
php artisan migrate
```

Optionally, you can publish the config file with:

```bash
php artisan vendor:publish --tag="trmnl-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Plugin Type
    |--------------------------------------------------------------------------
    |
    | Specifies if your TRMNL plugin is public or private; default is private.
    | If set to public, the authentication routes will be exposed.
    | Publish and run migrations to create the necessary tables.
    */
    'plugin_type' => env('TRMNL_PLUGIN_TYPE', 'private'),

    /*
    |--------------------------------------------------------------------------
    | Data Strategy
    |--------------------------------------------------------------------------
    |
    | TRMNL supports two data strategies: polling and webhook.
    | Default is polling.
    | If your plugin type is private, you can set the data strategy to webhook.
    | If you set the data strategy to webhook, you must provide a webhook URL.
    */
    'data_strategy' => env('TRMNL_DATA_STRATEGY', 'polling'),
    'webhook_url' => env('TRMNL_WEBHOOK_URL'),
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="trmnl-views"
```

## Usage

```php
// TODO
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Benjamin Nussbaum](https://github.com/bnussbau)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
