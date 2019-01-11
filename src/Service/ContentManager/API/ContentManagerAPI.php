<?php
declare(strict_types=1);

namespace Service\ContentManager\API;

use Service\ContentManager\Application\Service\ContentManagerService;
use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Entity\Entry;
use Zend\Diactoros\Stream;

class ContentManagerAPI
{
    /** @var ContentManagerService */
    private $contentManagerService;

    public function __construct(
        ContentManagerService $contentManagerService
    ) {
        $this->contentManagerService = $contentManagerService;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->contentManagerService->fetchPostList();
    }

    public function fetchSinglePost(string $postId): Entry
    {
        return $this->contentManagerService->fetchSinglePost($postId);
    }

    public function fetchPage(string $pageId): Entry
    {
        return $this->contentManagerService->fetchPage($pageId);
    }

    public function fetchFileForPost(string $postId, string $fileName): Stream
    {
        return $this->contentManagerService->fetchFileForPost($postId, $fileName);
    }

    public function fetchFileForPage(string $pageId, string $fileName): Stream
    {
        return $this->contentManagerService->fetchFileForPage($pageId, $fileName);
    }
}
