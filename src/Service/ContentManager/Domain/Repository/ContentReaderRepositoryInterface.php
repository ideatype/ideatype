<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Repository;

use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;

interface ContentReaderRepositoryInterface
{
    public function fetchPostList(): PostMetaCollection;
    public function fetchSinglePost(string $postId): Entry;
    public function fetchPage(string $pageId): Entry;
}
