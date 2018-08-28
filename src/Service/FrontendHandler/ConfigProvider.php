<?php

declare(strict_types=1);

namespace Service\FrontendHandler;

use Blast\ReflectionFactory\ReflectionFactory;
use Service\FrontendHandler\Application\Service\FrontendHandlerService;
use Service\FrontendHandler\Domain\Factory\FrontendHandlerDomainServiceFactory;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateExistsQuery;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateHasFileQuery;
use Service\FrontendHandler\Domain\Query\GenerateTemplateFileResponseQuery;
use Service\FrontendHandler\Domain\Repository\TemplateRepositoryInterface;
use Service\FrontendHandler\Domain\Service\FrontendHandlerDomainService;
use Service\FrontendHandler\Infrastructure\Definition\TemplateGatewayInterface;
use Service\FrontendHandler\Infrastructure\Gateway\TemplateGateway;
use Service\FrontendHandler\Infrastructure\Repository\TemplateRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    TemplateRepositoryInterface::class => TemplateRepository::class,
                    TemplateGatewayInterface::class => TemplateGateway::class,
                ],
                'factories' => [
                    FrontendHandlerService::class => ReflectionFactory::class,
                    FrontendHandlerDomainService::class => FrontendHandlerDomainServiceFactory::class,
                    CheckIfTemplateExistsQuery::class => ReflectionFactory::class,
                    CheckIfTemplateHasFileQuery::class => ReflectionFactory::class,
                    GenerateTemplateFileResponseQuery::class => ReflectionFactory::class,
                    TemplateRepository::class => ReflectionFactory::class,
                    TemplateGateway::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
