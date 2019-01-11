<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Query;

use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;
use Zend\Diactoros\Stream;

class FetchFileForPostQuery
{
    /** @var ContentReaderRepositoryInterface */
    private $contentReaderRepository;

    public function __construct(
        ContentReaderRepositoryInterface $contentReaderRepository
    ) {
        $this->contentReaderRepository = $contentReaderRepository;
    }

    public function execute(string $postId, string $fileName): Stream
    {
        return $this->contentReaderRepository->fetchFile($postId, $fileName, 'post');
    }
}
