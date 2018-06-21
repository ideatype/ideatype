<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Hydrator;


use Service\Parser\Domain\ValueObject\ParsedFileVO;
use Service\PostManager\Domain\Entity\PostMeta;

class PostMetaHydrator
{
    public static function hydrateFromParsedFile(
        string $postId,
        ParsedFileVO $parsedPost,
        int $date
    ): PostMeta {
        return new PostMeta(
            $postId,
            $parsedPost->getMeta()->getValue(),
            $parsedPost->getValue(),
            $date
        );
    }
}
