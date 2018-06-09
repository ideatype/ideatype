<?php
declare(strict_types=1);

namespace Service\Parser\Application\Service;

use Service\Parser\Domain\Service\ParserDomainService;
use Service\Parser\Domain\ValueObject\ParsedFileVO;

class ParserService
{
    /** @var ParserDomainService */
    private $parserDomainService;

    public function __construct(
        ParserDomainService $parserDomainService
    ) {
        $this->parserDomainService = $parserDomainService;
    }

    public function parseMarkdown(string $content): ParsedFileVO
    {
        return $this->parserDomainService->parseMarkdown($content);
    }
}
