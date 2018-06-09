<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Service;

use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Query\FetchPostListQuery;

class PostManagerDomainService
{
    /** @var FetchPostListQuery */
    private $fetchPostListQuery;

    public function __construct(
        FetchPostListQuery $fetchPostListQuery
    ) {
        $this->fetchPostListQuery = $fetchPostListQuery;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->fetchPostListQuery->execute();
    }
}
