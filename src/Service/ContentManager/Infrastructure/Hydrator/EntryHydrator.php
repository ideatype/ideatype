<?php
declare(strict_types=1);

namespace Service\ContentManager\Infrastructure\Hydrator;


use Service\Parser\Domain\ValueObject\ParsedContentFileVO;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\ValueObject\EntryContentVO;

class EntryHydrator
{
    public static function hydrate(
        string $postId,
        ParsedContentFileVO $parsedPost,
        int $date
    ): Entry {
        $postMeta = EntryMetaHydrator::hydrateFromParsedFile(
            $postId,
            $parsedPost,
            $date
        );
        return new Entry(
            $postMeta,
            new EntryContentVO($parsedPost->getValue())
        );
    }
}
