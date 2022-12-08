# Yii error handler bridge

[![PHP Version Require](https://poser.pugx.org/spiral-packages/yii-error-handler-bridge/require/php)](https://packagist.org/packages/spiral-packages/yii-error-handler-bridge)
[![Latest Stable Version](https://poser.pugx.org/spiral-packages/yii-error-handler-bridge/v/stable)](https://packagist.org/packages/spiral-packages/yii-error-handler-bridge)
[![phpunit](https://github.com/spiral-packages/yii-error-handler-bridge/actions/workflows/phpunit.yml/badge.svg)](https://github.com/spiral-packages/yii-error-handler-bridge/actions)
[![psalm](https://github.com/spiral-packages/yii-error-handler-bridge/actions/workflows/psalm.yml/badge.svg)](https://github.com/spiral-packages/yii-error-handler-bridge/actions)
[![Codecov](https://codecov.io/gh/spiral-packages/yii-error-handler-bridge/branch/master/graph/badge.svg)](https://codecov.io/gh/spiral-packages/yii-error-handler-bridge/)
[![Total Downloads](https://poser.pugx.org/spiral-packages/yii-error-handler-bridge/downloads)](https://packagist.org/spiral-packages/yii-error-handler-bridge/phpunit)
<a href="https://discord.gg/8bZsjYhVVk"><img src="https://img.shields.io/badge/discord-chat-magenta.svg"></a>

## Requirements

Make sure that your server is configured with following PHP version and extensions:

- PHP 8.1+
- Spiral framework 3.0+

## Installation

You can install the package via composer:

```bash
composer require spiral/yii-error-handler-bridge
```

After package install you need to register bootloader from the package.

```php
protected const LOAD = [
    // ...
    \Spiral\YiiErrorHandler\Bootloader\YiiErrorHandlerBootloader::class,
];
```

> Note: if you are using [`spiral-packages/discoverer`](https://github.com/spiral-packages/discoverer),
> you don't need to register bootloader by yourself.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [kastahov](https://github.com/spiral)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
