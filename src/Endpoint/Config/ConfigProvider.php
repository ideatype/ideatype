<?php

declare(strict_types=1);

namespace Endpoint\Config;

use Blast\ReflectionFactory\ReflectionFactory;
use Endpoint\Config\Action\MainConfigAction;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    MainConfigAction::class => ReflectionFactory::class,
                ],
            ],
            'api_routes' => [
                [
                    'name' => 'get-main-config',
                    'path' => "/config/main",
                    'middleware' => [
                        MainConfigAction::class
                    ],
                    'allowed_methods' => ['GET'],
                ],

            ],
        ];
    }
}
