<?php
declare(strict_types=1);

namespace Service\FrontendHandler\Domain\Factory;


use Interop\Container\ContainerInterface;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateExistsQuery;
use Service\FrontendHandler\Domain\Query\CheckIfTemplateHasFileQuery;
use Service\FrontendHandler\Domain\Query\GenerateTemplateFileResponseQuery;
use Service\FrontendHandler\Domain\Service\FrontendHandlerDomainService;

class FrontendHandlerDomainServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new FrontendHandlerDomainService(
            $container->get("config")["frontend"],
            $container->get(CheckIfTemplateExistsQuery::class),
            $container->get(CheckIfTemplateHasFileQuery::class),
            $container->get(GenerateTemplateFileResponseQuery::class)
        );
    }
}
