<?php

declare(strict_types=1);

namespace Service\PostManager;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\PostManager\API\PostManagerAPI;
use Service\PostManager\Application\Service\PostManagerService;
use Service\PostManager\Domain\Query\FetchPostListQuery;
use Service\PostManager\Domain\Query\FetchSinglePostQuery;
use Service\PostManager\Domain\Service\PostManagerDomainService;
use Service\PostManager\Infrastructure\Definition\PostReaderGatewayInterface;
use Service\PostManager\Infrastructure\Definition\PostReaderRepositoryInterface;
use Service\PostManager\Infrastructure\Gateway\PostReaderGateway;
use Service\PostManager\Infrastructure\Repository\PostReaderRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    PostReaderGatewayInterface::class => PostReaderGateway::class,
                    PostReaderRepositoryInterface::class => PostReaderRepository::class
                ],
                'factories' => [
                    PostManagerAPI::class => ReflectionFactory::class,
                    PostManagerService::class => ReflectionFactory::class,
                    PostManagerDomainService::class => ReflectionFactory::class,
                    PostReaderGateway::class => ReflectionFactory::class,
                    PostReaderRepository::class => ReflectionFactory::class,
                    FetchPostListQuery::class => ReflectionFactory::class,
                    FetchSinglePostQuery::class => ReflectionFactory::class
                ],
            ],
        ];
    }
}
