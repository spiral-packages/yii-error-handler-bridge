<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Exceptions\ExceptionHandler;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\Bootloader\Http\ErrorHandlerBootloader;

class YiiErrorHandlerBootloader extends Bootloader
{
    public const DEPENDENCIES = [
        ErrorHandlerBootloader::class,
    ];

    public function boot(ExceptionHandler $handler, HtmlRenderer $renderer): void
    {
        $handler->addRenderer($renderer);
    }
}
