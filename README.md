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

## Documentation, Installation, and Usage Instructions

See the [documentation](https://spiral.dev/docs/basics-errors#yii-error-renderer) for detailed installation and usage instructions.

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

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
