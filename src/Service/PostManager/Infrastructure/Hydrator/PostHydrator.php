<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Hydrator;


use Service\Parser\Domain\ValueObject\ParsedContentFileVO;
use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Domain\ValueObject\PostContentVO;

class PostHydrator
{
    public static function hydrate(
        string $postId,
        ParsedContentFileVO $parsedPost,
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
