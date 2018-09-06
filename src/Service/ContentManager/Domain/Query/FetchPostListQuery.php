<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Query;

use Service\ContentManager\Domain\Collection\PostMetaCollection;
use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;

class FetchPostListQuery
{
    /** @var ContentReaderRepositoryInterface */
    private $contentReaderRepository;

    public function __construct(
        ContentReaderRepositoryInterface $contentReaderRepository
    ) {
        $this->contentReaderRepository = $contentReaderRepository;
    }

    public function execute(): PostMetaCollection
    {
        return $this->contentReaderRepository->fetchPostList();
    }
}
