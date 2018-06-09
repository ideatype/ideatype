<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Query;

use Service\PostManager\Domain\Collection\PostMetaCollection;
use Service\PostManager\Infrastructure\Repository\PostReaderRepository;

class FetchPostListQuery
{
    /** @var PostReaderRepository */
    private $postReaderRepository;

    public function __construct(
        PostReaderRepository $postReaderRepository
    ) {
        $this->postReaderRepository = $postReaderRepository;
    }

    public function execute(): PostMetaCollection
    {
        return $this->postReaderRepository->fetchPostList();
    }
}
