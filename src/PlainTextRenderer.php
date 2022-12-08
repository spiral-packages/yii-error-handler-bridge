<?php

namespace Spiral\YiiErrorHandler;

use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class PlainTextRenderer implements ExceptionRendererInterface
{
    public const FORMATS = ['text/plain', 'text', 'plain', 'cli', 'console'];

    public function __construct(
        private ?ThrowableRendererInterface $renderer = null
    ) {
        $this->renderer = $renderer ?? new \Yiisoft\ErrorHandler\Renderer\PlainTextRenderer();
    }

    public function render(
        \Throwable $exception,
        ?Verbosity $verbosity = Verbosity::BASIC,
        string $format = null,
    ): string {
        if ($verbosity >= Verbosity::VERBOSE) {
            return (string)$this->renderer->renderVerbose($exception);
        }

        return (string)$this->renderer->render($exception);
    }

    public function canRender(string $format): bool
    {
        return \in_array($format, self::FORMATS, true);
    }
}
