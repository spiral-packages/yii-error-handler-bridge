<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Exceptions\ExceptionHandler;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\Bootloader\Http\ErrorHandlerBootloader;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\XmlRenderer;

class YiiErrorHandlerBootloader extends Bootloader
{
    public const DEPENDENCIES = [
        ErrorHandlerBootloader::class,
    ];

    public function boot(
        ExceptionHandler $handler,
        HtmlRenderer $htmlRenderer,
        PlainTextRenderer $plainTextRenderer,
        JsonRenderer $jsonRenderer,
        XmlRenderer $xmlRenderer
    ): void {
        $handler->addRenderer($htmlRenderer);
        $handler->addRenderer($plainTextRenderer);
        $handler->addRenderer($jsonRenderer);
        $handler->addRenderer($xmlRenderer);
    }
}
