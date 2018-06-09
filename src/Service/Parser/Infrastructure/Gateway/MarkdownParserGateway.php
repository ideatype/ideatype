<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Gateway;

use MaglMarkdown\Adapter\MichelfPHPMarkdownAdapter;
use MaglMarkdown\Service\Markdown;
use Service\Parser\Infrastructure\Definition\MarkdownParserGatewayInterface;

class MarkdownParserGateway implements MarkdownParserGatewayInterface
{
    /** @var Markdown */
    private $markdownService;

    public function __construct(
    ) {
        $this->markdownService = new Markdown(new MichelfPHPMarkdownAdapter());
    }

    public function parseContent(string $content): array
    {
        $content = $this->markdownService->render($content);
        return ['meta' => [], 'content' => $content];
    }
}
