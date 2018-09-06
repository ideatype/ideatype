<?php

declare(strict_types=1);

namespace Service\ContentManager;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\ContentManager\API\ContentManagerAPI;
use Service\ContentManager\Application\Service\ContentManagerService;
use Service\ContentManager\Domain\Query\FetchPageQuery;
use Service\ContentManager\Domain\Query\FetchPostListQuery;
use Service\ContentManager\Domain\Query\FetchSinglePostQuery;
use Service\ContentManager\Domain\Repository\ContentReaderRepositoryInterface;
use Service\ContentManager\Domain\Service\ContentManagerDomainService;
use Service\ContentManager\Infrastructure\Definition\ContentReaderGatewayInterface;
use Service\ContentManager\Infrastructure\Gateway\ContentReaderGateway;
use Service\ContentManager\Infrastructure\Repository\ContentReaderRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    ContentReaderGatewayInterface::class => ContentReaderGateway::class,
                    ContentReaderRepositoryInterface::class => ContentReaderRepository::class
                ],
                'factories' => [
                    ContentManagerAPI::class => ReflectionFactory::class,
                    ContentManagerService::class => ReflectionFactory::class,
                    ContentManagerDomainService::class => ReflectionFactory::class,
                    ContentReaderGateway::class => ReflectionFactory::class,
                    ContentReaderRepository::class => ReflectionFactory::class,
                    FetchPostListQuery::class => ReflectionFactory::class,
                    FetchSinglePostQuery::class => ReflectionFactory::class,
                    FetchPageQuery::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
