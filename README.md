# Laravel TRMNL - Develop TRMNL plugins with Laravel

⚠️ This is work in progress and not yet ready for production use. ⚠️

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bnussbau/laravel-trmnl.svg?style=flat-square)](https://packagist.org/packages/bnussbau/laravel-trmnl)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bnussbau/laravel-trmnl/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bnussbau/laravel-trmnl/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bnussbau/laravel-trmnl/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bnussbau/laravel-trmnl/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bnussbau/laravel-trmnl.svg?style=flat-square)](https://packagist.org/packages/bnussbau/laravel-trmnl)

Laravel TRMNL is a package that offers both public and private plugin capabilities with support for real-time updates through webhooks or polling strategies. For public plugins it features support for OAuth integration. UI Prototyping is easy by using the provided Blade components.

## Support ❤️
Support the development of this package by using referral link [https://usetrmnl.com/?ref=laravel-trmnl](https://usetrmnl.com/?ref=laravel-trmnl) when buying a TRMNL device. 
Using code `laravel-trmnl` in checkout, gets you a **discount** of $15.

## Features


- 🔌 Public and private plugin support [(docs)](https://help.usetrmnl.com/en/articles/10122094-plugin-recipes), [(docs)](https://docs.usetrmnl.com/go/plugin-marketplace/introduction)
- 🔄 Support for updates via webhooks or polling [(docs)](https://help.usetrmnl.com/en/articles/9510536-private-plugins)
- 🎨 Blade Components on top of the TRMNL Design System [(docs)](https://usetrmnl.com/framework)
- 🎯 OAuth integration support for public plugins [(docs)](https://docs.usetrmnl.com/go/plugin-marketplace/plugin-installation-flow)
- 📱 Helpers for Responsive layouts

## Installation

You can install the package via composer:

```bash
composer require bnussbau/laravel-trmnl
```

```bash
#before release
composer require bnussbau/laravel-trmnl:^0.1.0-alpha
```

If developing a public plugin with OAuth support, publish and run the migrations with:

```bash
php artisan vendor:publish --tag="trmnl-migrations"
php artisan migrate
```

Optionally, you can publish the config file with:

```bash
php artisan vendor:publish --tag="trmnl-config"
```

This are the contents of the published config file:
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

## Configuration

### Default Environment Variables

The package can be configured through environment variables:

```env
TRMNL_PLUGIN_TYPE=              # private | public
TRMNL_DATA_STRATEGY=            # polling | webhook
TRMNL_WEBHOOK_URL=              # grab from TRMNL Dashboard
TRMNL_OAUTH_CLIENT_ID=          # grab from TRMNL Dashboard
TRMNL_OAUTH_CLIENT_SECRET=      # grab from TRMNL Dashboard
```

## Usage

### Data Updates

For webhook-based updates:

```php
use Bnussbau\LaravelTrmnl\Jobs\UpdateScreenContentJob;

// Dispatch update to TRMNL
UpdateScreenContentJob::dispatch([
    'key' => 'value',
    // ... other variables
]);
```

## Blade Components
- [see TRMNL Design System](https://usetrmnl.com/framework)
- [resources/views/components](resources/views/components)

Blade Compontens can help you generate markup code. Alternatively you can just use the native CSS classes from the TRMNL Design System.

### Usage

### Basic Layout

```blade
<x-trmnl::view>
    <x-trmnl::layout class="gap--large">
        <x-trmnl::columns>
            <!-- Your content here -->
        </x-trmnl::columns>
    </x-trmnl::layout>
    <x-trmnl::title-bar/>
</x-trmnl::view>
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
