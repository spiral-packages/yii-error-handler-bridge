<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit\Bootloader;

use Spiral\Core\Container;
use Spiral\Exceptions\ExceptionHandler;
use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\Bootloader\YiiErrorHandlerBootloader;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\XmlRenderer;
use Testo\Assert;
use Testo\Codecov\Covers;
use Testo\Data\DataProvider;
use Testo\Test;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

#[Test]
#[Covers(YiiErrorHandlerBootloader::class)]
final class YiiErrorHandlerBootloaderTest
{
    /**
     * @return iterable<non-empty-string, array{non-empty-string, class-string<ExceptionRendererInterface>}>
     */
    public static function formats(): iterable
    {
        yield 'html' => ['html', HtmlRenderer::class];
        yield 'application/html' => ['application/html', HtmlRenderer::class];
        yield 'text/html' => ['text/html', HtmlRenderer::class];
        yield 'application/json' => ['application/json', JsonRenderer::class];
        yield 'json' => ['json', JsonRenderer::class];
        yield 'text/plain' => ['text/plain', PlainTextRenderer::class];
        yield 'text' => ['text', PlainTextRenderer::class];
        yield 'plain' => ['plain', PlainTextRenderer::class];
        yield 'application/xml' => ['application/xml', XmlRenderer::class];
        yield 'text/xml' => ['text/xml', XmlRenderer::class];
    }

    /**
     * @param class-string<ExceptionRendererInterface> $renderer
     */
    #[DataProvider('formats')]
    public function registersRendererForFormat(string $format, string $renderer): void
    {
        $handler = self::bootHandler();

        Assert::instanceOf($handler->getRenderer($format), $renderer);
    }

    public function handlerRendersThroughRegisteredRenderer(): void
    {
        $handler = self::bootHandler();

        $output = $handler->render(new \RuntimeException('Secret'), Verbosity::BASIC, 'application/json');

        Assert::same($output, \json_encode(['message' => ThrowableRendererInterface::DEFAULT_ERROR_MESSAGE]));
    }

    /**
     * Boots through the container, so the renderers are autowired the way an application gets them.
     */
    private static function bootHandler(): ExceptionHandler
    {
        $handler = new ExceptionHandler();
        $container = new Container();
        $container->bindSingleton(ExceptionHandler::class, $handler);

        $container->invoke([new YiiErrorHandlerBootloader(), 'boot']);

        return $handler;
    }
}
