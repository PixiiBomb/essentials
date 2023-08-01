<?php

use PixiiBomb\Essentials\Models;

class Errors
{
    const INVALID_COMPONENT = 'invalid-component';

    public static function oops(string $code, string $fileName)
    {
        throw match ($code) {
            self::INVALID_COMPONENT =>
                new InvalidArgumentException("The \$object variable is not set in the blade file {$fileName}"),
            default => new InvalidArgumentException("Unknown error code: {$code}"),
        };
    }
}
