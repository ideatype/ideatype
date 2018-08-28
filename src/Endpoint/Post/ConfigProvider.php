<?php

declare(strict_types=1);

namespace Endpoint\Post;

use Blast\ReflectionFactory\ReflectionFactory;
use Endpoint\Post\Action\GetPostAction;
use Endpoint\Post\Action\PostListAction;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    PostListAction::class => ReflectionFactory::class,
                    GetPostAction::class => ReflectionFactory::class,
                ],
            ],
            'api_routes' => [
                [
                    'name' => 'get-post',
                    'path' => "/post/{postId}",
                    'middleware' => [
                        GetPostAction::class
                    ],
                    'allowed_methods' => ['GET'],
                ],
                [
                    'name' => 'list-posts',
                    'path' => "/posts",
                    'middleware' => [
                        PostListAction::class
                    ],
                    'allowed_methods' => ['GET'],
                ],

            ],
        ];
    }
}
