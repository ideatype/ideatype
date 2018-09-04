<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Definition;


use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Domain\ValueObject\ParsedContentFileVO;

interface ParserRepositoryInterface
{
    public function parseMarkdown(string $content): ParsedContentFileVO;
    public function parseYaml(string $content): ParsedConfigFileVO;
}
