<?php
declare(strict_types=1);

namespace Endpoint\Page\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\ContentManager\API\ContentManagerAPI;
use Service\ContentManager\Domain\Exception\PageDoesNotExistException;
use SharedLibrary\Response\StandardResponse;

class GetPageAction implements RequestHandlerInterface
{
    /** @var ContentManagerAPI */
    private $postManagerAPI;

    public function __construct(ContentManagerAPI $postManagerAPI)
    {
        $this->postManagerAPI = $postManagerAPI;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $pageId = $request->getAttribute("pageId");

        if (empty($pageId)) {
            return new StandardResponse(['message' => "Page ID missing"], false);
        }

        try {
            $page = $this->postManagerAPI->fetchPage($pageId);
        } catch (PageDoesNotExistException $e) {
            return new StandardResponse(
                [
                    'message' => $e->getMessage()
                ],
                false,
                $e->getCode()
            );
        }

        return new StandardResponse(['page' => $page->toArray()]);
    }
}
