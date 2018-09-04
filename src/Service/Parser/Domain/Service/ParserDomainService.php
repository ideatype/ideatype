<?php
declare(strict_types=1);

namespace Service\Parser\Domain\Service;

use Service\Parser\Domain\Query\ParseMarkdownQuery;
use Service\Parser\Domain\Query\ParseYamlQuery;
use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileVO;

class ParserDomainService
{
    /** @var ParseMarkdownQuery */
    private $parseMarkdownQuery;

    /** @var ParseYamlQuery */
    private $parseYamlQuery;

    public function __construct(
        ParseMarkdownQuery $parseMarkdownQuery,
        ParseYamlQuery $parseYamlQuery
    ) {
        $this->parseMarkdownQuery = $parseMarkdownQuery;
        $this->parseYamlQuery = $parseYamlQuery;
    }

    public function parseMarkdown(string $content): ParsedContentFileVO
    {
        return $this->parseMarkdownQuery->execute($content);
    }

    public function parseConfig(string $yaml): ParsedConfigFileVO
    {
        return $this->parseYamlQuery->execute($yaml);
    }
}
