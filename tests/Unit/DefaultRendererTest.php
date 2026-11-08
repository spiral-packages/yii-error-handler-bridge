<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\XmlRenderer;
use Testo\Assert;
use Testo\Codecov\Covers;
use Testo\Data\DataProvider;
use Testo\Data\DataSet;
use Testo\Skip;
use Testo\Test;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

/**
 * Renderers built without an explicit Yii renderer, as the container creates them.
 */
#[Test]
#[Covers(HtmlRenderer::class)]
#[Covers(JsonRenderer::class)]
#[Covers(PlainTextRenderer::class)]
#[Covers(XmlRenderer::class)]
final class DefaultRendererTest
{
    private const MESSAGE = 'Secret exception message';

    /**
     * @return iterable<non-empty-string, array{class-string<ExceptionRendererInterface>}>
     */
    public static function renderers(): iterable
    {
        yield 'html' => [HtmlRenderer::class];
        yield 'json' => [JsonRenderer::class];
        yield 'plain text' => [PlainTextRenderer::class];
        yield 'xml' => [XmlRenderer::class];
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataProvider('renderers')]
    public function hidesExceptionDetailsInBasicMode(string $class): void
    {
        $output = (new $class())->render(new \RuntimeException(self::MESSAGE), Verbosity::BASIC);

        Assert::string($output)
            ->contains(ThrowableRendererInterface::DEFAULT_ERROR_MESSAGE)
            ->notContains(self::MESSAGE);
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataProvider('renderers')]
    public function exposesExceptionDetailsInVerboseMode(string $class): void
    {
        $output = (new $class())->render(new \RuntimeException(self::MESSAGE), Verbosity::VERBOSE);

        Assert::string($output)->contains(self::MESSAGE);
    }

    /**
     * The verbose page is the package's own template: it inlines the stylesheet next to it.
     */
    public function htmlVerboseUsesPackageTemplate(): void
    {
        $output = (new HtmlRenderer())->render(new \RuntimeException(self::MESSAGE), Verbosity::VERBOSE);

        Assert::string($output)->contains(\file_get_contents(\dirname(__DIR__, 2) . '/templates/development.css'));
    }

    public function htmlFallsBackToDefaultRendererOnNull(): void
    {
        $output = (new HtmlRenderer(null))->render(new \RuntimeException(self::MESSAGE));

        Assert::string($output)->contains(ThrowableRendererInterface::DEFAULT_ERROR_MESSAGE);
    }

    /**
     * The constructors accept null, but only HtmlRenderer replaces it with a default renderer;
     * the others store null and fail on the first render.
     *
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[Skip('Bug: an explicit null renderer is stored as is, so render() calls a method on null')]
    #[DataSet([JsonRenderer::class], 'json')]
    #[DataSet([PlainTextRenderer::class], 'plain text')]
    #[DataSet([XmlRenderer::class], 'xml')]
    public function fallsBackToDefaultRendererOnNull(string $class): void
    {
        $output = (new $class(null))->render(new \RuntimeException(self::MESSAGE));

        Assert::string($output)->contains(ThrowableRendererInterface::DEFAULT_ERROR_MESSAGE);
    }
}
