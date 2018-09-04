<?php
declare(strict_types=1);

namespace Service\Parser\Domain\ValueObject;

use Service\Base\ValueObject\BaseVO;

class ParsedContentFileVO extends BaseVO
{
    /** @var string */
    private $htmlContent;

    /** @var ParsedContentFileMetaVO */
    private $meta;

    public function __construct(
        string $htmlContent,
        ParsedContentFileMetaVO $meta
    ) {
        $this->htmlContent = $htmlContent;
        $this->meta = $meta;
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

    public function getMeta(): ParsedContentFileMetaVO
    {
        return $this->meta;
    }
}
