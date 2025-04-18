<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\HtmlRenderer;
use Spiral\YiiErrorHandler\Tests\Acceptance\ExceptionFactory;

// Set content type to HTML
\header('Content-Type: text/html');

// Get verbosity level from query parameter
$verbosityParam = $_GET['verbosity'] ?? 'basic';
$verbosity = match ($verbosityParam) {
    'basic' => Verbosity::BASIC,
    'verbose' => Verbosity::VERBOSE,
    'debug' => Verbosity::DEBUG,
    default => Verbosity::BASIC,
};

// Create a rich test exception
$exception = ExceptionFactory::createException('Complex exception for HTML renderer demonstration');

// Create HTML renderer
$renderer = new HtmlRenderer();

// Render and output the exception
echo $renderer->render($exception, $verbosity);
