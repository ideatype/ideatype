<?php
declare(strict_types=1);

namespace Service\PostManager\Application\Service;

use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Domain\Service\PostManagerDomainService;

class PostManagerService
{
    /** @var PostManagerDomainService */
    private $postManagerDomainService;

    public function __construct(
        PostManagerDomainService $postManagerDomainService
    ) {
        $this->postManagerDomainService = $postManagerDomainService;
    }

    public function fetchPostList(): PostMetaCollection
    {
        return $this->postManagerDomainService->fetchPostList();
    }
}
