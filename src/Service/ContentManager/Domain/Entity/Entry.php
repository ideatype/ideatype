<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Entity;

use Service\ContentManager\Domain\ValueObject\EntryContentVO;

class Entry
{
    /** @var EntryMeta */
    private $meta;

    /** @var EntryContentVO */
    private $contentVO;

    public function __construct(
        EntryMeta $meta,
        EntryContentVO $contentVO
    ) {
        $this->meta = $meta;
        $this->contentVO = $contentVO;
    }

    public function getMeta(): EntryMeta
    {
        return $this->meta;
    }

    public function setMeta(EntryMeta $meta): void
    {
        $this->meta = $meta;
    }

    public function getContent(): EntryContentVO
    {
        return $this->contentVO;
    }

    public function setContent(EntryContentVO $contentVO): void
    {
        $this->contentVO = $contentVO;
    }

    public function toArray(): array
    {
        return [
            'meta' => $this->getMeta()->getMeta(),
            'content' => $this->getContent()->getValue()
        ];
    }
}
