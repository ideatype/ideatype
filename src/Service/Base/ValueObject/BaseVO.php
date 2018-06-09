<?php
declare(strict_types=1);

namespace Service\Base\ValueObject;

use InvalidArgumentException;

abstract class BaseVO
{
    public function getErrorMessage(): string
    {
        return "Content is not valid";
    }

    protected abstract function isValid(): bool;

    protected function validate(): void
    {
        if (!$this->isValid()) {
            throw new InvalidArgumentException($this->getErrorMessage());
        }
    }

    public abstract function getValue();
}
