<?php

namespace Spiral\YiiErrorHandler;

use Spiral\Boot\Environment\DebugMode;
use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Yiisoft\ErrorHandler\Renderer\HtmlRenderer as YiiHtmlRenderer;

final class HtmlRenderer implements ExceptionRendererInterface
{
    public function __construct(
        private readonly YiiHtmlRenderer $renderer,
        private readonly DebugMode $debugMode
    ) {
    }

    public function render(
        \Throwable $exception,
        ?Verbosity $verbosity = Verbosity::BASIC,
        string $format = null,
    ): string {
        if ($this->debugMode->isEnabled()) {
            return (string)$this->renderer->renderVerbose($exception);
        }

        return (string)$this->renderer->render($exception);
    }

    public function canRender(string $format): bool
    {
        return \in_array($format, ['html', 'application/html', 'text/html'], true);
    }
}
