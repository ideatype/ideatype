<?php
declare(strict_types=1);

namespace SharedLibrary\Exception;

use RuntimeException;

class ContentTypeIsInvalidException extends RuntimeException
{
    public static function forType(string $name): self
    {
        return new self(sprintf("Content type %s is invalid", $name));
    }
}
