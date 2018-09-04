<?php
declare(strict_types=1);

namespace Service\ConfigManager\Application\Service;

use Service\ConfigManager\Domain\Service\ConfigManagerDomainService;
use Service\ConfigManager\Domain\ValueObject\ConfigVO;

class ConfigManagerService
{
    /** @var ConfigManagerDomainService */
    private $domainService;

    public function __construct(ConfigManagerDomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function getConfig(string $configName): ConfigVO
    {
        return $this->domainService->getConfig($configName);
    }
}
