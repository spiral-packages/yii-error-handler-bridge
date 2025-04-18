<?php

declare(strict_types=1);

namespace Spiral\YiiErrorHandler\Tests\Acceptance;

/**
 * Factory for creating rich test exceptions with deep stack traces
 * and multiple previous exceptions.
 */
final class ExceptionFactory
{
    /**
     * Creates a complex exception with nested previous exceptions and a deep stack trace.
     */
    public static function createException(string $message = 'Main exception'): \Throwable
    {
        try {
            self::levelOne();
            return new \RuntimeException('This should never be reached');
        } catch (\Throwable $e) {
            return new \RuntimeException($message, 500, $e);
        }
    }

    /**
     * First level of the call stack.
     */
    private static function levelOne(): void
    {
        try {
            self::levelTwo();
        } catch (\Throwable $e) {
            throw new \LogicException('Error in business logic processing', 400, $e);
        }
    }

    /**
     * Second level of the call stack.
     */
    private static function levelTwo(): void
    {
        try {
            self::levelThree();
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException('Invalid configuration parameter', 400, $e);
        }
    }

    /**
     * Third level of the call stack with database-like error.
     */
    private static function levelThree(): void
    {
        try {
            try {
                0 / 0;
            } catch (\Throwable $e) {
                // Database-related error
                throw new \RuntimeException('Database connection failed: Authentication error', 1045, $e);
            }
        } catch (\RuntimeException $dbError) {
            // Model-level error
            throw new \DomainException('Unable to retrieve user record', 404, $dbError);
        }
    }
}
