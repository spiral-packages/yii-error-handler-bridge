<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Spiral\Exceptions\Verbosity;
use Spiral\YiiErrorHandler\XmlRenderer;
use Spiral\YiiErrorHandler\Tests\Acceptance\ExceptionFactory;

// Set content type to XML
\header('Content-Type: application/xml');

// Get verbosity level from query parameter
$verbosityParam = $_GET['verbosity'] ?? 'basic';
$verbosity = match ($verbosityParam) {
    'basic' => Verbosity::BASIC,
    'verbose' => Verbosity::VERBOSE,
    'debug' => Verbosity::DEBUG,
    default => Verbosity::BASIC,
};

// Create a rich test exception
$exception = ExceptionFactory::createException('Complex exception for XML renderer demonstration');

// Create XML renderer
$renderer = new XmlRenderer();

// Render and output the exception
echo $renderer->render($exception, $verbosity);
