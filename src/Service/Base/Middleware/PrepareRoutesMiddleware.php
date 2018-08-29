<?php
declare(strict_types=1);

namespace Service\Base\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Application;

class PrepareRoutesMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Application $application */
        $application = $this->container->get(Application::class);
        $configRoutes = $this->container->get("config")['routes'] ?? [];
        $configApiRoutes = $this->container->get("config")['api_routes'] ?? [];

        foreach ($configRoutes as $configRoute) {
            $route = $application->route(
                $configRoute['path'],
                $configRoute['middleware'],
                $configRoute['allowed_methods'],
                $configRoute['name'] ?? null
            );

            if (isset($configRoute['options'])) {
                $route->setOptions($configRoute['options']);
            }
        }

        foreach ($configApiRoutes as $configRoute) {
            $route = $application->route(
                '/api' . $configRoute['path'],
                $configRoute['middleware'],
                $configRoute['allowed_methods'],
                $configRoute['name'] ?? null
            );

            if (isset($configRoute['options'])) {
                $route->setOptions($configRoute['options']);
            }
        }
        return $handler->handle($request);
    }
}
