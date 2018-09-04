<?php
declare(strict_types=1);

namespace Service\ConfigManager\Infrastructure\Definition;

interface ConfigGatewayInterface
{
    public function getConfigFileContent(string $configName): string;
}
