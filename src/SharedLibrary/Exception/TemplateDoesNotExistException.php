<?php
declare(strict_types=1);

namespace SharedLibrary\Exception;

use RuntimeException;

class TemplateDoesNotExistException extends RuntimeException
{
    public static function forTemplate(string $name): self
    {
        return new self(sprintf("Template %s does not exist", $name));
    }
}
