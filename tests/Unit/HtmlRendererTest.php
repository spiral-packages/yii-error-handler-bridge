<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Mockery as m;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Testo\Assert;
use Testo\Test;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

#[Test]
final class HtmlRendererTest
{
    public function testRender(): void
    {
        $htmlRenderer = new HtmlRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class),
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content'),
            );

        Assert::same($htmlRenderer->render($exception), 'foo content');
    }

    public function testCanRender(): void
    {
        $renderer = new HtmlRenderer();

        Assert::true($renderer->canRender('html'));
        Assert::true($renderer->canRender('application/html'));
        Assert::true($renderer->canRender('text/html'));
        Assert::false($renderer->canRender('application/json'));
    }
}
