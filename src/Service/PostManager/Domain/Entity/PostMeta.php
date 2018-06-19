<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Entity;

class PostMeta
{
    /** @var string */
    private $fileName;

    /** @var array */
    private $content;

    /** @var string */
    private $postExcerpt;

    /** @var int */
    private $date;

    public function __construct(
        string $fileName,
        array $content,
        string $postExcerpt,
        int $date
    ) {
        $this->fileName = $fileName;
        $this->content = $content;
        $this->postExcerpt = $postExcerpt;
        $this->date = $date;
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

    public function getPostExcerpt(): string
    {
        return $this->postExcerpt;
    }

    public function setPostExcerpt(string $postExcerpt): void
    {
        $this->postExcerpt = $postExcerpt;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): void
    {
        $this->date = $date;
    }

    public function toArray(): array
    {
        return [
            'fileName' => $this->getFileName(),
            'meta' => array_merge(
                ['time' => $this->getDate()],
                $this->getMeta()
            ),
            'excerpt' => $this->getPostExcerpt()
        ];
    }
}
