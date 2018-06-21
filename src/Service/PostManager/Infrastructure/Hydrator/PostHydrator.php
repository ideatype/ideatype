<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Hydrator;


use Service\Parser\Domain\ValueObject\ParsedFileVO;
use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Domain\ValueObject\PostContentVO;

class PostHydrator
{
    public static function hydrate(
        string $postId,
        ParsedFileVO $parsedPost,
        int $date
    ): Post {
        $postMeta = PostMetaHydrator::hydrateFromParsedFile(
            $postId,
            $parsedPost,
            $date
        );
        return new Post(
            $postMeta,
            new PostContentVO($parsedPost->getValue())
        );
    }
}
