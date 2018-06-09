<?php
declare(strict_types=1);

namespace Service\Parser\API;

use Service\Parser\Application\Service\ParserService;
use Service\Parser\Domain\ValueObject\ParsedFileVO;

class ParserAPI
{
    /** @var ParserService */
    private $parserService;

    function __construct(
        ParserService $parserService
    ) {
        $this->parserService = $parserService;
    }

    function parseMarkdown(string $markdown): ParsedFileVO
    {
        return $this->parserService->parseMarkdown($markdown);
    }
}
