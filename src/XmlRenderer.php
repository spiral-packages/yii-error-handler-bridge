<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler;

use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Yiisoft\ErrorHandler\Renderer\XmlRenderer as YiiXmlRenderer;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class XmlRenderer implements ExceptionRendererInterface
{
    public const FORMATS = ['application/xml', 'text/xml'];

    private readonly ThrowableRendererInterface $renderer;

    public function __construct(
        ?ThrowableRendererInterface $renderer = new YiiXmlRenderer(),
    ) {
        $this->renderer = $renderer ?? new YiiXmlRenderer();
    }

    #[\Override]
    public function render(
        \Throwable $exception,
        ?Verbosity $verbosity = Verbosity::BASIC,
        ?string $format = null,
    ): string {
        if ($verbosity?->value >= Verbosity::VERBOSE->value) {
            return (string) $this->renderer->renderVerbose($exception);
        }

        return (string) $this->renderer->render($exception);
    }

    #[\Override]
    public function canRender(string $format): bool
    {
        return \in_array($format, self::FORMATS, true);
    }
}
