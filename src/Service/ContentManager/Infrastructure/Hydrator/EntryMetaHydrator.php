<?php
declare(strict_types=1);

namespace Service\ContentManager\Infrastructure\Hydrator;


use Service\Parser\Domain\ValueObject\ParsedContentFileVO;
use Service\ContentManager\Domain\Entity\EntryMeta;

class EntryMetaHydrator
{
    public static function hydrateFromParsedFile(
        string $postId,
        ParsedContentFileVO $parsedPost,
        int $date
    ): EntryMeta {
        return new EntryMeta(
            $postId,
            $parsedPost->getMeta()->getValue(),
            $parsedPost->getValue(),
            $date
        );
    }
}
