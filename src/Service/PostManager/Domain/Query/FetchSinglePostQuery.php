<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Query;

use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Infrastructure\Repository\PostReaderRepository;

class FetchSinglePostQuery
{
    /** @var PostReaderRepository */
    private $postReaderRepository;

    public function __construct(
        PostReaderRepository $postReaderRepository
    ) {
        $this->postReaderRepository = $postReaderRepository;
    }

    public function execute(string $postId): Post
    {
        return $this->postReaderRepository->fetchSinglePost($postId);
    }
}
