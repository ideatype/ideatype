<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Query;

use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;

class FetchSinglePostQuery
{
    /** @var ContentReaderRepositoryInterface */
    private $contentReaderRepository;

    public function __construct(
        ContentReaderRepositoryInterface $contentReaderRepository
    ) {
        $this->contentReaderRepository = $contentReaderRepository;
    }

    public function execute(string $postId): Entry
    {
        return $this->contentReaderRepository->fetchSinglePost($postId);
    }
}
