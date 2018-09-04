<?php
declare(strict_types=1);

namespace Service\Parser\API;

use Service\Parser\Application\Service\ParserService;
use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileVO;

class ParserAPI
{
    /** @var ParserService */
    private $parserService;

    function __construct(
        ParserService $parserService
    ) {
        $this->parserService = $parserService;
    }

    function parseMarkdown(string $markdown): ParsedContentFileVO
    {
        return $this->parserService->parseMarkdown($markdown);
    }

    function parseConfig(string $yaml): ParsedConfigFileVO
    {
        return $this->parserService->parseConfig($yaml);
    }
}
