<?php
declare(strict_types=1);

namespace Service\Parser\Domain\Service;

use Service\Parser\Domain\Query\ParseMarkdownQuery;
use Service\Parser\Domain\ValueObject\ParsedFileVO;

class ParserDomainService
{
    /** @var ParseMarkdownQuery */
    private $parseMarkdownQuery;

    public function __construct(
        ParseMarkdownQuery $parseMarkdownQuery
    ) {
        $this->parseMarkdownQuery = $parseMarkdownQuery;
    }

    public function parseMarkdown(string $content): ParsedFileVO
    {
        return $this->parseMarkdownQuery->execute($content);
    }
}
