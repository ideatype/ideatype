<?php
declare(strict_types=1);

namespace Endpoint\HealthCheck\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SharedLibrary\Response\StandardResponse;
use Zend\Diactoros\Response\JsonResponse;

class GetPostAction implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new StandardResponse();
    }
}
