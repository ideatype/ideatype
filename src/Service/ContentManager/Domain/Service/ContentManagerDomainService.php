<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Service;

use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Query\FetchPageQuery;
use Service\ContentManager\Domain\Query\FetchPostListQuery;
use Service\ContentManager\Domain\Query\FetchSinglePostQuery;

class ContentManagerDomainService
{
    /** @var FetchPostListQuery */
    private $fetchPostListQuery;

    /** @var FetchSinglePostQuery */
    private $fetchSinglePostQuery;

    /** @var FetchPageQuery */
    private $fetchPageQuery;

    public function __construct(
        FetchPostListQuery $fetchPostListQuery,
        FetchSinglePostQuery $fetchSinglePostQuery,
        FetchPageQuery $fetchPageQuery
    ) {
        $this->fetchPostListQuery = $fetchPostListQuery;
        $this->fetchSinglePostQuery = $fetchSinglePostQuery;
        $this->fetchPageQuery = $fetchPageQuery;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->fetchPostListQuery->execute();
    }

    public function fetchSinglePost(string $postId): Entry
    {
        return $this->fetchSinglePostQuery->execute($postId);
    }

    public function fetchPage(string $pageId): Entry
    {
        return $this->fetchPageQuery->execute($pageId);
    }
}
