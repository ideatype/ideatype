<?php

declare(strict_types=1);

namespace Endpoint\File;

use Blast\ReflectionFactory\ReflectionFactory;
use Endpoint\File\Action\GetFileAction;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    GetFileAction::class => ReflectionFactory::class,
                ],
            ],
            'routes' => [
                [
                    'name' => 'get-file',
                    'path' => "/{type:(?:post|page)}/{id}/{fileName}",
                    'middleware' => [
                        GetFileAction::class
                    ],
                    'allowed_methods' => ['GET'],
                ],
            ],
        ];
    }
}
