<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Definition;

use Service\PostManager\Domain\Collection\PostMetaCollection;

interface PostReaderRepositoryInterface
{
    public function fetchPostList(): PostMetaCollection;
}
