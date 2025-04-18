<?php

declare(strict_types=1);

// Simple router for our demo application
$uri = $_SERVER['REQUEST_URI'];

// Strip query string
if (($pos = \strpos($uri, '?')) !== false) {
    $uri = \substr($uri, 0, $pos);
}

// Default to index.php for the root path
if ($uri === '/') {
    require __DIR__ . '/index.php';
    return true;
}

// Map routes to their respective files
$routes = [
    '/html-exception' => __DIR__ . '/html-exception.php',
    '/json-exception' => __DIR__ . '/json-exception.php',
    '/plain-exception' => __DIR__ . '/plain-exception.php',
    '/xml-exception' => __DIR__ . '/xml-exception.php',
];

// Check if the route exists and require the file
if (isset($routes[$uri])) {
    require $routes[$uri];
    return true;
}

// Return 404 if the route is not found
\http_response_code(404);
echo "404 Not Found: {$uri}";
