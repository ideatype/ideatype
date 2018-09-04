<?php

declare(strict_types=1);

namespace Service\ConfigManager;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\ConfigManager\Application\Service\ConfigManagerService;
use Service\ConfigManager\Domain\Query\GetConfigQuery;
use Service\ConfigManager\Domain\Repository\ConfigRepositoryInterface;
use Service\ConfigManager\Domain\Service\ConfigManagerDomainService;
use Service\ConfigManager\Infrastructure\Definition\ConfigGatewayInterface;
use Service\ConfigManager\Infrastructure\Gateway\ConfigGateway;
use Service\ConfigManager\Infrastructure\Repository\ConfigRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    ConfigRepositoryInterface::class => ConfigRepository::class,
                    ConfigGatewayInterface::class => ConfigGateway::class,
                ],
                'factories' => [
                    ConfigManagerService::class => ReflectionFactory::class,
                    GetConfigQuery::class => ReflectionFactory::class,
                    ConfigManagerDomainService::class => ReflectionFactory::class,
                    ConfigGateway::class => ReflectionFactory::class,
                    ConfigRepository::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
