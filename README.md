<p align="center">
    <a href="https://spiral.dev"><img alt="Spiral Framework" src="https://user-images.githubusercontent.com/773481/228578125-8e0ad713-905f-4450-a473-5839bd650472.png" style="width: 6in; display: block"></a>
</p>

<p align="center">Yii error renderers for Spiral Framework</p>

<div align="center">

[![Documentation](https://img.shields.io/badge/Documentation-blue?style=for-the-badge&logo=gitbook&logoColor=white)](https://spiral.dev/docs/basics-errors#yii-error-renderer)
[![Sponsor](https://img.shields.io/static/v1?style=for-the-badge&label=&message=Sponsor&logo=githubsponsors&logoColor=white&color=%23EA4AAA)](https://github.com/sponsors/spiral)

[![Psalm Level](https://shepherd.dev/github/spiral-packages/yii-error-handler-bridge/level.svg)](https://shepherd.dev/github/spiral-packages/yii-error-handler-bridge)
[![Type Coverage](https://shepherd.dev/github/spiral-packages/yii-error-handler-bridge/coverage.svg)](https://shepherd.dev/github/spiral-packages/yii-error-handler-bridge)
[![Codecov](https://codecov.io/gh/spiral-packages/yii-error-handler-bridge/branch/1.x/graph/badge.svg)](https://codecov.io/gh/spiral-packages/yii-error-handler-bridge)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fspiral-packages%2Fyii-error-handler-bridge%2F1.x)](https://dashboard.stryker-mutator.io/reports/github.com/spiral-packages/yii-error-handler-bridge/1.x)

</div>

<br />

This package plugs the [yiisoft/error-handler](https://github.com/yiisoft/error-handler) renderers into the Spiral
exception handler, so exceptions are rendered as HTML, JSON, XML or plain text depending on the requested format
and verbosity level.

## Get Started

### Installation

```bash
composer require spiral-packages/yii-error-handler-bridge
```

[![PHP](https://img.shields.io/packagist/php-v/spiral-packages/yii-error-handler-bridge.svg?style=flat-square&logo=php)](https://packagist.org/packages/spiral-packages/yii-error-handler-bridge)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/spiral-packages/yii-error-handler-bridge.svg?style=flat-square&logo=packagist)](https://packagist.org/packages/spiral-packages/yii-error-handler-bridge)
[![License](https://img.shields.io/packagist/l/spiral-packages/yii-error-handler-bridge.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/spiral-packages/yii-error-handler-bridge.svg?style=flat-square)](https://packagist.org/packages/spiral-packages/yii-error-handler-bridge/stats)

Requirements: PHP 8.2+ and Spiral Framework 3.15+.

### Configuration

Register the bootloader in your application kernel:

```php
public function defineBootloaders(): array
{
    return [
        // ...
        \Spiral\YiiErrorHandler\Bootloader\YiiErrorHandlerBootloader::class,
        // ...
    ];
}
```

See the [documentation](https://spiral.dev/docs/basics-errors#yii-error-renderer) for details on renderers and
verbosity levels.

## Acceptance Test Sandbox

This package includes an acceptance test sandbox that demonstrates how the different error renderers work with various verbosity levels. The sandbox provides a simple web interface to visualize errors rendered in HTML, JSON, XML, and Plain Text formats.

### Running the Sandbox

You can run the sandbox using Composer:

```bash
composer sandbox
```

Or manually start the PHP built-in web server from the project root:

```bash
php -S localhost:8000 tests/Acceptance/server.php
```

Then open your browser and navigate to `http://localhost:8000`

The interface allows you to select different renderer types (HTML, JSON, Plain Text, XML) and verbosity levels (Basic, Verbose, Debug) to see how exceptions are presented in each format.

This sandbox is useful for testing and understanding how the error renderers work in different scenarios without needing to integrate them into a full application.
