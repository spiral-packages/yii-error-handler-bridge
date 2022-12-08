<?php

namespace Spiral\YiiErrorHandler\Tests;

use Spiral\YiiErrorHandler\HtmlRenderer;
use Mockery as m;
use Spiral\YiiErrorHandler\JsonRenderer;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class JsonRendererTest extends TestCase
{
    public function testRender(): void
    {
        $jsonRenderer = new JsonRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class)
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content')
            );

        $this->assertSame('foo content', $jsonRenderer->render($exception));
    }

    public function testCanRender(): void
    {
        $renderer = new JsonRenderer(
            m::mock(ThrowableRendererInterface::class)
        );

        $this->assertTrue($renderer->canRender('application/json'));
        $this->assertTrue($renderer->canRender('json'));
    }
}
