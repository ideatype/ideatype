<?php

declare(strict_types=1);

namespace Endpoint\Post;

use Blast\ReflectionFactory\ReflectionFactory;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                ],
            ],
            'routes' => [
                [
                    'name' => 'get-post',
                    'path' => "/post/:title",
                    'middleware' => [
                    ],
                    'allowed_methods' => ['GET'],
                ],

            ],
        ];
    }
}
