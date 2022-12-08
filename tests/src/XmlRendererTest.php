<?php

namespace Spiral\YiiErrorHandler\Tests;

use Spiral\YiiErrorHandler\HtmlRenderer;
use Mockery as m;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\XmlRenderer;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class XmlRendererTest extends TestCase
{
    public function testRender(): void
    {
        $xmlRenderer = new XmlRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class)
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content')
            );

        $this->assertSame('foo content', $xmlRenderer->render($exception));
    }

    public function testCanRender(): void
    {
        $renderer = new XmlRenderer();

        $this->assertTrue($renderer->canRender('application/xml'));
        $this->assertTrue($renderer->canRender('text/xml'));
    }
}
