<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Query;

use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;
use Zend\Diactoros\Stream;

class FetchFileForPageQuery
{
    /** @var ContentReaderRepositoryInterface */
    private $contentReaderRepository;

    public function __construct(
        ContentReaderRepositoryInterface $contentReaderRepository
    ) {
        $this->contentReaderRepository = $contentReaderRepository;
    }

    public function execute(string $pageId, string $fileName): Stream
    {
        return $this->contentReaderRepository->fetchFile($pageId, $fileName, 'page');
    }
}
