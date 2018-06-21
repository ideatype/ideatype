<?php
declare(strict_types=1);

namespace Service\PostManager\Infrastructure\Definition;

interface PostReaderGatewayInterface
{
    public function fetchPostList(): array;
    public function fetchSinglePost(string $postId): ?array;
}
