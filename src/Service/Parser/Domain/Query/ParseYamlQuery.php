<?php
declare(strict_types=1);

namespace Service\Parser\Domain\Query;

use Service\Parser\Domain\ValueObject\ParsedConfigFileVO;
use Service\Parser\Infrastructure\Definition\ParserRepositoryInterface;

class ParseYamlQuery
{
    /** @var ParserRepositoryInterface */
    private $parserRepository;

    public function __construct(
        ParserRepositoryInterface $parserRepository
    ) {
        $this->parserRepository = $parserRepository;
    }

    public function execute(string $content): ParsedConfigFileVO
    {
        return $this->parserRepository->parseYaml($content);
    }
}
