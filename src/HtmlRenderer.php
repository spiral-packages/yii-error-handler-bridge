<?php

namespace Spiral\YiiErrorHandler;

use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Yiisoft\ErrorHandler\Renderer\HtmlRenderer as YiiHtmlRenderer;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class HtmlRenderer implements ExceptionRendererInterface
{
    public const FORMATS = ['html', 'application/html', 'text/html'];
    private readonly ThrowableRendererInterface $renderer;

    public function __construct(
        ?ThrowableRendererInterface $renderer = null,
    ) {
        $this->renderer = $renderer ?? new YiiHtmlRenderer(
            settings: [
                'verboseTemplate' => dirname(__DIR__) . '/templates/development.php',
            ]
        );
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
