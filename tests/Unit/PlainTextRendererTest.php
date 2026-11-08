<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Mockery as m;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Testo\Assert;
use Testo\Test;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

#[Test]
final class PlainTextRendererTest
{
    public function testRender(): void
    {
        $plainTextRenderer = new PlainTextRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class),
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content'),
            );

        Assert::same($plainTextRenderer->render($exception), 'foo content');
    }

    public function testCanRender(): void
    {
        $renderer = new PlainTextRenderer();

        Assert::true($renderer->canRender('text/plain'));
        Assert::true($renderer->canRender('text'));
        Assert::true($renderer->canRender('plain'));
        Assert::false($renderer->canRender('text/html'));
    }
}
