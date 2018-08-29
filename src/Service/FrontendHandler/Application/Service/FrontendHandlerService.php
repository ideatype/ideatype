<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Application\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Service\FrontendHandler\Domain\Service\FrontendHandlerDomainService;

class FrontendHandlerService
{
    /** @var FrontendHandlerDomainService */
    private $domainService;

    public function __construct(FrontendHandlerDomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        return $this->domainService->handleRequest($request);
    }
}
