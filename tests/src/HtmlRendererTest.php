<?php

namespace Spiral\YiiErrorHandler\Tests;

use Spiral\YiiErrorHandler\HtmlRenderer;
use Mockery as m;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class HtmlRendererTest extends TestCase
{
    public function testRender(): void
    {
        $htmlRenderer = new HtmlRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class)
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content')
            );

        $this->assertSame('foo content', $htmlRenderer->render($exception));
    }

    public function testCanRender(): void
    {
        $renderer = new HtmlRenderer();

        $this->assertTrue($renderer->canRender('html'));
        $this->assertTrue($renderer->canRender('application/html'));
        $this->assertTrue($renderer->canRender('text/html'));
    }
}
