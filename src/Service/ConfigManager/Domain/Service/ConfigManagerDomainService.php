<?php
declare(strict_types=1);

namespace Service\ConfigManager\Domain\Service;

use Service\ConfigManager\Domain\Query\GetConfigQuery;
use Service\ConfigManager\Domain\ValueObject\ConfigVO;

class ConfigManagerDomainService
{
    /** @var GetConfigQuery */
    private $query;

    public function __construct(GetConfigQuery $query)
    {
        $this->query = $query;
    }

    public function getConfig(string $configName): ConfigVO
    {
        return $this->query->execute($configName);
    }
}
