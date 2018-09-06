<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Exception;

use RuntimeException;
use SharedLibrary\Exception\ExceptionCode;

class PageDoesNotExistException extends RuntimeException
{
    public static function forPageId(string $pageId): self
    {
        return new self(
            sprintf(
                "Page %s does not exist",
                $pageId
            ),
            ExceptionCode::ENTRY_DOES_NOT_EXIST
        );
    }
}
