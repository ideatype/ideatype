<?php

declare(strict_types=1);

namespace Endpoint\Page;

use Blast\ReflectionFactory\ReflectionFactory;
use Endpoint\Page\Action\GetPageAction;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    GetPageAction::class => ReflectionFactory::class,
                ],
            ],
            'api_routes' => [
                [
                    'name' => 'get-post',
                    'path' => "/page/{pageId}",
                    'middleware' => [
                        GetPageAction::class
                    ],
                    'allowed_methods' => ['GET'],
                ],
            ],
        ];
    }
}
