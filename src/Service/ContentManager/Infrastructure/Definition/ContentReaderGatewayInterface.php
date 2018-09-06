<?php
declare(strict_types=1);

namespace Service\ContentManager\Infrastructure\Definition;

interface ContentReaderGatewayInterface
{
    public function fetchPostList(): array;
    public function fetchSinglePost(string $postId): ?array;
    public function fetchPage(string $pageId): ?array;
}
