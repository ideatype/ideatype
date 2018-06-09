<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\ValueObject;

use Service\Base\ValueObject\BaseVO;

class PostContentVO extends BaseVO
{
    /** @var string */
    private $htmlContent;
    public function __construct(
        string $htmlContent
    ) {
        $this->htmlContent = $htmlContent;
        $this->validate();
    }

    protected function isValid(): bool
    {
        return true;
    }

    public function getValue(): string
    {
        return $this->htmlContent;
    }
}
