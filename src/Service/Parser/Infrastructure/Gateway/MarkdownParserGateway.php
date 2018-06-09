<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Gateway;

use Mni\FrontYAML\Parser;
use Service\Parser\Infrastructure\Definition\MarkdownParserGatewayInterface;

class MarkdownParserGateway implements MarkdownParserGatewayInterface
{
    /** @var Parser */
    private $yamlParserService;

    public function __construct()
    {
        $this->yamlParserService = new Parser();
    }

    public function parseContent(string $content): array
    {
        $content = $this->yamlParserService->parse($content);
        $yaml = $content->getYAML();

        return [
            'meta' => is_array($yaml) ? $yaml : [],
            'content' => $content->getContent()
        ];
    }
}
