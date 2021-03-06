<?php
declare(strict_types=1);

namespace Endpoint\HealthCheck\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SharedLibrary\Response\StandardResponse;

class PingAction implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new StandardResponse(['ping' => "pong"]);
    }
}
