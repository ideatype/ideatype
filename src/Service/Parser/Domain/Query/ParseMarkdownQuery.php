<?php
declare(strict_types=1);

namespace Service\Parser\Domain\Query;

use Service\Parser\Domain\ValueObject\ParsedFileVO;
use Service\Parser\Infrastructure\Definition\ParserRepositoryInterface;

class ParseMarkdownQuery
{
    /** @var ParserRepositoryInterface */
    private $parserRepository;

    public function __construct(
        ParserRepositoryInterface $parserRepository
    ) {
        $this->parserRepository = $parserRepository;
    }

    public function execute(string $content): ParsedFileVO
    {
        return $this->parserRepository->parseMarkdown($content);
    }
}
