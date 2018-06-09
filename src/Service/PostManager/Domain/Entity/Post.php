<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Entity;

use Service\PostManager\Domain\ValueObject\PostContentVO;

class Post
{
    /** @var PostMeta */
    private $meta;

    /** @var PostContentVO */
    private $contentVO;

    public function __construct(
        PostMeta $meta,
        PostContentVO $contentVO
    ) {
        $this->meta = $meta;
        $this->contentVO = $contentVO;
    }

    public function getMeta(): PostMeta
    {
        return $this->meta;
    }

    public function setMeta(PostMeta $meta): void
    {
        $this->meta = $meta;
    }

    public function getContent(): PostContentVO
    {
        return $this->contentVO;
    }

    public function setContent(PostContentVO $contentVO): void
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
