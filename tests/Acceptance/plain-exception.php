<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\PlainTextRenderer;

// Create a test exception
$exception = new RuntimeException('This is a test exception for Plain Text renderer', 500);

// Create nested exception for better demonstration
try {
    try {
        throw new InvalidArgumentException('Invalid argument provided', 400);
    } catch (InvalidArgumentException $e) {
        throw new RuntimeException('Failed to process request: ' . $e->getMessage(), 500, $e);
    }
} catch (RuntimeException $e) {
    $exception = $e;
}

// Set content type to plain text
header('Content-Type: text/plain');

// Get verbosity level from query parameter
$verbosityParam = $_GET['verbosity'] ?? 'basic';
$verbosity = match ($verbosityParam) {
    'basic' => Verbosity::BASIC,
    'verbose' => Verbosity::VERBOSE,
    'debug' => Verbosity::DEBUG,
    default => Verbosity::BASIC,
};

// Create Plain Text renderer
$renderer = new PlainTextRenderer();

// Render and output the exception
echo $renderer->render($exception, $verbosity);
