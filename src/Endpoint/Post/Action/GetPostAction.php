<?php
declare(strict_types=1);

namespace Endpoint\Post\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\PostManager\API\PostManagerAPI;
use Service\PostManager\Domain\Exception\PostDoesNotExistException;
use SharedLibrary\Response\StandardResponse;
use Zend\Diactoros\Response\JsonResponse;

class GetPostAction implements RequestHandlerInterface
{
    /** @var PostManagerAPI */
    private $postManagerAPI;

    public function __construct(PostManagerAPI $postManagerAPI)
    {
        $this->postManagerAPI = $postManagerAPI;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $postId = $request->getAttribute("postId");

        if (empty($postId)) {
            return new StandardResponse(['message' => "Post ID missing"], false);
        }

        try {
            $post = $this->postManagerAPI->fetchSinglePost($postId);
        } catch (PostDoesNotExistException $e) {
            return new StandardResponse(
                [
                    'message' => $e->getMessage()
                ],
                false,
                $e->getCode()
            );
        }

        return new StandardResponse(['post' => $post->toArray()]);
    }
}
