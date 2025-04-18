<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\JsonRenderer;
use Spiral\YiiErrorHandler\Tests\Acceptance\ExceptionFactory;

// Set content type to JSON
\header('Content-Type: application/json');

// Get verbosity level from query parameter
$verbosityParam = $_GET['verbosity'] ?? 'basic';
$verbosity = match ($verbosityParam) {
    'basic' => Verbosity::BASIC,
    'verbose' => Verbosity::VERBOSE,
    'debug' => Verbosity::DEBUG,
    default => Verbosity::BASIC,
};

// Create a rich test exception
$exception = ExceptionFactory::createException('Complex exception for JSON renderer demonstration');

// Create JSON renderer
$renderer = new JsonRenderer();

// Render and output the exception
echo $renderer->render($exception, $verbosity);
