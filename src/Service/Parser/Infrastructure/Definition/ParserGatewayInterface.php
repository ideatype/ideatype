<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Definition;

interface ParserGatewayInterface
{
    public function parseContent(string $content): array;
}
