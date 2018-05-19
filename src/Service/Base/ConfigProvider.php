<?php

declare(strict_types=1);

namespace Service\Base;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\Base\Middleware\PrepareRoutesMiddleware;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'invokables' => [
                ],
                'factories'  => [
                    PrepareRoutesMiddleware::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
