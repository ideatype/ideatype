<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Entity;

class PostMeta
{
    /** @var string */
    private $fileName;

    /** @var array */
    private $content;

    public function __construct(
        string $fileName,
        array $content
    ) {
        $this->fileName = $fileName;
        $this->content = $content;
    }

    public function getMeta(): array
    {
        return $this->content;
    }

    public function setMeta(array $content): void
    {
        $this->content = $content;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function toArray(): array
    {
        return [
            'fileName' => $this->getFileName(),
            'meta' => $this->getMeta()
        ];
    }
}
