<?php
declare(strict_types=1);

namespace Service\ConfigManager\Domain\Repository;

use Service\ConfigManager\Domain\ValueObject\ConfigVO;

interface ConfigRepositoryInterface
{
    public function getConfig(string $configName): ConfigVO;
}
