<?php
declare(strict_types=1);

namespace Service\Base\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Service\FrontendHandler\Application\Service\FrontendHandlerService;

class FrontendTemplateMiddleware implements RequestHandlerInterface
{
    /** @var FrontendHandlerService */
    private $frontendHandlerService;

    public function __construct(
        FrontendHandlerService $frontendHandlerService
    ) {
        $this->frontendHandlerService = $frontendHandlerService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->frontendHandlerService->handleRequest($request);
    }

}
