<?php
declare(strict_types=1);

namespace Service\Parser\Domain\ValueObject;

use Service\Base\ValueObject\BaseVO;

class ParsedFileMetaVO extends BaseVO
{
    /** @var array*/
    private $content;

    public function __construct(
        array $content
    ) {
        $this->content = $content;
        $this->validate();
    }

    protected function isValid(): bool
    {
        return true;
    }

    public function getValue(): array
    {
        return $this->content;
    }
}
