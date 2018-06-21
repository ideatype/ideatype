<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Definition;

use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Entity\Post;

interface PostReaderRepositoryInterface
{
    public function fetchPostList(): PostMetaCollection;
    public function fetchSinglePost(string $postId): Post;
}
