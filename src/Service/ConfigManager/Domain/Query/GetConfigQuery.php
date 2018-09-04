<?php
declare(strict_types=1);

namespace Service\ConfigManager\Domain\Query;

use Service\ConfigManager\Domain\Repository\ConfigRepositoryInterface;
use Service\ConfigManager\Domain\ValueObject\ConfigVO;

class GetConfigQuery
{
    /** @var ConfigRepositoryInterface */
    private $repository;

    public function __construct(ConfigRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $configName): ConfigVO
    {
        return $this->repository->getConfig($configName);
    }
}
