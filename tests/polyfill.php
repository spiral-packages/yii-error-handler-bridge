<?php

declare(strict_types=1);

namespace Spiral\Bootloader\Http;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Http\ErrorHandler;
use Spiral\Http\Middleware\ErrorHandlerMiddleware;

final class ErrorHandlerBootloader extends Bootloader
{
    protected const BINDINGS = [
        ErrorHandlerMiddleware\SuppressErrorsInterface::class => ErrorHandlerMiddleware\EnvSuppressErrors::class,
        ErrorHandler\RendererInterface::class => ErrorHandler\PlainRenderer::class,
    ];
}
