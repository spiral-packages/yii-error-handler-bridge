<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\PlainTextRenderer;
use Spiral\YiiErrorHandler\Tests\Acceptance\ExceptionFactory;

// Set content type to plain text
\header('Content-Type: text/plain');

// Get verbosity level from query parameter
$verbosityParam = $_GET['verbosity'] ?? 'basic';
$verbosity = match ($verbosityParam) {
    'basic' => Verbosity::BASIC,
    'verbose' => Verbosity::VERBOSE,
    'debug' => Verbosity::DEBUG,
    default => Verbosity::BASIC,
};

// Create a rich test exception
$exception = ExceptionFactory::createException('Complex exception for Plain Text renderer demonstration');

// Create Plain Text renderer
$renderer = new PlainTextRenderer();

// Render and output the exception
echo $renderer->render($exception, $verbosity);
