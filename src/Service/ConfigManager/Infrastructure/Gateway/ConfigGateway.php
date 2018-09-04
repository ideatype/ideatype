<?php
declare(strict_types=1);

namespace Service\ConfigManager\Infrastructure\Gateway;

use Service\ConfigManager\Infrastructure\Definition\ConfigGatewayInterface;

class ConfigGateway implements ConfigGatewayInterface
{
    public function getConfigFileContent(string $configName): string
    {
        if (!$this->isValidConfigFile($configName)) {
            return "";
        }

        $path = realpath($this->getConfigDir() . '/' . $configName . '.yml');

        $fileContent = @file_get_contents(
            $path
        );
        return $fileContent;
    }

    private function isValidConfigFile(string $configName): bool
    {
        $path = realpath($this->getConfigDir() . '/' . $configName . '.yml');

        if (!$path) {
            return false;
        }

        if (is_file($path)) {
            return true;
        }

        return false;
    }

    private function getConfigDir(): string
    {
        return realpath('config/ideatype/');
    }
}
