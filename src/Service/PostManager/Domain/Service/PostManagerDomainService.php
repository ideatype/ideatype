<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Service;

use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Domain\Query\FetchPostListQuery;
use Service\PostManager\Domain\Query\FetchSinglePostQuery;

class PostManagerDomainService
{
    /** @var FetchPostListQuery */
    private $fetchPostListQuery;

    /** @var FetchSinglePostQuery */
    private $fetchSinglePostQuery;

    public function __construct(
        FetchPostListQuery $fetchPostListQuery,
        FetchSinglePostQuery $fetchSinglePostQuery
    ) {
        $this->fetchPostListQuery = $fetchPostListQuery;
        $this->fetchSinglePostQuery = $fetchSinglePostQuery;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->fetchPostListQuery->execute();
    }

    public function fetchSinglePost(string $postId): Post
    {
        return $this->fetchSinglePostQuery->execute($postId);
    }
}
