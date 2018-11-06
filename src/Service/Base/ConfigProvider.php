<?php

declare(strict_types=1);

namespace Service\Base;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\Base\Middleware\CORSOverrideMiddleware;
use Service\Base\Middleware\FrontendTemplateMiddleware;
use Service\Base\Middleware\PrepareRoutesMiddleware;
use Service\Base\Middleware\RequestLanguageMiddleware;
use Service\Base\Service\RequestLanguageManager;

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
                    RequestLanguageMiddleware::class => ReflectionFactory::class,
                    RequestLanguageManager::class => ReflectionFactory::class,
                ],
            ],
            'frontend' => [
                'template' => "basic",
                'index_file' => "index.html"
            ] // TODO: move to yaml
        ];
    }
}
