<?php
declare(strict_types=1);

namespace Endpoint\Post\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\PostManager\API\PostManagerAPI;
use SharedLibrary\Response\StandardResponse;

class PostListAction implements RequestHandlerInterface
{
    /** @var PostManagerAPI */
    private $postManagerAPI;

    public function __construct(PostManagerAPI $postManagerAPI)
    {
        $this->postManagerAPI = $postManagerAPI;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $postCollection = $this->postManagerAPI->fetchPostList();

        return new StandardResponse(
            [
                'posts' => $postCollection->toArray()
            ]
        );
    }
}
