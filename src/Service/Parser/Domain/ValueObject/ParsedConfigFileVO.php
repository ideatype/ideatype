<?php
declare(strict_types=1);

namespace Service\Parser\Domain\ValueObject;

use Service\Base\ValueObject\BaseVO;

class ParsedConfigFileVO extends BaseVO
{
    /** @var array */
    private $value;

    public function __construct(array $value) {
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
