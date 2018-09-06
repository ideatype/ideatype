<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Query;

use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;

class FetchPageQuery
{
    /** @var ContentReaderRepositoryInterface */
    private $contentReaderRepository;

    public function __construct(
        ContentReaderRepositoryInterface $contentReaderRepository
    ) {
        $this->contentReaderRepository = $contentReaderRepository;
    }

    public function execute(string $pageId): Entry
    {
        return $this->contentReaderRepository->fetchPage($pageId);
    }
}
