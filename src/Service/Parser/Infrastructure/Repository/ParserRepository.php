<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Repository;


use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileMetaVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileVO;
use Service\Parser\Infrastructure\Definition\MarkdownParserGatewayInterface;
use Service\Parser\Infrastructure\Definition\ParserRepositoryInterface;
use Service\Parser\Infrastructure\Definition\YamlParserGatewayInterface;
use Service\Parser\Infrastructure\Gateway\MarkdownParserGateway;

class ParserRepository implements ParserRepositoryInterface
{
    /** @var MarkdownParserGatewayInterface */
    private $markdownParserGateway;

    /** @var YamlParserGatewayInterface */
    private $yamlParserGateway;

    public function __construct(
        MarkdownParserGateway $markdownParserGateway,
        YamlParserGatewayInterface $yamlParserGateway
    ) {
        $this->markdownParserGateway = $markdownParserGateway;
        $this->yamlParserGateway = $yamlParserGateway;
    }

    public function parseMarkdown(string $content): ParsedContentFileVO
    {
        $content = $this->markdownParserGateway->parseContent($content);
        return new ParsedContentFileVO(
            $content['content'],
            new ParsedContentFileMetaVO($content['meta'])
        );
    }

    public function parseYaml(string $content): ParsedConfigFileVO
    {
        $content = $this->yamlParserGateway->parseContent($content);
        return new ParsedConfigFileVO($content);
    }
}
