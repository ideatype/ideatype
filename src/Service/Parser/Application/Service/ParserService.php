<?php
declare(strict_types=1);

namespace Service\Parser\Application\Service;

use Service\Parser\Domain\Service\ParserDomainService;
use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileVO;

class ParserService
{
    /** @var ParserDomainService */
    private $parserDomainService;

    public function __construct(
        ParserDomainService $parserDomainService
    ) {
        $this->parserDomainService = $parserDomainService;
    }

    public function parseMarkdown(string $content): ParsedContentFileVO
    {
        return $this->parserDomainService->parseMarkdown($content);
    }

    public function parseConfig(string $yaml): ParsedConfigFileVO
    {
        return $this->parserDomainService->parseConfig($yaml);
    }
}
