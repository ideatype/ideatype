<?php

declare(strict_types=1);

namespace Service\Base;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\Base\Factory\FrontendTemplateMiddlewareFactory;
use Service\Base\Middleware\CORSOverrideMiddleware;
use Service\Base\Middleware\FrontendTemplateMiddleware;
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
                    CORSOverrideMiddleware::class => ReflectionFactory::class,
                    FrontendTemplateMiddleware::class => ReflectionFactory::class,
                ],
            ],
            'frontend' => [
                'template' => "basic",
                'index_file' => "index.html"
            ] // TODO: move to yaml
        ];
    }
}
