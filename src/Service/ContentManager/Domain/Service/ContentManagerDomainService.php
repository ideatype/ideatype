<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Service;

use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Query\FetchFileForPageQuery;
use Service\ContentManager\Domain\Query\FetchFileForPostQuery;
use Service\ContentManager\Domain\Query\FetchPageQuery;
use Service\ContentManager\Domain\Query\FetchPostListQuery;
use Service\ContentManager\Domain\Query\FetchSinglePostQuery;
use Zend\Diactoros\Stream;

class ContentManagerDomainService
{
    /** @var FetchPostListQuery */
    private $fetchPostListQuery;

    /** @var FetchSinglePostQuery */
    private $fetchSinglePostQuery;

    /** @var FetchPageQuery */
    private $fetchPageQuery;

    /** @var FetchFileForPostQuery */
    private $fetchFileForPostQuery;

    /** @var FetchFileForPageQuery */
    private $fetchFileForPageQuery;

    public function __construct(
        FetchPostListQuery $fetchPostListQuery,
        FetchSinglePostQuery $fetchSinglePostQuery,
        FetchPageQuery $fetchPageQuery,
        FetchFileForPostQuery $fetchFileForPostQuery,
        FetchFileForPageQuery $fetchFileForPageQuery
    ) {
        $this->fetchPostListQuery = $fetchPostListQuery;
        $this->fetchSinglePostQuery = $fetchSinglePostQuery;
        $this->fetchPageQuery = $fetchPageQuery;
        $this->fetchFileForPostQuery = $fetchFileForPostQuery;
        $this->fetchFileForPageQuery = $fetchFileForPageQuery;
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

    public function fetchFileForPost(string $postId, string $fileName): Stream
    {
        return $this->fetchFileForPostQuery->execute($postId, $fileName);
    }

    public function fetchFileForPage(string $pageId, string $fileName): Stream
    {
        return $this->fetchFileForPostQuery->execute($pageId, $fileName);
    }
}
