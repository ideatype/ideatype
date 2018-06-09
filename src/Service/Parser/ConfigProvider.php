<?php

declare(strict_types=1);

namespace Service\Parser;

use Blast\ReflectionFactory\ReflectionFactory;
use MaglMarkdown\Service\Markdown;
use Service\Parser\API\ParserAPI;
use Service\Parser\Application\Service\ParserService;
use Service\Parser\Domain\Query\ParseMarkdownQuery;
use Service\Parser\Domain\Service\ParserDomainService;
use Service\Parser\Infrastructure\Definition\MarkdownParserGatewayInterface;
use Service\Parser\Infrastructure\Definition\ParserRepositoryInterface;
use Service\Parser\Infrastructure\Gateway\MarkdownParserGateway;
use Service\Parser\Infrastructure\Repository\ParserRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    MarkdownParserGatewayInterface::class => MarkdownParserGateway::class,
                    ParserRepositoryInterface::class => ParserRepository::class
                ],
                'factories' => [
                    ParserAPI::class => ReflectionFactory::class,
                    ParserService::class => ReflectionFactory::class,
                    ParserDomainService::class => ReflectionFactory::class,
                    ParserRepository::class => ReflectionFactory::class,
                    MarkdownParserGateway::class => ReflectionFactory::class,
                    ParseMarkdownQuery::class => ReflectionFactory::class
                ],
            ],
        ];
    }
}
