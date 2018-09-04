<?php
declare(strict_types=1);

namespace Service\ConfigManager\Infrastructure\Repository;

use Service\ConfigManager\Domain\Repository\ConfigRepositoryInterface;
use Service\ConfigManager\Domain\ValueObject\ConfigVO;
use Service\ConfigManager\Infrastructure\Definition\ConfigGatewayInterface;
use Service\Parser\API\ParserAPI;

class ConfigRepository implements ConfigRepositoryInterface
{
    /** @var ConfigGatewayInterface */
    private $configGateway;

    /** @var ParserAPI */
    private $parserAPI;

    public function __construct(
        ConfigGatewayInterface $configGateway,
        ParserAPI $parserAPI
    ) {
        $this->configGateway = $configGateway;
        $this->parserAPI = $parserAPI;
    }

    public function getConfig(string $configName): ConfigVO
    {
        $content = $this->configGateway->getConfigFileContent($configName);
        $parsed = $this->parserAPI->parseConfig($content);
        return new ConfigVO($parsed->getValue());
    }
}
