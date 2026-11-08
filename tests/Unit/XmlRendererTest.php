<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Mockery as m;
use Spiral\YiiErrorHandler\XmlRenderer;
use Testo\Assert;
use Testo\Test;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

#[Test]
final class XmlRendererTest
{
    public function testRender(): void
    {
        $xmlRenderer = new XmlRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class),
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content'),
            );

        Assert::same($xmlRenderer->render($exception), 'foo content');
    }

    public function testCanRender(): void
    {
        $renderer = new XmlRenderer();

        Assert::true($renderer->canRender('application/xml'));
        Assert::true($renderer->canRender('text/xml'));
        Assert::false($renderer->canRender('text/html'));
    }
}
