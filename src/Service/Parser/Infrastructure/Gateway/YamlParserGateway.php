<?php
declare(strict_types=1);

namespace Service\Parser\Infrastructure\Gateway;

use Service\Parser\Infrastructure\Definition\YamlParserGatewayInterface;
use Symfony\Component\Yaml\Yaml;

class YamlParserGateway implements YamlParserGatewayInterface
{
    public function parseContent(string $content): array
    {
        return Yaml::parse($content);
    }
}
