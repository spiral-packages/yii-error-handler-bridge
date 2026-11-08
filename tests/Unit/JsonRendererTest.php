<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Unit;

use Mockery as m;
use Spiral\YiiErrorHandler\JsonRenderer;
use Testo\Assert;
use Testo\Test;
use Yiisoft\ErrorHandler\ErrorData;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

#[Test]
final class JsonRendererTest
{
    public function testRender(): void
    {
        $jsonRenderer = new JsonRenderer(
            $renderer = m::mock(ThrowableRendererInterface::class),
        );

        $exception = new \ErrorException('Test exception');

        $renderer->shouldReceive('render')
            ->once()
            ->with($exception)
            ->andReturn(
                new ErrorData('foo content'),
            );

        Assert::same($jsonRenderer->render($exception), 'foo content');
    }

    public function testCanRender(): void
    {
        $renderer = new JsonRenderer();

        Assert::true($renderer->canRender('application/json'));
        Assert::true($renderer->canRender('json'));
        Assert::false($renderer->canRender('application/html'));
    }
}
