<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Mockery as m;
use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\XmlRenderer;
use Testo\Assert;
use Testo\Codecov\Covers;
use Testo\Data\DataCross;
use Testo\Data\DataProvider;
use Testo\Data\DataSet;
use Testo\Data\DataUnion;
use Testo\Test;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

/**
 * The contract shared by all four renderers: the Spiral verbosity picks the Yii rendering mode,
 * and the format list decides which requests a renderer accepts.
 */
#[Test]
#[Covers(HtmlRenderer::class)]
#[Covers(JsonRenderer::class)]
#[Covers(PlainTextRenderer::class)]
#[Covers(XmlRenderer::class)]
final class RendererTest
{
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
     * @return iterable<non-empty-string, array{class-string<ExceptionRendererInterface>, non-empty-string}>
     */
    public static function supportedFormats(): iterable
    {
        yield 'html: html' => [HtmlRenderer::class, 'html'];
        yield 'html: application/html' => [HtmlRenderer::class, 'application/html'];
        yield 'html: text/html' => [HtmlRenderer::class, 'text/html'];
        yield 'json: application/json' => [JsonRenderer::class, 'application/json'];
        yield 'json: json' => [JsonRenderer::class, 'json'];
        yield 'plain text: text/plain' => [PlainTextRenderer::class, 'text/plain'];
        yield 'plain text: text' => [PlainTextRenderer::class, 'text'];
        yield 'plain text: plain' => [PlainTextRenderer::class, 'plain'];
        yield 'xml: application/xml' => [XmlRenderer::class, 'application/xml'];
        yield 'xml: text/xml' => [XmlRenderer::class, 'text/xml'];
    }

    /**
     * @return iterable<non-empty-string, array{class-string<ExceptionRendererInterface>, string}>
     */
    public static function unsupportedFormats(): iterable
    {
        yield 'html: application/json' => [HtmlRenderer::class, 'application/json'];
        yield 'html: TEXT/HTML' => [HtmlRenderer::class, 'TEXT/HTML'];
        yield 'json: application/html' => [JsonRenderer::class, 'application/html'];
        yield 'json: application/problem+json' => [JsonRenderer::class, 'application/problem+json'];
        yield 'plain text: text/html' => [PlainTextRenderer::class, 'text/html'];
        yield 'plain text: empty' => [PlainTextRenderer::class, ''];
        yield 'xml: text/html' => [XmlRenderer::class, 'text/html'];
        yield 'xml: xml' => [XmlRenderer::class, 'xml'];
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataProvider('renderers')]
    public function rendersBasicByDefault(string $class): void
    {
        $exception = new \ErrorException('Test exception');
        $yiiRenderer = m::mock(ThrowableRendererInterface::class);
        $yiiRenderer->shouldReceive('render')->once()->with($exception)->andReturn(new ErrorData('foo content'));
        $yiiRenderer->shouldReceive('renderVerbose')->never();

        $output = (new $class($yiiRenderer))->render($exception);

        Assert::same($output, 'foo content');
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataCross(
        new DataProvider('renderers'),
        new DataUnion(
            new DataSet([Verbosity::BASIC], 'basic'),
            new DataSet([null], 'no verbosity'),
        ),
    )]
    public function rendersBasicBelowVerbose(string $class, ?Verbosity $verbosity): void
    {
        $exception = new \ErrorException('Test exception');
        $yiiRenderer = m::mock(ThrowableRendererInterface::class);
        $yiiRenderer->shouldReceive('render')->once()->with($exception)->andReturn(new ErrorData('basic content'));
        $yiiRenderer->shouldReceive('renderVerbose')->never();

        // Reading `->value` on a null verbosity only warns, so the warning is the failure signal.
        \set_error_handler(
            static fn(int $severity, string $message): never => throw new \ErrorException($message, 0, $severity),
        );
        try {
            $output = (new $class($yiiRenderer))->render($exception, $verbosity);
        } finally {
            \restore_error_handler();
        }

        Assert::same($output, 'basic content');
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataCross(
        new DataProvider('renderers'),
        new DataUnion(
            new DataSet([Verbosity::VERBOSE], 'verbose'),
            new DataSet([Verbosity::DEBUG], 'debug'),
        ),
    )]
    public function rendersVerboseFromVerbose(string $class, Verbosity $verbosity): void
    {
        $exception = new \ErrorException('Test exception');
        $yiiRenderer = m::mock(ThrowableRendererInterface::class);
        $yiiRenderer->shouldReceive('renderVerbose')->once()->with($exception)
            ->andReturn(new ErrorData('verbose content'));
        $yiiRenderer->shouldReceive('render')->never();

        $output = (new $class($yiiRenderer))->render($exception, $verbosity);

        Assert::same($output, 'verbose content');
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataProvider('supportedFormats')]
    public function acceptsSupportedFormat(string $class, string $format): void
    {
        Assert::true((new $class())->canRender($format));
    }

    /**
     * @param class-string<ExceptionRendererInterface> $class
     */
    #[DataProvider('unsupportedFormats')]
    public function rejectsUnsupportedFormat(string $class, string $format): void
    {
        Assert::false((new $class())->canRender($format));
    }
}
