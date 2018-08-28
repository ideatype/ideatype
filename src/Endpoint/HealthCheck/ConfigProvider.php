<?php

declare(strict_types=1);

namespace Endpoint\HealthCheck;

use Blast\ReflectionFactory\ReflectionFactory;
use Endpoint\HealthCheck\Action\PingAction;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    PingAction::class => ReflectionFactory::class
                ],
            ],
            'api_routes' => [
                [
                    'name' => 'ping',
                    'path' => "/ping",
                    'middleware' => [
                        PingAction::class,
                    ],
                    'allowed_methods' => ['GET'],
                ],

            ],
        ];
    }
}
