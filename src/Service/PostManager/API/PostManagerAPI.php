<?php
declare(strict_types=1);

namespace Service\PostManager\API;

use Service\PostManager\Application\Service\PostManagerService;
use Service\PostManager\Domain\Collection\PostMetaCollection;

class PostManagerAPI
{
    /** @var PostManagerService */
    private $postManagerService;

    public function __construct(
        PostManagerService $postManagerService
    ) {
        $this->postManagerService = $postManagerService;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->postManagerService->fetchPostList();
    }
}
