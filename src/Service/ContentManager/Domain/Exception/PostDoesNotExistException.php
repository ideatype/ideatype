<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Exception;

use RuntimeException;
use SharedLibrary\Exception\ExceptionCode;

class PostDoesNotExistException extends RuntimeException
{
    public static function forPostId(string $postId): self
    {
        return new self(
            sprintf(
                "Post %s does not exist",
                $postId
            ),
            ExceptionCode::ENTRY_DOES_NOT_EXIST
        );
    }
}
