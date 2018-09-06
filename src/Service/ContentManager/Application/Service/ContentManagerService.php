<?php
declare(strict_types=1);

namespace Service\ContentManager\Application\Service;

use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Service\ContentManagerDomainService;

class ContentManagerService
{
    /** @var ContentManagerDomainService */
    private $contentManagerDomainService;

    public function __construct(
        ContentManagerDomainService $contentManagerDomainService
    ) {
        $this->contentManagerDomainService = $contentManagerDomainService;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->contentManagerDomainService->fetchPostList();
    }

    public function fetchSinglePost(string $postId): Entry
    {
        return $this->contentManagerDomainService->fetchSinglePost($postId);
    }

    public function fetchPage(string $pageId): Entry
    {
        return $this->contentManagerDomainService->fetchPage($pageId);
    }
}
