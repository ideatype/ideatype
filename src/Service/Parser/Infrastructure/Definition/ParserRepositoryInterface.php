<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Definition;


use Service\Parser\Domain\ValueObject\ParsedFileVO;

interface ParserRepositoryInterface
{
    public function parseMarkdown(string $content): ParsedFileVO;
}
