<?php
declare(strict_types=1);

namespace Service\ConfigManager\Domain\ValueObject;

use Service\Base\ValueObject\BaseVO;

class ConfigVO extends BaseVO
{
    /** @var array */
    private $value;

    public function __construct(
        array $value
    ) {
        $this->value = $value;
    }

    protected function isValid(): bool
    {
        return true;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
