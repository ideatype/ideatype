<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Repository;


use Service\Parser\Domain\ValueObject\ParsedFileVO;
use Service\Parser\Infrastructure\Definition\ParserRepositoryInterface;
use Service\Parser\Infrastructure\Gateway\MarkdownParserGateway;

class ParserRepository implements ParserRepositoryInterface
{
    /** @var MarkdownParserGateway */
    private $markdownParserGateway;

    public function __construct(
        MarkdownParserGateway $markdownParserGateway
    ) {
        $this->markdownParserGateway = $markdownParserGateway;
    }

    public function parseMarkdown(string $content): ParsedFileVO
    {
        $content = $this->markdownParserGateway->parseContent($content);
        return new ParsedFileVO(
            $content['content'],
            $content['meta']
        );
    }
}
