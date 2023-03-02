<?php

namespace Spiral\YiiErrorHandler\Tests;

use Spiral\YiiErrorHandler\HtmlRenderer;
use Mockery as m;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class PlainTextRendererTest extends TestCase
{
    public function testRender(): void
    {
        $plainTextRenderer = new PlainTextRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class)
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content')
            );

        $this->assertSame('foo content', $plainTextRenderer->render($exception));
    }

    public function testCanRender(): void
    {
        $renderer = new PlainTextRenderer();

        $this->assertTrue($renderer->canRender('text/plain'));
        $this->assertTrue($renderer->canRender('text'));
        $this->assertTrue($renderer->canRender('plain'));
        $this->assertFalse($renderer->canRender('text/html'));
    }
}
